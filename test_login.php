<?php
// Test cashier login
require_once 'app/config/config.php';
require_once 'app/libraries/Database.php';

$db = new Database;

echo "=== Testing Cashier Login ===\n\n";

// Get cashier user
$db->query('SELECT * FROM users WHERE username = :username');
$db->bind(':username', 'cashier');
$user = $db->single();

if($user) {
    echo "Cashier user found:\n";
    echo "  Username: " . $user->username . "\n";
    echo "  Email: " . $user->email . "\n";
    echo "  Role: " . $user->role . "\n";
    echo "  Password hash length: " . strlen($user->password) . "\n\n";
    
    // Test password verification
    $test_password = '123456';
    echo "Testing password: '$test_password'\n";
    
    if(password_verify($test_password, $user->password)) {
        echo "✓ Password verification SUCCESSFUL\n";
    } else {
        echo "✗ Password verification FAILED\n";
        
        // Try creating a new hash for comparison
        $new_hash = password_hash($test_password, PASSWORD_DEFAULT);
        echo "\nNew hash generated: " . $new_hash . "\n";
        echo "Current hash: " . $user->password . "\n";
    }
} else {
    echo "Cashier user NOT FOUND in database\n";
}
