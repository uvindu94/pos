<?php
class Product {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getProducts($limit = null, $offset = null){
        $sql = 'SELECT products.*, categories.name as category_name 
                FROM products 
                LEFT JOIN categories ON products.category_id = categories.id
                ORDER BY products.created_at DESC';
        
        if($limit !== null && $offset !== null){
            $sql .= ' LIMIT :limit OFFSET :offset';
            $this->db->query($sql);
            $this->db->bind(':limit', (int)$limit);
            $this->db->bind(':offset', (int)$offset);
        } else {
            $this->db->query($sql);
        }

        return $this->db->resultSet();
    }

    public function getProductsCount(){
        $this->db->query('SELECT COUNT(*) as count FROM products');
        $row = $this->db->single();
        return $row->count;
    }

    public function addProduct($data){
        $this->db->query('INSERT INTO products (name, barcode, description, price, sale_price, stock, category_id) VALUES(:name, :barcode, :description, :price, :sale_price, :stock, :category_id)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':barcode', $data['barcode']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':sale_price', $data['sale_price']);
        $this->db->bind(':stock', $data['stock']);
        $this->db->bind(':category_id', $data['category_id']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function updateProduct($data){
        $this->db->query('UPDATE products SET name = :name, barcode = :barcode, description = :description, price = :price, sale_price = :sale_price, stock = :stock, category_id = :category_id WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':barcode', $data['barcode']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':sale_price', $data['sale_price']);
        $this->db->bind(':stock', $data['stock']);
        $this->db->bind(':category_id', $data['category_id']);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function getProductById($id){
        $this->db->query('SELECT * FROM products WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function deleteProduct($id){
        $this->db->query('DELETE FROM products WHERE id = :id');
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function getProductByBarcode($barcode){
        $this->db->query('SELECT * FROM products WHERE barcode = :barcode');
        $this->db->bind(':barcode', $barcode);
        return $this->db->single();
    }

    public function getLowStockProducts(){
        $this->db->query('SELECT * FROM products WHERE stock < 10 ORDER BY stock ASC LIMIT 5');
        return $this->db->resultSet();
    }

    // Add stock to existing product
    public function addStock($product_id, $quantity){
        $this->db->query('UPDATE products SET stock = stock + :quantity WHERE id = :id');
        $this->db->bind(':id', $product_id);
        $this->db->bind(':quantity', $quantity);
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }
}
