<?php
/**
 * Database Seed Script
 * Run this from the command line or browser to populate sample data
 */

require_once 'app/config/config.php';
require_once 'app/libraries/Database.php';

echo "Starting seeding process...\n";

$db = new Database();

// Clear existing data
echo "Clearing existing products and categories...\n";
$db->query("SET FOREIGN_KEY_CHECKS = 0;");
$db->execute();
$db->query("TRUNCATE TABLE sale_items;");
$db->execute();
$db->query("TRUNCATE TABLE sales;");
$db->execute();
$db->query("TRUNCATE TABLE products;");
$db->execute();
$db->query("TRUNCATE TABLE categories;");
$db->execute();
$db->query("SET FOREIGN_KEY_CHECKS = 1;");
$db->execute();

$categories = [
    ['name' => 'Electronics', 'sub' => ['Smartphones', 'Laptops', 'Wearables', 'Audio']],
    ['name' => 'Beverages', 'sub' => ['Soft Drinks', 'Coffee & Tea', 'Juices', 'Energy Drinks']],
    ['name' => 'Snacks', 'sub' => ['Chips', 'Cookies', 'Chocolate', 'Healthy Snacks']],
    ['name' => 'Home & Living', 'sub' => ['Kitchenware', 'Furniture', 'Decor', 'Bedding']],
    ['name' => 'Clothing', 'sub' => ['Menswear', 'Womenswear', 'Footwear', 'Accessories']]
];

$catMap = [];

foreach ($categories as $catData) {
    // Insert Parent Category
    $db->query("INSERT INTO categories (name) VALUES (:name)");
    $db->bind(':name', $catData['name']);
    $db->execute();
    $parentId = $db->lastInsertId();
    
    foreach ($catData['sub'] as $subName) {
        // Insert Sub Category
        $db->query("INSERT INTO categories (name, parent_id) VALUES (:name, :parent_id)");
        $db->bind(':name', $subName);
        $db->bind(':parent_id', $parentId);
        $db->execute();
        $subId = $db->lastInsertId();
        $catMap[$subName] = $subId;
    }
}

echo "Created " . count($catMap) . " sub-categories.\n";

