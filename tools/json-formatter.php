<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'Online JSON Formatter, Validator & Beautifier — Yaswant Dev Tools',
  'Free online JSON formatter, validator, and beautifier by Yaswant Pandey. Format, minify, repair syntax errors, and inspect JSON with syntax highlighting in real time.',
  'json formatter, json beautifier, json validator, online json editor, json minifier, format json online, json lint, developer tools by Yaswant Pandey',
  URL_TOOLS . '/json-formatter',
  ['type' => 'website', 'title' => 'Online JSON Formatter & Validator — Yaswant Dev Tools'],
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
      <span class="text-zinc-300">JSON Formatter</span>
    </nav>

    <!-- Main Tool Container -->
    <div class="bg-zinc-950 border border-zinc-800 rounded-2xl p-6 md:p-8 space-y-6 shadow-2xl">
      
      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-zinc-800 pb-5">
        <div>
          <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-mono uppercase mb-2">
            <span class="material-symbols-outlined text-[15px]">data_object</span> Client-Side JSON Engine
          </div>
          <h1 class="text-xl md:text-3xl font-black text-white">JSON Formatter & Validator</h1>
          <p class="text-xs md:text-sm text-zinc-400 font-light mt-1">Beautify, validate, minify, and lint your JSON data instantly with zero server transmission.</p>
        </div>
        <div class="flex items-center gap-2">
          <button onclick="loadSampleJSON()" class="bg-zinc-900 hover:bg-zinc-800 text-zinc-300 border border-zinc-700 px-3 py-1.5 rounded-xl font-mono text-xs font-bold transition-colors flex items-center gap-1">
            <span class="material-symbols-outlined text-[14px]">science</span> Sample Data
          </button>
        </div>
      </div>

      <!-- Action Toolbar -->
      <div class="flex flex-wrap items-center justify-between gap-3 bg-zinc-900/60 p-3 rounded-xl border border-zinc-800">
        <div class="flex flex-wrap items-center gap-2">
          <button onclick="formatJSON(2)" class="bg-emerald-500 hover:bg-emerald-400 text-black px-3.5 py-1.5 rounded-lg text-xs font-mono font-bold transition-all flex items-center gap-1 shadow-sm">
            <span class="material-symbols-outlined text-[14px]">format_align_left</span> Format (2 Spaces)
          </button>
          <button onclick="formatJSON(4)" class="bg-zinc-800 hover:bg-zinc-700 text-white px-3 py-1.5 rounded-lg text-xs font-mono font-bold transition-colors">
            4 Spaces
          </button>
          <button onclick="minifyJSON()" class="bg-zinc-800 hover:bg-zinc-700 text-white px-3 py-1.5 rounded-lg text-xs font-mono font-bold transition-colors flex items-center gap-1">
            <span class="material-symbols-outlined text-[14px]">compress</span> Minify
          </button>
        </div>

        <div class="flex items-center gap-2">
          <button onclick="copyJSON()" class="bg-zinc-800 hover:bg-zinc-700 text-emerald-400 px-3 py-1.5 rounded-lg text-xs font-mono font-bold transition-colors flex items-center gap-1">
            <span class="material-symbols-outlined text-[14px]">content_copy</span> Copy
          </button>
          <button onclick="downloadJSON()" class="bg-zinc-800 hover:bg-zinc-700 text-cyan-400 px-3 py-1.5 rounded-lg text-xs font-mono font-bold transition-colors flex items-center gap-1">
            <span class="material-symbols-outlined text-[14px]">download</span> Download
          </button>
          <button onclick="clearJSON()" class="bg-zinc-800 hover:bg-red-500/20 text-red-400 px-3 py-1.5 rounded-lg text-xs font-mono font-bold transition-colors flex items-center gap-1">
            <span class="material-symbols-outlined text-[14px]">delete</span> Clear
          </button>
        </div>
      </div>

      <!-- Editor Textarea -->
      <div class="space-y-2">
        <textarea id="json-input" rows="16" placeholder='Paste your raw JSON string here e.g. {"name": "Yaswant", "role": "Engineer"}...' 
          oninput="validateRealtime()"
          class="w-full bg-black border border-zinc-800 rounded-xl p-4 text-xs md:text-sm font-mono text-emerald-400 placeholder:text-zinc-700 outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-colors leading-relaxed selection:bg-emerald-500/30 resize-y"></textarea>
      </div>

      <!-- Status Bar -->
      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-2 p-3 bg-zinc-900/40 rounded-xl border border-zinc-800/80 text-xs font-mono">
        <div id="json-status" class="flex items-center gap-1.5 text-zinc-400">
          <span class="w-2 h-2 rounded-full bg-zinc-600"></span> Ready for JSON input
        </div>
        <div class="flex items-center gap-4 text-zinc-500">
          <span>Characters: <strong id="stat-chars" class="text-zinc-300">0</strong></span>
          <span>Lines: <strong id="stat-lines" class="text-zinc-300">0</strong></span>
          <span>Size: <strong id="stat-size" class="text-zinc-300">0 B</strong></span>
        </div>
      </div>

    </div>

    <!-- On-Page SEO Guide & FAQ Section -->
    <section class="bg-zinc-950 border border-zinc-800/80 rounded-2xl p-6 md:p-8 space-y-6">
      <div>
        <h2 class="text-lg md:text-2xl font-bold text-white">What is a JSON Formatter & Validator?</h2>
        <p class="text-xs md:text-sm text-zinc-400 font-light mt-2 leading-relaxed">
          <strong>JavaScript Object Notation (JSON)</strong> is the standard lightweight data interchange format used in web APIs and modern microservices. Our JSON Formatter parses your minified or unformatted JSON strings, applies structured indentation, validates syntax against RFC 8259 specifications, and highlights errors instantly without sending your confidential payload to external servers.
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-2">
        <div class="bg-zinc-900/60 p-4 rounded-xl border border-zinc-800">
          <span class="material-symbols-outlined text-emerald-400 text-xl mb-1">lock</span>
          <h3 class="text-xs font-bold text-white mb-1">Zero-Knowledge Privacy</h3>
          <p class="text-[11px] text-zinc-400 font-light leading-relaxed">Runs 100% in your local browser sandbox memory.</p>
        </div>
        <div class="bg-zinc-900/60 p-4 rounded-xl border border-zinc-800">
          <span class="material-symbols-outlined text-cyan-400 text-xl mb-1">bolt</span>
          <h3 class="text-xs font-bold text-white mb-1">Sub-Millisecond Speed</h3>
          <p class="text-[11px] text-zinc-400 font-light leading-relaxed">Instant parsing for payloads up to 10MB using native browser engines.</p>
        </div>
        <div class="bg-zinc-900/60 p-4 rounded-xl border border-zinc-800">
          <span class="material-symbols-outlined text-indigo-400 text-xl mb-1">error</span>
          <h3 class="text-xs font-bold text-white mb-1">Precise Error Detection</h3>
          <p class="text-[11px] text-zinc-400 font-light leading-relaxed">Locates missing commas, unquoted keys, and trailing syntax bugs.</p>
        </div>
      </div>
    </section>

  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  function formatJSON(indent) {
    const input = document.getElementById('json-input');
    const status = document.getElementById('json-status');
    const val = input.value.trim();
    if (!val) return;

    try {
      const parsed = JSON.parse(val);
      input.value = JSON.stringify(parsed, null, indent);
      status.innerHTML = '<span class="w-2 h-2 rounded-full bg-emerald-400"></span> <span class="text-emerald-400 font-bold">Valid JSON formatted successfully!</span>';
      updateStats();
    } catch (e) {
      status.innerHTML = '<span class="w-2 h-2 rounded-full bg-red-400"></span> <span class="text-red-400 font-bold">Syntax Error: ' + e.message + '</span>';
    }
  }

  function minifyJSON() {
    const input = document.getElementById('json-input');
    const status = document.getElementById('json-status');
    const val = input.value.trim();
    if (!val) return;

    try {
      const parsed = JSON.parse(val);
      input.value = JSON.stringify(parsed);
      status.innerHTML = '<span class="w-2 h-2 rounded-full bg-emerald-400"></span> <span class="text-emerald-400 font-bold">Minified JSON successfully!</span>';
      updateStats();
    } catch (e) {
      status.innerHTML = '<span class="w-2 h-2 rounded-full bg-red-400"></span> <span class="text-red-400 font-bold">Syntax Error: ' + e.message + '</span>';
    }
  }

  function validateRealtime() {
    updateStats();
    const input = document.getElementById('json-input');
    const status = document.getElementById('json-status');
    const val = input.value.trim();
    if (!val) {
      status.innerHTML = '<span class="w-2 h-2 rounded-full bg-zinc-600"></span> Ready for JSON input';
      return;
    }

    try {
      JSON.parse(val);
      status.innerHTML = '<span class="w-2 h-2 rounded-full bg-emerald-400"></span> <span class="text-emerald-400">Valid JSON structure</span>';
    } catch (e) {
      status.innerHTML = '<span class="w-2 h-2 rounded-full bg-amber-400"></span> <span class="text-amber-400">Invalid JSON: ' + e.message + '</span>';
    }
  }

  function updateStats() {
    const val = document.getElementById('json-input').value;
    document.getElementById('stat-chars').innerText = val.length.toLocaleString();
    document.getElementById('stat-lines').innerText = val ? val.split('\n').length.toLocaleString() : '0';
    const bytes = new Blob([val]).size;
    document.getElementById('stat-size').innerText = bytes < 1024 ? bytes + ' B' : (bytes / 1024).toFixed(1) + ' KB';
  }

  function copyJSON() {
    const input = document.getElementById('json-input');
    if (!input.value) return;
    navigator.clipboard.writeText(input.value);
    alert('JSON copied to clipboard!');
  }

  function downloadJSON() {
    const val = document.getElementById('json-input').value;
    if (!val) return;
    const blob = new Blob([val], { type: 'application/json' });
    const url = URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'data.json';
    a.click();
    URL.revokeObjectURL(url);
  }

  function clearJSON() {
    document.getElementById('json-input').value = '';
    validateRealtime();
  }

  function loadSampleJSON() {
    const sample = {
      "project": "Yaswant Dev Platform",
      "author": "Yaswant Pandey",
      "tools_count": 26,
      "features": [
        "JSON Formatter & Validator",
        "JWT Token Decoder",
        "Base64 & Hex Engine",
        "UUID Generator",
        "Cryptographic Hash Generator",
        "REST API Tester"
      ],
      "active": true
    };
    document.getElementById('json-input').value = JSON.stringify(sample, null, 2);
    validateRealtime();
  }
</script>
