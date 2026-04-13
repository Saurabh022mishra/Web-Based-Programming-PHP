<?php
require_once 'config.php';
require_once 'layout.php';

// Already authenticated
if (isset($_SESSION['user_id'])) {
    redirect('dashboard.php');
}

$errors  = [];
$success = '';
$old     = ['username' => '', 'email' => ''];

// ── Process form ───────────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $email    = trim($_POST['email']    ?? '');
    $password = $_POST['password']      ?? '';
    $confirm  = $_POST['confirm']       ?? '';

    $old = ['username' => $username, 'email' => $email];

    // ── Validation ─────────────────────────────────────────────
    if ($username === '') {
        $errors[] = 'Username is required.';
    } elseif (strlen($username) < 3 || strlen($username) > 50) {
        $errors[] = 'Username must be between 3 and 50 characters.';
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $errors[] = 'Username may only contain letters, numbers and underscores.';
    }

    if ($email === '') {
        $errors[] = 'Email address is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please enter a valid email address.';
    }

    if ($password === '') {
        $errors[] = 'Password is required.';
    } elseif (strlen($password) < 8) {
        $errors[] = 'Password must be at least 8 characters.';
    } elseif (!preg_match('/[A-Z]/', $password)) {
        $errors[] = 'Password must contain at least one uppercase letter.';
    } elseif (!preg_match('/[0-9]/', $password)) {
        $errors[] = 'Password must contain at least one number.';
    }

    if ($confirm === '') {
        $errors[] = 'Please confirm your password.';
    } elseif ($password !== $confirm) {
        $errors[] = 'Passwords do not match.';
    }

    // ── If valid, insert user ───────────────────────────────────
    if (empty($errors)) {
        // Check for duplicate username / email
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        if (!$stmt) {
            $errors[] = 'DB prepare error: ' . $conn->error;
        } else {
            $stmt->bind_param('ss', $username, $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                // Find out which field is duplicate
                $chk = $conn->prepare("SELECT username, email FROM users WHERE username = ? OR email = ?");
                $chk->bind_param('ss', $username, $email);
                $chk->execute();
                $chk->bind_result($dbUser, $dbEmail);
                while ($chk->fetch()) {
                    if (strtolower($dbUser) === strtolower($username)) $errors[] = 'That username is already taken.';
                    if (strtolower($dbEmail) === strtolower($email))   $errors[] = 'That email is already registered.';
                }
                $chk->close();
            } else {
                // Hash and insert
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $ins  = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                if (!$ins) {
                    $errors[] = 'DB prepare error: ' . $conn->error;
                } else {
                    $ins->bind_param('sss', $username, $email, $hash);
                    if ($ins->execute()) {
                        $success = 'Account created successfully! You can now log in.';
                        $old     = ['username' => '', 'email' => ''];
                    } else {
                        $errors[] = 'Registration failed: ' . $ins->error;
                    }
                    $ins->close();
                }
            }
            $stmt->close();
        }
    }
}
// ── Render ─────────────────────────────────────────────────────
page_head('Register');
?>

<div class="card">
  <div class="brand">
    <div class="brand-icon">🔐</div>
    <h1>NexusAuth</h1>
    <p>CREATE YOUR ACCOUNT</p>
  </div>

  <?php if (!empty($errors)): ?>
    <div class="alert alert-error">
      <span>⚠️</span>
      <ul style="list-style:none; line-height:1.8;">
        <?php foreach ($errors as $e): ?>
          <li><?= htmlspecialchars($e) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <?php if ($success): ?>
    <div class="alert alert-success">
      ✅ <?= htmlspecialchars($success) ?>
      <a href="login.php" class="link" style="margin-left:.5rem;">→ Login now</a>
    </div>
  <?php endif; ?>

  <form method="POST" action="register.php" id="regForm" novalidate>

    <div class="form-group">
      <label for="username">Username</label>
      <div class="input-wrap">
        <span class="icon">👤</span>
        <input type="text" id="username" name="username"
               placeholder="e.g. john_doe"
               value="<?= htmlspecialchars($old['username']) ?>"
               autocomplete="username" required>
      </div>
      <p class="hint" id="uHint">3–50 chars, letters / numbers / underscores only.</p>
    </div>

    <div class="form-group">
      <label for="email">Email Address</label>
      <div class="input-wrap">
        <span class="icon">✉️</span>
        <input type="email" id="email" name="email"
               placeholder="you@example.com"
               value="<?= htmlspecialchars($old['email']) ?>"
               autocomplete="email" required>
      </div>
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <div class="input-wrap">
        <span class="icon">🔑</span>
        <input type="password" id="password" name="password"
               placeholder="Min 8 chars, 1 uppercase, 1 number"
               autocomplete="new-password" required>
      </div>
      <p class="hint" id="pwHint">Must be 8+ chars with an uppercase letter and a digit.</p>
    </div>

    <div class="form-group">
      <label for="confirm">Confirm Password</label>
      <div class="input-wrap">
        <span class="icon">🔒</span>
        <input type="password" id="confirm" name="confirm"
               placeholder="Re-enter password"
               autocomplete="new-password" required>
      </div>
      <p class="hint" id="cfHint"></p>
    </div>

    <button type="submit" class="btn btn-primary">Create Account →</button>
  </form>

  <div class="divider">OR</div>
  <p class="text-center" style="font-size:.82rem; color:var(--muted)">
    Already have an account?
    <a href="login.php" class="link">Sign in →</a>
  </p>
</div>

<script>
/* ── Client-side live validation ──────────────────────────── */
const uField = document.getElementById('username');
const pwField = document.getElementById('password');
const cfField = document.getElementById('confirm');
const uHint  = document.getElementById('uHint');
const pwHint = document.getElementById('pwHint');
const cfHint = document.getElementById('cfHint');

uField.addEventListener('input', () => {
  const v = uField.value.trim();
  if (v.length < 3 || v.length > 50 || !/^[a-zA-Z0-9_]+$/.test(v)) {
    uHint.className = 'hint invalid';
    uHint.textContent = '✗ 3–50 chars, letters / numbers / underscores only.';
  } else {
    uHint.className = 'hint valid';
    uHint.textContent = '✓ Looks good!';
  }
});

pwField.addEventListener('input', () => {
  const v = pwField.value;
  const ok = v.length >= 8 && /[A-Z]/.test(v) && /[0-9]/.test(v);
  pwHint.className = ok ? 'hint valid' : 'hint invalid';
  pwHint.textContent = ok ? '✓ Strong password!' : '✗ 8+ chars, 1 uppercase, 1 number required.';
  if (cfField.value) checkConfirm();
});

cfField.addEventListener('input', checkConfirm);
function checkConfirm() {
  const match = cfField.value === pwField.value;
  cfHint.className = match ? 'hint valid' : 'hint invalid';
  cfHint.textContent = match ? '✓ Passwords match.' : '✗ Passwords do not match.';
}
</script>

<?php page_foot(); ?>