$products = [
    // Electronics - Smartphones
    ['name' => 'iPhone 15 Pro', 'cat' => 'Smartphones', 'price' => 999.00, 'stock' => 15, 'barcode' => 'APPLE15P'],
    ['name' => 'Samsung S24 Ultra', 'cat' => 'Smartphones', 'price' => 1199.00, 'stock' => 12, 'barcode' => 'SAMG24U'],
    ['name' => 'Pixel 8 Pro', 'cat' => 'Smartphones', 'price' => 899.00, 'stock' => 20, 'barcode' => 'PIX8P'],
    
    // Electronics - Laptops
    ['name' => 'MacBook Air M3', 'cat' => 'Laptops', 'price' => 1199.00, 'stock' => 10, 'barcode' => 'MBAM3'],
    ['name' => 'Dell XPS 13', 'cat' => 'Laptops', 'price' => 999.00, 'stock' => 8, 'barcode' => 'DELLX13'],
    ['name' => 'ASUS ROG Zephyrus', 'cat' => 'Laptops', 'price' => 1499.00, 'stock' => 5, 'barcode' => 'ROGZEP'],
    
    // Electronics - Wearables
    ['name' => 'Apple Watch Series 9', 'cat' => 'Wearables', 'price' => 399.00, 'stock' => 25, 'barcode' => 'AW9'],
    ['name' => 'Galaxy Watch 6', 'cat' => 'Wearables', 'price' => 299.00, 'stock' => 30, 'barcode' => 'GW6'],
    
    // Electronics - Audio
    ['name' => 'AirPods Pro 2', 'cat' => 'Audio', 'price' => 249.00, 'stock' => 40, 'barcode' => 'APRO2'],
    ['name' => 'Sony WH-1000XM5', 'cat' => 'Audio', 'price' => 349.00, 'stock' => 15, 'barcode' => 'SONYX5'],
    
    // Beverages - Soft Drinks
    ['name' => 'Coca Cola 500ml', 'cat' => 'Soft Drinks', 'price' => 1.50, 'stock' => 100, 'barcode' => 'COKE500'],
    ['name' => 'Pepsi 500ml', 'cat' => 'Soft Drinks', 'price' => 1.40, 'stock' => 120, 'barcode' => 'PEPSI500'],
    ['name' => 'Sprite 500ml', 'cat' => 'Soft Drinks', 'price' => 1.45, 'stock' => 90, 'barcode' => 'SPRITE500'],
    ['name' => 'Fanta Orange', 'cat' => 'Soft Drinks', 'price' => 1.45, 'stock' => 80, 'barcode' => 'FANTAO'],
    
    // Beverages - Coffee & Tea
    ['name' => 'Starbucks Latte', 'cat' => 'Coffee & Tea', 'price' => 4.50, 'stock' => 50, 'barcode' => 'SBLATTE'],
    ['name' => 'Lipton Iced Tea', 'cat' => 'Coffee & Tea', 'price' => 2.20, 'stock' => 200, 'barcode' => 'LIPTI'],
    ['name' => 'Nespresso Pods (10x)', 'cat' => 'Coffee & Tea', 'price' => 8.99, 'stock' => 60, 'barcode' => 'NESPOD'],
    
    // Beverages - Juices
    ['name' => 'Orange Juice 1L', 'cat' => 'Juices', 'price' => 3.50, 'stock' => 45, 'barcode' => 'OJ1L'],
    ['name' => 'Apple Juice 1L', 'cat' => 'Juices', 'price' => 3.20, 'stock' => 40, 'barcode' => 'AJ1L'],
    
    // Beverages - Energy Drinks
    ['name' => 'Red Bull 250ml', 'cat' => 'Energy Drinks', 'price' => 2.50, 'stock' => 150, 'barcode' => 'RB250'],
    ['name' => 'Monster Energy', 'cat' => 'Energy Drinks', 'price' => 2.80, 'stock' => 130, 'barcode' => 'MONST'],
    
    // Snacks - Chips
    ['name' => 'Lays Classic', 'cat' => 'Chips', 'price' => 1.99, 'stock' => 200, 'barcode' => 'LAYSCL'],
    ['name' => 'Doritos Nacho Cheese', 'cat' => 'Chips', 'price' => 2.49, 'stock' => 180, 'barcode' => 'DORNC'],
    ['name' => 'Pringles Original', 'cat' => 'Chips', 'price' => 2.99, 'stock' => 150, 'barcode' => 'PRING'],
    
    // Snacks - Cookies
    ['name' => 'Oreo Original', 'cat' => 'Cookies', 'price' => 1.80, 'stock' => 300, 'barcode' => 'OREO'],
    ['name' => 'Chips Ahoy!', 'cat' => 'Cookies', 'price' => 2.20, 'stock' => 250, 'barcode' => 'CAHOY'],
    
    // Snacks - Chocolate
    ['name' => 'Hershey Milk Chocolate', 'cat' => 'Chocolate', 'price' => 1.50, 'stock' => 400, 'barcode' => 'HERSH'],
    ['name' => 'KitKat 4 Finger', 'cat' => 'Chocolate', 'price' => 1.20, 'stock' => 500, 'barcode' => 'KITKAT'],
    ['name' => 'Lindt Excellence 70%', 'cat' => 'Chocolate', 'price' => 4.99, 'stock' => 100, 'barcode' => 'LINDT70'],
    
    // Home & Living - Kitchenware
    ['name' => 'Tefal Frying Pan', 'cat' => 'Kitchenware', 'price' => 29.99, 'stock' => 15, 'barcode' => 'TEFALFP'],
    ['name' => 'Ninja Air Fryer', 'cat' => 'Kitchenware', 'price' => 129.00, 'stock' => 10, 'barcode' => 'NINJAAF'],
    ['name' => 'Knife Set (5pcs)', 'cat' => 'Kitchenware', 'price' => 49.99, 'stock' => 12, 'barcode' => 'KNSET'],
    
    // Home & Living - Furniture
    ['name' => 'Gaming Chair', 'cat' => 'Furniture', 'price' => 199.00, 'stock' => 5, 'barcode' => 'GCHAIR'],
    ['name' => 'Desk Lamp LED', 'cat' => 'Furniture', 'price' => 24.50, 'stock' => 20, 'barcode' => 'DLAMP'],
    
    // Home & Living - Decor
    ['name' => 'Scented Candle Large', 'cat' => 'Decor', 'price' => 15.99, 'stock' => 35, 'barcode' => 'CANDLE'],
    ['name' => 'Wall Clock Minimal', 'cat' => 'Decor', 'price' => 19.99, 'stock' => 15, 'barcode' => 'WCLOCK'],
    
    // Home & Living - Bedding
    ['name' => 'Cotton Bed Sheets King', 'cat' => 'Bedding', 'price' => 45.00, 'stock' => 20, 'barcode' => 'BEDK'],
    ['name' => 'Memory Foam Pillow', 'cat' => 'Bedding', 'price' => 35.00, 'stock' => 25, 'barcode' => 'PILLOW'],
    
    // Clothing - Menswear
    ['name' => 'Cotton T-Shirt Black', 'cat' => 'Menswear', 'price' => 15.00, 'stock' => 100, 'barcode' => 'TSHIRT-M'],
    ['name' => 'Levi 501 Jeans', 'cat' => 'Menswear', 'price' => 59.99, 'stock' => 40, 'barcode' => 'LEVI501'],
    
    // Clothing - Womenswear
    ['name' => 'Floral Summer Dress', 'cat' => 'Womenswear', 'price' => 39.00, 'stock' => 30, 'barcode' => 'DRESS-S'],
    ['name' => 'Yoga Leggings High-Waist', 'cat' => 'Womenswear', 'price' => 25.00, 'stock' => 60, 'barcode' => 'YOGA-L'],
    
    // Clothing - Footwear
    ['name' => 'Nike Air Max 270', 'cat' => 'Footwear', 'price' => 150.00, 'stock' => 25, 'barcode' => 'NIKE270'],
    ['name' => 'Adidas Stan Smith', 'cat' => 'Footwear', 'price' => 90.00, 'stock' => 35, 'barcode' => 'STANSM'],
    ['name' => 'Leather Boots Brown', 'cat' => 'Footwear', 'price' => 120.00, 'stock' => 15, 'barcode' => 'LBOOTS'],
    
    // Clothing - Accessories
    ['name' => 'Ray-Ban Wayfarer', 'cat' => 'Accessories', 'price' => 160.00, 'stock' => 10, 'barcode' => 'RAYBAN'],
    ['name' => 'Leather Wallet Black', 'cat' => 'Accessories', 'price' => 45.00, 'stock' => 50, 'barcode' => 'WALLETL'],
    ['name' => 'Sun Hat Straw', 'cat' => 'Accessories', 'price' => 12.00, 'stock' => 20, 'barcode' => 'SUNHAT'],
    
    // More Snacks
    ['name' => 'Snickers Bar 50g', 'cat' => 'Chocolate', 'price' => 1.00, 'stock' => 600, 'barcode' => 'SNICK'],
    ['name' => 'Granola Bars (Pack of 6)', 'cat' => 'Healthy Snacks', 'price' => 5.50, 'stock' => 80, 'barcode' => 'GRANOL'],
    ['name' => 'Mixed Nuts 200g', 'cat' => 'Healthy Snacks', 'price' => 4.20, 'stock' => 120, 'barcode' => 'MNUTS'],
    ['name' => 'Cheetos Puffs', 'cat' => 'Chips', 'price' => 2.20, 'stock' => 160, 'barcode' => 'CHEET'],
];

