<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'CSPRNG Password Generator — Cyber Security Tools',
  'Hardware-level cryptographic random password & passphrase generator with custom length slider & entropy badge.',
  'csprng password generator, random password, security tools',
  URL_TOOLS . '/02-csprng-password-generator.php',
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
          <span class="material-symbols-outlined text-emerald-400">key</span> CSPRNG Password Generator
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Security Tool</span>
      </div>

      <div class="flex gap-xs">
        <input type="text" id="gen-pass-out" readonly class="flex-1 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-xs font-mono text-emerald-400 font-bold outline-none selection:bg-emerald-500/30"/>
        <button onclick="copyGeneratedPassword()" class="bg-emerald-500 hover:bg-emerald-400 text-black px-md py-sm rounded-xl font-mono text-xs font-bold flex items-center gap-xs transition-colors">
          <span class="material-symbols-outlined text-[16px]">content_copy</span> Copy
        </button>
      </div>

      <div class="bg-surface-container-lowest p-md rounded-xl space-y-md border border-outline-variant/20">
        <div class="space-y-xs">
          <div class="flex justify-between text-xs font-mono text-on-surface">
            <span>Password Length:</span>
            <span id="gen-len-val" class="text-emerald-400 font-bold">16 characters</span>
          </div>
          <input type="range" id="gen-len-slider" min="8" max="64" value="16" oninput="updatePassLengthLabel(this.value); generateSecurePassword();" class="w-full accent-emerald-400 cursor-pointer"/>
        </div>

        <div class="grid grid-cols-2 gap-xs text-xs font-mono text-on-surface">
          <label class="flex items-center gap-xs cursor-pointer"><input type="checkbox" id="opt-upper" checked onchange="generateSecurePassword()" class="accent-emerald-400"/> Uppercase (A-Z)</label>
          <label class="flex items-center gap-xs cursor-pointer"><input type="checkbox" id="opt-lower" checked onchange="generateSecurePassword()" class="accent-emerald-400"/> Lowercase (a-z)</label>
          <label class="flex items-center gap-xs cursor-pointer"><input type="checkbox" id="opt-num" checked onchange="generateSecurePassword()" class="accent-emerald-400"/> Numbers (0-9)</label>
          <label class="flex items-center gap-xs cursor-pointer"><input type="checkbox" id="opt-sym" checked onchange="generateSecurePassword()" class="accent-emerald-400"/> Symbols (!@#$)</label>
        </div>
      </div>

      <div class="flex items-center justify-between pt-xs">
        <span id="gen-entropy-badge" class="text-[11px] font-mono text-emerald-400 bg-emerald-500/10 px-2 py-1 rounded border border-emerald-500/20">Entropy: 95.6 bits</span>
        <button onclick="generateSecurePassword()" class="bg-surface-container-highest hover:bg-surface-variant text-on-surface px-md py-xs rounded-xl font-mono text-xs font-bold flex items-center gap-xs transition-colors">
          <span class="material-symbols-outlined text-[16px]">refresh</span> Generate New
        </button>
      </div>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  function updatePassLengthLabel(val) {
    document.getElementById('gen-len-val').innerText = val + ' characters';
  }

  function generateSecurePassword() {
    const len = parseInt(document.getElementById('gen-len-slider').value) || 16;
    const incUpper = document.getElementById('opt-upper').checked;
    const incLower = document.getElementById('opt-lower').checked;
    const incNum   = document.getElementById('opt-num').checked;
    const incSym   = document.getElementById('opt-sym').checked;

    let chars = '';
    if (incUpper) chars += 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    if (incLower) chars += 'abcdefghijklmnopqrstuvwxyz';
    if (incNum)   chars += '0123456789';
    if (incSym)   chars += '!@#$%^&*()_+-=[]{}|;:,.<>?';

    if (!chars) {
      document.getElementById('gen-pass-out').value = 'Please select at least 1 character set!';
      return;
    }

    const array = new Uint8Array(len);
    window.crypto.getRandomValues(array);
    let result = '';
    for (let i = 0; i < len; i++) {
      result += chars[array[i] % chars.length];
    }
    document.getElementById('gen-pass-out').value = result;

    const entropy = Math.round(len * Math.log2(chars.length));
    document.getElementById('gen-entropy-badge').innerText = 'Entropy: ' + entropy + ' bits';
  }

  function copyGeneratedPassword() {
    const out = document.getElementById('gen-pass-out');
    out.select();
    document.execCommand('copy');
    alert('Generated password copied to clipboard!');
  }

  document.addEventListener('DOMContentLoaded', generateSecurePassword);
</script>
