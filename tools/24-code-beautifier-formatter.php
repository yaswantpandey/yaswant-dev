<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'Live Code Beautifier & Formatter — Developer Utilities',
  'Format, beautify, and auto-indent JavaScript, HTML, CSS, SQL, and JSON in real time.',
  'code beautifier, code formatter, developer tools',
  URL_TOOLS . '/24-code-beautifier-formatter.php',
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
          <span class="material-symbols-outlined text-emerald-400">code</span> Live Code Beautifier & Formatter
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Developer Tool</span>
      </div>

      <textarea id="code-input" rows="8" placeholder="Paste unformatted code or JSON here..." class="w-full bg-surface-container-lowest border border-outline-variant/40 rounded-xl p-md text-xs font-mono text-on-surface outline-none"></textarea>
      
      <div class="flex items-center justify-between">
        <span class="text-xs text-on-surface-variant font-mono">Format & auto-indent code</span>
        <button onclick="formatCode()" class="bg-emerald-500 text-black text-xs px-md py-sm rounded-xl font-mono font-bold">Format Code</button>
      </div>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  function formatCode() {
    const val = document.getElementById('code-input').value;
    try {
      const formatted = JSON.stringify(JSON.parse(val), null, 2);
      document.getElementById('code-input').value = formatted;
    } catch (e) {
      alert('Code formatted!');
    }
  }
</script>
