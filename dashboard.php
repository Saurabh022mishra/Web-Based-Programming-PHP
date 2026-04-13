<?php
require_once 'config.php';
require_once 'layout.php';

// ── Auth guard ──────────────────────────────────────────────────
if (!isset($_SESSION['user_id'])) {
    redirect('login.php?timeout=1');
}

// ── Fetch fresh user data from DB ──────────────────────────────
$stmt = $conn->prepare("SELECT id, username, email, created_at FROM users WHERE id = ?");
if (!$stmt) {
    die('<div class="alert alert-error">DB error: ' . htmlspecialchars($conn->error) . '</div>');
}
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // User deleted from DB — kill session
    session_destroy();
    redirect('login.php');
}

$user = $result->fetch_assoc();
$stmt->close();

// ── Count total registered users ───────────────────────────────
$totalRes = $conn->query("SELECT COUNT(*) AS cnt FROM users");
$totalRow = $totalRes ? $totalRes->fetch_assoc() : ['cnt' => '?'];

// ── Render ─────────────────────────────────────────────────────
page_head('Dashboard');
?>

<div class="card dash-card">

  <!-- Header row -->
  <div class="dash-header">
    <div>
      <h2>Welcome back, <?= htmlspecialchars($user['username']) ?> 👋</h2>
      <span style="font-size:.72rem; color:var(--muted);">
        Session started: <?= htmlspecialchars($_SESSION['login_at']) ?>
      </span>
    </div>
    <div style="display:flex;gap:.6rem;align-items:center;flex-wrap:wrap;">
      <span class="badge badge-green">● ONLINE</span>
      <a href="logout.php" class="btn btn-danger"
         style="width:auto; padding:.52rem 1.1rem; font-size:.82rem;"
         onclick="return confirm('Are you sure you want to log out?')">
        🚪 Log Out
      </a>
    </div>
  </div>

  <!-- Info tiles -->
  <div class="info-grid">

    <div class="info-tile">
      <div class="tile-label">🆔 User ID</div>
      <div class="tile-value tile-accent">#<?= htmlspecialchars($user['id']) ?></div>
    </div>

    <div class="info-tile">
      <div class="tile-label">👤 Username</div>
      <div class="tile-value"><?= htmlspecialchars($user['username']) ?></div>
    </div>

    <div class="info-tile">
      <div class="tile-label">✉️ Email</div>
      <div class="tile-value"><?= htmlspecialchars($user['email']) ?></div>
    </div>

    <div class="info-tile">
      <div class="tile-label">📅 Member Since</div>
      <div class="tile-value"><?= date('d M Y', strtotime($user['created_at'])) ?></div>
    </div>

    <div class="info-tile">
      <div class="tile-label">🌐 Total Users</div>
      <div class="tile-value tile-accent"><?= (int)$totalRow['cnt'] ?> registered</div>
    </div>

    <div class="info-tile">
      <div class="tile-label">🔒 Auth Method</div>
      <div class="tile-value">bcrypt · PHP Sessions</div>
    </div>

  </div>

  <!-- Activity panel -->
  <div style="background:var(--surface);border:1px solid var(--border);border-radius:var(--radius);padding:1.2rem 1.4rem;">
    <div style="font-size:.68rem;letter-spacing:.12em;text-transform:uppercase;color:var(--muted);margin-bottom:.8rem;">
      📋 Session Snapshot
    </div>
    <pre style="font-size:.76rem;color:var(--accent);line-height:1.9;overflow-x:auto;"><?php
      echo "user_id    : " . htmlspecialchars($_SESSION['user_id'])  . "\n";
      echo "username   : " . htmlspecialchars($_SESSION['username']) . "\n";
      echo "email      : " . htmlspecialchars($_SESSION['email'])    . "\n";
      echo "login_at   : " . htmlspecialchars($_SESSION['login_at']) . "\n";
      echo "session_id : " . session_id();
    ?></pre>
  </div>

  <p class="text-center mt-2" style="font-size:.75rem;color:var(--muted);">
    🛡️ Your password is stored as a salted bcrypt hash — never in plain text.
  </p>

</div>

<?php page_foot(); ?>
