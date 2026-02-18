<?php
class Dashboard extends Controller {
    public function __construct(){
        if(!isLoggedIn()){
            redirect('users/login');
        }
        $this->saleModel = $this->model('Sale');
        $this->productModel = $this->model('Product');
        
        // Add getStats method to Sale model or create Report model
        // For now, I'll extend Sale model or just do raw queries in Dashboard Controller 
        // But better to use Model. Let's add stats methods to Sale model later.
        // For now, let's assume methods exist or add them.
    }

    public function index(){
        // Get Stats
        $totalRevenue = $this->saleModel->getTotalRevenue();
        $totalOrders = $this->saleModel->getTotalOrders();
        $recentSales = $this->saleModel->getRecentSales();
        $lowStock = $this->productModel->getLowStockProducts();

        $data = [
            'totalRevenue' => $totalRevenue,
            'totalOrders' => $totalOrders,
            'recentSales' => $recentSales,
            'lowStock' => $lowStock
        ];

        $this->view('dashboard/index', $data);
    }
}
