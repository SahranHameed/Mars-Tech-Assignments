<?php
// Assignment 02 - Grocery Bill Calculation (form + result in one file)
$prices = ['biscuits' => 50, 'noodles' => 100, 'bread' => 40, 'milk' => 60, 'eggs' => 5, 'dhal' => 75];
$show = false;
$total = 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($prices as $item => $price) {
        $qty = isset($_POST[$item]) ? floatval($_POST[$item]) : 0;
        if ($qty < 0) $qty = 0;              // negative values are ignored
        $total += $qty * $price;
    }
    $show = true;
}
?>
<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Grocery Bill Calculation</title></head>
<body>
<?php if ($show): ?>
  <h1>Your Total Bill</h1>
  <p>Total Bill: Rs<?= $total ?></p>
  <a href="assignment2_bill.php">Go Back</a>
<?php else: ?>
  <h1>Grocery Bill Calculation</h1>
  <form method="post">
    <p>Biscuits (Rs50 each): <input type="number" name="biscuits" value="0" min="0" step="1"></p>
    <p>Noodles (Rs100 each): <input type="number" name="noodles" value="0" min="0" step="1"></p>
    <p>Bread (Rs40 each): <input type="number" name="bread" value="0" min="0" step="1"></p>
    <p>Milk (Rs60 each): <input type="number" name="milk" value="0" min="0" step="1"></p>
    <p>Eggs (Rs5 each): <input type="number" name="eggs" value="0" min="0" step="1"></p>
    <p>Dhal (Rs75 each kg): <input type="number" name="dhal" value="0" min="0" step="0.1"></p>
    <input type="submit" value="Calculate Bill">
  </form>
<?php endif; ?>
</body>
</html>
