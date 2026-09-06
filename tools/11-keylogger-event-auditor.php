<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'Keylogger & Input Event Auditor — Cyber Security Tools',
  'Capture live keypress events, keycodes, and modifier combinations (Shift, Ctrl, Alt).',
  'keylogger auditor, input event inspector, security tools',
  URL_TOOLS . '/11-keylogger-event-auditor.php',
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
          <span class="material-symbols-outlined text-emerald-400">keyboard</span> Keylogger & Input Event Auditor
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Security Tool</span>
      </div>

      <input type="text" id="key-test-input" onkeydown="auditKeystroke(event)" placeholder="Click here and type any key combination (Shift, Ctrl, Alt, Letters)..." class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-xs font-mono text-on-surface outline-none focus:ring-2 focus:ring-emerald-400"/>
      
      <div id="key-log-stream" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono max-h-72 overflow-y-auto border border-outline-variant/20 space-y-1">
        <span class="text-zinc-500">Live keystroke logs will stream here as you type...</span>
      </div>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  function auditKeystroke(e) {
    const stream = document.getElementById('key-log-stream');
    const time = new Date().toLocaleTimeString();
    const mods = [];
    if (e.ctrlKey) mods.push('Ctrl');
    if (e.shiftKey) mods.push('Shift');
    if (e.altKey) mods.push('Alt');

    const modStr = mods.length > 0 ? `[${mods.join('+')}] ` : '';
    const item = document.createElement('div');
    item.className = 'text-emerald-400 font-mono text-xs';
    item.innerText = `[${time}] Key: "${e.key}" | Code: ${e.code} | KeyCode: ${e.keyCode} ${modStr}`;

    if (stream.children[0] && stream.children[0].innerText.startsWith('Live keystroke logs')) {
      stream.innerHTML = '';
    }
    stream.prepend(item);
  }
</script>
