<?php

namespace App\Http\Controllers\Frontend;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
 
class OrderController extends Controller
{
    /**
     * Display the checkout page.
     */
    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
 
        $subtotal = 0;
        foreach($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
 
        $shipping_zones = \App\Models\ShippingZone::where('is_active', true)->get();
        // Default shipping to 0 if none exist to prevent errors before selection
        $shipping = 0;
        $total = $subtotal;
 
        return view('Frontend.checkout.order', compact('cart', 'subtotal', 'shipping', 'total', 'shipping_zones'));
    }
 
    /**
     * Process order.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'shipping_zone_id' => 'required|exists:shipping_zones,id',
            'payment_method' => 'required|string'
        ]);
 
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Cart is empty');
        }
 
        $subtotal = 0;
        foreach($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        $shippingZone = \App\Models\ShippingZone::find($request->shipping_zone_id);
        $shipping = $shippingZone ? $shippingZone->cost : 0;
        $cityName = $shippingZone ? $shippingZone->name : 'Unknown';

        $total = $subtotal + $shipping;
 
        try {
            DB::beginTransaction();
 
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'full_name' => $request->full_name,
                'email' => auth()->user()->email ?? null,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $cityName,
                'postal_code' => $request->postal_code,
                'total_amount' => $total,
                'shipping_cost' => $shipping,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'order_status' => 'pending'
            ]);
 
            foreach ($cart as $id => $details) {
                $product = Product::find($id);
                if ($product) {
                    $product->decrement('stock_quantity', $details['quantity']);
                }
 
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);
            }
 
            DB::commit();
 
            if ($request->payment_method === 'cod') {
                session()->forget('cart');
                return redirect()->route('payment.success')->with('success', 'Order placed successfully.');
            } else {
                // UddoktaPay cURL Integration
                $baseURL = env('UDDOKTAPAY_API_URL', 'https://sandbox.uddoktapay.com/');
                $apiKEY = env('UDDOKTAPAY_API_KEY', '982d381360a69d419689740d9f2e26ce36fb7a50');
 
                $fields = [
                    'full_name'     => $request->full_name,
                    'email'         => auth()->user()->email ?? 'customer@example.com',
                    'amount'        => $total,
                    'metadata'      => [
                        'order_number' => $order->order_number,
                    ],
                    'redirect_url'  => route('uddoktapay.success'),
                    'return_type'   => 'GET',        
                    'cancel_url'    => route('uddoktapay.cancel'),
                    'webhook_url'   => route('uddoktapay.webhook')
                ];
 
                $curl = curl_init();
                curl_setopt_array($curl, [
                  CURLOPT_URL => rtrim($baseURL, '/') . "/api/checkout-v2",
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "POST",
                  CURLOPT_POSTFIELDS => json_encode($fields),
                  CURLOPT_SSL_VERIFYPEER => false,
                  CURLOPT_SSL_VERIFYHOST => 0,
                  CURLOPT_HTTPHEADER => [
                    "RT-UDDOKTAPAY-API-KEY: " . $apiKEY,
                    "accept: application/json",
                    "content-type: application/json"
                  ],
                ]);
 
                $responseBody = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
 
                if ($err) {
                    return back()->with('error', 'cURL Error: ' . $err);
                }
 
                $response = json_decode($responseBody, true);
 
                if (isset($response['payment_url'])) {
                    return redirect($response['payment_url']);
                } else {
                    return back()->with('error', $response['message'] ?? 'Payment error occurred.');
                }
            }
 
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
 
    /**
     * UddoktaPay Success Callback.
     */
    public function paymentSuccess(Request $request)
    {
        $invoice_id = $request->get('invoice_id');
        if (!$invoice_id) {
            return redirect()->route('checkout')->with('error', 'Invalid Invoice ID');
        }
 
        $baseURL = env('UDDOKTAPAY_API_URL', 'https://sandbox.uddoktapay.com/');
        $apiKEY = env('UDDOKTAPAY_API_KEY', '982d381360a69d419689740d9f2e26ce36fb7a50');
 
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => rtrim($baseURL, '/') . "/api/verify-payment",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => json_encode(['invoice_id' => $invoice_id]),
          CURLOPT_SSL_VERIFYPEER => false,
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_HTTPHEADER => [
            "RT-UDDOKTAPAY-API-KEY: " . $apiKEY,
            "accept: application/json",
            "content-type: application/json"
          ],
        ]);
 
        $responseBody = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($responseBody, true);
 
        if (isset($response['status']) && $response['status'] === 'completed') {
            $order_number = $response['metadata']['order_number'] ?? null;
            $order = Order::where('order_number', $order_number)->first();
            if ($order) {
                $order->update([
                    'payment_status' => 'completed',
                    'transaction_id' => $invoice_id
                ]);
            }
            session()->forget('cart');
            return redirect()->route('payment.success')->with('success', 'Payment successful and order completed!');
        }
 
        return redirect()->route('checkout')->with('error', 'Payment verification failed.');
    }
 
    /**
     * UddoktaPay Cancel Callback.
     */
    public function paymentCancel()
    {
        return redirect()->route('checkout')->with('error', 'Payment was cancelled.');
    }
 
    /**
     * UddoktaPay Webhook.
     */
    public function webhook(Request $request)
    {
        $headerApiKEY = $request->header('RT-UDDOKTAPAY-API-KEY');
        $localApiKEY = env('UDDOKTAPAY_API_KEY', '982d381360a69d419689740d9f2e26ce36fb7a50');
 
        if ($headerApiKEY === $localApiKEY) {
            $data = $request->all();
            if (isset($data['status']) && $data['status'] === 'completed') {
                $order_number = $data['metadata']['order_number'] ?? null;
                $order = Order::where('order_number', $order_number)->first();
                if ($order && $order->payment_status != 'completed') {
                    $order->update([
                        'payment_status' => 'completed',
                        'transaction_id' => $data['invoice_id'] ?? null
                    ]);
                }
            }
            return response('OK', 200);
        }
 
        return response('Invalid IPN', 400);
    }
 
    /**
     * Success page.
     */
    public function success()
    {
        return view('Frontend.checkout.payment_success');
    }
}

