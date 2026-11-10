<?php
// Assignment 03 - ABC Shop Invoice
function h($v) { return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); }

$showInvoice = false;
$items = [];
$totalPrice = 0;
$totalDiscount = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $shop = trim($_POST['shop'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $contact = trim($_POST['contact'] ?? '');
    $email = trim($_POST['email'] ?? '');

    $codes = $_POST['code'] ?? [];
    $names = $_POST['iname'] ?? [];
    $qtys = $_POST['qty'] ?? [];
    $prices = $_POST['price'] ?? [];

    for ($i = 0; $i < count($codes); $i++) {
        if (trim($codes[$i]) === '' && trim($names[$i]) === '') continue;   // skip empty rows
        $qty = (int)$qtys[$i];
        $unit = (float)$prices[$i];
        $line = $qty * $unit;

        // Discount rules (the sample output gives 2% for qty 10 and 10% for qty 23)
        $disc = 0;
        if ($qty > 50) {
            $free = intdiv($qty, 30) * 5;      // 5 free items for every 30 items
            $disc = $free * $unit;
        } elseif ($qty >= 20) {
            $disc = $line * 0.10;
        } elseif ($qty >= 10) {
            $disc = $line * 0.02;
        }
        $items[] = ['code' => $codes[$i], 'name' => $names[$i], 'qty' => $qty, 'line' => $line];
        $totalPrice += $line;
        $totalDiscount += $disc;
    }
    $showInvoice = true;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Shop Invoice</title>
<style>
 body { font-family: Arial, sans-serif; }
 .box { border:1px solid #999; width:700px; padding:15px; margin:15px; }
 table { width:100%; border-collapse:collapse; text-align:center; }
 td, th { padding:6px; }
 .head { border-bottom:1px solid #999; margin-bottom:10px; padding-bottom:8px; }
</style>
</head>
<body>
<?php if ($showInvoice): ?>
 <div class="box">
  <div class="head">
   <h3 style="text-align:center"><?= h($shop) ?> - Invoice</h3>
   Address: <?= h($address) ?><br>
   Contact Number: <?= h($contact) ?><br>
   Email: <?= h($email) ?>
  </div>
  <table>
   <tr><th>Item Code</th><th>Item Name</th><th>Quantity</th><th>Price (Rs:)</th></tr>
   <?php foreach ($items as $it): ?>
    <tr><td><?= h($it['code']) ?></td><td><?= h($it['name']) ?></td><td><?= $it['qty'] ?></td><td><?= number_format($it['line'], 2, '.', '') ?></td></tr>
   <?php endforeach; ?>
   <tr><td></td><td></td><td><b>Discount</b></td><td><b><?= number_format($totalDiscount, 2, '.', '') ?></b></td></tr>
   <tr><td></td><td></td><td><b>Total</b></td><td><b><?= number_format($totalPrice - $totalDiscount, 2, '.', '') ?></b></td></tr>
  </table>
 </div>
 <a href="assignment3_abc_shop_invoice.php">Back to form</a>
<?php else: ?>
 <div class="box">
  <form method="post">
   <p>Shop Name: <input type="text" name="shop" required></p>
   <p>Address: <input type="text" name="address" required></p>
   <p>Contact Number: <input type="text" name="contact" required></p>
   <p>Email Address: <input type="email" name="email" required></p>
   <table>
    <tr><th>Item Code</th><th>Item Name</th><th>Quantity</th><th>Unit Price (Rs:)</th></tr>
    <?php for ($i = 0; $i < 3; $i++): ?>
     <tr>
      <td><input type="text" name="code[]"></td>
      <td><input type="text" name="iname[]"></td>
      <td><input type="number" name="qty[]" min="0"></td>
      <td><input type="number" name="price[]" min="0" step="0.01"></td>
     </tr>
    <?php endfor; ?>
   </table>
   <p><input type="submit" value="Submit"> <input type="reset" value="Clear"></p>
  </form>
 </div>
<?php endif; ?>
</body>
</html>
