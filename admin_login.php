<?php
// admin_login.php — Yaswant Dev Admin Login Portal
session_start();
require_once 'config.php';
require_once 'includes/layout.php';

// Redirect if already logged in
if (!empty($_SESSION['admin_logged_in'])) {
  header('Location: admin.php');
  exit;
}

$error   = '';
$timeout = !empty($_GET['timeout']);
if ($timeout) {
  $error = 'Session expired due to inactivity. Please log in again.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username'] ?? '');
  $password = trim($_POST['password'] ?? '');

  if ($username === ADMIN_USER && $password === ADMIN_PASS) {
    session_regenerate_id(true);
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_user']      = $username;
    $_SESSION['last_activity']   = time();
    header('Location: admin.php');
    exit;
  } else {
    $error = 'Invalid admin username or password.';
  }
}

nexus_head(
  'Admin Login — Yaswant Dev',
  'Secure admin login portal for Yaswant Dev platform.',
  'admin login, yaswant dev admin',
  'https://yaswant.co.in/admin_login.php'
);
?>
<style>
  body { background: #09090b; }
  .login-card {
    background: rgba(18,18,22,0.9);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 1.25rem;
  }
  .login-input {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.10);
    border-radius: 0.75rem;
    color: #f4f4f5;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
  }
  .login-input:focus {
    outline: none;
    border-color: #10b981;
    box-shadow: 0 0 0 1px #10b981, 0 4px 16px -4px rgba(16,185,129,0.15);
  }
  .login-input::placeholder { color: #52525b; }
  .dot-grid {
    background-image: radial-gradient(rgba(255,255,255,0.05) 1px, transparent 1px);
    background-size: 24px 24px;
  }
</style>

<div class="min-h-screen flex items-center justify-center dot-grid p-4">

  <!-- Ambient Glow -->
  <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full blur-[200px] pointer-events-none"
    style="background: radial-gradient(circle, rgba(16,185,129,0.06) 0%, transparent 70%);"></div>

  <div class="login-card w-full max-w-sm p-8 shadow-2xl relative">

    <!-- Logo / Icon -->
    <div class="text-center mb-8">
      <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500/20 to-cyan-500/10 border border-emerald-500/30 flex items-center justify-center mx-auto mb-4 shadow-lg shadow-emerald-500/10">
        <span class="material-symbols-outlined text-emerald-400 text-[30px]">admin_panel_settings</span>
      </div>
      <h1 class="text-xl font-black text-white tracking-tight">Admin Control Center</h1>
      <p class="text-xs text-zinc-500 font-mono mt-1">Yaswant Dev · Secure Access</p>
    </div>

    <!-- Error / Timeout Banner -->
    <?php if ($error): ?>
      <div class="mb-5 flex items-center gap-2.5 px-4 py-3 rounded-xl bg-red-500/10 border border-red-500/25 text-red-400 text-xs font-mono">
        <span class="material-symbols-outlined text-[16px] shrink-0">error</span>
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <!-- Login Form -->
    <form method="POST" action="admin_login.php" class="space-y-4">

      <div>
        <label for="username" class="block text-[10px] font-mono uppercase tracking-wider text-zinc-500 mb-1.5">Username</label>
        <div class="relative">
          <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-zinc-500 text-[18px]">person</span>
          <input id="username" name="username" type="text" required autofocus
            placeholder="Enter admin username"
            class="login-input w-full pl-9 pr-4 py-2.5 text-sm font-mono" />
        </div>
      </div>

      <div>
        <label for="password" class="block text-[10px] font-mono uppercase tracking-wider text-zinc-500 mb-1.5">Password</label>
        <div class="relative">
          <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-zinc-500 text-[18px]">lock</span>
          <input id="password" name="password" type="password" required
            placeholder="Enter admin password"
            class="login-input w-full pl-9 pr-4 py-2.5 text-sm font-mono" />
        </div>
      </div>

      <button type="submit"
        class="w-full bg-emerald-500 hover:bg-emerald-400 text-black py-2.5 rounded-xl font-mono font-bold text-sm transition-all active:scale-95 shadow-lg shadow-emerald-500/20 flex items-center justify-center gap-2 mt-2">
        <span class="material-symbols-outlined text-[18px]">login</span>
        Sign In
      </button>
    </form>

    <div class="mt-6 text-center border-t border-white/[0.06] pt-5">
      <a href="<?= URL_HOME ?>" class="text-xs text-zinc-500 hover:text-zinc-300 transition-colors font-mono">
        ← Back to public site
      </a>
    </div>
  </div>
</div>
</body>
</html>