<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'REST API Endpoint Tester — Developer Utilities',
  'Test GET and POST API endpoints directly in browser with JSON response formatting.',
  'rest api tester, api endpoint client, developer tools',
  URL_TOOLS . '/26-rest-api-tester.php',
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
          <span class="material-symbols-outlined text-emerald-400">api</span> REST API Endpoint Tester
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Developer Tool</span>
      </div>

      <div class="flex gap-xs">
        <select id="api-method" class="bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-sm py-xs text-xs text-on-surface font-mono outline-none">
          <option value="GET">GET</option><option value="POST">POST</option>
        </select>
        <input id="api-url" type="text" value="https://jsonplaceholder.typicode.com/todos/1" class="flex-1 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-xs text-xs font-mono text-on-surface outline-none"/>
        <button onclick="runApiTest()" class="bg-emerald-500 text-black text-xs px-md py-xs rounded-xl font-mono font-bold">Send Request</button>
      </div>

      <pre id="api-response" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono text-on-surface max-h-96 overflow-y-auto border border-outline-variant/20">Response will appear here...</pre>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  function runApiTest() {
    const method = document.getElementById('api-method').value;
    const url = document.getElementById('api-url').value;
    const out = document.getElementById('api-response');
    out.innerText = 'Sending ' + method + ' request to ' + url + '...';

    fetch(url, { method: method })
      .then(res => res.json())
      .then(data => {
        out.innerText = JSON.stringify(data, null, 2);
      })
      .catch(err => {
        out.innerText = 'Error executing API request: ' + err.message;
      });
  }
</script>
