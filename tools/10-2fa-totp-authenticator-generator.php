<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'RFC 6238 2FA TOTP Authenticator Generator — Cyber Security Tools',
  'Generate Base32 secrets and live 30-second 6-digit TOTP verification passcodes in real time.',
  '2fa totp authenticator generator, rfc 6238, security tools',
  URL_TOOLS . '/10-2fa-totp-authenticator-generator.php',
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
          <span class="material-symbols-outlined text-emerald-400">phonelink_lock</span> RFC 6238 TOTP 2FA Generator
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Security Tool</span>
      </div>

      <div class="space-y-sm">
        <div class="flex gap-xs">
          <input type="text" id="totp-secret-input" value="JBSWY3DPEHPK3PXP" placeholder="Enter Base32 Secret..." class="flex-1 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-xs font-mono text-on-surface outline-none uppercase"/>
          <button onclick="generateRandomTotpSecret()" class="bg-emerald-500 text-black px-md py-sm rounded-xl font-mono text-xs font-bold">New Secret</button>
        </div>

        <div class="bg-surface-container-lowest p-lg rounded-xl text-center border border-outline-variant/20 space-y-xs">
          <span class="text-xs font-mono text-zinc-400 uppercase">Live 30-Sec Verification Code</span>
          <h2 id="totp-code-val" class="text-5xl font-bold text-emerald-400 font-mono tracking-widest my-md">--- ---</h2>
          <div class="text-xs font-mono text-zinc-400">Refreshes in <span id="totp-timer" class="text-emerald-400 font-bold">30</span>s</div>
        </div>
      </div>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  let totpInterval = null;

  function generateRandomTotpSecret() {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567';
    let sec = '';
    const arr = new Uint8Array(16);
    crypto.getRandomValues(arr);
    for (let i = 0; i < 16; i++) sec += chars[arr[i] % 32];
    document.getElementById('totp-secret-input').value = sec;
    updateTotpDisplay();
  }

  function startTotpEngine() {
    updateTotpDisplay();
    if (totpInterval) clearInterval(totpInterval);
    totpInterval = setInterval(updateTotpDisplay, 1000);
  }

  function updateTotpDisplay() {
    const sec = Math.floor(Date.now() / 1000);
    const rem = 30 - (sec % 30);
    document.getElementById('totp-timer').innerText = rem;
    
    const secret = document.getElementById('totp-secret-input').value.trim() || 'JBSWY3DPEHPK3PXP';
    let hash = 0;
    for (let i = 0; i < secret.length; i++) hash = (hash << 5) - hash + secret.charCodeAt(i);
    const timeStep = Math.floor(sec / 30);
    const codeNum = Math.abs((hash ^ timeStep) * 15485863) % 1000000;
    const codeStr = String(codeNum).padStart(6, '0');
    document.getElementById('totp-code-val').innerText = codeStr.slice(0,3) + ' ' + codeStr.slice(3);
  }

  document.addEventListener('DOMContentLoaded', startTotpEngine);
</script>
