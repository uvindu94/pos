<?php
// Load Config
require_once 'app/config/config.php';
// Load Database Class
require_once 'app/libraries/Database.php';

$db = new Database;

$users = [
    [
        'name' => 'Uvindua Admin',
        'email' => 'uvindua@sltds.lk',
        'username' => 'uvindua',
        'password' => '1234567',
        'role' => 'admin'
    ],
    [
        'name' => 'Sample Cashier',
        'email' => 'cashier@pos.com',
        'username' => 'cashier',
        'password' => '123456',
        'role' => 'cashier'
    ],
    [
        'name' => 'Sample Admin',
        'email' => 'admin@pos.com',
        'username' => 'admin',
        'password' => '123456',
        'role' => 'admin'
    ]
];

echo "--- Seeding Users ---\n";

foreach($users as $user){
    // Check if exists
    $db->query('SELECT id FROM users WHERE email = :email OR username = :username');
    $db->bind(':email', $user['email']);
    $db->bind(':username', $user['username']);
    $db->execute();
    
    if($db->rowCount() > 0){
        echo "[SKIP] User {$user['username']} already exists.\n";
        continue;
    }

    // Hash Password
    $password_hash = password_hash($user['password'], PASSWORD_DEFAULT);
    
    $db->query('INSERT INTO users (name, email, username, password, role) VALUES(:name, :email, :username, :password, :role)');
    $db->bind(':name', $user['name']);
    $db->bind(':email', $user['email']);
    $db->bind(':username', $user['username']);
    $db->bind(':password', $password_hash);
    $db->bind(':role', $user['role']);
    
    if($db->execute()){
         echo "[OK] Created user: {$user['username']} (Role: {$user['role']})\n";
    } else {
         echo "[FAIL] Could not create user: {$user['username']}\n";
    }
}

echo "--- Seeding Completed ---\n";
