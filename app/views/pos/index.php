<?php require APPROOT . '/views/inc/header.php'; ?>
<link rel="stylesheet" href="<?php echo URLROOT; ?>/css/pos-premium.css">

<!-- POS Terminal - Premium Split Screen -->
<div class="pos-container">
    <!-- Left Panel - Product Grid (60%) -->
    <div class="product-panel">
        <!-- Search Bar -->
        <div class="pos-search-container">
            <i class="fa fa-search search-icon"></i>
            <input 
                type="text" 
                id="search_product" 
                class="pos-search" 
                placeholder="Search products by name or scan barcode..."
                autocomplete="off"
            >
        </div>

        <!-- Product Grid -->
        <div class="product-list-container">
            <div class="product-grid" id="product-list">
                <!-- Products loaded via AJAX -->
                <div class="col-12 text-center mt-5 text-muted" id="initial-message">
                    <i class="fa fa-barcode fa-4x mb-3 opacity-25"></i>
                    <h3>Start typing or scan a product</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Panel - Cart (40%) -->
    <div class="cart-panel">
        <div class="cart-header">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="cart-title"><i class="ph-bold ph-shopping-cart me-2"></i>Current Sale</h4>
                <span class="badge bg-secondary" id="cart-count">0 Items</span>
            </div>
        </div>

        <div class="cart-container" id="cart-items">
            <!-- Cart items will be loaded here via JS -->
            <div id="empty-cart">
                <i class="fa fa-shopping-basket empty-icon d-block"></i>
                <p>Your cart is empty</p>
            </div>
        </div>

        <div class="cart-footer">
            <div class="total-section">
                <div class="total-row">
                    <span class="total-label">Subtotal</span>
                    <span class="total-value"><?php echo CURRENCY; ?><span id="subtotal">0.00</span></span>
                </div>
                <div class="total-row">
                    <span class="total-label">Tax (<?php echo TAX_RATE; ?>%)</span>
                    <span class="total-value"><?php echo CURRENCY; ?><span id="tax">0.00</span></span>
                </div>
                <div class="total-row align-items-center">
                    <span class="total-label">Discount</span>
                    <div class="input-group input-group-sm w-25">
                         <span class="input-group-text"><?php echo CURRENCY; ?></span>
                         <input type="number" id="discount" class="form-control text-end" value="0">
                    </div>
                </div>
                <div class="total-row final">
                    <span class="total-label">Total</span>
                    <span class="total-value"><?php echo CURRENCY; ?><span id="grand_total">0.00</span></span>
                </div>
            </div>

            <!-- Cash Input Section -->
            <div class="cash-input-container" id="cash-section">
                <label class="form-label fw-bold text-muted mb-1 small">Cash Received:</label>
                <div class="input-group">
                    <span class="input-group-text"><?php echo CURRENCY; ?></span>
                    <input type="number" step="0.01" id="cash_received" class="form-control" placeholder="0.00">
                </div>
            </div>

            <div id="change-display" style="display: none;">
                <div class="change-label">Change Due</div>
                <div class="change-amount"><?php echo CURRENCY; ?><span id="change_amount">0.00</span></div>
            </div>

            <!-- Payment Methods -->
            <div class="payment-methods">
                <div class="payment-method">
                    <input type="radio" name="payment_method" id="pay_cash" value="cash" checked>
                    <label for="pay_cash" class="payment-method-label">
                        <i class="fa fa-money-bill-wave payment-icon"></i>
                        <span class="payment-text">CASH</span>
                    </label>
                </div>
                <div class="payment-method">
                    <input type="radio" name="payment_method" id="pay_card" value="card">
                    <label for="pay_card" class="payment-method-label">
                        <i class="fa fa-credit-card payment-icon"></i>
                        <span class="payment-text">CARD</span>
                    </label>
                </div>
                <div class="payment-method">
                    <input type="radio" name="payment_method" id="pay_cheque" value="cheque">
                    <label for="pay_cheque" class="payment-method-label">
                        <i class="fa fa-money-check payment-icon"></i>
                        <span class="payment-text">CHEQUE</span>
                    </label>
                </div>
            </div>

            <button class="btn btn-success btn-lg w-100" id="btn-checkout">
                <i class="fa fa-check-circle me-2"></i> COMPLETE PAYMENT
            </button>
        </div>
    </div>
</div>

<!-- Global JS Config -->
<script>
    const CURRENCY = '<?php echo CURRENCY; ?>';
    const TAX_RATE = <?php echo TAX_RATE; ?>;
    const URLROOT = '<?php echo URLROOT; ?>';
</script>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo URLROOT; ?>/js/main.js"></script>
<script src="<?php echo URLROOT; ?>/js/pos.js"></script>
</body>
</html>
