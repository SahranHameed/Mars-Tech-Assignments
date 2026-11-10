<?php
// Assignment 06 - Internet Usage Bill
function h($v) { return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); }

$packages = ['Basic' => 760, 'Web Lite' => 1520, 'Any Blast' => 2340, 'Family Plan' => 3790];

// Extra GB charges: 1-4 GB Rs.100, 5-19 GB Rs.85, 20-49 GB Rs.75, 50+ GB Rs.60 (each slab charged separately)
function extra_gb_charge($gb) {
    $charge = 0;
    $slabs = [[4, 100], [15, 85], [30, 75], [PHP_INT_MAX, 60]];   // [GB in slab, rate]
    foreach ($slabs as $s) {
        $use = min($gb, $s[0]);
        $charge += $use * $s[1];
        $gb -= $use;
        if ($gb <= 0) break;
    }
    return $charge;
}

$show = false;
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $acc  = trim($_POST['account'] ?? '');
    $type = $_POST['type'] ?? '';
    $pkg  = $_POST['package'] ?? '';
    $gb   = $_POST['gb'] ?? '';

    if ($name === '') $errors[] = "Client's name is required.";
    if (!preg_match('/^\d+$/', $acc)) $errors[] = 'Account number must contain digits only.';
    if ($type !== '4G' && $type !== 'Fiber') $errors[] = 'Select the connection type.';
    if (!isset($packages[$pkg])) $errors[] = 'Select an internet package.';
    if ($gb === '' || !ctype_digit((string)$gb)) $errors[] = 'Extra GB used must be a whole number (0 or more).';

    if (!$errors) {
        $gb = (int)$gb;
        $fiber = ($type === 'Fiber') ? 760 : 0;      // Rs.760 rental for fiber
        $monthly = $packages[$pkg];
        $extra = extra_gb_charge($gb);
        $total = $fiber + $monthly + $extra;
        $show = true;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Internet Usage Bill</title>
<style>
 body { font-family: "Times New Roman", serif; }
 .box { border:1px solid #000; width:620px; padding:12px; margin:15px; }
 td { padding:3px 8px; }
 .err { color:#c00; }
</style>
</head>
<body>
<?php if ($show): ?>
 <div class="box">
  <h2>Internet Usage Bill of Account Number <?= h($acc) ?></h2>
  <b>Customer Name : <?= h($name) ?></b><br>
  <b>Internet Package : <?= h($pkg) ?></b>
  <hr>
  <table width="100%">
   <tr><td></td><td><b>Units</b></td><td><b>Amount</b></td></tr>
   <tr><td>Rental : <?= h($type) ?></td><td></td><td>Rs. <?= $fiber ?></td></tr>
   <tr><td>Monthly Rental</td><td></td><td>Rs. <?= $monthly ?></td></tr>
   <tr><td>Extra GB used</td><td><?= $gb ?></td><td>Rs. <?= $extra ?></td></tr>
   <tr><td>Total</td><td></td><td><b>Rs. <?= $total ?></b></td></tr>
  </table>
 </div>
 <a href="assignment6_internet_bill.php">Back to form</a>
<?php else: ?>
 <div class="box">
  <?php foreach ($errors as $e): ?><div class="err"><?= h($e) ?></div><?php endforeach; ?>
  <form method="post">
   <table>
    <tr><td>Client's name</td><td><input type="text" name="name" value="<?= h($_POST['name'] ?? '') ?>"></td></tr>
    <tr><td>Account number</td><td><input type="text" name="account" value="<?= h($_POST['account'] ?? '') ?>"></td></tr>
    <tr><td>Type</td><td><label><input type="radio" name="type" value="4G"> 4G</label>
                          <label><input type="radio" name="type" value="Fiber"> Fiber</label></td></tr>
    <tr><td>Internet Package</td><td><select name="package">
       <?php foreach (array_keys($packages) as $p): ?><option><?= h($p) ?></option><?php endforeach; ?>
    </select></td></tr>
    <tr><td>Extra GB used</td><td><input type="number" name="gb" min="0" value="0"></td></tr>
    <tr><td></td><td><input type="submit" value="Calculate"></td></tr>
   </table>
  </form>
 </div>
<?php endif; ?>
</body>
</html>
