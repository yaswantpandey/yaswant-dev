<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'SHA-256 / SHA-1 Hash Generator — Cyber Security Tools',
  'Instant client-side SHA-256 and SHA-1 cryptographic text and file hash calculation.',
  'sha256 hash generator, sha1 hash, cryptographic integrity, security tools',
  URL_TOOLS . '/16-sha256-sha1-hash-generator.php',
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
          <span class="material-symbols-outlined text-emerald-400">fingerprint</span> SHA-256 / SHA-1 Hash Generator
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Security Tool</span>
      </div>

      <textarea id="hash-input" oninput="computeHashes()" rows="4" placeholder="Enter text string to hash..." class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl p-md text-xs font-mono text-on-surface outline-none"></textarea>
      
      <div class="space-y-xs font-mono text-xs">
        <div>
          <span class="text-zinc-400 text-[10px] uppercase">SHA-256 Hash Digest:</span>
          <div id="sha256-out" class="bg-surface-container-lowest p-md rounded border border-outline-variant/20 text-emerald-400 break-all">...</div>
        </div>
      </div>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  async function computeHashes() {
    const text = document.getElementById('hash-input').value;
    if (!text) {
      document.getElementById('sha256-out').innerText = '...';
      return;
    }
    const msgUint8 = new TextEncoder().encode(text);
    const hashBuffer = await crypto.subtle.digest('SHA-256', msgUint8);
    const hashArray = Array.from(new Uint8Array(hashBuffer));
    const hashHex = hashArray.map(b => b.toString(16).padStart(2, '0')).join('');
    document.getElementById('sha256-out').innerText = hashHex;
  }
</script>
