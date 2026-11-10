<?php
// Assignment 01 - Job Application Form + PHP Validation
function h($v) { return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8'); }

$errors = [];
$success = false;
$positions = ['Software Developer', 'Web Designer', 'Project Manager'];
$allSkills = ['HTML', 'CSS', 'JavaScript', 'PHP', 'Java'];

$name = $email = $phone = $dob = $position = $cover = $linkedin = $experience = '';
$skills = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name       = trim($_POST['name'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $phone      = trim($_POST['phone'] ?? '');
    $dob        = trim($_POST['dob'] ?? '');
    $position   = trim($_POST['position'] ?? '');
    $cover      = trim($_POST['cover'] ?? '');
    $linkedin   = trim($_POST['linkedin'] ?? '');
    $experience = trim($_POST['experience'] ?? '');
    $skills     = $_POST['skills'] ?? [];

    // Full name
    if ($name === '') $errors['name'] = 'Full name is required.';
    elseif (!preg_match("/^[A-Za-z .'-]{3,}$/", $name)) $errors['name'] = 'Name can contain letters only (min 3 characters).';

    // Email
    if ($email === '') $errors['email'] = 'Email address is required.';
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Enter a valid email address (e.g. name@example.com).';

    // Contact number (Sri Lankan format: 0771234567 or +94771234567)
    $cleanPhone = preg_replace('/[\s-]/', '', $phone);
    if ($phone === '') $errors['phone'] = 'Contact number is required.';
    elseif (!preg_match('/^(?:\+94|0)\d{9}$/', $cleanPhone)) $errors['phone'] = 'Enter a valid number (e.g. 0771234567 or +94771234567).';

    // Date of birth
    if ($dob === '') $errors['dob'] = 'Date of birth is required.';
    else {
        $d = DateTime::createFromFormat('Y-m-d', $dob);
        if (!$d || $d->format('Y-m-d') !== $dob) $errors['dob'] = 'Invalid date.';
        elseif ($d > new DateTime()) $errors['dob'] = 'Date of birth cannot be in the future.';
    }

    // Position
    if ($position === '') $errors['position'] = 'Please select a position.';
    elseif (!in_array($position, $positions, true)) $errors['position'] = 'Invalid position selected.';

    // Resume (.pdf only)
    if (!isset($_FILES['resume']) || $_FILES['resume']['error'] === UPLOAD_ERR_NO_FILE) {
        $errors['resume'] = 'Resume is required.';
    } elseif ($_FILES['resume']['error'] !== UPLOAD_ERR_OK) {
        $errors['resume'] = 'File upload failed. Please try again.';
    } else {
        $ext = strtolower(pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION));
        $mime = function_exists('mime_content_type') ? mime_content_type($_FILES['resume']['tmp_name']) : 'application/pdf';
        if ($ext !== 'pdf' || $mime !== 'application/pdf') $errors['resume'] = 'Resume must be a .pdf file.';
    }

    // Cover letter
    if ($cover === '') $errors['cover'] = 'Cover letter is required.';

    // LinkedIn
    if ($linkedin === '') $errors['linkedin'] = 'LinkedIn profile URL is required.';
    elseif (!filter_var($linkedin, FILTER_VALIDATE_URL)) $errors['linkedin'] = 'Enter a valid URL (e.g. https://linkedin.com/in/yourname).';

    // Experience
    if ($experience === '') $errors['experience'] = 'Work experience is required.';
    elseif (!is_numeric($experience) || $experience < 0 || $experience > 60) $errors['experience'] = 'Enter a valid number of years (0 - 60).';

    // Skills
    if (empty($skills)) $errors['skills'] = 'Select at least one skill.';

    if (empty($errors)) $success = true;
}
function err($errors, $k) { return isset($errors[$k]) ? '<div class="err">' . h($errors[$k]) . '</div>' : ''; }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Job Application Form</title>
<style>
 body { font-family: Arial, sans-serif; background:#f2f2f2; }
 .card { max-width:420px; margin:30px auto; background:#fff; padding:20px; border-radius:12px; }
 label { display:block; font-weight:bold; margin-top:10px; }
 input[type=text], input[type=email], input[type=date], input[type=url], input[type=number], input[type=file], select, textarea
 { width:100%; padding:8px; margin-top:4px; border:1px solid #ccc; border-radius:6px; box-sizing:border-box; }
 .skills label { display:inline; margin-right:8px; }
 button { width:100%; margin-top:15px; padding:10px; background:#007bff; color:#fff; border:0; border-radius:6px; font-size:16px; }
 .err { color:#c00; font-size:13px; margin-top:3px; }
 .ok { background:#d4edda; color:#155724; padding:10px; border-radius:6px; }
</style>
</head>
<body>
<div class="card">
 <h2>Job Application Form</h2>
 <?php if ($success): ?>
   <div class="ok">Application submitted successfully! Thank you, <?= h($name) ?>.</div>
 <?php endif; ?>
 <form method="post" enctype="multipart/form-data" novalidate>
  <label>Full Name</label>
  <input type="text" name="name" value="<?= h($name) ?>"><?= err($errors,'name') ?>

  <label>Email</label>
  <input type="email" name="email" value="<?= h($email) ?>"><?= err($errors,'email') ?>

  <label>Contact Number</label>
  <input type="text" name="phone" value="<?= h($phone) ?>"><?= err($errors,'phone') ?>

  <label>Date of Birth</label>
  <input type="date" name="dob" value="<?= h($dob) ?>"><?= err($errors,'dob') ?>

  <label>Position Applied For</label>
  <select name="position">
   <option value="">-- Select --</option>
   <?php foreach ($positions as $p): ?>
     <option value="<?= h($p) ?>" <?= $position === $p ? 'selected' : '' ?>><?= h($p) ?></option>
   <?php endforeach; ?>
  </select><?= err($errors,'position') ?>

  <label>Upload Resume (PDF)</label>
  <input type="file" name="resume"><?= err($errors,'resume') ?>

  <label>Cover Letter</label>
  <textarea name="cover" rows="4"><?= h($cover) ?></textarea><?= err($errors,'cover') ?>

  <label>LinkedIn Profile</label>
  <input type="url" name="linkedin" value="<?= h($linkedin) ?>"><?= err($errors,'linkedin') ?>

  <label>Work Experience (Years)</label>
  <input type="number" name="experience" step="0.5" value="<?= h($experience) ?>"><?= err($errors,'experience') ?>

  <label>Skills</label>
  <div class="skills">
   <?php foreach ($allSkills as $s): ?>
     <label><input type="checkbox" name="skills[]" value="<?= h($s) ?>" <?= in_array($s, $skills) ? 'checked' : '' ?>> <?= h($s) ?></label>
   <?php endforeach; ?>
  </div><?= err($errors,'skills') ?>

  <button type="submit">Apply</button>
 </form>
</div>
</body>
</html>
