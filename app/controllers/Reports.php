<?php
class Reports extends Controller {
    public function __construct(){
        if(!isLoggedIn()){
            redirect('users/login');
        }
        
        // Only Admin can see reports
        if(!isAdmin()){
            flash('category_message', 'Access denied. Administrator privileges required.', 'alert alert-danger');
            redirect('dashboard');
        }

        $this->saleModel = $this->model('Sale');
    }

    public function index(){
        $start = isset($_GET['start']) ? $_GET['start'] : date('Y-m-01');
        $end = isset($_GET['end']) ? $_GET['end'] : date('Y-m-d');

        // Pagination for Transaction Table
        $limit = 10;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = $page < 1 ? 1 : $page;
        $offset = ($page - 1) * $limit;

        $totalSales = $this->saleModel->getSalesCountByRange($start, $end);
        $sales = $this->saleModel->getSalesByRange($start, $end, $limit, $offset);
        $totalPages = ceil($totalSales / $limit);

        $dailyStats = $this->saleModel->getDailySalesStats($start, $end);
        $topProducts = $this->saleModel->getTopSellingProducts(5);
        $globalStats = $this->saleModel->getGlobalStats($start, $end);

        $data = [
            'sales' => $sales,
            'dailyStats' => $dailyStats,
            'topProducts' => $topProducts,
            'globalStats' => $globalStats,
            'start' => $start,
            'end' => $end,
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'totalResults' => $totalSales
        ];

        $this->view('reports/sales', $data);
    }

    public function salesData(){
        $start = isset($_GET['start']) ? $_GET['start'] : date('Y-m-d', strtotime('-7 days'));
        $end = isset($_GET['end']) ? $_GET['end'] : date('Y-m-d');

        $dailyStats = $this->saleModel->getDailySalesStats($start, $end);
        header('Content-Type: application/json');
        echo json_encode($dailyStats);
    }

    public function exportCsv(){
        $start = isset($_GET['start']) ? $_GET['start'] : date('Y-m-01');
        $end = isset($_GET['end']) ? $_GET['end'] : date('Y-m-d');

        $sales = $this->saleModel->getSalesByRange($start, $end);

        $filename = "sales_report_" . $start . "_to_" . $end . ".csv";
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $output = fopen('php://output', 'w');
        fputcsv($output, ['Invoice ID', 'Cashier', 'Subtotal', 'Tax', 'Discount', 'Total', 'Payment Method', 'Date']);

        foreach($sales as $sale){
            fputcsv($output, [
                $sale->invoice_id,
                $sale->cashier_name,
                $sale->subtotal,
                $sale->tax,
                $sale->discount,
                $sale->total,
                ucfirst($sale->payment_method),
                $sale->created_at
            ]);
        }
        fclose($output);
    }
}
