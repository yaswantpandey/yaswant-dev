<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'Wi-Fi Network Security & Cipher Analyzer — Cyber Security Tools',
  'Inspect WPA2/WPA3 handshake security and WPS vulnerability risk factors.',
  'wifi security analyzer, cipher inspector, wpa3 wpa2, security tools',
  URL_TOOLS . '/05-wifi-security-analyzer.php',
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
          <span class="material-symbols-outlined text-emerald-400">wifi</span> Wi-Fi Network Security & Cipher Analyzer
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Security Tool</span>
      </div>

      <p class="font-body-md text-xs text-on-surface-variant">Select wireless handshake parameters to evaluate cipher strength and PMKID attack vectors.</p>

      <div class="space-y-xs font-mono text-xs">
        <select id="wifi-cipher" onchange="inspectWifiSecurity()" class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-on-surface outline-none">
          <option value="WPA3-SAE">WPA3-Personal (SAE / Dragonfly Handshake)</option>
          <option value="WPA2-CCMP">WPA2-Personal (AES-CCMP - 4-Way Handshake)</option>
          <option value="WEP">WEP (Legacy RC4 - Insecure)</option>
        </select>
        
        <div id="wifi-out" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono border border-outline-variant/20 text-emerald-400">
          WPA3 SAE provides strong forward secrecy and protects against offline dictionary attacks.
        </div>
      </div>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  function inspectWifiSecurity() {
    const cipher = document.getElementById('wifi-cipher').value;
    const out = document.getElementById('wifi-out');

    if (cipher === 'WPA3-SAE') {
      out.innerText = 'WPA3 SAE (Dragonfly) provides strong forward secrecy and protects against offline dictionary attacks.';
      out.className = 'bg-surface-container-lowest p-md rounded-xl text-xs font-mono border border-emerald-500/30 text-emerald-400';
    } else if (cipher === 'WPA2-CCMP') {
      out.innerText = 'WPA2 CCMP AES is secure, but vulnerable to dictionary attacks if PMKID / 4-way handshakes are captured.';
      out.className = 'bg-surface-container-lowest p-md rounded-xl text-xs font-mono border border-yellow-500/30 text-yellow-400';
    } else {
      out.innerText = 'CRITICAL: WEP cipher uses weak 24-bit IVs and can be cracked in under 60 seconds!';
      out.className = 'bg-surface-container-lowest p-md rounded-xl text-xs font-mono border border-red-500/30 text-red-400 font-bold';
    }
  }
</script>
