<?php
require_once 'config.php';
require_once 'layout.php';

// Already authenticated
if (isset($_SESSION['user_id'])) {
    redirect('dashboard.php');
}

$errors  = [];
$old_id  = '';          // username or email field value

// ── Process login form ─────────────────────────────────────────
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $identifier = trim($_POST['identifier'] ?? '');  // username OR email
    $password   = $_POST['password'] ?? '';

    $old_id = $identifier;

    // ── Validation ─────────────────────────────────────────────
    if ($identifier === '') {
        $errors[] = 'Username or email is required.';
    }
    if ($password === '') {
        $errors[] = 'Password is required.';
    }

    // ── DB lookup ───────────────────────────────────────────────
    if (empty($errors)) {
        $stmt = $conn->prepare(
            "SELECT id, username, email, password FROM users
             WHERE username = ? OR email = ?
             LIMIT 1"
        );
        if (!$stmt) {
            $errors[] = 'DB prepare error: ' . $conn->error;
        } else {
            $stmt->bind_param('ss', $identifier, $identifier);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 0) {
                $errors[] = 'No account found with that username or email.';
            } else {
                $user = $result->fetch_assoc();

                if (!password_verify($password, $user['password'])) {
                    $errors[] = 'Incorrect password. Please try again.';
                } else {
                    // ── Successful login ────────────────────────
                    $_SESSION['user_id']  = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email']    = $user['email'];
                    $_SESSION['login_at'] = date('Y-m-d H:i:s');

                    // Regenerate session ID to prevent fixation
                    session_regenerate_id(true);
                    redirect('dashboard.php');
                }
            }
            $stmt->close();
        }
    }
}

// ── Render ─────────────────────────────────────────────────────
page_head('Login');
?>

<div class="card">
  <div class="brand">
    <div class="brand-icon">🚀</div>
    <h1>NexusAuth</h1>
    <p>SIGN IN TO YOUR ACCOUNT</p>
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

  <?php if (isset($_GET['registered'])): ?>
    <div class="alert alert-success">
      ✅ Registration successful! Please log in below.
    </div>
  <?php endif; ?>

  <?php if (isset($_GET['timeout'])): ?>
    <div class="alert alert-info">
      🕐 Your session expired. Please log in again.
    </div>
  <?php endif; ?>

  <?php if (isset($_GET['logout'])): ?>
    <div class="alert alert-success">
      👋 You have been logged out successfully.
    </div>
  <?php endif; ?>

  <form method="POST" action="login.php" novalidate>

    <div class="form-group">
      <label for="identifier">Username or Email</label>
      <div class="input-wrap">
        <span class="icon">👤</span>
        <input type="text" id="identifier" name="identifier"
               placeholder="username or email@example.com"
               value="<?= htmlspecialchars($old_id) ?>"
               autocomplete="username" required autofocus>
      </div>
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <div class="input-wrap">
        <span class="icon">🔑</span>
        <input type="password" id="password" name="password"
               placeholder="Your password"
               autocomplete="current-password" required>
      </div>
    </div>

    <button type="submit" class="btn btn-primary">Sign In →</button>
  </form>

  <div class="divider">NEW HERE?</div>
  <p class="text-center" style="font-size:.82rem; color:var(--muted)">
    Don't have an account yet?
    <a href="register.php" class="link">Create one →</a>
  </p>
</div>

<?php page_foot(); ?>
