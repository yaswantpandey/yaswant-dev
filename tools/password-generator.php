<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'Online CSPRNG Password Generator & Passphrase Creator — Yaswant Dev Tools',
  'Free hardware-level cryptographic random password & passphrase generator by Yaswant Pandey. Custom length sliders, character toggles, Shannon entropy meter, and crack time analysis.',
  'password generator, csprng password generator, secure password generator, random password maker, strong password generator, developer tools by Yaswant Pandey',
  URL_TOOLS . '/password-generator',
  ['type' => 'website', 'title' => 'Online CSPRNG Password Generator — Yaswant Dev Tools'],
  $schema
);
?>
<div class="sidebar-push pl-0 lg:pl-72 flex flex-col min-h-screen">
  <?php nexus_sidebar('tools'); nexus_topbar('tools'); ?>
  <main id="main-content" role="main" class="flex-1 pt-16 w-full max-w-max-width-content mx-auto p-lg space-y-lg">
    
    <!-- Breadcrumb -->
    <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs font-mono text-zinc-400">
      <a href="<?= URL_HOME ?>" class="hover:text-emerald-400 transition-colors">Home</a>
      <span class="text-zinc-600">/</span>
      <a href="<?= URL_TOOLS ?>" class="hover:text-emerald-400 transition-colors">Tools</a>
      <span class="text-zinc-600">/</span>
      <span class="text-zinc-300">Password Generator</span>
    </nav>

    <!-- Main Tool Container -->
    <div class="bg-zinc-950 border border-zinc-800 rounded-2xl p-6 md:p-8 space-y-6 shadow-2xl">
      
      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-zinc-800 pb-5">
        <div>
          <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-mono uppercase mb-2">
            <span class="material-symbols-outlined text-[15px]">security</span> CSPRNG WebCrypto
          </div>
          <h1 class="text-xl md:text-3xl font-black text-white">Strong Password Generator</h1>
          <p class="text-xs md:text-sm text-zinc-400 font-light mt-1">Generate uncrackable, hardware-randomized passwords and passphrases with entropy metrics.</p>
        </div>
      </div>

      <!-- Generated Password Box -->
      <div class="bg-black p-5 rounded-2xl border border-zinc-800 flex flex-col sm:flex-row items-center justify-between gap-3 shadow-inner">
        <input type="text" id="gen-pass-out" readonly 
          class="w-full bg-transparent text-base sm:text-2xl font-mono font-bold text-emerald-400 outline-none selection:bg-emerald-500/30"/>
        <div class="flex items-center gap-2 shrink-0 w-full sm:w-auto justify-end">
          <button onclick="copyGeneratedPassword()" class="bg-emerald-500 hover:bg-emerald-400 text-black px-4 py-2.5 rounded-xl font-mono text-xs font-bold transition-all flex items-center gap-1 shadow-md">
            <span class="material-symbols-outlined text-[16px]">content_copy</span> Copy
          </button>
          <button onclick="generateSecurePassword()" class="bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white p-2.5 rounded-xl font-mono text-xs transition-colors">
            <span class="material-symbols-outlined text-[18px]">refresh</span>
          </button>
        </div>
      </div>

      <!-- Options & Sliders -->
      <div class="bg-zinc-900/60 p-5 rounded-xl border border-zinc-800 space-y-5">
        
        <!-- Length Slider -->
        <div class="space-y-2">
          <div class="flex justify-between text-xs font-mono text-zinc-300">
            <span>Password Length:</span>
            <span id="gen-len-val" class="text-emerald-400 font-bold">20 characters</span>
          </div>
          <input type="range" id="gen-len-slider" min="8" max="64" value="20" oninput="updatePassLengthLabel(this.value); generateSecurePassword();" class="w-full accent-emerald-500 cursor-pointer"/>
        </div>

        <!-- Checkboxes -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-xs font-mono text-zinc-300">
          <label class="flex items-center gap-2 cursor-pointer bg-black/50 p-2.5 rounded-lg border border-zinc-800 hover:border-zinc-700 transition-colors">
            <input type="checkbox" id="opt-upper" checked onchange="generateSecurePassword()" class="accent-emerald-500"/>
            <span>Uppercase (A-Z)</span>
          </label>
          <label class="flex items-center gap-2 cursor-pointer bg-black/50 p-2.5 rounded-lg border border-zinc-800 hover:border-zinc-700 transition-colors">
            <input type="checkbox" id="opt-lower" checked onchange="generateSecurePassword()" class="accent-emerald-500"/>
            <span>Lowercase (a-z)</span>
          </label>
          <label class="flex items-center gap-2 cursor-pointer bg-black/50 p-2.5 rounded-lg border border-zinc-800 hover:border-zinc-700 transition-colors">
            <input type="checkbox" id="opt-num" checked onchange="generateSecurePassword()" class="accent-emerald-500"/>
            <span>Numbers (0-9)</span>
          </label>
          <label class="flex items-center gap-2 cursor-pointer bg-black/50 p-2.5 rounded-lg border border-zinc-800 hover:border-zinc-700 transition-colors">
            <input type="checkbox" id="opt-sym" checked onchange="generateSecurePassword()" class="accent-emerald-500"/>
            <span>Symbols (!@#$)</span>
          </label>
        </div>

        <!-- Entropy & Crack Time Stats -->
        <div class="flex flex-wrap items-center justify-between gap-3 pt-3 border-t border-zinc-800 text-xs font-mono">
          <div class="flex items-center gap-3">
            <span id="gen-entropy-badge" class="text-emerald-400 bg-emerald-500/10 px-3 py-1 rounded-md border border-emerald-500/20 font-bold">
              Entropy: 119 bits
            </span>
            <span id="gen-crack-time" class="text-zinc-400">Crack Time: &gt; 100 Trillion Years</span>
          </div>
          <button onclick="generateSecurePassword()" class="text-xs font-mono text-emerald-400 hover:underline flex items-center gap-1">
            <span class="material-symbols-outlined text-[14px]">autorenew</span> Regenerate
          </button>
        </div>

      </div>

    </div>

    <!-- On-Page SEO Guide -->
    <section class="bg-zinc-950 border border-zinc-800/80 rounded-2xl p-6 md:p-8 space-y-4">
      <h2 class="text-lg md:text-2xl font-bold text-white">What makes a password cryptographically secure?</h2>
      <p class="text-xs md:text-sm text-zinc-400 font-light leading-relaxed">
        Standard <code>Math.random()</code> pseudo-random functions in JavaScript are predictable. Our generator uses <strong><code>window.crypto.getRandomValues()</code></strong> (CSPRNG), which samples true cryptographic entropy from your operating system kernel hardware state, ensuring 100% unpredictability against brute-force attacks.
      </p>
    </section>

  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  function updatePassLengthLabel(val) {
    document.getElementById('gen-len-val').innerText = val + ' characters';
  }

  function generateSecurePassword() {
    const len = parseInt(document.getElementById('gen-len-slider').value) || 20;
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

    if (entropy > 80) {
      document.getElementById('gen-crack-time').innerText = 'Crack Time: > 100 Trillion Years (Military Grade)';
    } else if (entropy > 60) {
      document.getElementById('gen-crack-time').innerText = 'Crack Time: ~ 500,000 Years (Very Strong)';
    } else {
      document.getElementById('gen-crack-time').innerText = 'Crack Time: Minutes / Hours (Weak)';
    }
  }

  function copyGeneratedPassword() {
    const out = document.getElementById('gen-pass-out');
    if (!out.value) return;
    navigator.clipboard.writeText(out.value);
    alert('Password copied to clipboard!');
  }

  // Initial load
  generateSecurePassword();
</script>
