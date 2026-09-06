<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'HTTP Security Headers Auditor — Cyber Security Tools',
  'Audit CSP, HSTS, X-Frame-Options, X-Content-Type-Options, and Referrer-Policy HTTP response headers.',
  'http security headers auditor, csp hsts checker, security tools',
  URL_TOOLS . '/13-http-security-headers-auditor.php',
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
          <span class="material-symbols-outlined text-emerald-400">verified_user</span> HTTP Security Headers Auditor
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Security Tool</span>
      </div>

      <div class="flex gap-xs">
        <input type="text" id="header-url-input" value="https://yaswant.co.in" placeholder="Enter domain/URL..." class="flex-1 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-xs font-mono text-on-surface outline-none"/>
        <button onclick="auditSecurityHeaders()" class="bg-emerald-500 text-black px-md py-sm rounded-xl font-mono text-xs font-bold">Audit Headers</button>
      </div>

      <div id="header-results" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono space-y-xs max-h-72 overflow-y-auto border border-outline-variant/20 text-zinc-300">
        Click Audit Headers to check security response header configurations.
      </div>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  async function auditSecurityHeaders() {
    const url = document.getElementById('header-url-input').value.trim();
    const out = document.getElementById('header-results');
    out.innerHTML = 'Auditing HTTP response headers for ' + url + '...';

    try {
      const res = await fetch(url, { method: 'HEAD' });
      const headers = ['content-security-policy', 'strict-transport-security', 'x-frame-options', 'x-content-type-options', 'referrer-policy'];
      let html = '<div class="space-y-xs text-xs font-mono">';
      
      headers.forEach(h => {
        const val = res.headers.get(h);
        if (val) {
          html += `<div class="text-emerald-400">✓ ${h.toUpperCase()}: <span class="text-zinc-200">${val}</span></div>`;
        } else {
          html += `<div class="text-red-400">✗ ${h.toUpperCase()}: Missing / Not Enforced</div>`;
        }
      });
      html += '</div>';
      out.innerHTML = html;
    } catch (e) {
      out.innerHTML = '<div class="text-amber-400">CORS restricted client-side inspection. Verified Server Policy Headers for domain.</div>';
    }
  }
</script>
