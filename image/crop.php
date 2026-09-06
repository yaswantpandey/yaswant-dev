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
<title>Crop Image Online — Free Photo Cropper | Yaswant Image</title>
<meta name="description" content="Crop JPG, PNG, and WebP images online with free aspect ratio presets (1:1, 16:9, 4:3, circular). 100% private in browser."/>
<link rel="canonical" href="https://image.yaswant.co.in/crop.php"/>
<link rel="icon" type="image/svg+xml" href="https://yaswant.co.in/favicon.svg"/>
<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@400,0&display=swap"/>
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        fontFamily: { sans: ['Inter', 'sans-serif'], mono: ['JetBrains Mono', 'monospace'] }
      }
    }
  }
</script>
<style>
  body{margin:0;font-family:'Inter',sans-serif;background:#09090b;color:#fff}
  .dot-grid{background-image:radial-gradient(rgba(255,255,255,.07) 1px,transparent 1px);background-size:28px 28px}
  .ctrl-card{background:#121215;border:1px solid rgba(255,255,255,.08);border-radius:1rem;padding:1.25rem}
  .preset-pill{padding:.35rem .65rem;border-radius:.5rem;font-size:.7rem;font-weight:500;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);color:#a1a1aa;transition:all .15s;cursor:pointer}
  .preset-pill:hover{background:rgba(6,182,212,.18);border-color:rgba(6,182,212,.45);color:#67e8f9}
  .preset-pill.active{background:rgba(6,182,212,.25);border-color:#22d3ee;color:#fff}
  #dropzone{border:2px dashed rgba(6,182,212,.4);border-radius:1.5rem;background:rgba(6,182,212,.03);display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:280px;cursor:pointer;position:relative}
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
    <span class="text-white font-bold text-sm">Yaswant <span class="text-cyan-400">Crop Image</span></span>
  </div>
  <button id="btn-download" onclick="downloadCropped()" disabled class="bg-cyan-500 hover:bg-cyan-400 disabled:opacity-30 disabled:cursor-not-allowed text-black text-xs font-bold px-4 py-2 rounded-xl transition-all flex items-center gap-1.5 shadow-md">
    <span class="material-symbols-outlined text-[16px]">crop</span> Crop & Download
  </button>
</nav>

<main class="pt-20 flex-1 max-w-6xl w-full mx-auto px-4 pb-16">
  <!-- Header -->
  <div id="hero-area" class="text-center py-8 max-w-xl mx-auto">
    <h1 class="text-3xl sm:text-4xl font-black text-white mb-2">Crop <span class="text-cyan-400">Image</span> Online</h1>
    <p class="text-zinc-400 text-sm">Select exact crop regions with square 1:1, 16:9, 4:3, or custom freeform crop boxes.</p>
  </div>

  <div id="upload-area" class="max-w-xl mx-auto mb-8">
    <div id="dropzone">
      <input type="file" id="file-input" accept="image/*" onchange="handleFile(this.files[0])"/>
      <div class="text-center pointer-events-none p-6">
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-3 bg-cyan-500/10 border border-cyan-500/30 text-cyan-400">
          <span class="material-symbols-outlined text-[32px]">crop</span>
        </div>
        <div class="text-white font-bold mb-1">Upload Photo to Crop</div>
        <div class="text-zinc-500 text-xs">JPG, PNG, WebP · 100% Private</div>
      </div>
    </div>
  </div>

  <div id="workspace" class="hidden flex flex-col lg:flex-row gap-6">
    <div class="flex-1 flex flex-col items-center justify-center bg-zinc-950 p-4 rounded-2xl border border-zinc-800 min-h-[400px]">
      <canvas id="crop-canvas" class="max-w-full max-h-[500px] border border-zinc-700 shadow-2xl rounded-lg"></canvas>
    </div>

    <div class="lg:w-80 flex flex-col gap-4">
      <div class="ctrl-card space-y-3">
        <label class="text-xs font-bold font-mono text-zinc-300">Aspect Ratio Presets</label>
        <div class="grid grid-cols-2 gap-2">
          <button class="preset-pill active" onclick="setAspect('free', this)">Freeform</button>
          <button class="preset-pill" onclick="setAspect('1:1', this)">Square 1:1</button>
          <button class="preset-pill" onclick="setAspect('16:9', this)">YouTube 16:9</button>
          <button class="preset-pill" onclick="setAspect('4:3', this)">Standard 4:3</button>
          <button class="preset-pill" onclick="setAspect('9:16', this)">Story 9:16</button>
          <button class="preset-pill" onclick="setAspect('3:4', this)">Portrait 3:4</button>
        </div>
      </div>

      <div class="ctrl-card space-y-2">
        <div class="flex justify-between text-xs font-mono">
          <span class="text-zinc-400">Cropped Dims:</span>
          <span id="crop-dims" class="text-cyan-400 font-bold">-- × -- px</span>
        </div>
      </div>

      <button id="btn-crop-action" onclick="downloadCropped()" class="w-full bg-cyan-500 hover:bg-cyan-400 text-black py-3 rounded-xl font-bold text-sm transition-all shadow-lg flex items-center justify-center gap-2">
        <span class="material-symbols-outlined text-[18px]">download</span> Download Cropped Photo
      </button>
      <button onclick="location.reload()" class="text-xs font-mono text-zinc-500 hover:text-zinc-300 py-1">↺ Upload Another</button>
    </div>
  </div>
</main>

<script>
  let img = null, origW = 0, origH = 0;
  let cropX = 50, cropY = 50, cropW = 300, cropH = 300;
  let aspectMode = 'free';

  function handleFile(file) {
    if (!file) return;
    const r = new FileReader();
    r.onload = (e) => {
      img = new Image();
      img.onload = () => {
        origW = img.naturalWidth; origH = img.naturalHeight;
        cropX = Math.round(origW * 0.1); cropY = Math.round(origH * 0.1);
        cropW = Math.round(origW * 0.8); cropH = Math.round(origH * 0.8);

        document.getElementById('hero-area').classList.add('hidden');
        document.getElementById('upload-area').classList.add('hidden');
        document.getElementById('workspace').classList.remove('hidden');
        document.getElementById('btn-download').disabled = false;
        drawCanvas();
      };
      img.src = e.target.result;
    };
    r.readAsDataURL(file);
  }

  function setAspect(mode, btn) {
    aspectMode = mode;
    document.querySelectorAll('.preset-pill').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    if (mode === '1:1') cropH = cropW;
    else if (mode === '16:9') cropH = Math.round(cropW * 9 / 16);
    else if (mode === '4:3') cropH = Math.round(cropW * 3 / 4);
    else if (mode === '9:16') cropH = Math.round(cropW * 16 / 9);
    else if (mode === '3:4') cropH = Math.round(cropW * 4 / 3);

    drawCanvas();
  }

  function drawCanvas() {
    if (!img) return;
    const c = document.getElementById('crop-canvas');
    c.width = origW; c.height = origH;
    const ctx = c.getContext('2d');
    ctx.drawImage(img, 0, 0);

    // Dark overlay
    ctx.fillStyle = 'rgba(0,0,0,0.55)';
    ctx.fillRect(0, 0, origW, origH);

    // Clear Crop Box
    ctx.clearRect(cropX, cropY, cropW, cropH);
    ctx.drawImage(img, cropX, cropY, cropW, cropH, cropX, cropY, cropW, cropH);

    // Border
    ctx.strokeStyle = '#22d3ee';
    ctx.lineWidth = 4;
    ctx.strokeRect(cropX, cropY, cropW, cropH);

    document.getElementById('crop-dims').innerText = `${cropW} × ${cropH} px`;
  }

  function downloadCropped() {
    if (!img) return;
    const outCanvas = document.createElement('canvas');
    outCanvas.width = cropW; outCanvas.height = cropH;
    const ctx = outCanvas.getContext('2d');
    ctx.drawImage(img, cropX, cropY, cropW, cropH, 0, 0, cropW, cropH);

    const link = document.createElement('a');
    link.href = outCanvas.toDataURL('image/jpeg', 0.92);
    link.download = `yaswant_cropped_${cropW}x${cropH}.jpg`;
    link.click();
  }
</script>
</body>
</html>
