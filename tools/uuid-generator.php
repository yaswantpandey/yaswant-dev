<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'Online UUID / GUID v4 Generator (Bulk & RFC 4122) — Yaswant Dev Tools',
  'Free online UUID (Universally Unique Identifier) v4 generator by Yaswant Pandey. Generate random, cryptographically secure UUIDs and GUIDs individually or in bulk.',
  'uuid generator, guid generator, uuid v4, random uuid online, bulk uuid generator, online guid maker, developer tools by Yaswant Pandey',
  URL_TOOLS . '/uuid-generator',
  ['type' => 'website', 'title' => 'Online UUID / GUID v4 Generator — Yaswant Dev Tools'],
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
      <span class="text-zinc-300">UUID Generator</span>
    </nav>

    <!-- Main Tool Container -->
    <div class="bg-zinc-950 border border-zinc-800 rounded-2xl p-6 md:p-8 space-y-6 shadow-2xl">
      
      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-zinc-800 pb-5">
        <div>
          <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-mono uppercase mb-2">
            <span class="material-symbols-outlined text-[15px]">tag</span> RFC 4122 Standard
          </div>
          <h1 class="text-xl md:text-3xl font-black text-white">UUID / GUID v4 Generator</h1>
          <p class="text-xs md:text-sm text-zinc-400 font-light mt-1">Generate cryptographically secure version-4 random UUIDs locally in your browser.</p>
        </div>
      </div>

      <!-- Single Primary UUID Display -->
      <div class="bg-black p-5 rounded-2xl border border-zinc-800 flex flex-col sm:flex-row items-center justify-between gap-3 shadow-inner">
        <span id="single-uuid" class="text-base sm:text-2xl font-mono font-black text-emerald-400 tracking-wider break-all selection:bg-emerald-500/30">
          Generating...
        </span>
        <div class="flex items-center gap-2 shrink-0">
          <button onclick="copySingleUUID()" class="bg-emerald-500 hover:bg-emerald-400 text-black px-4 py-2 rounded-xl text-xs font-mono font-bold transition-all flex items-center gap-1 shadow-md">
            <span class="material-symbols-outlined text-[16px]">content_copy</span> Copy
          </button>
          <button onclick="generateSingleUUID()" class="bg-zinc-900 hover:bg-zinc-800 border border-zinc-700 text-white p-2 rounded-xl text-xs font-mono transition-colors">
            <span class="material-symbols-outlined text-[18px]">refresh</span>
          </button>
        </div>
      </div>

      <!-- Bulk Generation Options -->
      <div class="bg-zinc-900/60 p-5 rounded-xl border border-zinc-800 space-y-4">
        <h3 class="text-xs font-mono uppercase text-zinc-400 tracking-wider font-bold">Bulk Generator Options</h3>
        
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
          <div class="space-y-1">
            <label for="bulk-count" class="text-xs font-mono text-zinc-400">Count:</label>
            <select id="bulk-count" class="w-full bg-black border border-zinc-800 rounded-lg px-3 py-2 text-xs font-mono text-white outline-none focus:border-emerald-500">
              <option value="5">5 UUIDs</option>
              <option value="10" selected>10 UUIDs</option>
              <option value="25">25 UUIDs</option>
              <option value="50">50 UUIDs</option>
              <option value="100">100 UUIDs</option>
            </select>
          </div>

          <div class="space-y-1">
            <label class="text-xs font-mono text-zinc-400">Case:</label>
            <div class="flex gap-2">
              <label class="flex items-center gap-1 text-xs font-mono text-zinc-300 cursor-pointer">
                <input type="radio" name="opt-case" value="lower" checked class="accent-emerald-500"/> Lowercase
              </label>
              <label class="flex items-center gap-1 text-xs font-mono text-zinc-300 cursor-pointer">
                <input type="radio" name="opt-case" value="upper" class="accent-emerald-500"/> Uppercase
              </label>
            </div>
          </div>

          <div class="space-y-1">
            <label class="text-xs font-mono text-zinc-400">Format:</label>
            <label class="flex items-center gap-1 text-xs font-mono text-zinc-300 cursor-pointer">
              <input type="checkbox" id="opt-hyphen" checked class="accent-emerald-500"/> Include Hyphens (-)
            </label>
          </div>
        </div>

        <div class="flex gap-2 pt-2">
          <button onclick="generateBulkUUIDs()" class="bg-emerald-500 hover:bg-emerald-400 text-black px-4 py-2 rounded-xl text-xs font-mono font-bold transition-all flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">sync</span> Generate Bulk UUIDs
          </button>
          <button onclick="copyBulkUUIDs()" class="bg-zinc-800 hover:bg-zinc-700 text-white px-4 py-2 rounded-xl text-xs font-mono font-bold transition-colors flex items-center gap-1">
            <span class="material-symbols-outlined text-[16px]">content_copy</span> Copy All
          </button>
        </div>

        <textarea id="bulk-output" rows="8" readonly
          class="w-full bg-black border border-zinc-800 rounded-xl p-3.5 text-xs font-mono text-zinc-300 outline-none leading-relaxed selection:bg-emerald-500/30"></textarea>
      </div>

    </div>

    <!-- On-Page SEO Guide -->
    <section class="bg-zinc-950 border border-zinc-800/80 rounded-2xl p-6 md:p-8 space-y-4">
      <h2 class="text-lg md:text-2xl font-bold text-white">What is a UUID (Universally Unique Identifier)?</h2>
      <p class="text-xs md:text-sm text-zinc-400 font-light leading-relaxed">
        A <strong>UUID (v4)</strong> is a 128-bit label used in software development to uniquely identify resources without central coordination. The probability of generating a duplicate UUID v4 is mathematically close to zero (1 in 5.3 x 10^36).
      </p>
    </section>

  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  function getUUIDv4() {
    if (typeof crypto.randomUUID === 'function') {
      return crypto.randomUUID();
    }
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
      const r = Math.random() * 16 | 0;
      const v = c === 'x' ? r : (r & 0x3 | 0x8);
      return v.toString(16);
    });
  }

  function generateSingleUUID() {
    document.getElementById('single-uuid').innerText = getUUIDv4();
  }

  function copySingleUUID() {
    const text = document.getElementById('single-uuid').innerText;
    navigator.clipboard.writeText(text);
    alert('Copied UUID: ' + text);
  }

  function generateBulkUUIDs() {
    const count = parseInt(document.getElementById('bulk-count').value) || 10;
    const isUpper = document.querySelector('input[name="opt-case"]:checked').value === 'upper';
    const withHyphen = document.getElementById('opt-hyphen').checked;

    const list = [];
    for (let i = 0; i < count; i++) {
      let u = getUUIDv4();
      if (!withHyphen) u = u.replace(/-/g, '');
      if (isUpper) u = u.toUpperCase();
      list.push(u);
    }
    document.getElementById('bulk-output').value = list.join('\n');
  }

  function copyBulkUUIDs() {
    const val = document.getElementById('bulk-output').value;
    if (!val) return;
    navigator.clipboard.writeText(val);
    alert('Copied all bulk UUIDs to clipboard!');
  }

  // Initial load
  generateSingleUUID();
  generateBulkUUIDs();
</script>
