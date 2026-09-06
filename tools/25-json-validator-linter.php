<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'JSON Validator & Syntax Linter — Developer Utilities',
  'Validate syntax structure, lint error positions, and pretty-print JSON objects.',
  'json validator, json linter, developer tools',
  URL_TOOLS . '/25-json-validator-linter.php',
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
          <span class="material-symbols-outlined text-emerald-400">data_object</span> JSON Validator & Linter
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Developer Tool</span>
      </div>

      <textarea id="json-input" rows="8" placeholder='{"name": "Yaswant", "role": "Developer", "status": "Active"}' class="w-full bg-surface-container-lowest border border-outline-variant/40 rounded-xl p-md text-xs font-mono text-on-surface outline-none"></textarea>
      
      <div class="flex items-center justify-between">
        <span id="json-status" class="text-xs font-mono text-on-surface-variant">Enter JSON string</span>
        <button onclick="validateJSON()" class="bg-emerald-500 text-black text-xs px-md py-sm rounded-xl font-mono font-bold">Validate & Format JSON</button>
      </div>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  function validateJSON() {
    const val = document.getElementById('json-input').value;
    const status = document.getElementById('json-status');
    try {
      const parsed = JSON.parse(val);
      document.getElementById('json-input').value = JSON.stringify(parsed, null, 2);
      status.innerText = '✓ Valid JSON! Formatted successfully.';
      status.className = 'text-xs font-mono text-emerald-400 font-bold';
    } catch (e) {
      status.innerText = '✗ Invalid JSON: ' + e.message;
      status.className = 'text-xs font-mono text-red-400 font-bold';
    }
  }
</script>
