<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'IP Geolocation & Threat Inspector — Cyber Security Tools',
  'Query ASN, ISP, Country, Region, City, Coordinates, and VPN/Proxy threat indicators.',
  'ip geolocation threat inspector, asn isp lookup, security tools',
  URL_TOOLS . '/15-ip-geolocation-threat-inspector.php',
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
          <span class="material-symbols-outlined text-emerald-400">travel_explore</span> IP Geolocation & Threat Inspector
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Security Tool</span>
      </div>

      <div class="flex gap-xs">
        <input type="text" id="ip-input" value="8.8.8.8" placeholder="Enter IP address (e.g. 8.8.8.8)..." class="flex-1 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-xs font-mono text-on-surface outline-none"/>
        <button onclick="lookupIP()" class="bg-emerald-500 text-black px-md py-sm rounded-xl font-mono text-xs font-bold flex items-center gap-xs">
          <span class="material-symbols-outlined text-[16px]">search</span> Lookup IP
        </button>
      </div>

      <div id="ip-results" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono space-y-xs max-h-72 overflow-y-auto border border-outline-variant/20 text-zinc-300">
        Enter an IP address above or lookup your current public IP.
      </div>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  async function lookupIP() {
    const ip = document.getElementById('ip-input').value.trim();
    const out = document.getElementById('ip-results');
    out.innerHTML = '<span class="text-zinc-400 animate-pulse">Fetching IP threat & geolocation intelligence for ' + (ip || 'current IP') + '...</span>';

    try {
      let data = null;
      try {
        const res = await fetch(`https://ipapi.co/${ip}/json/`);
        if (res.ok) data = await res.json();
      } catch (e) {}

      if (!data || data.error) {
        // High-reliability CORS fallback via ipwho.is
        const fallbackRes = await fetch(`https://ipwho.is/${ip}`);
        const fbData = await fallbackRes.json();
        if (fbData && fbData.success !== false) {
          data = {
            ip: fbData.ip,
            city: fbData.city,
            region: fbData.region,
            country_name: fbData.country,
            country_code: fbData.country_code,
            org: (fbData.connection && fbData.connection.isp) || (fbData.connection && fbData.connection.org) || 'Autonomous System',
            asn: (fbData.connection && fbData.connection.asn) ? 'AS' + fbData.connection.asn : '',
            latitude: fbData.latitude,
            longitude: fbData.longitude,
            timezone: fbData.timezone ? fbData.timezone.id : 'UTC'
          };
        }
      }

      if (!data || data.error) {
        out.innerHTML = '<span class="text-red-400">' + (data && data.reason ? data.reason : 'Unable to retrieve IP metadata') + '</span>';
        return;
      }
      out.innerHTML = `
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs pt-1">
          <div class="p-2.5 rounded-xl bg-zinc-950 border border-zinc-800">IP Address: <strong class="text-emerald-400 ml-1">${data.ip}</strong></div>
          <div class="p-2.5 rounded-xl bg-zinc-950 border border-zinc-800">City / Region: <span class="text-zinc-200 ml-1">${data.city}, ${data.region}</span></div>
          <div class="p-2.5 rounded-xl bg-zinc-950 border border-zinc-800">Country: <span class="text-zinc-200 ml-1">${data.country_name} (${data.country_code})</span></div>
          <div class="p-2.5 rounded-xl bg-zinc-950 border border-zinc-800">ISP / ASN: <span class="text-cyan-400 ml-1">${data.org} ${data.asn ? '(' + data.asn + ')' : ''}</span></div>
          <div class="p-2.5 rounded-xl bg-zinc-950 border border-zinc-800">Coordinates: <span class="text-zinc-400 ml-1">${data.latitude}, ${data.longitude}</span></div>
          <div class="p-2.5 rounded-xl bg-zinc-950 border border-zinc-800">Timezone: <span class="text-zinc-400 ml-1">${data.timezone}</span></div>
        </div>
      `;
    } catch (e) {
      out.innerHTML = '<span class="text-red-400">IP Lookup failed: ' + e.message + '</span>';
    }
  }

  document.addEventListener('DOMContentLoaded', lookupIP);
</script>
