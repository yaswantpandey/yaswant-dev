<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'Base64 & Hex Encoder / Decoder — Developer Utilities',
  'Convert raw strings, URLs, and binary payloads into Base64 and Hex encoding formats.',
  'base64 encoder decoder, hex converter, developer tools',
  URL_TOOLS . '/22-base64-hex-encoder-decoder.php',
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
          <span class="material-symbols-outlined text-emerald-400">enhanced_encryption</span> Base64 & Hex Encoder / Decoder
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Developer Tool</span>
      </div>

      <textarea id="b64-input" rows="6" placeholder="Enter text to encode or decode..." class="w-full bg-surface-container-lowest border border-outline-variant/40 rounded-xl p-md text-xs font-mono text-on-surface outline-none"></textarea>
      
      <div class="flex items-center justify-end gap-xs">
        <button onclick="encodeB64()" class="bg-emerald-500 text-black text-xs px-md py-sm rounded-xl font-mono font-bold">Encode Base64</button>
        <button onclick="decodeB64()" class="bg-surface-container-highest text-on-surface text-xs px-md py-sm rounded-xl font-mono font-bold">Decode Base64</button>
      </div>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  function encodeB64() {
    const val = document.getElementById('b64-input').value;
    document.getElementById('b64-input').value = btoa(val);
  }

  function decodeB64() {
    const val = document.getElementById('b64-input').value;
    try {
      document.getElementById('b64-input').value = atob(val);
    } catch (e) {
      alert('Invalid Base64 string!');
    }
  }
</script>
