<?php
// Assignment 05 - Hotel Reservation
function h($v) { return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); }

$rates = [
  'Riverside hotel'  => ['Standard Double' => 7500,  'Deluxe Twin Room' => 8500,  'Executive Suite' => 10000],
  'Lagoon view hotel'=> ['Standard Double' => 8500,  'Deluxe Twin Room' => 10000, 'Executive Suite' => 12500],
  'Nature Villa'     => ['Standard Double' => 10000, 'Deluxe Twin Room' => 12500, 'Executive Suite' => 15000],
  'Beach Resort'     => ['Standard Double' => 12500, 'Deluxe Twin Room' => 15000, 'Executive Suite' => 20000],
];
$activityRates = ['Spa' => 5000, 'Cycling' => 400, 'Swimming' => 1000, 'Gym' => 850];

$show = false;
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = trim($_POST['name'] ?? '');
    $in    = $_POST['checkin'] ?? '';
    $out   = $_POST['checkout'] ?? '';
    $hotel = $_POST['hotel'] ?? '';
    $room  = $_POST['room'] ?? '';
    $board = $_POST['board'] ?? '';
    $acts  = $_POST['activity'] ?? [];
    $hours = $_POST['hours'] ?? [];

    if ($name === '') $errors[] = 'Customer name is required.';
    if (!isset($rates[$hotel])) $errors[] = 'Select a hotel.';
    if (!isset($rates[$hotel][$room] )) $errors[] = 'Select a room type.';
    if ($board !== 'Half board' && $board !== 'Full board') $errors[] = 'Select half board or full board.';

    $days = 0;
    try {
        $d1 = new DateTime($in); $d2 = new DateTime($out);
        $days = (int)$d1->diff($d2)->format('%r%a');
    } catch (Exception $e) {}
    if ($days < 1) $errors[] = 'Check-out date must be after the check-in date.';

    if (!$errors) {
        $roomCharge = $rates[$hotel][$room] * $days;
        $boardCharge = ($board === 'Full board') ? 3500 : 0;
        $lines = [];
        $total = $roomCharge + $boardCharge;
        foreach ($acts as $a) {
            if (!isset($activityRates[$a])) continue;
            $hr = (float)($hours[$a] ?? 0);
            if ($hr <= 0) continue;
            $charge = $activityRates[$a] * $hr;
            $lines[] = ["$a ({$hr}h)", $charge];
            $total += $charge;
        }
        $show = true;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Hotel Reservation</title>
<style>
 body { font-family: "Times New Roman", serif; }
 .box { border:1px solid #000; width:560px; padding:10px; margin:15px; }
 td { padding:2px 6px; vertical-align:top; }
 .err { color:#c00; }
</style>
</head>
<body>
<?php if ($show): ?>
 <div class="box">
  <h3 style="text-align:center">Reservation Receipt</h3>
  <b>Customer Name : <?= h($name) ?></b>
  <table width="100%">
   <tr><td></td><td></td><td align="right"><b>Charges (Rs.)</b></td></tr>
   <tr><td>Hotel:</td><td><?= h($hotel) ?></td><td></td></tr>
   <tr><td>Room type:</td><td><?= h($room) ?></td><td></td></tr>
   <tr><td>Number of days you stay:</td><td><?= $days ?></td><td align="right"><?= number_format($roomCharge, 2, '.', '') ?></td></tr>
   <tr><td>Full board/ half board:</td><td><?= h($board) ?></td><td align="right"><?= number_format($boardCharge, 2, '.', '') ?></td></tr>
   <tr><td colspan="3"><b>Activities</b></td></tr>
   <?php foreach ($lines as $l): ?>
    <tr><td><?= h($l[0]) ?></td><td></td><td align="right"><?= number_format($l[1], 2, '.', '') ?></td></tr>
   <?php endforeach; ?>
   <tr><td></td><td><b>Total</b></td><td align="right"><b><?= number_format($total, 2, '.', '') ?></b></td></tr>
  </table>
 </div>
 <a href="assignment5_hotel_reservation.php">Back to form</a>
<?php else: ?>
 <div class="box">
  <?php foreach ($errors as $e): ?><div class="err"><?= h($e) ?></div><?php endforeach; ?>
  <form method="post">
   <table>
    <tr><td>Customer name</td><td colspan="2"><input type="text" name="name" value="<?= h($_POST['name'] ?? '') ?>"></td></tr>
    <tr><td>Check-in date</td><td><input type="date" name="checkin" required></td>
        <td>Check-out date <input type="date" name="checkout" required></td></tr>
    <tr><td>Hotel</td><td colspan="2">
      <select name="hotel">
       <?php foreach (array_keys($rates) as $hn): ?><option><?= h($hn) ?></option><?php endforeach; ?>
      </select></td></tr>
    <tr><td>Room Type</td><td colspan="2">
      <label><input type="radio" name="room" value="Standard Double"> Standard Double</label><br>
      <label><input type="radio" name="room" value="Deluxe Twin Room"> Deluxe Twin Room</label><br>
      <label><input type="radio" name="room" value="Executive Suite"> Executive Suite</label></td></tr>
    <tr><td><b>Activities</b></td><td colspan="2"><b>Number of hours</b></td></tr>
    <?php foreach (array_keys($activityRates) as $a): ?>
     <tr><td><label><input type="checkbox" name="activity[]" value="<?= $a ?>"> <?= $a ?></label></td>
         <td colspan="2"><input type="number" name="hours[<?= $a ?>]" min="0" step="0.5"></td></tr>
    <?php endforeach; ?>
    <tr><td colspan="3">
      <label><input type="radio" name="board" value="Half board"> Half board</label>
      <label><input type="radio" name="board" value="Full board"> Full board</label></td></tr>
    <tr><td colspan="3" align="right"><input type="submit" value="Reserve"></td></tr>
   </table>
  </form>
 </div>
<?php endif; ?>
</body>
</html>
