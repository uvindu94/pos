// URLROOT is now provided as a global constant from the view
let cart = [];

$(document).ready(function () {
    // Initial Load
    fetchProducts();

    // Search Product
    $('#search_product').on('keyup', function () {
        fetchProducts($(this).val());
    });

    // Checkout
    $('#btn-checkout').click(function () {
        if (cart.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Cart is empty',
                text: 'Please add some products to the cart first.',
                confirmButtonColor: '#4361ee'
            });
            return;
        }

        let payment_method = $('input[name="payment_method"]:checked').val();
        let total = parseFloat($('#grand_total').text());

        // Validate cash payment
        if (payment_method === 'cash') {
            let cashReceived = parseFloat($('#cash_received').val()) || 0;
            if (cashReceived < total) {
                Swal.fire({
                    icon: 'error',
                    title: 'Insufficient Cash',
                    text: 'Cash received (' + CURRENCY + cashReceived.toFixed(2) + ') is less than total amount (' + CURRENCY + total.toFixed(2) + ')',
                    confirmButtonColor: '#4361ee'
                });
                return;
            }
        }

        Swal.fire({
            title: 'Process Payment?',
            text: "Total Amount: " + CURRENCY + total.toFixed(2),
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#4361ee',
            cancelButtonColor: '#secondary',
            confirmButtonText: 'Yes, Complete Sale'
        }).then((result) => {
            if (result.isConfirmed) {
                let subtotal = parseFloat($('#subtotal').text());
                let tax = parseFloat($('#tax').text());
                let discount = parseFloat($('#discount').val()) || 0;

                let saleData = {
                    cart: cart,
                    subtotal: subtotal,
                    tax: tax,
                    discount: discount,
                    total: total,
                    payment_method: payment_method
                };

                $.ajax({
                    url: URLROOT + '/pos/checkout',
                    method: 'POST',
                    data: JSON.stringify(saleData),
                    contentType: 'application/json',
                    success: function (response) {
                        let res = JSON.parse(response);
                        if (res.status === 'success') {
                            cart = [];
                            updateCartUI();
                            $('#discount').val(0);
                            $('#cash_received').val('');
                            $('#change-display').hide();
                            $('#product-search').val('');

                            Swal.fire({
                                icon: 'success',
                                title: 'Sale Completed!',
                                showConfirmButton: false,
                                timer: 1500
                            });

                            // Open Receipt
                            window.open(URLROOT + '/pos/receipt/' + res.sale_id, '_blank', 'width=400,height=600');
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Checkout Failed',
                                text: res.message,
                                confirmButtonColor: '#4361ee'
                            });
                        }
                    }
                });
            }
        });
    });

    // Discount change
    $('#discount').on('input', function () {
        updateCartUI();
    });

    // Cash received change calculation
    $('#cash_received').on('input', function () {
        calculateChange();
    });

    // Payment method change (Radio buttons)
    $('input[name="payment_method"]').on('change', function () {
        if ($(this).val() === 'cash') {
            $('#cash-section').slideDown();
        } else {
            $('#cash-section').slideUp();
            $('#change-display').slideUp();
        }
    });

    // Initial state
    if ($('input[name="payment_method"]:checked').val() !== 'cash') {
        $('#cash-section').hide();
    }
});

function addToCart(id, name, price, stock) {
    let existing = cart.find(item => item.id === id);
    if (existing) {
        if (existing.qty + 1 > stock) {
            Swal.fire({
                icon: 'warning',
                title: 'Stock Limit Reached',
                text: 'Only ' + stock + ' units of ' + name + ' available in inventory.',
                confirmButtonColor: '#4361ee'
            });
            return;
        }
        existing.qty++;
    } else {
        if (1 > stock) {
            Swal.fire({
                icon: 'error',
                title: 'Out of Stock',
                text: name + ' is currently unavailable.',
                confirmButtonColor: '#4361ee'
            });
            return;
        }
        cart.push({ id: id, name: name, price: parseFloat(price), qty: 1, stock: stock });
    }
    updateCartUI();
}

function removeFromCart(id) {
    cart = cart.filter(item => item.id !== id);
    updateCartUI();
}

