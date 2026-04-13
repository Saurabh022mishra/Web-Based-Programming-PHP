<?php
// ============================================================
//  Shared layout helpers
// ============================================================

function page_head(string $title, string $extra_css = ''): void { ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= htmlspecialchars($title) ?> — NexusAuth</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
/* ── Reset & Root ───────────────────────────────────────────── */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --bg:        #07080d;
  --surface:   #0e1117;
  --panel:     #13161f;
  --border:    #1e2333;
  --accent:    #00e5ff;
  --accent2:   #7b61ff;
  --danger:    #ff4d6d;
  --success:   #00ffa3;
  --warning:   #ffb347;
  --text:      #e8eaf0;
  --muted:     #606880;
  --font-head: 'Syne', sans-serif;
  --font-mono: 'JetBrains Mono', monospace;
  --radius:    12px;
  --transition: .22s cubic-bezier(.4,0,.2,1);
}

html { font-size: 16px; }
body {
  background: var(--bg);
  color: var(--text);
  font-family: var(--font-mono);
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 2rem 1rem;
  position: relative;
  overflow-x: hidden;
}

/* ── Background grid ───────────────────────────────────────── */
body::before {
  content: '';
  position: fixed; inset: 0;
  background-image:
    linear-gradient(rgba(0,229,255,.03) 1px, transparent 1px),
    linear-gradient(90deg, rgba(0,229,255,.03) 1px, transparent 1px);
  background-size: 48px 48px;
  pointer-events: none;
  z-index: 0;
}
body::after {
  content: '';
  position: fixed;
  width: 600px; height: 600px;
  border-radius: 50%;
  background: radial-gradient(circle, rgba(123,97,255,.12) 0%, transparent 70%);
  top: -200px; right: -200px;
  pointer-events: none;
  z-index: 0;
}

/* ── Card ──────────────────────────────────────────────────── */
.card {
  position: relative; z-index: 1;
  background: var(--panel);
  border: 1px solid var(--border);
  border-radius: 20px;
  padding: 2.8rem 2.4rem;
  width: 100%;
  max-width: 460px;
  box-shadow:
    0 0 0 1px rgba(0,229,255,.06),
    0 24px 64px rgba(0,0,0,.7),
    inset 0 1px 0 rgba(255,255,255,.04);
  animation: slideUp .45s cubic-bezier(.16,1,.3,1) both;
}

@keyframes slideUp {
  from { opacity: 0; transform: translateY(28px); }
  to   { opacity: 1; transform: translateY(0); }
}

/* ── Logo / Brand ──────────────────────────────────────────── */
.brand {
  text-align: center;
  margin-bottom: 2rem;
}
.brand-icon {
  width: 56px; height: 56px;
  background: linear-gradient(135deg, var(--accent2), var(--accent));
  border-radius: 16px;
  display: inline-flex; align-items: center; justify-content: center;
  font-size: 1.6rem;
  margin-bottom: .9rem;
  box-shadow: 0 8px 32px rgba(0,229,255,.25);
  animation: pulse 3s ease-in-out infinite;
}
@keyframes pulse {
  0%,100% { box-shadow: 0 8px 32px rgba(0,229,255,.25); }
  50%      { box-shadow: 0 8px 48px rgba(0,229,255,.5); }
}
.brand h1 {
  font-family: var(--font-head);
  font-size: 1.65rem;
  font-weight: 800;
  letter-spacing: -.02em;
  background: linear-gradient(90deg, var(--accent), var(--accent2));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}
.brand p {
  color: var(--muted);
  font-size: .78rem;
  margin-top: .3rem;
  letter-spacing: .05em;
}

/* ── Form elements ─────────────────────────────────────────── */
.form-group {
  margin-bottom: 1.3rem;
}
.form-group label {
  display: block;
  font-size: .7rem;
  letter-spacing: .12em;
  text-transform: uppercase;
  color: var(--muted);
  margin-bottom: .5rem;
  font-weight: 500;
}
.input-wrap {
  position: relative;
}
.input-wrap .icon {
  position: absolute;
  left: 14px; top: 50%; transform: translateY(-50%);
  font-size: 1rem;
  pointer-events: none;
  opacity: .5;
}
.form-group input {
  width: 100%;
  padding: .82rem 1rem .82rem 2.6rem;
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  color: var(--text);
  font-family: var(--font-mono);
  font-size: .88rem;
  outline: none;
  transition: border-color var(--transition), box-shadow var(--transition);
}
.form-group input:focus {
  border-color: var(--accent);
  box-shadow: 0 0 0 3px rgba(0,229,255,.12);
}
.form-group input::placeholder { color: var(--muted); }

