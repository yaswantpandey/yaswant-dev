<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'Brute Force Rate Limiter Simulator — Cyber Security Tools',
  'Simulate login rate limiting thresholds, exponential backoff timers, and IP ban triggers.',
  'brute force rate limiter, lockout simulator, security tools',
  URL_TOOLS . '/04-brute-force-rate-limiter.php',
  [],
  $schema
);
?>
<div class="sidebar-push pl-0 lg:pl-72 flex flex-col min-h-screen">
  <?php nexus_sidebar('tools'); nexus_topbar('tools'); ?>
  <main id="main-content" role="main" class="flex-1 pt-16 w-full max-w-max-width-content mx-auto p-lg space-y-lg">
    <a href="<?= URL_TOOLS ?>" class="inline-flex items-center gap-xs font-mono text-xs text-emerald-400 hover:underline">
      <span class="material-symbols-outlined text-[16px]">arrow_back</span> Back to All Tools
    </a>
    
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl p-lg space-y-md shadow-xl">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h1 class="font-headline-md text-xl font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">timer</span> Brute Force Rate Limiter Simulator
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Security Tool</span>
      </div>

      <p class="font-body-md text-xs text-on-surface-variant">Simulate authentication rate limiting against brute force attacks with exponential backoff timers.</p>

      <div class="flex gap-xs">
        <input type="text" id="brute-user" value="admin@yaswant.co.in" class="flex-1 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-xs font-mono text-on-surface outline-none"/>
        <button onclick="simulateFailedLogin()" class="bg-red-500 hover:bg-red-400 text-white px-md py-sm rounded-xl font-mono text-xs font-bold">Failed Login Attempt</button>
      </div>
      
      <div id="brute-status" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono text-emerald-400 border border-outline-variant/20">
        Account status: Normal. Failed attempts: 0 / 5 limit.
      </div>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  let failedLoginCount = 0;

  function simulateFailedLogin() {
    failedLoginCount++;
    const user = document.getElementById('brute-user').value;
    const status = document.getElementById('brute-status');

    if (failedLoginCount >= 5) {
      const lockSeconds = Math.pow(2, failedLoginCount - 5) * 30;
      status.innerHTML = `<span class="text-red-400 font-bold">[IP BANNED & ACCOUNT LOCKED]</span> 5/5 Threshold Exceeded for ${user}. Exponential Lockout Active: ${lockSeconds}s remaining.`;
      status.className = 'bg-surface-container-lowest p-md rounded-xl text-xs font-mono border border-red-500/30';
    } else {
      status.innerHTML = `Attempt ${failedLoginCount} failed for ${user}. Warning: ${5 - failedLoginCount} attempts remaining before rate-limit lockout.`;
      status.className = 'bg-surface-container-lowest p-md rounded-xl text-xs font-mono text-amber-400 border border-amber-500/30';
    }
  }
</script>
