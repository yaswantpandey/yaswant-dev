<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'XSS Payload Sanitizer & Security Auditor — Cyber Security Tools',
  'Inspect HTML payloads for DOM/Reflected XSS threat vectors and render escaped safe HTML output.',
  'xss payload sanitizer, xss auditor, security tools',
  URL_TOOLS . '/19-xss-payload-sanitizer-auditor.php',
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
          <span class="material-symbols-outlined text-emerald-400">bug_report</span> XSS Payload Sanitizer & Security Auditor
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Security Tool</span>
      </div>

      <textarea id="xss-input" oninput="sanitizeXssPayload()" rows="4" placeholder="Enter HTML payload e.g. <script>alert(1)</script> or <img src=x onerror=alert(1)>..." class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl p-md text-xs font-mono text-on-surface outline-none"></textarea>
      
      <div class="space-y-xs font-mono text-xs">
        <div class="flex items-center justify-between">
          <span class="text-zinc-400 text-[10px] uppercase">Threat Assessment:</span>
          <span id="xss-threat-status" class="text-emerald-400 font-bold">Safe Payload</span>
        </div>
        <div class="bg-surface-container-lowest p-md rounded border border-outline-variant/20">
          <span class="text-zinc-500 text-[10px] block mb-1 uppercase">Sanitized HTML Output:</span>
          <pre id="xss-sanitized-out" class="text-emerald-400 break-all whitespace-pre-wrap"></pre>
        </div>
      </div>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  function sanitizeXssPayload() {
    const raw = document.getElementById('xss-input').value;
    const status = document.getElementById('xss-threat-status');
    const out = document.getElementById('xss-sanitized-out');

    if (!raw) {
      status.innerText = 'Safe Payload';
      status.className = 'text-emerald-400 font-bold';
      out.innerText = '';
      return;
    }

    const containsScript = /<script\b[^>]*>([\s\S]*?)<\/script>/gi.test(raw);
    const containsInline = /on\w+\s*=/gi.test(raw) || /javascript:/gi.test(raw);

    if (containsScript || containsInline) {
      status.innerText = 'DANGER: Malicious XSS Pattern Detected!';
      status.className = 'text-red-400 font-bold animate-pulse';
    } else {
      status.innerText = 'Clean / Low Risk';
      status.className = 'text-emerald-400 font-bold';
    }

    const sanitized = raw.replace(/&/g, '&amp;')
                         .replace(/</g, '&lt;')
                         .replace(/>/g, '&gt;')
                         .replace(/"/g, '&quot;')
                         .replace(/'/g, '&#039;');

    out.innerText = sanitized;
  }
</script>
