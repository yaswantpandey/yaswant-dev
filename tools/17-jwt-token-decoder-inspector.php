<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'JWT Token Decoder & Inspector — Cyber Security Tools',
  'Decode JSON Web Token (JWT) Header, Payload Claims, and Expiration timestamps.',
  'jwt token decoder, jwt inspector, json web token, security tools',
  URL_TOOLS . '/17-jwt-token-decoder-inspector.php',
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
          <span class="material-symbols-outlined text-emerald-400">badge</span> JWT Token Decoder & Inspector
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Security Tool</span>
      </div>

      <textarea id="jwt-input" oninput="decodeJWT()" rows="4" placeholder="Paste encoded JSON Web Token (eyJhbGci...)..." class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl p-md text-xs font-mono text-on-surface outline-none"></textarea>
      
      <div class="grid grid-cols-2 gap-md font-mono text-xs">
        <div>
          <span class="text-zinc-400 text-[10px] uppercase">Header</span>
          <pre id="jwt-header-out" class="bg-surface-container-lowest p-md rounded border border-outline-variant/20 text-cyan-400 max-h-60 overflow-y-auto">{}</pre>
        </div>
        <div>
          <span class="text-zinc-400 text-[10px] uppercase">Payload Claims</span>
          <pre id="jwt-payload-out" class="bg-surface-container-lowest p-md rounded border border-outline-variant/20 text-emerald-400 max-h-60 overflow-y-auto">{}</pre>
        </div>
      </div>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  function decodeJWT() {
    const token = document.getElementById('jwt-input').value.trim();
    const headOut = document.getElementById('jwt-header-out');
    const payOut = document.getElementById('jwt-payload-out');
    
    if (!token || token.split('.').length < 2) {
      headOut.innerText = '{}';
      payOut.innerText = '{}';
      return;
    }
    try {
      const parts = token.split('.');
      const header = JSON.parse(atob(parts[0]));
      const payload = JSON.parse(atob(parts[1]));
      headOut.innerText = JSON.stringify(header, null, 2);
      payOut.innerText = JSON.stringify(payload, null, 2);
    } catch (e) {
      headOut.innerText = 'Invalid Token Header';
      payOut.innerText = 'Invalid Token Payload';
    }
  }
</script>
