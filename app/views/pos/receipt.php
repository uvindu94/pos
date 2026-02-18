<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt - <?php echo $data['sale']->invoice_id; ?></title>
    <style>
        body { font-family: 'Courier New', monospace; font-size: 14px; width: 80mm; margin: 0 auto; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .border-top { border-top: 1px dashed #000; }
        .border-bottom { border-bottom: 1px dashed #000; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 5px 0; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="text-center">
        <h3><?php echo SITENAME; ?></h3>
        <p>123 POS Street, Tech City</p>
        <p>Tel: 123-456-7890</p>
    </div>
    
    <div class="border-bottom"></div>
    
    <p>
        Invoice: <?php echo $data['sale']->invoice_id; ?><br>
        Date: <?php echo $data['sale']->created_at; ?><br>
        Cashier: <?php echo $_SESSION['user_name']; ?>
    </p>
    
    <div class="border-bottom"></div>
    
    <table>
        <thead>
            <tr>
                <th class="text-left">Item</th>
                <th class="text-center">Qty</th>
                <th class="text-right">Price</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data['items'] as $item) : ?>
            <tr>
                <td><?php echo $item->product_name; ?></td>
                <td class="text-center"><?php echo $item->quantity; ?></td>
                <td class="text-right"><?php echo number_format($item->price, 2); ?></td>
                <td class="text-right"><?php echo number_format($item->total, 2); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <div class="border-top"></div>
    
    <table>
        <tr>
            <td>Subtotal:</td>
            <td class="text-right"><?php echo CURRENCY; ?><?php echo number_format($data['sale']->subtotal, 2); ?></td>
        </tr>
        <tr>
            <td>Tax:</td>
            <td class="text-right"><?php echo CURRENCY; ?><?php echo number_format($data['sale']->tax, 2); ?></td>
        </tr>
        <tr>
            <td>Discount:</td>
            <td class="text-right">-<?php echo CURRENCY; ?><?php echo number_format($data['sale']->discount, 2); ?></td>
        </tr>
        <tr>
            <td><strong>TOTAL:</strong></td>
            <td class="text-right"><strong><?php echo CURRENCY; ?><?php echo number_format($data['sale']->total, 2); ?></strong></td>
        </tr>
         <tr>
            <td>Payment:</td>
            <td class="text-right"><?php echo ucfirst($data['sale']->payment_method); ?></td>
        </tr>
    </table>
    
    <div class="border-top text-center" style="margin-top: 20px;">
        <p>Thank you for shopping with us!</p>
    </div>
    
    <div class="text-center no-print" style="margin-top: 20px;">
        <button onclick="window.print()">Print</button>
        <button onclick="window.close()">Close</button>
    </div>
    
    <script>
        window.onload = function() {
            // window.print();
        }
    </script>
</body>
</html>
