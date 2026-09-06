<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'Online REST API Tester & HTTP Request Client — Yaswant Dev Tools',
  'Free in-browser REST API tester and HTTP request client by Yaswant Pandey. Send GET, POST, PUT, DELETE requests, inspect JSON responses, response time, and headers.',
  'rest api tester, http client online, test api online, postman alternative online, api debugger, json response viewer, developer tools by Yaswant Pandey',
  URL_TOOLS . '/rest-api-tester',
  ['type' => 'website', 'title' => 'Online REST API Tester & HTTP Client — Yaswant Dev Tools'],
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
      <span class="text-zinc-300">REST API Tester</span>
    </nav>

    <!-- Main Tool Container -->
    <div class="bg-zinc-950 border border-zinc-800 rounded-2xl p-6 md:p-8 space-y-6 shadow-2xl">
      
      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-zinc-800 pb-5">
        <div>
          <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-mono uppercase mb-2">
            <span class="material-symbols-outlined text-[15px]">api</span> Browser HTTP Client
          </div>
          <h1 class="text-xl md:text-3xl font-black text-white">REST API Tester & Debugger</h1>
          <p class="text-xs md:text-sm text-zinc-400 font-light mt-1">Send HTTP requests, test webhooks, inspect JSON payloads, and monitor latency in real time.</p>
        </div>
      </div>

      <!-- URL & Method Bar -->
      <div class="flex flex-col sm:flex-row items-stretch gap-2">
        <select id="api-method" class="bg-zinc-900 border border-zinc-800 text-emerald-400 font-mono text-xs font-bold px-3 py-3 rounded-xl outline-none focus:border-emerald-500">
          <option value="GET">GET</option>
          <option value="POST">POST</option>
          <option value="PUT">PUT</option>
          <option value="DELETE">DELETE</option>
          <option value="PATCH">PATCH</option>
        </select>
        
        <input type="text" id="api-url" value="https://jsonplaceholder.typicode.com/todos/1" placeholder="https://api.example.com/v1/resource..."
          class="flex-1 bg-black border border-zinc-800 text-white font-mono text-xs px-4 py-3 rounded-xl outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 selection:bg-emerald-500/30"/>

        <button onclick="sendApiRequest()" class="bg-emerald-500 hover:bg-emerald-400 text-black px-6 py-3 rounded-xl font-mono text-xs font-bold transition-all flex items-center justify-center gap-1.5 shadow-md shrink-0">
          <span class="material-symbols-outlined text-[16px]">send</span> Send Request
        </button>
      </div>

      <!-- Request Headers & Body Tabs -->
      <div class="bg-zinc-900/60 p-4 rounded-xl border border-zinc-800 space-y-3">
        <div class="flex items-center gap-4 border-b border-zinc-800/80 pb-2 text-xs font-mono">
          <button id="tab-btn-headers" onclick="switchApiTab('headers')" class="text-emerald-400 font-bold border-b-2 border-emerald-400 pb-1">Headers</button>
          <button id="tab-btn-body" onclick="switchApiTab('body')" class="text-zinc-400 hover:text-white pb-1">Request Body (JSON)</button>
        </div>

        <div id="tab-pane-headers" class="space-y-2">
          <textarea id="api-headers" rows="2" placeholder='{"Accept": "application/json", "Authorization": "Bearer token..."}'
            class="w-full bg-black border border-zinc-800 rounded-lg p-3 text-xs font-mono text-zinc-300 outline-none focus:border-emerald-500"></textarea>
        </div>

        <div id="tab-pane-body" class="space-y-2 hidden">
          <textarea id="api-body" rows="4" placeholder='{"title": "foo", "body": "bar", "userId": 1}'
            class="w-full bg-black border border-zinc-800 rounded-lg p-3 text-xs font-mono text-zinc-300 outline-none focus:border-emerald-500"></textarea>
        </div>
      </div>

      <!-- Response Panel -->
      <div class="space-y-2">
        <div class="flex items-center justify-between">
          <div class="flex items-center gap-3 text-xs font-mono">
            <span class="text-zinc-400 uppercase tracking-wider font-bold">Response:</span>
            <span id="res-status-badge" class="hidden px-2 py-0.5 rounded text-[11px] font-bold"></span>
            <span id="res-time-badge" class="hidden text-zinc-500 text-[11px]"></span>
          </div>
          <button onclick="copyApiResponse()" class="text-xs font-mono text-zinc-400 hover:text-emerald-400 flex items-center gap-1">
            <span class="material-symbols-outlined text-[14px]">content_copy</span> Copy Response
          </button>
        </div>
        
        <pre id="api-response-out" class="w-full bg-black border border-zinc-800 rounded-xl p-4 text-xs font-mono text-emerald-400 overflow-x-auto min-h-[160px] leading-relaxed selection:bg-emerald-500/30">Click "Send Request" to trigger HTTP call...</pre>
      </div>

    </div>

    <!-- On-Page SEO Guide -->
    <section class="bg-zinc-950 border border-zinc-800/80 rounded-2xl p-6 md:p-8 space-y-4">
      <h2 class="text-lg md:text-2xl font-bold text-white">How to Test REST APIs in Browser</h2>
      <p class="text-xs md:text-sm text-zinc-400 font-light leading-relaxed">
        This tool uses the native W3C <code>fetch()</code> API to trigger HTTP requests directly from your browser. Note: If you test private APIs without CORS (Cross-Origin Resource Sharing) headers, modern browsers block foreign origin responses.
      </p>
    </section>

  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  function switchApiTab(tab) {
    if (tab === 'headers') {
      document.getElementById('tab-pane-headers').classList.remove('hidden');
      document.getElementById('tab-pane-body').classList.add('hidden');
      document.getElementById('tab-btn-headers').className = 'text-emerald-400 font-bold border-b-2 border-emerald-400 pb-1';
      document.getElementById('tab-btn-body').className = 'text-zinc-400 hover:text-white pb-1';
    } else {
      document.getElementById('tab-pane-headers').classList.add('hidden');
      document.getElementById('tab-pane-body').classList.remove('hidden');
      document.getElementById('tab-btn-headers').className = 'text-zinc-400 hover:text-white pb-1';
      document.getElementById('tab-btn-body').className = 'text-emerald-400 font-bold border-b-2 border-emerald-400 pb-1';
    }
  }

  async function sendApiRequest() {
    const method = document.getElementById('api-method').value;
    const url = document.getElementById('api-url').value.trim();
    const headersRaw = document.getElementById('api-headers').value.trim();
    const bodyRaw = document.getElementById('api-body').value.trim();
    const out = document.getElementById('api-response-out');
    const statusBadge = document.getElementById('res-status-badge');
    const timeBadge = document.getElementById('res-time-badge');

    if (!url) {
      alert('Please enter a target URL!');
      return;
    }

    out.innerText = 'Connecting to ' + url + ' via ' + method + '...';
    statusBadge.classList.add('hidden');
    timeBadge.classList.add('hidden');

    let headers = {};
    if (headersRaw) {
      try {
        headers = JSON.parse(headersRaw);
      } catch (e) {
        console.warn('Could not parse headers JSON:', e);
      }
    }

    const options = {
      method: method,
      headers: headers
    };

    if (method !== 'GET' && method !== 'HEAD' && bodyRaw) {
      options.body = bodyRaw;
    }

    const startTime = performance.now();

    try {
      const response = await fetch(url, options);
      const endTime = performance.now();
      const duration = Math.round(endTime - startTime);

      statusBadge.classList.remove('hidden');
      timeBadge.classList.remove('hidden');
      timeBadge.innerText = duration + ' ms';

      if (response.ok) {
        statusBadge.className = 'px-2 py-0.5 rounded text-[11px] font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20';
        statusBadge.innerText = response.status + ' ' + response.statusText;
      } else {
        statusBadge.className = 'px-2 py-0.5 rounded text-[11px] font-bold bg-amber-500/10 text-amber-400 border border-amber-500/20';
        statusBadge.innerText = response.status + ' ' + response.statusText;
      }

      const contentType = response.headers.get('content-type') || '';
      if (contentType.includes('application/json')) {
        const data = await response.json();
        out.innerText = JSON.stringify(data, null, 2);
      } else {
        const text = await response.text();
        out.innerText = text || '(Empty Response)';
      }

    } catch (err) {
      statusBadge.classList.remove('hidden');
      statusBadge.className = 'px-2 py-0.5 rounded text-[11px] font-bold bg-red-500/10 text-red-400 border border-red-500/20';
      statusBadge.innerText = 'Network Error';
      out.innerText = 'Request Failed: ' + err.message + '\n\nNote: If calling external domains, check that the remote server supports CORS (Cross-Origin Resource Sharing).';
    }
  }

  function copyApiResponse() {
    const text = document.getElementById('api-response-out').innerText;
    navigator.clipboard.writeText(text);
    alert('Response copied to clipboard!');
  }
</script>
