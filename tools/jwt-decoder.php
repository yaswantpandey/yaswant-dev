<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'Online JWT Token Decoder & Claims Inspector — Yaswant Dev Tools',
  'Free client-side JWT (JSON Web Token) debugger and decoder by Yaswant Pandey. Inspect JWT headers, payload claims, expiration countdown, and signatures with zero server exposure.',
  'jwt decoder, jwt debugger, json web token inspector, decode jwt online, jwt expiration checker, developer tools by Yaswant Pandey',
  URL_TOOLS . '/jwt-decoder',
  ['type' => 'website', 'title' => 'Online JWT Token Decoder & Inspector — Yaswant Dev Tools'],
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
      <span class="text-zinc-300">JWT Decoder</span>
    </nav>

    <!-- Main Tool Container -->
    <div class="bg-zinc-950 border border-zinc-800 rounded-2xl p-6 md:p-8 space-y-6 shadow-2xl">
      
      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-zinc-800 pb-5">
        <div>
          <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 text-xs font-mono uppercase mb-2">
            <span class="material-symbols-outlined text-[15px]">badge</span> Auth & Token Debugger
          </div>
          <h1 class="text-xl md:text-3xl font-black text-white">JWT Token Decoder & Inspector</h1>
          <p class="text-xs md:text-sm text-zinc-400 font-light mt-1">Decode JSON Web Tokens instantly. Inspect headers, payload claims, and check expiration status locally.</p>
        </div>
        <button onclick="loadSampleJWT()" class="bg-zinc-900 hover:bg-zinc-800 text-zinc-300 border border-zinc-700 px-3 py-1.5 rounded-xl font-mono text-xs font-bold transition-colors flex items-center gap-1">
          <span class="material-symbols-outlined text-[14px]">science</span> Sample JWT
        </button>
      </div>

      <!-- Input Encoded JWT -->
      <div class="space-y-2">
        <div class="flex items-center justify-between">
          <label for="jwt-input" class="text-xs font-mono text-zinc-400 uppercase tracking-wider">Encoded Token (Header.Payload.Signature)</label>
          <button onclick="document.getElementById('jwt-input').value=''; decodeJWT();" class="text-xs font-mono text-red-400 hover:underline">Clear</button>
        </div>
        <textarea id="jwt-input" rows="4" placeholder="Paste encoded JWT string (eyJh...)" oninput="decodeJWT()"
          class="w-full bg-black border border-zinc-800 rounded-xl p-3.5 text-xs md:text-sm font-mono text-pink-400 placeholder:text-zinc-700 outline-none focus:border-cyan-500 focus:ring-1 focus:ring-cyan-500 transition-colors leading-relaxed selection:bg-pink-500/30"></textarea>
      </div>

      <!-- Decoded Split Layout -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        
        <!-- Header -->
        <div class="space-y-2 bg-zinc-900/60 p-4 rounded-xl border border-zinc-800">
          <div class="flex items-center justify-between">
            <span class="text-xs font-mono text-red-400 font-bold uppercase flex items-center gap-1">
              <span class="w-2 h-2 rounded-full bg-red-400"></span> Header (Algorithm & Token Type)
            </span>
            <button onclick="copyElementText('jwt-header')" class="text-xs font-mono text-zinc-400 hover:text-white">Copy</button>
          </div>
          <pre id="jwt-header" class="bg-black p-3 rounded-lg text-xs font-mono text-red-400 border border-zinc-800/80 overflow-x-auto min-h-[120px]">{}</pre>
        </div>

        <!-- Payload -->
        <div class="space-y-2 bg-zinc-900/60 p-4 rounded-xl border border-zinc-800">
          <div class="flex items-center justify-between">
            <span class="text-xs font-mono text-purple-400 font-bold uppercase flex items-center gap-1">
              <span class="w-2 h-2 rounded-full bg-purple-400"></span> Payload (Data Claims)
            </span>
            <button onclick="copyElementText('jwt-payload')" class="text-xs font-mono text-zinc-400 hover:text-white">Copy</button>
          </div>
          <pre id="jwt-payload" class="bg-black p-3 rounded-lg text-xs font-mono text-purple-400 border border-zinc-800/80 overflow-x-auto min-h-[120px]">{}</pre>
        </div>

      </div>

      <!-- Token Status & Expiration Box -->
      <div id="jwt-exp-box" class="hidden p-4 rounded-xl border border-zinc-800 bg-zinc-900/40 space-y-2 text-xs font-mono">
        <div class="flex items-center justify-between">
          <span class="text-zinc-400">Token Status:</span>
          <span id="jwt-status-badge" class="font-bold px-2.5 py-1 rounded-md">Checking...</span>
        </div>
        <div class="flex items-center justify-between text-zinc-400">
          <span>Issued At (iat):</span>
          <span id="jwt-iat-val" class="text-zinc-300">-</span>
        </div>
        <div class="flex items-center justify-between text-zinc-400">
          <span>Expires At (exp):</span>
          <span id="jwt-exp-val" class="text-zinc-300">-</span>
        </div>
      </div>

    </div>

    <!-- On-Page SEO Guide -->
    <section class="bg-zinc-950 border border-zinc-800/80 rounded-2xl p-6 md:p-8 space-y-4">
      <h2 class="text-lg md:text-2xl font-bold text-white">How JWT Decoding Works</h2>
      <p class="text-xs md:text-sm text-zinc-400 font-light leading-relaxed">
        A <strong>JSON Web Token (JWT)</strong> consists of three Base64URL-encoded parts separated by dots (<code>.</code>): the <strong>Header</strong> (defines cryptographic hashing algorithm like HS256/RS256), the <strong>Payload</strong> (stores user claims, roles, and expiration timestamps), and the <strong>Signature</strong>. Our tool decodes the payload in your browser memory so you can debug authentication issues without exposing tokens.
      </p>
    </section>

  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  function decodeJWT() {
    const raw = document.getElementById('jwt-input').value.trim();
    const headerEl = document.getElementById('jwt-header');
    const payloadEl = document.getElementById('jwt-payload');
    const expBox = document.getElementById('jwt-exp-box');

    if (!raw) {
      headerEl.innerText = '{}';
      payloadEl.innerText = '{}';
      expBox.classList.add('hidden');
      return;
    }

    const parts = raw.split('.');
    if (parts.length < 2) {
      headerEl.innerText = 'Invalid JWT format (must have at least Header & Payload separated by dots)';
      payloadEl.innerText = '{}';
      expBox.classList.add('hidden');
      return;
    }

    try {
      const headerStr = b64DecodeUnicode(parts[0]);
      const headerJson = JSON.parse(headerStr);
      headerEl.innerText = JSON.stringify(headerJson, null, 2);
    } catch (e) {
      headerEl.innerText = 'Error decoding Header: ' + e.message;
    }

    try {
      const payloadStr = b64DecodeUnicode(parts[1]);
      const payloadJson = JSON.parse(payloadStr);
      payloadEl.innerText = JSON.stringify(payloadJson, null, 2);

      // Check timestamps
      expBox.classList.remove('hidden');
      if (payloadJson.iat) {
        document.getElementById('jwt-iat-val').innerText = new Date(payloadJson.iat * 1000).toLocaleString();
      } else {
        document.getElementById('jwt-iat-val').innerText = 'Not specified';
      }

      if (payloadJson.exp) {
        const expDate = new Date(payloadJson.exp * 1000);
        document.getElementById('jwt-exp-val').innerText = expDate.toLocaleString();
        const now = Math.floor(Date.now() / 1000);
        const badge = document.getElementById('jwt-status-badge');
        if (now > payloadJson.exp) {
          badge.className = 'font-bold px-2.5 py-1 rounded-md bg-red-500/10 text-red-400 border border-red-500/20';
          badge.innerText = 'EXPIRED';
        } else {
          badge.className = 'font-bold px-2.5 py-1 rounded-md bg-emerald-500/10 text-emerald-400 border border-emerald-500/20';
          badge.innerText = 'ACTIVE (Valid)';
        }
      } else {
        document.getElementById('jwt-exp-val').innerText = 'No expiration claim';
        const badge = document.getElementById('jwt-status-badge');
        badge.className = 'font-bold px-2.5 py-1 rounded-md bg-zinc-800 text-zinc-300';
        badge.innerText = 'NO EXPIRY';
      }

    } catch (e) {
      payloadEl.innerText = 'Error decoding Payload: ' + e.message;
      expBox.classList.add('hidden');
    }
  }

  function b64DecodeUnicode(str) {
    str = str.replace(/-/g, '+').replace(/_/g, '/');
    while (str.length % 4) str += '=';
    return decodeURIComponent(atob(str).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));
  }

  function copyElementText(id) {
    const txt = document.getElementById(id).innerText;
    navigator.clipboard.writeText(txt);
    alert('Copied to clipboard!');
  }

  function loadSampleJWT() {
    const sample = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6Illhc3dhbnQgUGFuZGV5IiwiYWRtaW4iOnRydWUsImlhdCI6MTY5MjE4MDAwMCwiZXhwIjoxNzg2ODQ0MDAwfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c';
    document.getElementById('jwt-input').value = sample;
    decodeJWT();
  }
</script>
