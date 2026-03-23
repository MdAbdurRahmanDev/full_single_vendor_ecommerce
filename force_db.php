<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

try {
    echo "Current DB: " . DB::getDatabaseName() . "\n";
    
    // Force Create FAQs
    DB::statement("DROP TABLE IF EXISTS faqs");
    DB::statement("CREATE TABLE faqs (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        question VARCHAR(255) NOT NULL,
        answer TEXT NOT NULL,
        order_num INT DEFAULT 0,
        status TINYINT(1) DEFAULT 1,
        created_at TIMESTAMP NULL,
        updated_at TIMESTAMP NULL
    )");
    echo "Forced table 'faqs' creation.\n";

    // Force Create Contacts
    DB::statement("DROP TABLE IF EXISTS contacts");
    DB::statement("CREATE TABLE contacts (
        id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        subject VARCHAR(255) NULL,
        message TEXT NOT NULL,
        is_read TINYINT(1) DEFAULT 0,
        created_at TIMESTAMP NULL,
        updated_at TIMESTAMP NULL
    )");
     echo "Forced table 'contacts' creation.\n";

    $exists = Schema::hasTable('faqs');
    echo "Verification - Table 'faqs' exists: " . ($exists ? "YES" : "NO") . "\n";

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
