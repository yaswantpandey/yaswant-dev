<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'DNS & Email Policy Inspector (SPF/DMARC) — Cyber Security Tools',
  'Query live A, MX, TXT, SPF, and DMARC security records via Google DNS over HTTPS.',
  'dns inspector, spf dmarc checker, dns over https, security tools',
  URL_TOOLS . '/18-dns-email-policy-inspector.php',
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
          <span class="material-symbols-outlined text-emerald-400">dns</span> DNS & Email Policy Inspector (SPF / DMARC)
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Security Tool</span>
      </div>

      <div class="flex gap-xs">
        <input type="text" id="dns-domain-input" value="yaswant.co.in" placeholder="Enter domain name..." class="flex-1 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-xs font-mono text-on-surface outline-none"/>
        <button onclick="queryDnsRecords()" class="bg-emerald-500 text-black px-md py-sm rounded-xl font-mono text-xs font-bold flex items-center gap-xs">
          <span class="material-symbols-outlined text-[16px]">search</span> Inspect DNS
        </button>
      </div>

      <div id="dns-results" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono space-y-xs max-h-72 overflow-y-auto border border-outline-variant/20 text-zinc-300">
        Enter a domain name above to fetch live DNS records via DNS over HTTPS.
      </div>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  async function queryDnsRecords() {
    const domain = document.getElementById('dns-domain-input').value.trim();
    const out = document.getElementById('dns-results');
    if (!domain) return;
    out.innerHTML = 'Querying live DNS records for ' + domain + ' via Google DoH...';

    try {
      const types = [{ name: 'A', id: 1 }, { name: 'MX', id: 15 }, { name: 'TXT (SPF/DMARC)', id: 16 }];
      let html = '<div class="space-y-sm">';
      for (const t of types) {
        const res = await fetch(`https://dns.google/resolve?name=${domain}&type=${t.id}`);
        const data = await res.json();
        html += `<div><span class="text-emerald-400 font-bold">[${t.name} Records]:</span>`;
        if (data.Answer && data.Answer.length > 0) {
          data.Answer.forEach(ans => {
            html += `<div class="pl-md text-zinc-300">• ${ans.data} (TTL: ${ans.TTL})</div>`;
          });
        } else {
          html += `<div class="pl-md text-zinc-500">No ${t.name} records found.</div>`;
        }
        html += '</div>';
      }
      html += '</div>';
      out.innerHTML = html;
    } catch (e) {
      out.innerHTML = '<span class="text-red-400">DNS lookup failed: ' + e.message + '</span>';
    }
  }

  document.addEventListener('DOMContentLoaded', queryDnsRecords);
</script>