echo "Inserting " . count($products) . " products...\n";

foreach ($products as $p) {
    if (isset($catMap[$p['cat']])) {
        $db->query("INSERT INTO products (name, category_id, barcode, price, stock) VALUES (:name, :category_id, :barcode, :price, :stock)");
        $db->bind(':name', $p['name']);
        $db->bind(':category_id', $catMap[$p['cat']]);
        $db->bind(':barcode', $p['barcode']);
        $db->bind(':price', $p['price']);
        $db->bind(':stock', $p['stock']);
        $db->execute();
    } else {
        echo "Warning: Category '{$p['cat']}' not found for product '{$p['name']}'.\n";
    }
}

// Transaction Seeding
echo "Generating 25 random transactions...\n";

// Get all products to pick from
$db->query("SELECT id, price, sale_price FROM products");
$insertedProducts = $db->resultSet();
$paymentMethods = ['cash', 'card', 'cheque'];

for ($i = 0; $i < 25; $i++) {
    $numItems = rand(1, 5);
    $selectedProducts = [];
    $subtotal = 0;
    
    for ($j = 0; $j < $numItems; $j++) {
        $p = $insertedProducts[array_rand($insertedProducts)];
        $qty = rand(1, 3);
        $price = (!empty($p->sale_price)) ? $p->sale_price : $p->price;
        $total = $price * $qty;
        
        $selectedProducts[] = [
            'id' => $p->id,
            'qty' => $qty,
            'price' => $price,
            'total' => $total
        ];
        $subtotal += $total;
    }
    
    $tax = $subtotal * (TAX_RATE / 100);
    $discount = (rand(0, 10) > 8) ? rand(5, 20) : 0; // 20% chance of discount
    $grandTotal = $subtotal + $tax - $discount;
    $paymentMethod = $paymentMethods[array_rand($paymentMethods)];
    $invoiceId = 'INV-' . strtoupper(substr(md5(uniqid()), 0, 8));
    
    // Random date within last 30 days
    $randomDays = rand(0, 30);
    $createdAt = date('Y-m-d H:i:s', strtotime("-$randomDays days " . rand(0, 23) . ":" . rand(0, 59) . ":" . rand(0, 59)));

    // Insert Sale
    $db->query("INSERT INTO sales (invoice_id, subtotal, tax, discount, total, payment_method, created_at) VALUES (:invoice_id, :subtotal, :tax, :discount, :total, :payment_method, :created_at)");
    $db->bind(':invoice_id', $invoiceId);
    $db->bind(':subtotal', $subtotal);
    $db->bind(':tax', $tax);
    $db->bind(':discount', $discount);
    $db->bind(':total', $grandTotal);
    $db->bind(':payment_method', $paymentMethod);
    $db->bind(':created_at', $createdAt);
    $db->execute();
    
    $saleId = $db->lastInsertId();
    
    // Insert Sale Items
    foreach ($selectedProducts as $item) {
        $db->query("INSERT INTO sale_items (sale_id, product_id, quantity, price, total) VALUES (:sale_id, :product_id, :quantity, :price, :total)");
        $db->bind(':sale_id', $saleId);
        $db->bind(':product_id', $item['id']);
        $db->bind(':quantity', $item['qty']);
        $db->bind(':price', $item['price']);
        $db->bind(':total', $item['total']);
        $db->execute();
    }
}

echo "Seeded 25 transactions successfully!\n";
echo "Seeding completed successfully!\n";
