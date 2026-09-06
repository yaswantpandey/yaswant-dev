<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'Browser Port Reachability Scanner — Cyber Security Tools',
  'Test TCP port responsiveness and WebSocket host connectivity directly in browser.',
  'browser port scanner, websocket port test, security tools',
  URL_TOOLS . '/21-browser-port-reachability-scanner.php',
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
          <span class="material-symbols-outlined text-emerald-400">radar</span> Browser Port Reachability Scanner
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Security Tool</span>
      </div>

      <div class="flex gap-xs">
        <input type="text" id="port-target" value="echo.websocket.events" class="flex-1 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-xs font-mono text-on-surface outline-none"/>
        <button onclick="testPortReachability()" class="bg-emerald-500 text-black px-md py-sm rounded-xl font-mono text-xs font-bold">Test Port</button>
      </div>

      <div id="port-out" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono text-zinc-300 border border-outline-variant/20">Target status will appear here...</div>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  function testPortReachability() {
    const host = document.getElementById('port-target').value;
    const out = document.getElementById('port-out');
    out.innerText = 'Connecting to wss://' + host + '...';

    try {
      const ws = new WebSocket('wss://' + host);
      ws.onopen = function () {
        out.innerText = 'SUCCESS: Target host ' + host + ' WebSocket port 443 is OPEN & REACHABLE.';
        out.className = 'bg-surface-container-lowest p-md rounded-xl text-xs font-mono text-emerald-400 border border-emerald-500/30';
        ws.close();
      };
      ws.onerror = function () {
        out.innerText = 'CLOSED / BLOCKED: Target host ' + host + ' port connection timed out.';
        out.className = 'bg-surface-container-lowest p-md rounded-xl text-xs font-mono text-red-400 border border-red-500/30';
      };
    } catch (e) {
      out.innerText = 'Error: ' + e.message;
    }
  }
</script>
