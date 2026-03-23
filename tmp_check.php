<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

try {
    $db = DB::getDatabaseName();
    echo "Current DB: " . $db . "\n";
    $exists = Schema::hasTable('faqs');
    echo "Table 'faqs' exists: " . ($exists ? "YES" : "NO") . "\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
