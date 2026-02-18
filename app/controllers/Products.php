<?php
class Products extends Controller {
    public function __construct(){
        if(!isLoggedIn()){
            redirect('users/login');
        }

        $this->productModel = $this->model('Product');
        $this->categoryModel = $this->model('Category');
    }

    public function index(){
        // Pagination logic
        $limit = 8;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = $page < 1 ? 1 : $page;
        $offset = ($page - 1) * $limit;

        $totalProducts = $this->productModel->getProductsCount();
        $products = $this->productModel->getProducts($limit, $offset);
        $totalPages = ceil($totalProducts / $limit);

        $data = [
            'products' => $products,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalResults' => $totalProducts
        ];

        $this->view('products/index', $data);
    }

    public function add(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'barcode' => trim($_POST['barcode']),
                'description' => trim($_POST['description']),
                'price' => trim($_POST['price']),
                'sale_price' => !empty($_POST['sale_price']) ? trim($_POST['sale_price']) : NULL,
                'stock' => trim($_POST['stock']),
                'category_id' => trim($_POST['category_id']),
                'name_err' => '',
                'barcode_err' => '',
                'price_err' => '',
                'sale_price_err' => ''
            ];

            // Validate Name
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter name';
            }
            if(empty($data['barcode'])){
                $data['barcode_err'] = 'Please enter barcode';
            }
            if(empty($data['price'])){
                $data['price_err'] = 'Please enter price';
            }

            // Validate Sale Price
            if(!empty($data['sale_price'])){
                if(!is_numeric($data['sale_price'])){
                    $data['sale_price_err'] = 'Sale price must be a number';
                } elseif($data['sale_price'] >= $data['price']){
                    $data['sale_price_err'] = 'Sale price should be less than regular price';
                }
            }

            // Make sure no errors
            if(empty($data['name_err']) && empty($data['barcode_err']) && empty($data['price_err']) && empty($data['sale_price_err'])){
                // Validated
                if($this->productModel->addProduct($data)){
                    flash('product_message', 'Product Added');
                    redirect('products');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $categories = $this->categoryModel->getCategories();
                $data['categories'] = $categories;
                $this->view('products/add', $data);
            }

        } else {
            $categories = $this->categoryModel->getCategories();

            $data = [
                'name' => '',
                'barcode' => '',
                'description' => '',
                'price' => '',
                'sale_price' => '',
                'stock' => '',
                'category_id' => '',
                'categories' => $categories
            ];

            $this->view('products/add', $data);
        }
    }

    public function edit($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'barcode' => trim($_POST['barcode']),
                'description' => trim($_POST['description']),
                'price' => trim($_POST['price']),
                'sale_price' => !empty($_POST['sale_price']) ? trim($_POST['sale_price']) : NULL,
                'stock' => trim($_POST['stock']),
                'category_id' => trim($_POST['category_id']),
                'name_err' => '',
                'barcode_err' => '',
                'price_err' => '',
                'sale_price_err' => ''
            ];

            // Validate Name
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter name';
            }
            if(empty($data['barcode'])){
                $data['barcode_err'] = 'Please enter barcode';
            }
            if(empty($data['price'])){
                $data['price_err'] = 'Please enter price';
            }

            // Validate Sale Price
            if(!empty($data['sale_price'])){
                if(!is_numeric($data['sale_price'])){
                    $data['sale_price_err'] = 'Sale price must be a number';
                } elseif($data['sale_price'] >= $data['price']){
                    $data['sale_price_err'] = 'Sale price should be less than regular price';
                }
            }

            // Make sure no errors
            if(empty($data['name_err']) && empty($data['barcode_err']) && empty($data['price_err']) && empty($data['sale_price_err'])){
                // Validated
                if($this->productModel->updateProduct($data)){
                    flash('product_message', 'Product Updated');
                    redirect('products');
                } else {
                    die('Something went wrong');
                }
            } else {
                // Load view with errors
                $categories = $this->categoryModel->getCategories();
                $data['categories'] = $categories;
                $this->view('products/edit', $data);
            }

        } else {
            // Get product from model
            $product = $this->productModel->getProductById($id);
            $categories = $this->categoryModel->getCategories();

            // Check for owner
            // if($product->user_id != $_SESSION['user_id']){
            //     redirect('products');
            // }

            $data = [
                'id' => $id,
                'name' => $product->name,
                'barcode' => $product->barcode,
                'description' => $product->description,
                'price' => $product->price,
                'sale_price' => $product->sale_price,
                'stock' => $product->stock,
                'category_id' => $product->category_id,
                'categories' => $categories
            ];

            $this->view('products/edit', $data);
        }
    }

    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->productModel->deleteProduct($id)){
                flash('product_message', 'Product Removed');
                redirect('products');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('products');
        }
    }

    public function restock($id){
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
}
