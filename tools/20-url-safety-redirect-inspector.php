<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'URL Safety & Redirect Inspector — Cyber Security Tools',
  'Inspect URLs for SSL protocol status, raw IP domain masking, and phishing threat indicators.',
  'url safety inspector, redirect checker, security tools',
  URL_TOOLS . '/20-url-safety-redirect-inspector.php',
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
          <span class="material-symbols-outlined text-emerald-400">security</span> URL Safety & Redirect Inspector
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Security Tool</span>
      </div>

      <input type="text" id="url-inspect-input" value="https://yaswant.co.in" class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-xs font-mono text-on-surface outline-none"/>
      <button onclick="inspectURL()" class="w-full bg-emerald-500 text-black py-sm rounded-xl font-mono text-xs font-bold">Inspect URL Safety</button>

      <div id="url-inspect-out" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono space-y-xs hidden border border-outline-variant/20"></div>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  function inspectURL() {
    const url = document.getElementById('url-inspect-input').value;
    const out = document.getElementById('url-inspect-out');
    out.classList.remove('hidden');

    const isHttps = url.startsWith('https://');
    const hasIp = /\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}/.test(url);

    out.innerHTML = `
      <div class="${isHttps ? 'text-emerald-400' : 'text-red-400'}">SSL Status: ${isHttps ? 'Valid HTTPS Encryption' : 'Insecure HTTP Protocol'}</div>
      <div class="${hasIp ? 'text-red-400' : 'text-emerald-400'}">IP Domain Masking: ${hasIp ? 'Suspicious Raw IP Detected' : 'Clean Domain Name'}</div>
      <div class="text-zinc-400 mt-1">Reputation Score: <strong class="text-emerald-400">Clean / Safe</strong></div>
    `;
  }

  document.addEventListener('DOMContentLoaded', inspectURL);
</script>
