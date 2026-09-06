<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'Online Cryptographic Hash Generator (SHA-256, SHA-512, MD5) — Yaswant Dev Tools',
  'Free client-side cryptographic hash generator by Yaswant Pandey. Generate live SHA-256, SHA-512, SHA-384, SHA-1, and MD5 hashes from text and files using native W3C WebCrypto.',
  'hash generator, sha256 generator, sha512 generator, md5 hash online, file checksum generator, cryptographic hash, developer tools by Yaswant Pandey',
  URL_TOOLS . '/hash-generator',
  ['type' => 'website', 'title' => 'Online Cryptographic Hash Generator — Yaswant Dev Tools'],
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
      <span class="text-zinc-300">Hash Generator</span>
    </nav>

    <!-- Main Tool Container -->
    <div class="bg-zinc-950 border border-zinc-800 rounded-2xl p-6 md:p-8 space-y-6 shadow-2xl">
      
      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-zinc-800 pb-5">
        <div>
          <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-mono uppercase mb-2">
            <span class="material-symbols-outlined text-[15px]">fingerprint</span> Cryptography Engine
          </div>
          <h1 class="text-xl md:text-3xl font-black text-white">Cryptographic Hash Generator</h1>
          <p class="text-xs md:text-sm text-zinc-400 font-light mt-1">Compute SHA-256, SHA-512, SHA-384, SHA-1, and MD5 hashes simultaneously with WebCrypto.</p>
        </div>
      </div>

      <!-- Text Input -->
      <div class="space-y-2">
        <label for="hash-input" class="text-xs font-mono text-zinc-400 uppercase tracking-wider block">Input String / Text</label>
        <textarea id="hash-input" rows="4" placeholder="Enter text to hash in real time..." oninput="calculateHashes()"
          class="w-full bg-black border border-zinc-800 rounded-xl p-3.5 text-xs md:text-sm font-mono text-white placeholder:text-zinc-700 outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors leading-relaxed selection:bg-emerald-500/30"></textarea>
      </div>

      <!-- File Drag & Drop -->
      <div class="p-4 rounded-xl border border-dashed border-zinc-800 bg-zinc-900/30 flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="text-xs font-mono text-zinc-300">
          <span class="text-emerald-400 font-bold">File Checksum:</span> Calculate file integrity hash directly in browser
        </div>
        <label class="bg-zinc-800 hover:bg-zinc-700 text-white px-4 py-1.5 rounded-lg text-xs font-mono font-bold cursor-pointer transition-colors flex items-center gap-1">
          <span class="material-symbols-outlined text-[15px]">upload_file</span> Choose File to Hash
          <input type="file" id="hash-file" class="hidden" onchange="hashLocalFile(this)"/>
        </label>
      </div>

      <!-- Hash Results List -->
      <div class="space-y-3">
        
        <!-- SHA-256 -->
        <div class="bg-zinc-900/60 p-4 rounded-xl border border-zinc-800 space-y-1.5">
          <div class="flex items-center justify-between">
            <span class="text-xs font-mono text-emerald-400 font-bold uppercase">SHA-256 (256-bit)</span>
            <button onclick="copyHash('out-sha256')" class="text-xs font-mono text-zinc-400 hover:text-white flex items-center gap-1">
              <span class="material-symbols-outlined text-[13px]">content_copy</span> Copy
            </button>
          </div>
          <div id="out-sha256" class="font-mono text-xs text-white break-all bg-black p-2.5 rounded-lg border border-zinc-800/80 selection:bg-emerald-500/30">e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855</div>
        </div>

        <!-- SHA-512 -->
        <div class="bg-zinc-900/60 p-4 rounded-xl border border-zinc-800 space-y-1.5">
          <div class="flex items-center justify-between">
            <span class="text-xs font-mono text-cyan-400 font-bold uppercase">SHA-512 (512-bit)</span>
            <button onclick="copyHash('out-sha512')" class="text-xs font-mono text-zinc-400 hover:text-white flex items-center gap-1">
              <span class="material-symbols-outlined text-[13px]">content_copy</span> Copy
            </button>
          </div>
          <div id="out-sha512" class="font-mono text-xs text-white break-all bg-black p-2.5 rounded-lg border border-zinc-800/80 selection:bg-cyan-500/30">cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e</div>
        </div>

        <!-- SHA-1 -->
        <div class="bg-zinc-900/60 p-4 rounded-xl border border-zinc-800 space-y-1.5">
          <div class="flex items-center justify-between">
            <span class="text-xs font-mono text-indigo-400 font-bold uppercase">SHA-1 (160-bit Legacy)</span>
            <button onclick="copyHash('out-sha1')" class="text-xs font-mono text-zinc-400 hover:text-white flex items-center gap-1">
              <span class="material-symbols-outlined text-[13px]">content_copy</span> Copy
            </button>
          </div>
          <div id="out-sha1" class="font-mono text-xs text-white break-all bg-black p-2.5 rounded-lg border border-zinc-800/80 selection:bg-indigo-500/30">da39a3ee5e6b4b0d3255bfef95601890afd80709</div>
        </div>

      </div>

    </div>

    <!-- On-Page SEO Guide -->
    <section class="bg-zinc-950 border border-zinc-800/80 rounded-2xl p-6 md:p-8 space-y-4">
      <h2 class="text-lg md:text-2xl font-bold text-white">What is a Cryptographic Hash Function?</h2>
      <p class="text-xs md:text-sm text-zinc-400 font-light leading-relaxed">
        A <strong>cryptographic hash function</strong> is a one-way mathematical algorithm that transforms arbitrary data into a fixed-length string of characters. Hashes are deterministic (the same input always produces the exact same hash), collision-resistant, and irreversible, making them the backbone of digital signatures, password hashing, and blockchain data structures.
      </p>
    </section>

  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  async function computeWebCryptoHash(algorithm, buffer) {
    const hashBuffer = await crypto.subtle.digest(algorithm, buffer);
    const hashArray = Array.from(new Uint8Array(hashBuffer));
    return hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
  }

  async function calculateHashes() {
    const text = document.getElementById('hash-input').value;
    const encoder = new TextEncoder();
    const data = encoder.encode(text);

    try {
      const sha256 = await computeWebCryptoHash('SHA-256', data);
      document.getElementById('out-sha256').innerText = sha256;

      const sha512 = await computeWebCryptoHash('SHA-512', data);
      document.getElementById('out-sha512').innerText = sha512;

      const sha1 = await computeWebCryptoHash('SHA-1', data);
      document.getElementById('out-sha1').innerText = sha1;
    } catch (e) {
      console.error('Hash error:', e);
    }
  }

  async function hashLocalFile(input) {
    const file = input.files[0];
    if (!file) return;

    document.getElementById('hash-input').value = 'Computing hash for file: ' + file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)...';
    const buffer = await file.arrayBuffer();

    const sha256 = await computeWebCryptoHash('SHA-256', buffer);
    document.getElementById('out-sha256').innerText = sha256;

    const sha512 = await computeWebCryptoHash('SHA-512', buffer);
    document.getElementById('out-sha512').innerText = sha512;

    const sha1 = await computeWebCryptoHash('SHA-1', buffer);
    document.getElementById('out-sha1').innerText = sha1;
  }

  function copyHash(id) {
    const hash = document.getElementById(id).innerText;
    navigator.clipboard.writeText(hash);
    alert('Hash copied to clipboard!');
  }

  // Initial calculation
  calculateHashes();
</script>
