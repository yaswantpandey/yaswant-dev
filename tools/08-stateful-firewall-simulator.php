<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'Stateful Firewall Rule Simulator — Cyber Security Tools',
  'Simulate stateful packet filtering rules (ALLOW/DENY) by IP address, Port number, and Protocol.',
  'stateful firewall simulator, packet filtering, security tools',
  URL_TOOLS . '/08-stateful-firewall-simulator.php',
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
          <span class="material-symbols-outlined text-emerald-400">local_firewall</span> Stateful Firewall Rule Simulator
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Security Tool</span>
      </div>

      <p class="font-body-md text-xs text-on-surface-variant">Configure firewall parameters and test incoming packet headers against rule tables.</p>

      <div class="grid grid-cols-12 gap-xs text-xs font-mono">
        <input type="text" id="fw-ip" value="192.168.1.10" placeholder="Source IP" class="col-span-5 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-sm py-xs text-on-surface outline-none"/>
        <input type="number" id="fw-port" value="22" placeholder="Port" class="col-span-3 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-sm py-xs text-on-surface outline-none"/>
        <select id="fw-proto" class="col-span-4 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-sm py-xs text-on-surface outline-none">
          <option value="TCP">TCP</option><option value="UDP">UDP</option><option value="ICMP">ICMP</option>
        </select>
      </div>
      
      <button onclick="testFirewallRule()" class="w-full bg-emerald-500 text-black py-sm rounded-xl font-mono text-xs font-bold">Simulate Incoming Packet Inspection</button>
      
      <div id="fw-out" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono border border-outline-variant/20">
        Packet evaluation status will render here...
      </div>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  function testFirewallRule() {
    const ip = document.getElementById('fw-ip').value.trim();
    const port = parseInt(document.getElementById('fw-port').value);
    const proto = document.getElementById('fw-proto').value;
    const out = document.getElementById('fw-out');

    const blockedPorts = [22, 23, 3389, 445];
    if (blockedPorts.includes(port)) {
      out.innerHTML = `<span class="text-red-400 font-bold">[BLOCKED / DENY]</span> Rule #1 matched: Block inbound ${proto} port ${port} from ${ip}. Threat mitigated.`;
      out.className = 'bg-surface-container-lowest p-md rounded-xl text-xs font-mono border border-red-500/30';
    } else {
      out.innerHTML = `<span class="text-emerald-400 font-bold">[ALLOWED / ACCEPT]</span> Inbound ${proto} traffic on port ${port} from ${ip} passed firewall inspection rules.`;
      out.className = 'bg-surface-container-lowest p-md rounded-xl text-xs font-mono border border-emerald-500/30';
    }
  }
</script>