function updateQty(id, delta) {
    let item = cart.find(item => item.id === id);
    if (item) {
        if (delta > 0 && item.qty + delta > item.stock) {
            Swal.fire({
                icon: 'warning',
                title: 'Stock Limit',
                text: 'Cannot exceed available stock of ' + item.stock + ' units.',
                confirmButtonColor: '#4361ee'
            });
            return;
        }
        item.qty += delta;
        if (item.qty <= 0) {
            removeFromCart(id);
        } else {
            updateCartUI();
        }
    }
}

function setQty(id, val) {
    let item = cart.find(item => item.id === id);
    if (item) {
        let newQty = parseInt(val) || 0;
        if (newQty > item.stock) {
            Swal.fire({
                icon: 'warning',
                title: 'Stock Limit',
                text: 'Only ' + item.stock + ' units available. Quantity capped.',
                confirmButtonColor: '#4361ee'
            });
            item.qty = item.stock; // Cap at max
        } else {
            item.qty = newQty;
        }

        if (item.qty <= 0) {
            removeFromCart(id);
        } else {
            updateCartUI();
        }
    }
}

function updateCartUI() {
    let html = '';
    let subtotal = 0;

    if (cart.length === 0) {
        $('#empty-cart').show();
        $('#cart-items').html('<div id="empty-cart"><i class="fa fa-shopping-basket empty-icon d-block"></i><p>Your cart is empty</p></div>');
    } else {
        $('#empty-cart').hide();
        cart.forEach(item => {
            let total = item.price * item.qty;
            subtotal += total;
            html += `
                <div class="cart-item">
                    <div class="cart-item-details">
                        <div class="cart-item-name">${item.name}</div>
                        <div class="cart-item-price">${CURRENCY}${item.price.toFixed(2)} x ${item.qty} = <strong>${CURRENCY}${total.toFixed(2)}</strong></div>
                    </div>
                    <div class="cart-item-controls">
                        <button class="qty-btn" onclick="updateQty(${item.id}, -1)"><i class="fa fa-minus"></i></button>
                        <span class="qty-display">${item.qty}</span>
                        <button class="qty-btn" onclick="updateQty(${item.id}, 1)"><i class="fa fa-plus"></i></button>
                        <button class="remove-item ms-2" onclick="removeFromCart(${item.id})"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            `;
        });
        $('#cart-items').html(html);
    }

    let tax = subtotal * (TAX_RATE / 100);
    let discount = parseFloat($('#discount').val()) || 0;
    let grand_total = subtotal + tax - discount;

    $('#subtotal').text(subtotal.toFixed(2));
    $('#tax').text(tax.toFixed(2));
    $('#grand_total').text(grand_total.toFixed(2));

    // Update count
    let totalQty = cart.reduce((acc, item) => acc + item.qty, 0);
    $('#cart-count').text(totalQty + ' Items');

    // Recalculate change if cash is active
    if ($('input[name="payment_method"]:checked').val() === 'cash') {
        calculateChange();
    }
}

function calculateChange() {
    let total = parseFloat($('#grand_total').text()) || 0;
    let cashReceived = parseFloat($('#cash_received').val()) || 0;

    if (cashReceived >= total && cashReceived > 0) {
        let change = cashReceived - total;
        $('#change_amount').text(change.toFixed(2));
        $('#change-display').slideDown();
    } else {
        $('#change-display').slideUp();
    }
}

function fetchProducts(query = '') {
    $.ajax({
        url: URLROOT + '/pos/search_products',
        method: 'POST',
        data: { query: query },
        success: function (response) {
            let products = JSON.parse(response);
            let output = '';
            if (products.length > 0) {
                products.forEach(p => {
                    output += `
                        <div class="pos-product-card" onclick="addToCart(${p.id}, '${p.name.replace(/'/g, "\\'")}', ${p.price}, ${p.stock})">
                            <div class="product-info">
                                <div class="product-name" title="${p.name}">${p.name}</div>
                                <div class="product-price">${CURRENCY}${parseFloat(p.price).toFixed(2)}</div>
                            </div>
                            <div class="product-stock">
                                <span class="badge ${p.stock < 10 ? 'bg-danger' : 'bg-secondary'}">Stock: ${p.stock}</span>
                            </div>
                        </div>
                    `;
                });
            } else {
                output = '<div class="col-12 text-center text-muted p-5">No products found</div>';
            }
            $('#product-list').html(output);
            $('#initial-message').hide();
        }
    });
}
