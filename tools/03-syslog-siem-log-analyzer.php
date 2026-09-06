<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'Syslog SIEM & Auth Log Analyzer — Cyber Security Tools',
  'Parse Linux auth.log, Apache access logs, and extract threat IPs and failed SSH login events.',
  'syslog siem log analyzer, auth log parser, security tools',
  URL_TOOLS . '/03-syslog-siem-log-analyzer.php',
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
          <span class="material-symbols-outlined text-emerald-400">receipt_long</span> Syslog SIEM & Auth Log Analyzer
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Security Tool</span>
      </div>

      <p class="font-body-md text-xs text-on-surface-variant">Paste raw server logs to extract security metrics, failed SSH auth attempts, and malicious IP addresses.</p>

      <textarea id="siem-input" oninput="analyzeSiemLogs()" rows="6" placeholder="Paste Syslog lines e.g. Oct 11 14:32:01 server sshd[1024]: Failed password for invalid user root from 192.168.1.105 port 54322 ssh2..." class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl p-md text-xs font-mono text-on-surface outline-none"></textarea>
      
      <div id="siem-out" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono border border-outline-variant/20 text-zinc-300">
        SIEM analysis summary will render here...
      </div>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  function analyzeSiemLogs() {
    const raw = document.getElementById('siem-input').value;
    const out = document.getElementById('siem-out');
    if (!raw) {
      out.innerHTML = 'SIEM analysis summary will render here...';
      return;
    }

    const lines = raw.split('\n').filter(l => l.trim().length > 0);
    const failedSsh = lines.filter(l => /failed password|authentication failure|invalid user/i.test(l));
    const ips = Array.from(new Set(raw.match(/\b(?:\d{1,3}\.){3}\d{1,3}\b/g) || []));

    out.innerHTML = `
      <div class="space-y-xs">
        <div>Total Log Lines Processed: <strong class="text-emerald-400">${lines.length}</strong></div>
        <div class="${failedSsh.length > 0 ? 'text-red-400' : 'text-emerald-400'} font-bold">Failed Auth / Suspicious Events: ${failedSsh.length}</div>
        <div>Unique Source IPs Extracted: <span class="text-cyan-400">${ips.join(', ') || 'None'}</span></div>
      </div>
    `;
  }
</script>
