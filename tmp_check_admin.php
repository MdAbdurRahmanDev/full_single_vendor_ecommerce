<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$count = DB::table('admins')->count();
echo "Admins found: " . $count . "\n";
if ($count > 0) {
    $admin = DB::table('admins')->first();
    echo "Admin Email: " . $admin->email . "\n";
}
