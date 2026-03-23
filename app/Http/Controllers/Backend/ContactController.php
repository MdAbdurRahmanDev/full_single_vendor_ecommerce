<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of inquiries.
     */
    public function index()
    {
        $contacts = Contact::latest()->get();
        return view('Backend.contact.index', compact('contacts'));
    }

    /**
     * Mark inquiry as read.
     */
    public function read(Contact $contact)
    {
        $contact->update(['is_read' => true]);
        return redirect()->back()->with('success', 'Marked as read.');
    }

    /**
     * Remove inquiry.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->back()->with('success', 'Message deleted.');
    }
}
