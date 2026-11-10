<?php
// Assignment 04 - BMI Calculation
function h($v) { return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); }

function bmi_category($bmi) {
    if ($bmi < 18.5) return 'Under Healthy weight';
    if ($bmi < 25)   return 'Healthy Weight';
    if ($bmi < 30)   return 'Overweight';
    if ($bmi < 35)   return 'Obese I';
    if ($bmi < 40)   return 'Obese II';
    return 'Obese III';
}

$show = false;
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $age = trim($_POST['age'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $contact = trim($_POST['contact'] ?? '');
    $kg = (float)($_POST['weight'] ?? 0);
    $cm = (float)($_POST['height'] ?? 0);

    if ($kg <= 0 || $cm <= 0) {
        $error = 'Please enter a valid weight and height.';
    } else {
        $pounds = $kg * 2.205;            // 1 kg = 2.205 pounds
        $inches = $cm / 2.54;             // 1 inch = 2.54 cm
        $bmi = 703 * $pounds / ($inches * $inches);   // BMI formula for pounds & inches

        $feet = (int)floor($inches / 12);
        $restInches = (int)round($inches - $feet * 12);
        if ($restInches == 12) { $feet++; $restInches = 0; }

        $category = bmi_category($bmi);
        $show = true;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>BMI Calculator</title>
<style>
 body { font-family: Arial, sans-serif; }
 .box { border:1px solid #999; width:650px; padding:15px; margin:15px; }
 table { width:100%; text-align:center; border-collapse:collapse; }
 td, th { padding:6px; }
 .head { border-bottom:1px solid #999; margin-bottom:10px; padding-bottom:8px; }
 .err { color:#c00; }
</style>
</head>
<body>
<?php if ($show): ?>
 <div class="box">
  <div class="head">
   <h3 style="text-align:center">BMI Report of <?= h($name) ?></h3>
   Age: <?= h($age) ?><br>
   Address: <?= h($address) ?><br>
   Contact Number: <?= h($contact) ?>
  </div>
  <table>
   <tr><th>Weight (Pounds)</th><th>Height (Inches)</th><th>BMI</th></tr>
   <tr><td><?= round($pounds) ?></td><td><?= $feet ?>' <?= $restInches ?>''</td><td><?= round($bmi, 1) ?></td></tr>
   <tr><td></td><td><b>Category</b></td><td><b><?= h($category) ?></b></td></tr>
  </table>
 </div>
 <a href="assignment4_bmi.php">Back to form</a>
<?php else: ?>
 <div class="box">
  <?php if ($error): ?><p class="err"><?= h($error) ?></p><?php endif; ?>
  <form method="post">
   <p>Full Name: <input type="text" name="name" required></p>
   <p>Age: <input type="number" name="age" min="1" required></p>
   <p>Address: <input type="text" name="address" required></p>
   <p>Contact Number: <input type="text" name="contact" required></p>
   <p>Weight (Kg): <input type="number" name="weight" step="0.1" min="1" required>
      &nbsp; Height (cm): <input type="number" name="height" step="0.1" min="1" required></p>
   <input type="submit" value="Submit"> <input type="reset" value="Clear">
  </form>
 </div>
<?php endif; ?>
</body>
</html>
