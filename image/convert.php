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
<title>Convert Image Online — JPG, PNG, WebP, GIF | Yaswant Image</title>
<meta name="description" content="Convert images between JPG, PNG, WebP, and BMP formats online for free in browser."/>
<link rel="canonical" href="https://image.yaswant.co.in/convert.php"/>
<link rel="icon" type="image/svg+xml" href="https://yaswant.co.in/favicon.svg"/>
<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@400,0&display=swap"/>
<script src="https://cdn.tailwindcss.com"></script>
<style>
  body{margin:0;font-family:'Inter',sans-serif;background:#09090b;color:#fff}
  .dot-grid{background-image:radial-gradient(rgba(255,255,255,.07) 1px,transparent 1px);background-size:28px 28px}
  .ctrl-card{background:#121215;border:1px solid rgba(255,255,255,.08);border-radius:1rem;padding:1.25rem}
  #dropzone{border:2px dashed rgba(245,158,11,.4);border-radius:1.5rem;background:rgba(245,158,11,.03);display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:280px;cursor:pointer;position:relative}
  #dropzone input[type=file]{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%}
</style>
</head>
<body class="dot-grid min-h-screen flex flex-col justify-between">

<nav class="fixed top-0 left-0 right-0 h-14 z-50 flex items-center justify-between px-4 md:px-8 border-b border-white/[0.08]" style="background:rgba(9,9,11,.92);backdrop-filter:blur(20px)">
  <div class="flex items-center gap-3">
    <a href="index.php" class="text-zinc-400 hover:text-white transition-colors text-xs font-mono flex items-center gap-1">
      <span class="material-symbols-outlined text-[18px]">arrow_back</span> All Tools
    </a>
    <div class="w-px h-4 bg-zinc-800"></div>
    <span class="text-white font-bold text-sm">Yaswant <span class="text-amber-400">Convert Image</span></span>
  </div>
</nav>

<main class="pt-20 flex-1 max-w-4xl w-full mx-auto px-4 pb-16">
  <div id="hero-area" class="text-center py-8">
    <h1 class="text-3xl sm:text-4xl font-black text-white mb-2">Convert <span class="text-amber-400">Image Format</span> Free</h1>
    <p class="text-zinc-400 text-sm">Convert JPG ↔ PNG ↔ WebP ↔ BMP instantly in your browser.</p>
  </div>

  <div id="upload-area" class="max-w-xl mx-auto mb-8">
    <div id="dropzone">
      <input type="file" id="file-input" accept="image/*" onchange="handleFile(this.files[0])"/>
      <div class="text-center pointer-events-none p-6">
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-3 bg-amber-500/10 border border-amber-500/30 text-amber-400">
          <span class="material-symbols-outlined text-[32px]">transform</span>
        </div>
        <div class="text-white font-bold mb-1">Upload Photo to Convert</div>
        <div class="text-zinc-500 text-xs">JPG, PNG, WebP, BMP, GIF</div>
      </div>
    </div>
  </div>

  <div id="workspace" class="hidden max-w-xl mx-auto space-y-4">
    <div class="ctrl-card space-y-4">
      <div class="flex justify-between items-center text-xs font-mono">
        <span class="text-zinc-400">Detected Format:</span>
        <span id="detected-fmt" class="text-white font-bold">JPEG</span>
      </div>

      <div>
        <label class="block text-xs font-mono text-zinc-400 mb-2">Target Output Format</label>
        <select id="target-fmt" class="w-full bg-zinc-800 border border-zinc-700 text-white rounded-xl p-3 text-sm font-mono outline-none">
          <option value="image/webp">WebP (Smallest file size & high quality)</option>
          <option value="image/jpeg">JPG / JPEG (Standard universal format)</option>
          <option value="image/png">PNG (Lossless & transparent)</option>
        </select>
      </div>

      <button onclick="convertAndDownload()" class="w-full bg-amber-500 hover:bg-amber-400 text-black py-3 rounded-xl font-bold text-sm transition-all shadow-lg flex items-center justify-center gap-2">
        <span class="material-symbols-outlined text-[18px]">download</span> Convert & Download
      </button>
      <button onclick="location.reload()" class="w-full text-center text-xs font-mono text-zinc-500 hover:text-zinc-300 py-1">↺ Convert Another File</button>
    </div>
  </div>
</main>

<script>
  let img = null, origType = '';

  function handleFile(file) {
    if (!file) return;
    origType = file.type;
    const r = new FileReader();
    r.onload = (e) => {
      img = new Image();
      img.onload = () => {
        document.getElementById('detected-fmt').innerText = origType.split('/')[1]?.toUpperCase() || 'IMAGE';
        document.getElementById('hero-area').classList.add('hidden');
        document.getElementById('upload-area').classList.add('hidden');
        document.getElementById('workspace').classList.remove('hidden');
      };
      img.src = e.target.result;
    };
    r.readAsDataURL(file);
  }

  function convertAndDownload() {
    if (!img) return;
    const fmt = document.getElementById('target-fmt').value;
    const ext = fmt.split('/')[1];

    const c = document.createElement('canvas');
    c.width = img.naturalWidth; c.height = img.naturalHeight;
    const ctx = c.getContext('2d');
    if (fmt !== 'image/png') {
      ctx.fillStyle = '#ffffff';
      ctx.fillRect(0, 0, c.width, c.height);
    }
    ctx.drawImage(img, 0, 0);

    const link = document.createElement('a');
    link.href = c.toDataURL(fmt, 0.9);
    link.download = `yaswant_converted.${ext}`;
    link.click();
  }
</script>
</body>
</html>
