<?php
class Sale {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function createSale($data){
        // Start Transaction
        $this->db->dbh->beginTransaction();

        try {
            // 1. Insert into Sales
            $this->db->query('INSERT INTO sales (invoice_id, user_id, subtotal, tax, discount, total, payment_method) VALUES(:invoice_id, :user_id, :subtotal, :tax, :discount, :total, :payment_method)');
            
            // Generate Invoice ID (Simple logic)
            $invoice_id = 'INV-' . time();
            
            $this->db->bind(':invoice_id', $invoice_id);
            $this->db->bind(':user_id', $_SESSION['user_id']); // Assuming logged in
            $this->db->bind(':subtotal', $data['subtotal']);
            $this->db->bind(':tax', $data['tax']);
            $this->db->bind(':discount', $data['discount']);
            $this->db->bind(':total', $data['total']);
            $this->db->bind(':payment_method', $data['payment_method']);
            
            $this->db->execute();
            $sale_id = $this->db->lastInsertId();

            // 2. Insert Sale Items and Update Stock
            foreach($data['cart'] as $item){
                // Check current stock first
                $this->db->query('SELECT stock, name FROM products WHERE id = :id FOR UPDATE');
                $this->db->bind(':id', $item['id']);
                $product = $this->db->single();
                
                if(!$product){
                    throw new Exception("Product ID " . $item['id'] . " not found.");
                }
                
                if($product->stock < $item['qty']){
                    throw new Exception("Insufficient stock for " . $product->name . ". Available: " . $product->stock . ", Requested: " . $item['qty']);
                }

                // Insert Item
                $this->db->query('INSERT INTO sale_items (sale_id, product_id, quantity, price, total) VALUES(:sale_id, :product_id, :quantity, :price, :total)');
                $this->db->bind(':sale_id', $sale_id);
                $this->db->bind(':product_id', $item['id']);
                $this->db->bind(':quantity', $item['qty']);
                $this->db->bind(':price', $item['price']);
                $this->db->bind(':total', $item['price'] * $item['qty']);
                $this->db->execute();

                // Update Stock
                $this->db->query('UPDATE products SET stock = stock - :qty WHERE id = :id');
                $this->db->bind(':qty', $item['qty']);
                $this->db->bind(':id', $item['id']);
                $this->db->execute();
            }

            // Commit
            $this->db->dbh->commit();
            return ['status' => true, 'sale_id' => $sale_id];

        } catch(Exception $e){
            $this->db->dbh->rollBack();
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }
    
    public function getSaleById($id){
        $this->db->query('SELECT * FROM sales WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
    
    public function getSaleItems($sale_id){
         $this->db->query('SELECT sale_items.*, products.name as product_name 
                          FROM sale_items 
                          JOIN products ON sale_items.product_id = products.id 
                          WHERE sale_id = :sale_id');
        $this->db->bind(':sale_id', $sale_id);
        return $this->db->resultSet();
    }

    // Dashboard Stats
    public function getTotalRevenue(){
        $this->db->query('SELECT SUM(total) as revenue FROM sales WHERE DATE(created_at) = CURDATE()');
        $row = $this->db->single();
        return $row->revenue ? $row->revenue : 0;
    }

    public function getTotalOrders(){
        $this->db->query('SELECT COUNT(*) as count FROM sales WHERE DATE(created_at) = CURDATE()');
        $row = $this->db->single();
        return $row->count;
    }

    public function getRecentSales(){
        $this->db->query('SELECT sales.*, users.name as user_name FROM sales JOIN users ON sales.user_id = users.id ORDER BY created_at DESC LIMIT 5');
        return $this->db->resultSet();
    }

    // --- Analytics Methods ---

    public function getSalesByRange($start, $end){
        $this->db->query('SELECT s.*, u.name as cashier_name 
                          FROM sales s 
                          JOIN users u ON s.user_id = u.id 
                          WHERE DATE(s.created_at) BETWEEN :start AND :end 
                          ORDER BY s.created_at DESC');
        $this->db->bind(':start', $start);
        $this->db->bind(':end', $end);
        return $this->db->resultSet();
    }

    public function getDailySalesStats($start, $end){
        $this->db->query('SELECT DATE(created_at) as sale_date, SUM(total) as daily_total, COUNT(*) as order_count 
                          FROM sales 
                          WHERE DATE(created_at) BETWEEN :start AND :end 
                          GROUP BY DATE(created_at) 
                          ORDER BY DATE(created_at) ASC');
        $this->db->bind(':start', $start);
        $this->db->bind(':end', $end);
        return $this->db->resultSet();
    }

    public function getTopSellingProducts($limit = 5){
        $this->db->query('SELECT p.name, SUM(si.quantity) as total_qty, SUM(si.total) as total_revenue, c.name as category_name
                          FROM sale_items si
                          JOIN products p ON si.product_id = p.id
                          JOIN categories c ON p.category_id = c.id
                          GROUP BY si.product_id
                          ORDER BY total_qty DESC
                          LIMIT :limit');
        $this->db->bind(':limit', $limit);
        return $this->db->resultSet();
    }

    public function getGlobalStats($start, $end){
        $this->db->query('SELECT SUM(total) as total_revenue, COUNT(*) as total_orders, AVG(total) as avg_order_value 
                          FROM sales 
                          WHERE DATE(created_at) BETWEEN :start AND :end');
        $this->db->bind(':start', $start);
        $this->db->bind(':end', $end);
        return $this->db->single();
    }
}