/* ── Buttons ───────────────────────────────────────────────── */
.btn {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: .5rem;
  padding: .88rem 1.6rem;
  border: none;
  border-radius: var(--radius);
  font-family: var(--font-head);
  font-size: .95rem;
  font-weight: 700;
  letter-spacing: .03em;
  cursor: pointer;
  transition: all var(--transition);
  text-decoration: none;
  width: 100%;
}
.btn-primary {
  background: linear-gradient(135deg, var(--accent2), var(--accent));
  color: var(--bg);
  box-shadow: 0 6px 24px rgba(0,229,255,.2);
}
.btn-primary:hover {
  filter: brightness(1.1);
  transform: translateY(-2px);
  box-shadow: 0 10px 32px rgba(0,229,255,.35);
}
.btn-primary:active { transform: translateY(0); }

.btn-danger {
  background: rgba(255,77,109,.15);
  color: var(--danger);
  border: 1px solid rgba(255,77,109,.3);
}
.btn-danger:hover {
  background: rgba(255,77,109,.25);
  transform: translateY(-1px);
}

.btn-ghost {
  background: transparent;
  color: var(--accent);
  border: 1px solid var(--border);
  font-size: .85rem;
  padding: .55rem 1rem;
  width: auto;
}
.btn-ghost:hover { border-color: var(--accent); background: rgba(0,229,255,.06); }

/* ── Alerts ────────────────────────────────────────────────── */
.alert {
  padding: .9rem 1.1rem;
  border-radius: var(--radius);
  font-size: .82rem;
  margin-bottom: 1.4rem;
  display: flex;
  align-items: flex-start;
  gap: .6rem;
  animation: fadeIn .3s ease both;
}
@keyframes fadeIn { from { opacity:0; transform:translateY(-6px); } to { opacity:1; transform:none; } }
.alert-error   { background: rgba(255,77,109,.1);  border: 1px solid rgba(255,77,109,.3);  color: #ff8fa3; }
.alert-success { background: rgba(0,255,163,.08);  border: 1px solid rgba(0,255,163,.3);   color: var(--success); }
.alert-info    { background: rgba(0,229,255,.07);  border: 1px solid rgba(0,229,255,.25);  color: var(--accent); }

/* ── Divider ───────────────────────────────────────────────── */
.divider {
  text-align: center;
  position: relative;
  margin: 1.5rem 0;
  color: var(--muted);
  font-size: .72rem;
  letter-spacing: .1em;
}
.divider::before, .divider::after {
  content: '';
  position: absolute;
  top: 50%;
  width: 40%;
  height: 1px;
  background: var(--border);
}
.divider::before { left: 0; }
.divider::after  { right: 0; }

/* ── Misc ──────────────────────────────────────────────────── */
.link {
  color: var(--accent);
  text-decoration: none;
  font-size: .82rem;
  transition: color var(--transition);
}
.link:hover { color: #fff; }
.text-center { text-align: center; }
.mt-1 { margin-top: .75rem; }
.mt-2 { margin-top: 1.5rem; }

/* ── Validation hints ──────────────────────────────────────── */
.hint {
  font-size: .7rem;
  color: var(--muted);
  margin-top: .4rem;
}
.hint.valid   { color: var(--success); }
.hint.invalid { color: var(--danger); }

/* ── Dashboard specific ────────────────────────────────────── */
.dash-card { max-width: 680px; }
.dash-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 1rem;
  margin-bottom: 2rem;
  padding-bottom: 1.4rem;
  border-bottom: 1px solid var(--border);
}
.dash-header h2 {
  font-family: var(--font-head);
  font-size: 1.35rem;
  font-weight: 800;
}
.badge {
  display: inline-flex;
  align-items: center;
  gap: .35rem;
  padding: .25rem .75rem;
  border-radius: 100px;
  font-size: .7rem;
  font-weight: 600;
  letter-spacing: .08em;
}
.badge-green {
  background: rgba(0,255,163,.12);
  color: var(--success);
  border: 1px solid rgba(0,255,163,.3);
}
.info-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 1rem;
  margin-bottom: 2rem;
}
@media(max-width:480px) { .info-grid { grid-template-columns: 1fr; } }
.info-tile {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: var(--radius);
  padding: 1.1rem 1.3rem;
}
.info-tile .tile-label {
  font-size: .65rem;
  letter-spacing: .14em;
  text-transform: uppercase;
  color: var(--muted);
  margin-bottom: .4rem;
}
.info-tile .tile-value {
  font-size: .95rem;
  font-weight: 500;
  color: var(--text);
  word-break: break-all;
}
.tile-accent { color: var(--accent) !important; }

<?= $extra_css ?>
</style>
</head>
<body>
<?php } // end page_head


function page_foot(): void { ?>
</body>
</html>
<?php }
