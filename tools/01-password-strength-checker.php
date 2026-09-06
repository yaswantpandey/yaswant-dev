<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'Password Strength & Shannon Entropy Checker — Cyber Security Tools',
  'Calculate Shannon entropy in bits, character set diversity, and visual strength score with zero-knowledge client-side processing.',
  'password strength checker, shannon entropy, security tools, password audit',
  URL_TOOLS . '/01-password-strength-checker.php',
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
          <span class="material-symbols-outlined text-emerald-400">lock_reset</span> Password Strength & Shannon Entropy Checker
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Security Tool</span>
      </div>

      <p class="font-body-md text-xs text-on-surface-variant">Calculates Shannon entropy ($L \times \log_2 R$), character diversity (length, case, numbers, symbols), and visual strength score using zero-knowledge client-side Web Cryptography.</p>

      <div class="space-y-sm">
        <input type="password" id="pass-check-input" oninput="checkPasswordStrength()" placeholder="Enter password to test strength..."
          class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl p-md text-xs font-mono text-on-surface outline-none focus:ring-2 focus:ring-emerald-400"/>
        <div class="w-full bg-surface-container-lowest h-3 rounded-full overflow-hidden">
          <div id="pass-meter-bar" class="h-full bg-red-500 w-0 transition-all duration-300"></div>
        </div>
        <div class="flex justify-between text-xs font-mono">
          <span class="text-on-surface-variant">Entropy Score: <strong id="pass-entropy-val" class="text-emerald-400">0 bits</strong></span>
          <span id="pass-status-label" class="text-red-400 font-bold">Very Weak</span>
        </div>
      </div>

      <div class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono text-on-surface-variant space-y-1 border border-outline-variant/20">
        <div>Length: <span id="chk-len" class="text-zinc-400">0</span> chars</div>
        <div>Uppercase / Lowercase: <span id="chk-case" class="text-zinc-400">No</span></div>
        <div>Numbers & Symbols: <span id="chk-sym" class="text-zinc-400">No</span></div>
      </div>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  function checkPasswordStrength() {
    const val = document.getElementById('pass-check-input').value;
    const bar = document.getElementById('pass-meter-bar');
    const entVal = document.getElementById('pass-entropy-val');
    const label = document.getElementById('pass-status-label');

    document.getElementById('chk-len').innerText = val.length;
    document.getElementById('chk-case').innerText = (/[a-z]/.test(val) && /[A-Z]/.test(val)) ? 'Yes' : 'No';
    document.getElementById('chk-sym').innerText = (/[0-9]/.test(val) && /[^a-zA-Z0-9]/.test(val)) ? 'Yes' : 'No';

    let entropy = 0;
    if (val.length > 0) {
      let pool = 0;
      if (/[a-z]/.test(val)) pool += 26;
      if (/[A-Z]/.test(val)) pool += 26;
      if (/[0-9]/.test(val)) pool += 10;
      if (/[^a-zA-Z0-9]/.test(val)) pool += 32;
      entropy = Math.round(val.length * Math.log2(pool || 1));
    }

    entVal.innerText = entropy + ' bits';

    if (entropy < 30) {
      bar.style.width = '25%'; bar.className = 'h-full bg-red-500 transition-all duration-300';
      label.innerText = 'Very Weak'; label.className = 'text-red-400 font-bold';
    } else if (entropy < 50) {
      bar.style.width = '50%'; bar.className = 'h-full bg-amber-500 transition-all duration-300';
      label.innerText = 'Moderate'; label.className = 'text-amber-400 font-bold';
    } else if (entropy < 70) {
      bar.style.width = '75%'; bar.className = 'h-full bg-yellow-400 transition-all duration-300';
      label.innerText = 'Strong'; label.className = 'text-yellow-400 font-bold';
    } else {
      bar.style.width = '100%'; bar.className = 'h-full bg-emerald-400 transition-all duration-300';
      label.innerText = 'Very Strong (High Entropy)'; label.className = 'text-emerald-400 font-bold';
    }
  }
</script>
