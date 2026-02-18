
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
