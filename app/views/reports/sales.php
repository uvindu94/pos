<?php require APPROOT . '/views/inc/header.php'; ?>

<div class="container-fluid py-4 pb-5">
    <!-- Header & Filters -->
    <div class="row mb-5 align-items-center">
        <div class="col-md-6">
            <h1 class="h2 mb-1 fw-bold text-dark">Sales Analytics</h1>
            <p class="text-secondary mb-0">Deep dive into your store's performance metrics</p>
        </div>
        <div class="col-md-6 mt-3 mt-md-0">
            <form action="<?php echo URLROOT; ?>/reports" method="get" class="d-flex gap-2 justify-content-md-end">
                <div class="input-group glass shadow-sm rounded-pill overflow-hidden border-0 px-3" style="width: auto;">
                    <span class="input-group-text bg-transparent border-0"><i class="ph ph-calendar text-primary"></i></span>
                    <input type="date" name="start" class="form-control bg-transparent border-0 shadow-none py-2" value="<?php echo $data['start']; ?>">
                    <span class="input-group-text bg-transparent border-0 text-secondary small">to</span>
                    <input type="date" name="end" class="form-control bg-transparent border-0 shadow-none py-2" value="<?php echo $data['end']; ?>">
                </div>
                <button type="submit" class="btn btn-primary rounded-pill px-4">
                    <i class="ph-bold ph-funnel me-2"></i>Apply
                </button>
                <a href="<?php echo URLROOT; ?>/reports/exportCsv?start=<?php echo $data['start']; ?>&end=<?php echo $data['end']; ?>" class="btn btn-outline-primary rounded-pill px-4">
                    <i class="ph-bold ph-file-csv me-2"></i>Export
                </a>
            </form>
        </div>
    </div>

    <!-- Summary Stats -->
    <div class="row g-4 mb-5">
        <div class="col-xl-4 col-md-6">
            <div class="glass-card p-4 border-0 border-start border-4 border-primary h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-secondary fw-bold small text-uppercase ls-wide">Total Revenue</span>
                    <div class="p-2 bg-primary bg-opacity-10 rounded-circle"><i class="ph-fill ph-money text-primary"></i></div>
                </div>
                <h2 class="display-6 fw-bold mb-1 text-dark">$<?php echo number_format($data['globalStats']->total_revenue, 2); ?></h2>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-primary" style="width: 100%"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="glass-card p-4 border-0 border-start border-4 border-success h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-secondary fw-bold small text-uppercase ls-wide">Total Orders</span>
                    <div class="p-2 bg-success bg-opacity-10 rounded-circle"><i class="ph-fill ph-shopping-cart-simple text-success"></i></div>
                </div>
                <h2 class="display-6 fw-bold mb-1 text-dark"><?php echo $data['globalStats']->total_orders; ?></h2>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar bg-success" style="width: 100%"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-12">
            <div class="glass-card p-4 border-0 border-start border-4 border-purple h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-secondary fw-bold small text-uppercase ls-wide">Avg. Order Value</span>
                    <div class="p-2 bg-purple bg-opacity-10 rounded-circle" style="color: #8B5CF6;"><i class="ph-fill ph-chart-pie"></i></div>
                </div>
                <h2 class="display-6 fw-bold mb-1 text-dark">$<?php echo number_format($data['globalStats']->avg_order_value, 2); ?></h2>
                <div class="progress mt-3" style="height: 6px;">
                    <div class="progress-bar" style="width: 100%; background-color: #8B5CF6;"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row g-4 mb-5">
        <div class="col-lg-8">
            <div class="glass-card p-4 h-100 shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0 text-dark"><i class="ph-bold ph-chart-line me-2 text-primary"></i>Revenue Trend</h5>
                    <div class="badge bg-light text-primary border border-primary border-opacity-10 py-2 px-3">
                        <?php echo date('M d', strtotime($data['start'])); ?> - <?php echo date('M d', strtotime($data['end'])); ?>
                    </div>
                </div>
                <div id="salesChart" style="min-height: 350px;"></div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="glass-card p-4 h-100 shadow-sm border-0">
                <h5 class="fw-bold mb-4 text-dark"><i class="ph-bold ph-crown-simple me-2 text-warning"></i>Top Products</h5>
                <div class="d-flex flex-column gap-3">
                    <?php if(empty($data['topProducts'])) : ?>
                        <div class="text-center py-5 text-muted">No sales data yet.</div>
                    <?php else : ?>
                        <?php foreach($data['topProducts'] as $index => $product) : ?>
                            <div class="d-flex align-items-center p-3 rounded-4 bg-light bg-opacity-50 border border-white border-opacity-20 shadow-sm">
                                <div class="bg-primary bg-opacity-10 text-primary fw-bold rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 32px; height: 32px; flex-shrink: 0;">
                                    <?php echo $index + 1; ?>
                                </div>
                                <div class="flex-grow-1 min-width-0">
                                    <div class="fw-bold text-dark text-truncate"><?php echo $product->name; ?></div>
                                    <div class="small text-secondary"><?php echo $product->category_name; ?></div>
                                </div>
                                <div class="text-end ms-3">
                                    <div class="fw-bold text-primary"><?php echo $product->total_qty; ?> units</div>
                                    <div class="small text-muted">$<?php echo number_format($product->total_revenue, 2); ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed Transactions -->
    <div class="glass-card shadow-sm border-0">
        <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center border-bottom border-light">
            <h5 class="m-0 fw-bold text-dark"><i class="ph-bold ph-list-numbers me-2 text-primary"></i>Transaction History</h5>
            <span class="badge bg-light text-secondary px-3 py-2 border rounded-pill">Total: <?php echo count($data['sales']); ?> Sales</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th class="ps-4">Invoice ID</th>
                            <th>Cashier</th>
                            <th class="text-end">Discount</th>
                            <th class="text-end">Total</th>
                            <th class="text-center">Method</th>
                            <th class="text-center">Created At</th>
                            <th class="pe-4 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($data['sales'] as $sale) : ?>
                        <tr>
                            <td class="ps-4 align-middle">
                                <span class="badge bg-secondary bg-opacity-10 text-dark border border-secondary border-opacity-20 px-2 py-1"><?php echo $sale->invoice_id; ?></span>
                            </td>
                            <td class="align-middle fw-medium"><?php echo $sale->cashier_name; ?></td>
                            <td class="align-middle text-end text-danger">$<?php echo number_format($sale->discount, 2); ?></td>
                            <td class="align-middle text-end">
                                <span class="h6 mb-0 fw-bold text-dark">$<?php echo number_format($sale->total, 2); ?></span>
                            </td>
                            <td class="align-middle text-center">
                                <?php 
                                    $icon = 'ph ph-money'; $color = 'success';
                                    if($sale->payment_method == 'card') { $icon = 'ph ph-credit-card'; $color = 'primary'; }
                                    if($sale->payment_method == 'cheque') { $icon = 'ph ph-bank'; $color = 'warning'; }
                                ?>
                                <span class="badge bg-<?php echo $color; ?> bg-opacity-10 text-<?php echo $color; ?> border border-<?php echo $color; ?> border-opacity-25 px-3 py-2">
                                    <i class="<?php echo $icon; ?> me-1"></i> <?php echo ucfirst($sale->payment_method); ?>
                                </span>
                            </td>
                            <td class="align-middle text-center text-muted small">
                                <?php echo date('M d, Y', strtotime($sale->created_at)); ?><br>
                                <?php echo date('H:i A', strtotime($sale->created_at)); ?>
                            </td>
                            <td class="pe-4 align-middle text-center">
                                <a href="<?php echo URLROOT; ?>/pos/receipt/<?php echo $sale->id; ?>" target="_blank" class="btn btn-sm btn-light rounded-pill p-3" title="Print Receipt">
                                    <i class="ph-bold ph-printer text-primary"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Prepare Data for ApexCharts
    const stats = <?php echo json_encode($data['dailyStats']); ?>;
    
    // Fallback for empty data
    if (stats.length === 0) {
        document.getElementById('salesChart').innerHTML = '<div class="text-center py-5 text-muted">No data available for this range.</div>';
        return;
    }

    const categories = stats.map(s => {
        const date = new Date(s.sale_date);
        return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric' });
    });
    const revenueData = stats.map(s => parseFloat(s.daily_total));

    const options = {
        series: [{
            name: 'Daily Revenue',
            data: revenueData
        }],
        chart: {
            height: 350,
            type: 'area',
            toolbar: {
                show: false
            },
            animations: {
                enabled: true,
                easing: 'easeinout',
                speed: 800,
                animateGradually: {
                    enabled: true,
                    delay: 150
                },
                dynamicAnimation: {
                    enabled: true,
                    speed: 350
                }
            },
            fontFamily: 'Inter, sans-serif'
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth',
            width: 3,
            colors: ['#4361EE']
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.45,
                opacityTo: 0.05,
                stops: [20, 100, 100, 100]
            }
        },
        colors: ['#4361EE'],
        grid: {
            borderColor: 'rgba(0, 0, 0, 0.05)',
            strokeDashArray: 4,
            xaxis: {
                lines: {
                    show: false
                }
            }
        },
        xaxis: {
            categories: categories,
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            },
            labels: {
                style: {
                    colors: '#6B7280',
                    fontSize: '11px'
                }
            }
        },
        yaxis: {
            labels: {
                formatter: function (value) {
                    return "$" + value.toLocaleString();
                },
                style: {
                    colors: '#6B7280',
                    fontSize: '11px'
                }
            }
        },
        tooltip: {
            theme: 'dark',
            x: {
                show: true
            },
            y: {
                formatter: function (value) {
                    return "$" + value.toLocaleString();
                }
            }
        },
        markers: {
            size: 5,
            colors: ['#4361EE'],
            strokeColors: '#fff',
            strokeWidth: 2,
            hover: {
                size: 7
            }
        }
    };

    const chart = new ApexCharts(document.querySelector("#salesChart"), options);
    chart.render();
});
</script>

<style>
/* Gradient styles used in summary cards */
.border-success { border-color: var(--accent-success) !important; }
.border-purple { border-color: #8B5CF6 !important; }
.bg-purple { background-color: #8B5CF6 !important; }
</style>

<?php require APPROOT . '/views/inc/footer.php'; ?>
