<?php
class Pos extends Controller {
    public function __construct(){
        if(!isLoggedIn()){
            redirect('users/login');
        }
        $this->productModel = $this->model('Product');
        $this->saleModel = $this->model('Sale'); // Need to create this
    }

    public function index(){
        $data = [];
        $this->view('pos/index', $data);
    }

    // API to search products
    public function search_products(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $query = trim($_POST['query']);
            $products = $this->productModel->getProducts(); // Ideally filter in SQL
            // Filtering in PHP for now as getProducts returns all (or modify model)
            
            $results = [];
            foreach($products as $product){
                if(stripos($product->name, $query) !== false || stripos($product->barcode, $query) !== false){
                    $results[] = [
                        'id' => $product->id,
                        'name' => $product->name,
                        'barcode' => $product->barcode,
                        'price' => $product->price,
                        'sale_price' => $product->sale_price,
                        'stock' => $product->stock,
                        'category_name' => $product->category_name
                    ];
                }
            }
            echo json_encode($results);
        }
    }

    // API to get product by barcode
    public function get_product(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $barcode = trim($_POST['barcode']);
            $product = $this->productModel->getProductByBarcode($barcode);
            echo json_encode($product);
        }
    }
    
    // Add to cart (Session based)
    // Actually, cart logic can be handled in JS and just sent to server on checkout
    // But secure way is server side session
    
    // Let's implement checkout
    public function checkout(){
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
             $data = json_decode(file_get_contents('php://input'), true);
             
             if(empty($data['cart'])){
                 echo json_encode(['status' => 'error', 'message' => 'Cart is empty']);
                 return;
             }
             
             // Process Sale
             $result = $this->saleModel->createSale($data);
             if($result['status']){
                 echo json_encode(['status' => 'success', 'message' => 'Sale completed', 'sale_id' => $result['sale_id']]);
             } else {
                 echo json_encode(['status' => 'error', 'message' => 'Something went wrong: ' . $result['message']]);
             }
         }
    }
    
    public function receipt($sale_id){
        $sale = $this->saleModel->getSaleById($sale_id);
        $items = $this->saleModel->getSaleItems($sale_id);
        
        $data = [
            'sale' => $sale,
            'items' => $items
        ];
        
        $this->view('pos/receipt', $data);
    }
}
