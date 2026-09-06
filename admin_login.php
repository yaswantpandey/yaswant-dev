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

$error = '';
if (!empty($_GET['timeout'])) {
  $error = 'Your admin session expired due to inactivity. Please log in again.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = trim($_POST['username'] ?? '');
  $password = trim($_POST['password'] ?? '');

  if ($username === ADMIN_USER && $password === ADMIN_PASS) {
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_user'] = $username;
    $_SESSION['last_activity'] = time();
    header('Location: admin.php');
    exit;
  } else {
    $error = 'Invalid admin username or password';
  }
}

nexus_head(
  'Admin Login — Yaswant Dev',
  'Secure login portal for Yaswant Dev platform administration.',
  'admin login, yaswant dev admin portal',
  'https://yaswant.co.in/admin_login.php'
);
?>
<div class="min-h-screen flex items-center justify-center bg-surface p-md">
  <div class="w-full max-w-md bg-surface-container-high rounded-2xl p-xl shadow-2xl border border-outline-variant/20">
    <div class="text-center mb-lg">
      <div
        class="w-14 h-14 rounded-2xl bg-primary-container text-on-primary-container flex items-center justify-center mx-auto mb-md shadow-lg shadow-primary/20">
        <span class="material-symbols-outlined text-[32px]" aria-hidden="true">admin_panel_settings</span>
      </div>
      <h1 class="font-display-lg text-headline-md text-on-surface">Admin Login</h1>
      <p class="text-sm text-on-surface-variant mt-xs">Enter credentials to access the control panel</p>
    </div>

    <?php if ($error): ?>
      <div
        class="bg-error-container text-on-error-container px-md py-sm rounded-xl text-sm mb-md flex items-center gap-xs">
        <span class="material-symbols-outlined text-[18px]">error</span>
        <span><?= htmlspecialchars($error) ?></span>
      </div>
    <?php endif; ?>

    <form method="POST" action="admin_login.php" class="space-y-md">
      <div>
        <label for="username"
          class="block text-xs font-label-sm uppercase tracking-wider text-on-surface-variant mb-xs">Username</label>
        <div class="relative">
          <span class="material-symbols-outlined absolute left-3 top-2.5 text-outline text-[20px]"
            aria-hidden="true">person</span>
          <input id="username" name="username" type="text" required autofocus placeholder="Enter admin username"
            class="w-full bg-surface-container-lowest border border-outline-variant rounded-xl pl-10 pr-md py-sm text-on-surface text-sm focus:outline-none focus:ring-2 ring-primary" />
        </div>
      </div>

      <div>
        <label for="password"
          class="block text-xs font-label-sm uppercase tracking-wider text-on-surface-variant mb-xs">Password</label>
        <div class="relative">
          <span class="material-symbols-outlined absolute left-3 top-2.5 text-outline text-[20px]"
            aria-hidden="true">lock</span>
          <input id="password" name="password" type="password" required placeholder="Enter admin password"
            class="w-full bg-surface-container-lowest border border-outline-variant rounded-xl pl-10 pr-md py-sm text-on-surface text-sm focus:outline-none focus:ring-2 ring-primary" />
        </div>
      </div>

      <button type="submit"
        class="w-full bg-primary hover:bg-primary-fixed text-on-primary py-sm rounded-xl font-label-sm text-sm transition-all shadow-lg shadow-primary/20 flex items-center justify-center gap-xs">
        <span class="material-symbols-outlined text-[18px]">login</span> Log In
      </button>
    </form>

    <div class="mt-lg text-center border-t border-outline-variant/10 pt-md">
      <a href="index.php" class="text-xs text-on-surface-variant hover:text-primary transition-colors font-label-sm">←
        Back to Public Website</a>
    </div>
  </div>
</div>
</body>

</html>