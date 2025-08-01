<?php

// Test script to verify contact_person handling
require_once 'bootstrap/app.php';

use App\Models\Product;

// Test different input formats
$testCases = [
    '81234567890',     // Expected: 6281234567890
    '081234567890',    // Expected: 6281234567890  
    '6281234567890',   // Expected: 6281234567890
    '+6281234567890',  // Expected: 6281234567890
    '0812-3456-7890',  // Expected: 62812-3456-7890
];

echo "Testing contact_person mutator:\n\n";

foreach ($testCases as $input) {
    $product = new Product();
    $product->contact_person = $input;
    
    echo "Input: '{$input}' -> Stored: '{$product->contact_person}' -> Display: '{$product->contact_person_display}'\n";
}
