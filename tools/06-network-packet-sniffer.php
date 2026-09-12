<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'Network Packet Sniffer & Stream Analyzer — Cyber Security Tools',
  'Simulate live PCAP packet capture, packet headers, and hex payload dumps.',
  'network packet sniffer, pcap stream analyzer, security tools',
  URL_TOOLS . '/06-network-packet-sniffer.php',
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
          <span class="material-symbols-outlined text-emerald-400">hub</span> Network Packet Sniffer & Stream Analyzer
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Security Tool</span>
      </div>

      <div class="flex items-center justify-between flex-wrap gap-2">
        <div class="flex items-center gap-2">
          <button id="btn-packet-toggle" onclick="togglePacketCapture()" class="bg-emerald-500 hover:bg-emerald-400 text-black px-md py-xs rounded-xl font-mono text-xs font-bold transition-all active:scale-95">Start Capture</button>
          <button onclick="clearPacketStream()" class="bg-zinc-800 hover:bg-zinc-700 text-zinc-300 border border-zinc-700 px-md py-xs rounded-xl font-mono text-xs transition-all active:scale-95">Clear Stream</button>
        </div>
        <span id="packet-count-label" class="text-xs font-mono text-emerald-400">Packets Captured: 0</span>
      </div>

      <div id="packet-stream" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono max-h-96 overflow-y-auto border border-outline-variant/20 space-y-1">
        <span class="text-zinc-500">Click Start Capture to begin streaming live simulated network packet frames...</span>
      </div>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  let packetInterval = null;
  let packetCount = 0;

  function clearPacketStream() {
    packetCount = 0;
    document.getElementById('packet-count-label').innerText = 'Packets Captured: 0';
    document.getElementById('packet-stream').innerHTML = '<span class="text-zinc-500">Stream cleared. Click Start Capture to resume live frames.</span>';
  }

  function togglePacketCapture() {
    const btn = document.getElementById('btn-packet-toggle');
    const stream = document.getElementById('packet-stream');

    if (packetInterval) {
      clearInterval(packetInterval);
      packetInterval = null;
      btn.innerText = 'Start Capture';
      return;
    }

    btn.innerText = 'Stop Capture';
    if (stream.children[0] && stream.children[0].innerText.includes('Click Start Capture')) {
      stream.innerHTML = '';
    }

    const protos = ['TCP', 'UDP', 'HTTP', 'DNS', 'HTTPS', 'ARP'];
    const ips = ['192.168.1.100', '10.0.0.15', '172.16.0.4', '8.8.8.8', '1.1.1.1'];

    packetInterval = setInterval(() => {
      packetCount++;
      document.getElementById('packet-count-label').innerText = 'Packets Captured: ' + packetCount;

      const src = ips[Math.floor(Math.random() * ips.length)];
      const dst = ips[Math.floor(Math.random() * ips.length)];
      const proto = protos[Math.floor(Math.random() * protos.length)];
      const len = Math.floor(Math.random() * 1200) + 64;
      const time = new Date().toLocaleTimeString();

      const div = document.createElement('div');
      div.className = 'text-xs font-mono text-emerald-400 border-b border-outline-variant/10 pb-1 mb-1';
      div.innerHTML = `<span class="text-zinc-500">[${time}]</span> <strong class="text-cyan-400">${proto}</strong> ${src}:${Math.floor(Math.random()*60000)+1024} &rarr; ${dst}:443 (Len: ${len}B)`;
      
      stream.prepend(div);
      if (stream.children.length > 50) stream.removeChild(stream.lastChild);
    }, 800);
  }
</script>
