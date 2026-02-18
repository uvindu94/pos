
    public function getLowStockProducts(){
        $this->db->query('SELECT * FROM products WHERE stock < 10 ORDER BY stock ASC LIMIT 5');
        return $this->db->resultSet();
    }
