<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'AES-256-GCM Web Encryptor / Decryptor — Cyber Security Tools',
  'Zero-knowledge client-side AES-256-GCM encryption with PBKDF2 key derivation.',
  'aes 256 gcm web encryptor, zero knowledge encryption, security tools',
  URL_TOOLS . '/14-aes-256-gcm-web-encryptor.php',
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
          <span class="material-symbols-outlined text-emerald-400">shield</span> AES-256-GCM Web Encryptor / Decryptor
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Security Tool</span>
      </div>

      <textarea id="aes-input" rows="4" placeholder="Enter plaintext message or ciphertext..." class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl p-md text-xs font-mono text-on-surface outline-none"></textarea>
      <input type="password" id="aes-pass" placeholder="Enter Secret Encryption Key / Passphrase..." class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-md py-sm text-xs font-mono text-on-surface outline-none"/>
      
      <div class="flex gap-xs">
        <button onclick="encryptAES()" class="flex-1 bg-emerald-500 text-black py-sm rounded-xl font-mono text-xs font-bold">Encrypt (AES-GCM)</button>
        <button onclick="decryptAES()" class="flex-1 bg-surface-container-highest text-on-surface py-sm rounded-xl font-mono text-xs font-bold">Decrypt</button>
      </div>

      <pre id="aes-output" class="bg-surface-container-lowest p-md rounded-xl text-xs font-mono text-emerald-400 break-all max-h-48 overflow-y-auto border border-outline-variant/20">Ciphertext / Output will appear here...</pre>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  async function encryptAES() {
    const text = document.getElementById('aes-input').value;
    const pass = document.getElementById('aes-pass').value;
    const out  = document.getElementById('aes-output');
    if (!text || !pass) { alert('Please enter both text and a passphrase!'); return; }

    try {
      const enc = new TextEncoder();
      const passBuffer = enc.encode(pass);
      const keyMaterial = await crypto.subtle.importKey('raw', passBuffer, 'PBKDF2', false, ['deriveKey']);
      const salt = crypto.getRandomValues(new Uint8Array(16));
      const key = await crypto.subtle.deriveKey(
        { name: 'PBKDF2', salt, iterations: 100000, hash: 'SHA-256' },
        keyMaterial, { name: 'AES-GCM', length: 256 }, false, ['encrypt']
      );
      const iv = crypto.getRandomValues(new Uint8Array(12));
      const encrypted = await crypto.subtle.encrypt({ name: 'AES-GCM', iv }, key, enc.encode(text));
      
      const combined = new Uint8Array(salt.length + iv.length + encrypted.byteLength);
      combined.set(salt, 0);
      combined.set(iv, 16);
      combined.set(new Uint8Array(encrypted), 28);
      
      const b64 = btoa(String.fromCharCode(...combined));
      out.innerText = 'ENC:' + b64;
    } catch (e) {
      out.innerText = 'Encryption Error: ' + e.message;
    }
  }

  async function decryptAES() {
    const raw = document.getElementById('aes-input').value.trim();
    const pass = document.getElementById('aes-pass').value;
    const out  = document.getElementById('aes-output');
    if (!raw || !pass) { alert('Please enter encrypted text starting with ENC: and passphrase!'); return; }

    try {
      const b64 = raw.replace(/^ENC:/, '');
      const bytes = Uint8Array.from(atob(b64), c => c.charCodeAt(0));
      const salt = bytes.slice(0, 16);
      const iv   = bytes.slice(16, 28);
      const data = bytes.slice(28);

      const passBuffer = new TextEncoder().encode(pass);
      const keyMaterial = await crypto.subtle.importKey('raw', passBuffer, 'PBKDF2', false, ['deriveKey']);
      const key = await crypto.subtle.deriveKey(
        { name: 'PBKDF2', salt, iterations: 100000, hash: 'SHA-256' },
        keyMaterial, { name: 'AES-GCM', length: 256 }, false, ['decrypt']
      );

      const decrypted = await crypto.subtle.decrypt({ name: 'AES-GCM', iv }, key, data);
      out.innerText = new TextDecoder().decode(decrypted);
    } catch (e) {
      out.innerText = 'Decryption Failed: Invalid Passphrase or Corrupted Ciphertext!';
    }
  }
</script>
