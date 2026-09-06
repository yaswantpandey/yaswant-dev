<!DOCTYPE html>
<html lang="en">
<head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-PVZPJM66WM"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-PVZPJM66WM');
</script>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
<title>Meme Generator Online — Create Viral Memes Free | Yaswant Image</title>
<meta name="description" content="Free online meme generator. Choose from popular meme templates or upload your own image. Add custom text, stickers, and export in 1 click."/>
<meta name="keywords" content="meme generator online free, create memes online, meme maker, viral meme templates, drake meme generator, engineering memes"/>
<link rel="canonical" href="https://image.yaswant.co.in/meme.php"/>
<link rel="icon" type="image/svg+xml" href="https://yaswant.co.in/favicon.svg"/>
<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&family=JetBrains+Mono:wght@400;600&family=Impact&display=swap"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@400,0&display=swap"/>
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        fontFamily: {
          sans: ['Inter', 'sans-serif'],
          mono: ['JetBrains Mono', 'monospace'],
          meme: ['Impact', 'sans-serif'],
        }
      }
    }
  }
</script>
<style>
  *,:before,:after{box-sizing:border-box}
  body{margin:0;font-family:'Inter',sans-serif;background:#09090b;color:#fff;-webkit-font-smoothing:antialiased}
  ::-webkit-scrollbar{width:5px;height:5px}
  ::-webkit-scrollbar-track{background:#121215}
  ::-webkit-scrollbar-thumb{background:#27272a;border-radius:9999px}
  ::-webkit-scrollbar-thumb:hover{background:#3f3f46}

  /* Grid dot background */
  .dot-grid{background-image:radial-gradient(rgba(255,255,255,.07) 1px,transparent 1px);background-size:28px 28px}

  /* Control cards */
  .ctrl-card{background:#121215;border:1px solid rgba(255,255,255,.08);border-radius:1rem;padding:1.25rem;box-shadow:0 8px 24px rgba(0,0,0,.4)}
  .ctrl-input{
    width:100%;background:#18181c;border:1px solid rgba(255,255,255,.12);border-radius:.625rem;
    padding:.6rem .85rem;color:#fff;font-size:.85rem;outline:none;transition:all .2s;
  }
  .ctrl-input:focus{border-color:#f59e0b;box-shadow:0 0 0 2px rgba(245,158,11,.25);background:#1f1f24}
  .ctrl-label{font-size:.68rem;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#71717a;margin-bottom:.35rem;display:block}

  /* Template Card */
  .template-card{
    background:#18181c;border:2px solid transparent;border-radius:.75rem;
    padding:.25rem;cursor:pointer;transition:all .2s;overflow:hidden;
  }
  .template-card:hover{border-color:#f59e0b;transform:scale(1.03);box-shadow:0 6px 20px rgba(245,158,11,.2)}
  .template-card.active{border-color:#fbbf24;box-shadow:0 0 16px rgba(245,158,11,.4)}

  /* Shimmer */
  @keyframes shimmer{0%{background-position:0% 50%}50%{background-position:100% 50%}100%{background-position:0% 50%}}
  .grad-text{background:linear-gradient(135deg,#fbbf24,#f97316,#ef4444,#fbbf24);background-size:300% 300%;-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;animation:shimmer 5s ease infinite}
</style>
</head>
<body class="dot-grid min-h-screen flex flex-col justify-between">

<!-- Top Navigation -->
<nav class="fixed top-0 left-0 right-0 h-14 z-50 flex items-center justify-between px-4 md:px-8 border-b border-white/[0.08]" style="background:rgba(9,9,11,.92);backdrop-filter:blur(20px)">
  <div class="flex items-center gap-3">
    <a href="index.php" class="flex items-center gap-1.5 text-zinc-400 hover:text-white transition-colors text-xs font-mono">
      <span class="material-symbols-outlined text-[18px]">arrow_back</span>
      <span class="hidden sm:inline">All Tools</span>
    </a>
    <div class="w-px h-4 bg-zinc-800"></div>
    <a href="index.php" class="flex items-center gap-2 text-white font-bold text-sm">
      <div class="w-7 h-7 rounded-lg flex items-center justify-center bg-gradient-to-tr from-amber-500 to-orange-500 shadow-md text-black font-bold">
        <span class="material-symbols-outlined text-[16px] text-black">sentiment_very_satisfied</span>
      </div>
      <span>Yaswant <span class="text-amber-400">Meme Studio</span></span>
    </a>
  </div>

  <div class="flex items-center gap-3">
    <a href="resize.php" class="text-zinc-400 hover:text-white text-xs font-mono hidden md:inline">Resize Tool</a>
    <a href="compress.php" class="text-zinc-400 hover:text-white text-xs font-mono hidden md:inline">Compress Tool</a>
    <button id="btn-download" onclick="downloadMeme()" class="bg-amber-400 hover:bg-amber-300 text-black text-xs font-bold px-4 py-2 rounded-xl transition-all flex items-center gap-1.5 shadow-md">
      <span class="material-symbols-outlined text-[16px]">download</span> Download Meme
    </button>
  </div>
</nav>

<main class="pt-20 flex-1 max-w-7xl w-full mx-auto px-4 md:px-6 pb-16">

  <!-- Header Banner -->
  <div class="text-center py-6 max-w-2xl mx-auto">
    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-300 text-xs font-mono uppercase tracking-widest mb-3">
      <span class="material-symbols-outlined text-[14px]">local_fire_department</span> Instant Viral Meme Maker
    </div>
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white tracking-tight mb-2">
      Create <span class="grad-text">Viral Memes</span> Online
    </h1>
    <p class="text-zinc-400 text-xs sm:text-sm font-light">
      Select popular templates or upload your own image. Add custom captions, impact text, and download in 1 click.
    </p>
  </div>

  <!-- Workspace Grid -->
  <div class="flex flex-col lg:flex-row gap-6">

    <!-- ── Left: Interactive Meme Canvas Preview ── -->
    <div class="flex-1 flex flex-col gap-4">
      
      <!-- Meme Canvas Box -->
      <div class="bg-zinc-950 p-4 rounded-2xl border border-zinc-800 flex items-center justify-center min-h-[480px] shadow-2xl relative">
        <canvas id="meme-canvas" class="max-w-full max-h-[520px] rounded-lg shadow-2xl border border-zinc-800"></canvas>
      </div>

      <!-- Quick Actions -->
      <div class="flex items-center justify-between bg-zinc-900/60 p-3 rounded-xl border border-zinc-800 text-xs font-mono text-zinc-400">
        <span>Click on canvas text or type in sidebar to update instantly!</span>
        <button onclick="copyToClipboard()" class="hover:text-amber-400 flex items-center gap-1">
          <span class="material-symbols-outlined text-[16px]">content_copy</span> Copy to Clipboard
        </button>
      </div>

    </div>

    <!-- ── Right: Templates & Text Customizer Sidebar ── -->
    <div class="lg:w-96 flex flex-col gap-4">

      <!-- Text Inputs Card -->
      <div class="ctrl-card space-y-3">
        <label class="ctrl-label text-white font-bold flex items-center gap-1.5 border-b border-zinc-800 pb-2">
          <span class="material-symbols-outlined text-amber-400 text-[16px]">title</span> Meme Text Captions
        </label>

        <div>
          <span class="ctrl-label">Top Text</span>
          <input type="text" id="inp-top-text" value="WHEN THE CODE FINALLY" oninput="renderMeme()" class="ctrl-input font-meme text-base tracking-wider uppercase" placeholder="TOP TEXT HERE..."/>
        </div>

        <div>
          <span class="ctrl-label">Bottom Text</span>
          <input type="text" id="inp-bottom-text" value="COMPILES ON FIRST TRY" oninput="renderMeme()" class="ctrl-input font-meme text-base tracking-wider uppercase" placeholder="BOTTOM TEXT HERE..."/>
        </div>

        <!-- Text Styling Row -->
        <div class="grid grid-cols-3 gap-2 pt-2 border-t border-zinc-800">
          <div>
            <span class="ctrl-label">Font</span>
            <select id="sel-font" onchange="renderMeme()" class="ctrl-input text-xs font-mono p-1.5">
              <option value="Impact">Impact</option>
              <option value="Arial">Arial Black</option>
              <option value="Inter">Inter</option>
              <option value="Courier New">Monospace</option>
            </select>
          </div>
          <div>
            <span class="ctrl-label">Text Color</span>
            <input type="color" id="inp-text-color" value="#ffffff" onchange="renderMeme()" class="w-full h-8 rounded bg-zinc-800 border border-zinc-700 cursor-pointer p-0.5"/>
          </div>
          <div>
            <span class="ctrl-label">Outline</span>
            <input type="color" id="inp-stroke-color" value="#000000" onchange="renderMeme()" class="w-full h-8 rounded bg-zinc-800 border border-zinc-700 cursor-pointer p-0.5"/>
          </div>
        </div>

        <!-- Font Size Slider -->
        <div>
          <div class="flex justify-between items-center mb-1">
            <span class="ctrl-label !mb-0">Font Size (<span id="val-font-size">42px</span>)</span>
          </div>
          <input type="range" id="range-font-size" min="20" max="80" value="42" oninput="document.getElementById('val-font-size').innerText=this.value+'px';renderMeme()" class="w-full"/>
        </div>
      </div>

      <!-- Meme Template Gallery -->
      <div class="ctrl-card space-y-3">
        <div class="flex items-center justify-between border-b border-zinc-800 pb-2">
          <label class="ctrl-label !mb-0 text-white font-bold flex items-center gap-1.5">
            <span class="material-symbols-outlined text-amber-400 text-[16px]">grid_view</span> Popular Templates
          </label>
          <label class="cursor-pointer text-[10px] font-mono text-amber-400 hover:underline flex items-center gap-1">
            <input type="file" id="custom-file" accept="image/*" onchange="handleCustomUpload(this.files[0])" class="hidden"/>
            <span class="material-symbols-outlined text-[12px]">upload</span> Upload Custom
          </label>
        </div>

        <div class="grid grid-cols-3 gap-2 max-h-48 overflow-y-auto pr-1">
          <!-- Template 1: Drake -->
          <div class="template-card active" onclick="selectTemplate('https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=500', this)">
            <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=150" class="w-full h-16 object-cover rounded"/>
            <span class="text-[9px] font-mono text-zinc-400 block text-center truncate mt-1">Portrait Reaction</span>
          </div>
          <!-- Template 2: Coding Cat -->
          <div class="template-card" onclick="selectTemplate('https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=500', this)">
            <img src="https://images.unsplash.com/photo-1514888286974-6c03e2ca1dba?w=150" class="w-full h-16 object-cover rounded"/>
            <span class="text-[9px] font-mono text-zinc-400 block text-center truncate mt-1">Surprised Cat</span>
          </div>
          <!-- Template 3: Cyber Hacker -->
          <div class="template-card" onclick="selectTemplate('https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=500', this)">
            <img src="https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=150" class="w-full h-16 object-cover rounded"/>
            <span class="text-[9px] font-mono text-zinc-400 block text-center truncate mt-1">Matrix Hacker</span>
          </div>
          <!-- Template 4: Robot AI -->
          <div class="template-card" onclick="selectTemplate('https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=500', this)">
            <img src="https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=150" class="w-full h-16 object-cover rounded"/>
            <span class="text-[9px] font-mono text-zinc-400 block text-center truncate mt-1">Robot Future</span>
          </div>
          <!-- Template 5: Success Kid / Celebration -->
          <div class="template-card" onclick="selectTemplate('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=500', this)">
            <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=150" class="w-full h-16 object-cover rounded"/>
            <span class="text-[9px] font-mono text-zinc-400 block text-center truncate mt-1">Peaceful Beach</span>
          </div>
          <!-- Template 6: Coffee Developer -->
          <div class="template-card" onclick="selectTemplate('https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=500', this)">
            <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=150" class="w-full h-16 object-cover rounded"/>
            <span class="text-[9px] font-mono text-zinc-400 block text-center truncate mt-1">Coding Laptop</span>
          </div>
        </div>
      </div>

      <!-- Action Buttons -->
      <button onclick="downloadMeme()" class="w-full bg-amber-400 hover:bg-amber-300 text-black py-3 rounded-xl font-bold text-sm transition-all shadow-lg flex items-center justify-center gap-2">
        <span class="material-symbols-outlined text-[20px]">download</span>
        Download Meme Image (JPG)
      </button>

      <button onclick="resetDefaults()" class="w-full text-center py-2 text-xs font-mono text-zinc-500 hover:text-zinc-300 transition-colors">
        ↺ Reset to Default Template
      </button>

    </div>

  </div>

</main>

<!-- Footer -->
<footer class="py-6 border-t border-white/[0.08] text-center text-xs text-zinc-500 font-mono">
  <span>© 2026 Yaswant Meme Studio · Create & Share Memes Instantly</span>
</footer>

<script>
  /* ──────────────────────────────────────────────────────────
     MEME GENERATOR ENGINE (JAVASCRIPT)
     ────────────────────────────────────────────────────────── */
  let currentImg = new Image();
  currentImg.crossOrigin = 'anonymous';

  // Load default template on start
  currentImg.onload = () => renderMeme();
  currentImg.src = 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600';

  function selectTemplate(url, cardEl) {
    document.querySelectorAll('.template-card').forEach(c => c.classList.remove('active'));
    if (cardEl) cardEl.classList.add('active');

    currentImg = new Image();
    currentImg.crossOrigin = 'anonymous';
    currentImg.onload = () => renderMeme();
    currentImg.src = url;
  }

  function handleCustomUpload(file) {
    if (!file) return;
    const reader = new FileReader();
    reader.onload = (e) => {
      document.querySelectorAll('.template-card').forEach(c => c.classList.remove('active'));
      currentImg = new Image();
      currentImg.onload = () => renderMeme();
      currentImg.src = e.target.result;
    };
    reader.readAsDataURL(file);
  }

  function renderMeme() {
    if (!currentImg.complete || !currentImg.naturalWidth) return;

    const c = document.getElementById('meme-canvas');
    c.width = currentImg.naturalWidth;
    c.height = currentImg.naturalHeight;

    const ctx = c.getContext('2d');
    ctx.drawImage(currentImg, 0, 0);

    const topText = document.getElementById('inp-top-text').value;
    const bottomText = document.getElementById('inp-bottom-text').value;
    const font = document.getElementById('sel-font').value;
    const fontSize = parseInt(document.getElementById('range-font-size').value) || 42;
    const textColor = document.getElementById('inp-text-color').value;
    const strokeColor = document.getElementById('inp-stroke-color').value;

    // Scale font proportional to canvas size
    const scaleFactor = c.width / 600;
    const scaledSize = Math.round(fontSize * scaleFactor);

    ctx.font = `900 ${scaledSize}px ${font}, Impact, sans-serif`;
    ctx.fillStyle = textColor;
    ctx.strokeStyle = strokeColor;
    ctx.lineWidth = Math.max(3, Math.round(scaledSize / 10));
    ctx.textAlign = 'center';
    ctx.lineJoin = 'round';

    // Draw Top Text
    if (topText) {
      ctx.textBaseline = 'top';
      ctx.strokeText(topText, c.width / 2, 20 * scaleFactor);
      ctx.fillText(topText, c.width / 2, 20 * scaleFactor);
    }

    // Draw Bottom Text
    if (bottomText) {
      ctx.textBaseline = 'bottom';
      ctx.strokeText(bottomText, c.width / 2, c.height - (20 * scaleFactor));
      ctx.fillText(bottomText, c.width / 2, c.height - (20 * scaleFactor));
    }
  }

  function downloadMeme() {
    const c = document.getElementById('meme-canvas');
    const link = document.createElement('a');
    link.href = c.toDataURL('image/jpeg', 0.95);
    link.download = 'yaswant_meme.jpg';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);

    const btn = document.getElementById('btn-download');
    const orig = btn.innerHTML;
    btn.innerHTML = '<span class="material-symbols-outlined text-[18px]">check_circle</span> Downloaded!';
    setTimeout(() => btn.innerHTML = orig, 2000);
  }

  function copyToClipboard() {
    const c = document.getElementById('meme-canvas');
    c.toBlob((blob) => {
      try {
        navigator.clipboard.write([new ClipboardItem({ 'image/png': blob })]);
        alert('Meme copied to clipboard! Paste directly with Ctrl+V into WhatsApp, Discord, or Twitter.');
      } catch (err) {
        alert('Browser clipboard image write not supported, use download button instead.');
      }
    }, 'image/png');
  }

  function resetDefaults() {
    document.getElementById('inp-top-text').value = 'WHEN THE CODE FINALLY';
    document.getElementById('inp-bottom-text').value = 'COMPILES ON FIRST TRY';
    document.getElementById('range-font-size').value = 42;
    document.getElementById('val-font-size').innerText = '42px';
    selectTemplate('https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600', document.querySelector('.template-card'));
  }
</script>
</body>
</html>
