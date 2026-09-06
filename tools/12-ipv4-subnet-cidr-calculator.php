<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'IPv4 Subnet & CIDR Calculator — Cyber Security Tools',
  'Calculate Network Address, Broadcast IP, Subnet Mask, Host Range, and Total Usable Addresses.',
  'ipv4 cidr subnet calculator, network mask, security tools',
  URL_TOOLS . '/12-ipv4-subnet-cidr-calculator.php',
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
          <span class="material-symbols-outlined text-emerald-400">lan</span> IPv4 Subnet & CIDR Calculator
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Security Tool</span>
      </div>

      <div class="flex gap-xs">
        <input type="text" id="cidr-input" value="192.168.1.50/24" placeholder="Enter IP/CIDR (e.g. 192.168.1.1/24)..." class="flex-1 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-xs font-mono text-on-surface outline-none"/>
        <button onclick="calculateCIDR()" class="bg-emerald-500 text-black px-md py-sm rounded-xl font-mono text-xs font-bold">Calculate</button>
      </div>

      <div id="cidr-results" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono space-y-xs border border-outline-variant/20 text-zinc-300">
        Enter a CIDR string above (e.g. 10.0.0.1/16).
      </div>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  function calculateCIDR() {
    const raw = document.getElementById('cidr-input').value.trim();
    const out = document.getElementById('cidr-results');
    if (!raw.includes('/')) { alert('Please enter valid CIDR format e.g. 192.168.1.1/24'); return; }

    try {
      const [ipStr, maskStr] = raw.split('/');
      const maskBits = parseInt(maskStr);
      if (maskBits < 0 || maskBits > 32) throw new Error('Mask must be between 0 and 32');

      const ipOctets = ipStr.split('.').map(Number);
      const ipNum = (ipOctets[0] << 24) | (ipOctets[1] << 16) | (ipOctets[2] << 8) | ipOctets[3];
      
      const maskNum = maskBits === 0 ? 0 : (~0 << (32 - maskBits)) >>> 0;
      const netNum = (ipNum & maskNum) >>> 0;
      const broadcastNum = (netNum | (~maskNum >>> 0)) >>> 0;

      const numToIp = num => [(num >>> 24) & 255, (num >>> 16) & 255, (num >>> 8) & 255, num & 255].join('.');
      
      const totalHosts = Math.pow(2, 32 - maskBits);
      const usableHosts = maskBits >= 31 ? 0 : totalHosts - 2;

      out.innerHTML = `
        <div class="grid grid-cols-2 gap-md text-xs">
          <div>Network IP: <strong class="text-emerald-400">${numToIp(netNum)}</strong></div>
          <div>Subnet Mask: <span class="text-zinc-200">${numToIp(maskNum)}</span></div>
          <div>Broadcast IP: <span class="text-zinc-200">${numToIp(broadcastNum)}</span></div>
          <div>Usable Host Range: <span class="text-zinc-200">${numToIp(netNum + 1)} - ${numToIp(broadcastNum - 1)}</span></div>
          <div>Total Addresses: <span class="text-zinc-400">${totalHosts.toLocaleString()}</span></div>
          <div>Usable Hosts: <strong class="text-emerald-400">${usableHosts.toLocaleString()}</strong></div>
        </div>
      `;
    } catch (e) {
      out.innerHTML = '<span class="text-red-400">Invalid CIDR calculation: ' + e.message + '</span>';
    }
  }

  document.addEventListener('DOMContentLoaded', calculateCIDR);
</script>
