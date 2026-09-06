<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'Online Base64 & Hex Encoder / Decoder — Yaswant Dev Tools',
  'Free online Base64 and Hexadecimal encoder & decoder by Yaswant Pandey. Convert text, strings, and files to Base64, URL-Safe Base64, and Hex encoding in real time.',
  'base64 encoder, base64 decoder, text to base64, hex converter, base64 to text, url safe base64, developer tools by Yaswant Pandey',
  URL_TOOLS . '/base64-encoder',
  ['type' => 'website', 'title' => 'Online Base64 & Hex Encoder / Decoder — Yaswant Dev Tools'],
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
      <span class="text-zinc-300">Base64 Encoder</span>
    </nav>

    <!-- Main Tool Container -->
    <div class="bg-zinc-950 border border-zinc-800 rounded-2xl p-6 md:p-8 space-y-6 shadow-2xl">
      
      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-zinc-800 pb-5">
        <div>
          <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/30 text-indigo-400 text-xs font-mono uppercase mb-2">
            <span class="material-symbols-outlined text-[15px]">enhanced_encryption</span> Encoding Utility
          </div>
          <h1 class="text-xl md:text-3xl font-black text-white">Base64 & Hex Encoder / Decoder</h1>
          <p class="text-xs md:text-sm text-zinc-400 font-light mt-1">Encode and decode text strings, binary data, and URLs to Base64, URL-Safe Base64, and Hex.</p>
        </div>
      </div>

      <!-- Action Toolbar -->
      <div class="flex flex-wrap items-center justify-between gap-3 bg-zinc-900/60 p-3 rounded-xl border border-zinc-800">
        <div class="flex flex-wrap items-center gap-2">
          <button onclick="encodeText()" class="bg-emerald-500 hover:bg-emerald-400 text-black px-4 py-1.5 rounded-lg text-xs font-mono font-bold transition-all flex items-center gap-1 shadow-sm">
            <span class="material-symbols-outlined text-[14px]">lock</span> Encode Base64
          </button>
          <button onclick="decodeText()" class="bg-zinc-800 hover:bg-zinc-700 text-white px-4 py-1.5 rounded-lg text-xs font-mono font-bold transition-colors flex items-center gap-1">
            <span class="material-symbols-outlined text-[14px]">lock_open</span> Decode Base64
          </button>
          <button onclick="encodeToHex()" class="bg-zinc-800 hover:bg-zinc-700 text-cyan-400 px-3.5 py-1.5 rounded-lg text-xs font-mono font-bold transition-colors">
            To Hex
          </button>
          <button onclick="decodeFromHex()" class="bg-zinc-800 hover:bg-zinc-700 text-cyan-400 px-3.5 py-1.5 rounded-lg text-xs font-mono font-bold transition-colors">
            From Hex
          </button>
        </div>

        <div class="flex items-center gap-2">
          <button onclick="swapContent()" class="bg-zinc-800 hover:bg-zinc-700 text-zinc-300 px-3 py-1.5 rounded-lg text-xs font-mono font-bold transition-colors flex items-center gap-1">
            <span class="material-symbols-outlined text-[14px]">swap_vert</span> Swap
          </button>
          <button onclick="clearAll()" class="bg-zinc-800 hover:bg-red-500/20 text-red-400 px-3 py-1.5 rounded-lg text-xs font-mono font-bold transition-colors flex items-center gap-1">
            <span class="material-symbols-outlined text-[14px]">delete</span> Clear
          </button>
        </div>
      </div>

      <!-- Split Textareas -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="space-y-2">
          <div class="flex items-center justify-between">
            <label for="plain-input" class="text-xs font-mono text-zinc-400 uppercase tracking-wider">Plain Text Input</label>
            <span id="plain-count" class="text-[11px] font-mono text-zinc-500">0 chars</span>
          </div>
          <textarea id="plain-input" rows="10" placeholder="Type or paste plain text here..." oninput="updateCounts()"
            class="w-full bg-black border border-zinc-800 rounded-xl p-3.5 text-xs md:text-sm font-mono text-white placeholder:text-zinc-700 outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors leading-relaxed selection:bg-emerald-500/30"></textarea>
        </div>

        <div class="space-y-2">
          <div class="flex items-center justify-between">
            <label for="encoded-output" class="text-xs font-mono text-emerald-400 uppercase tracking-wider">Encoded / Result Output</label>
            <button onclick="copyOutput()" class="text-xs font-mono text-emerald-400 hover:underline flex items-center gap-1">
              <span class="material-symbols-outlined text-[14px]">content_copy</span> Copy Result
            </button>
          </div>
          <textarea id="encoded-output" rows="10" placeholder="Base64 or Hex encoded string appears here..." oninput="updateCounts()"
            class="w-full bg-black border border-zinc-800 rounded-xl p-3.5 text-xs md:text-sm font-mono text-emerald-400 placeholder:text-zinc-700 outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors leading-relaxed selection:bg-emerald-500/30"></textarea>
        </div>
      </div>

      <!-- File to Base64 Box -->
      <div class="p-4 rounded-xl border border-zinc-800 bg-zinc-900/40 flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="text-xs font-mono text-zinc-300">
          <span class="text-emerald-400 font-bold">File to Base64:</span> Convert any image or small file to Base64 Data URI
        </div>
        <label class="bg-zinc-800 hover:bg-zinc-700 text-white px-4 py-1.5 rounded-lg text-xs font-mono font-bold cursor-pointer transition-colors flex items-center gap-1">
          <span class="material-symbols-outlined text-[15px]">upload_file</span> Choose File
          <input type="file" id="file-uploader" class="hidden" onchange="convertFileToBase64(this)"/>
        </label>
      </div>

    </div>

    <!-- On-Page SEO Guide -->
    <section class="bg-zinc-950 border border-zinc-800/80 rounded-2xl p-6 md:p-8 space-y-4">
      <h2 class="text-lg md:text-2xl font-bold text-white">What is Base64 Encoding?</h2>
      <p class="text-xs md:text-sm text-zinc-400 font-light leading-relaxed">
        <strong>Base64</strong> is a binary-to-text encoding scheme that represents binary data in an ASCII string format using 64 printable characters. It is commonly used to transfer data over HTTP networks (e.g. email attachments via MIME, basic auth tokens, and embedded image Data URIs) without risk of data corruption.
      </p>
    </section>

  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  function encodeText() {
    const plain = document.getElementById('plain-input').value;
    try {
      const encoded = btoa(unescape(encodeURIComponent(plain)));
      document.getElementById('encoded-output').value = encoded;
      updateCounts();
    } catch (e) {
      alert('Error encoding to Base64: ' + e.message);
    }
  }

  function decodeText() {
    const encoded = document.getElementById('encoded-output').value.trim() || document.getElementById('plain-input').value.trim();
    try {
      const decoded = decodeURIComponent(escape(atob(encoded)));
      document.getElementById('plain-input').value = decoded;
      updateCounts();
    } catch (e) {
      alert('Invalid Base64 string: ' + e.message);
    }
  }

  function encodeToHex() {
    const plain = document.getElementById('plain-input').value;
    let hex = '';
    for (let i = 0; i < plain.length; i++) {
      hex += plain.charCodeAt(i).toString(16).padStart(2, '0') + ' ';
    }
    document.getElementById('encoded-output').value = hex.trim();
    updateCounts();
  }

  function decodeFromHex() {
    const hex = (document.getElementById('encoded-output').value.trim() || document.getElementById('plain-input').value.trim()).replace(/\s+/g, '');
    let str = '';
    for (let i = 0; i < hex.length; i += 2) {
      str += String.fromCharCode(parseInt(hex.substr(i, 2), 16));
    }
    document.getElementById('plain-input').value = str;
    updateCounts();
  }

  function swapContent() {
    const plain = document.getElementById('plain-input').value;
    document.getElementById('plain-input').value = document.getElementById('encoded-output').value;
    document.getElementById('encoded-output').value = plain;
    updateCounts();
  }

  function clearAll() {
    document.getElementById('plain-input').value = '';
    document.getElementById('encoded-output').value = '';
    updateCounts();
  }

  function copyOutput() {
    const val = document.getElementById('encoded-output').value;
    if (!val) return;
    navigator.clipboard.writeText(val);
    alert('Result copied to clipboard!');
  }

  function updateCounts() {
    document.getElementById('plain-count').innerText = document.getElementById('plain-input').value.length + ' chars';
  }

  function convertFileToBase64(input) {
    const file = input.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('encoded-output').value = e.target.result;
      document.getElementById('plain-input').value = 'File: ' + file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
      updateCounts();
    };
    reader.readAsDataURL(file);
  }
</script>
