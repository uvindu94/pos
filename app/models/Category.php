<?php
class Category {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getCategories(){
        $this->db->query('SELECT c.*, p.name as parent_name 
                          FROM categories c 
                          LEFT JOIN categories p ON c.parent_id = p.id 
                          ORDER BY COALESCE(c.parent_id, c.id), c.parent_id IS NOT NULL, c.name');
        return $this->db->resultSet();
    }

    public function getCategoryById($id){
        $this->db->query('SELECT * FROM categories WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function addCategory($data){
        $this->db->query('INSERT INTO categories (name, parent_id) VALUES(:name, :parent_id)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':parent_id', $data['parent_id'] ? $data['parent_id'] : null);
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function updateCategory($data){
        $this->db->query('UPDATE categories SET name = :name, parent_id = :parent_id WHERE id = :id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':parent_id', $data['parent_id'] ? $data['parent_id'] : null);
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function deleteCategory($id){
        $this->db->query('DELETE FROM categories WHERE id = :id');
        $this->db->bind(':id', $id);
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    // Get only parent categories (for dropdown)
    public function getParentCategories(){
        $this->db->query('SELECT * FROM categories WHERE parent_id IS NULL ORDER BY name');
        return $this->db->resultSet();
    }
}
