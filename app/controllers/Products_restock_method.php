
    public function restock($id){
        // Admin only
        if(!isAdmin()){
            flash('product_message', 'Unauthorized access', 'alert alert-danger');
            redirect('products');
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $quantity = intval(trim($_POST['quantity']));

            if($quantity > 0){
                if($this->productModel->addStock($id, $quantity)){
                    flash('product_message', 'Stock Added Successfully');
                    redirect('products');
                } else {
                    die('Something went wrong');
                }
            } else {
                flash('product_message', 'Invalid quantity', 'alert alert-danger');
                redirect('products');
            }
        } else {
            $product = $this->productModel->getProductById($id);
            
            $data = [
                'product' => $product
            ];

            $this->view('products/restock', $data);
        }
    }
