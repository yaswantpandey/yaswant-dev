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
<title>Remove Background from Image Free Online | Yaswant Image</title>
<meta name="description" content="Remove image background 100% automatically in browser. Make background transparent or replace with color. Free, fast, and no server upload."/>
<meta name="keywords" content="remove background from image free, background remover online, transparent png maker, erase photo background, remove bg free online"/>
<link rel="canonical" href="https://image.yaswant.co.in/remove-bg.php"/>
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
        fontFamily: {
          sans: ['Inter', 'sans-serif'],
          mono: ['JetBrains Mono', 'monospace'],
        },
        colors: {
          brand: '#10b981',
          'brand-light': '#34d399',
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

  /* Drop zone */
  #dropzone{
    border:2px dashed rgba(20,184,166,.4);border-radius:1.5rem;
    background:rgba(20,184,166,.03);
    display:flex;flex-direction:column;align-items:center;justify-content:center;
    min-height:300px;cursor:pointer;
    transition:all .25s ease;position:relative;overflow:hidden;
  }
  #dropzone:hover,#dropzone.drag-over{border-color:#2dd4bf;background:rgba(20,184,166,.08);box-shadow:0 0 35px rgba(20,184,166,.18)}
  #dropzone input[type=file]{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%}

  /* Controls & Cards */
  .ctrl-card{background:#121215;border:1px solid rgba(255,255,255,.08);border-radius:1rem;padding:1.25rem;box-shadow:0 8px 24px rgba(0,0,0,.4)}
  .ctrl-label{font-size:.68rem;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#71717a;margin-bottom:.35rem;display:block}
  
  /* Checkerboard for Transparent background */
  .checkerboard-bg {
    background-color: #18181b;
    background-image: linear-gradient(45deg, #27272a 25%, transparent 25%), 
                      linear-gradient(-45deg, #27272a 25%, transparent 25%), 
                      linear-gradient(45deg, transparent 75%, #27272a 75%), 
                      linear-gradient(-45deg, transparent 75%, #27272a 75%);
    background-size: 20px 20px;
    background-position: 0 0, 0 10px, 10px -10px, -10px 0px;
  }

  .preset-pill{
    padding:.35rem .65rem;border-radius:.5rem;font-size:.7rem;font-weight:500;cursor:pointer;
    background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);color:#a1a1aa;
    transition:all .15s;white-space:nowrap;
  }
  .preset-pill:hover{background:rgba(20,184,166,.18);border-color:rgba(20,184,166,.45);color:#5eead4}
  .preset-pill.active{background:rgba(20,184,166,.25);border-color:#2dd4bf;color:#fff}

  /* Compare Split View */
  .compare-container{
    position:relative;width:100%;height:460px;overflow:hidden;border-radius:1rem;
    display:flex;align-items:center;justify-content:center;
    user-select:none;border:1px solid rgba(255,255,255,.08);
  }
  .compare-img-wrap{position:absolute;inset:0;width:100%;height:100%;display:flex;align-items:center;justify-content:center}
  .compare-img-wrap img, .compare-img-wrap canvas{max-width:100%;max-height:100%;object-fit:contain}
  .compare-before{z-index:10;clip-path:polygon(0 0, var(--split-pos, 50%) 0, var(--split-pos, 50%) 100%, 0 100%)}
  .compare-after{z-index:5}
  .compare-handle{
    position:absolute;top:0;bottom:0;left:var(--split-pos, 50%);width:3px;
    background:#2dd4bf;z-index:30;transform:translateX(-50%);cursor:ew-resize;
    box-shadow:0 0 12px rgba(45,212,191,.8);
  }
  .compare-handle-knob{
    position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
    width:36px;height:36px;border-radius:9999px;background:#14b8a6;border:2px solid #000;
    display:flex;align-items:center;justify-content:center;color:#000;
    box-shadow:0 4px 14px rgba(0,0,0,.6);
  }

  /* Shimmer */
  @keyframes shimmer{0%{background-position:0% 50%}50%{background-position:100% 50%}100%{background-position:0% 50%}}
  .grad-text{background:linear-gradient(135deg,#2dd4bf,#38bdf8,#a78bfa,#2dd4bf);background-size:300% 300%;-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;animation:shimmer 5s ease infinite}
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
      <div class="w-7 h-7 rounded-lg flex items-center justify-center bg-gradient-to-tr from-teal-500 to-cyan-500 shadow-md text-black font-bold">
        <span class="material-symbols-outlined text-[16px] text-black">auto_fix_high</span>
      </div>
      <span>Yaswant <span class="text-teal-400">Remove BG</span></span>
    </a>
  </div>

  <div class="flex items-center gap-3">
    <a href="resize.php" class="text-zinc-400 hover:text-white text-xs font-mono hidden md:inline">Resize Tool</a>
    <a href="compress.php" class="text-zinc-400 hover:text-white text-xs font-mono hidden md:inline">Compress Tool</a>
    <button id="btn-nav-download" onclick="downloadCutout()" disabled class="bg-teal-400 hover:bg-teal-300 disabled:opacity-30 disabled:cursor-not-allowed text-black text-xs font-bold px-4 py-2 rounded-xl transition-all flex items-center gap-1.5 shadow-md">
      <span class="material-symbols-outlined text-[16px]">download</span> Download PNG
    </button>
  </div>
</nav>

<main class="pt-20 flex-1 max-w-7xl w-full mx-auto px-4 md:px-6 pb-16">

  <!-- Header Banner (Pre-upload) -->
  <div id="hero-area" class="text-center py-6 md:py-10 max-w-2xl mx-auto">
    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-500/10 border border-teal-500/20 text-teal-300 text-xs font-mono uppercase tracking-widest mb-4">
      <span class="material-symbols-outlined text-[14px]">auto_fix_high</span> 100% Free · Browser Side
    </div>
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white tracking-tight mb-3">
      Remove <span class="grad-text">Image Background</span> Free
    </h1>
    <p class="text-zinc-400 text-sm md:text-base font-light leading-relaxed">
      Make photo backgrounds transparent (PNG) in 1 click or replace background with white, blue, or passport studio colors.
    </p>
  </div>

  <!-- Upload Area -->
  <div id="upload-area" class="max-w-2xl mx-auto mb-10">
    <div id="dropzone">
      <input type="file" id="file-input" accept="image/*" onchange="handleFile(this.files[0])"/>
      <div class="text-center pointer-events-none p-6">
        <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 bg-teal-500/10 border border-teal-500/30 text-teal-400 shadow-inner">
          <span class="material-symbols-outlined text-[36px]">auto_fix_high</span>
        </div>
        <div class="text-white font-bold text-lg mb-1">Upload Photo to Remove Background</div>
        <div class="text-zinc-400 text-xs mb-4">Portraits, Products, Logos, Signatures · Instant Transparency</div>
        <div class="flex items-center justify-center gap-2 text-[11px] font-mono text-zinc-500">
          <span class="bg-zinc-900 border border-zinc-800 px-2 py-0.5 rounded">Ctrl + V to Paste Image</span>
          <span class="bg-zinc-900 border border-zinc-800 px-2 py-0.5 rounded">Transparent PNG Output</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Editor Workspace (Active once image is loaded) -->
  <div id="workspace" class="hidden flex flex-col lg:flex-row gap-6">

    <!-- ── Left: Interactive Before vs Transparent After View ── -->
    <div class="flex-1 flex flex-col gap-4">
      
      <!-- Prominent Output Banner -->
      <div class="bg-gradient-to-r from-teal-950/40 via-zinc-900 to-cyan-950/40 border border-teal-500/30 rounded-2xl p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 shadow-xl">
        <div class="flex items-center gap-3">
          <div class="w-12 h-12 rounded-xl bg-teal-500/20 text-teal-400 flex items-center justify-center font-bold shadow-inner">
            <span class="material-symbols-outlined text-[26px]">check_circle</span>
          </div>
          <div>
            <span class="text-[11px] font-mono text-zinc-400 uppercase tracking-wider block font-medium">Background Removed Output</span>
            <div class="text-sm sm:text-base text-white font-sans flex items-center gap-2 flex-wrap">
              <span>Status:</span>
              <span id="prominent-status" class="text-teal-400 font-mono text-xl font-black">Transparent Cutout Ready</span>
            </div>
          </div>
        </div>
        <div class="bg-teal-500/20 text-teal-400 border border-teal-500/30 px-3.5 py-1.5 rounded-xl text-xs font-mono font-bold whitespace-nowrap">
          Lossless Alpha PNG
        </div>
      </div>

      <!-- Split Screen Compare Box with Checkerboard Background -->
      <div id="compare-box" class="compare-container checkerboard-bg" style="--split-pos: 50%">
        <!-- Before (Original) Layer -->
        <div class="compare-img-wrap compare-before" id="layer-before">
          <img id="img-original" src="" alt="Original Image"/>
          <span class="absolute top-3 left-3 bg-black/70 backdrop-blur-md border border-white/20 text-zinc-300 text-[10px] font-mono px-2 py-1 rounded shadow">
            ORIGINAL
          </span>
        </div>

        <!-- After (Transparent / Custom BG) Layer -->
        <div class="compare-img-wrap compare-after" id="layer-after">
          <canvas id="cutout-canvas"></canvas>
          <span class="absolute top-3 right-3 bg-teal-950/80 backdrop-blur-md border border-teal-500/40 text-teal-300 text-[10px] font-mono px-2 py-1 rounded shadow">
            TRANSPARENT PNG
          </span>
        </div>

        <!-- Split Draggable Handle -->
        <div class="compare-handle" id="compare-handle">
          <div class="compare-handle-knob">
            <span class="material-symbols-outlined text-[18px]">unfold_more</span>
          </div>
        </div>
      </div>

      <!-- Tips Banner -->
      <div class="bg-zinc-900/60 border border-zinc-800 p-3.5 rounded-xl flex items-center gap-3 text-xs text-zinc-400">
        <span class="material-symbols-outlined text-teal-400 text-[20px] shrink-0">info</span>
        <span>Click on the background area on the right side to sample & remove any specific background color, or use the tolerance slider to clean edges!</span>
      </div>

    </div>

    <!-- ── Right: Background Removal & Replacement Controls ── -->
    <div class="lg:w-96 flex flex-col gap-4">

      <!-- Removal Methods Card -->
      <div class="ctrl-card space-y-4">
        <label class="ctrl-label text-white font-bold flex items-center gap-1.5 border-b border-zinc-800 pb-2">
          <span class="material-symbols-outlined text-teal-400 text-[16px]">tune</span> Removal Tuning
        </label>

        <!-- Color Removal Tolerance Slider -->
        <div>
          <div class="flex items-center justify-between mb-1">
            <span class="ctrl-label !mb-0">Color Match Tolerance</span>
            <span id="val-tolerance" class="text-xs font-mono text-teal-400 font-bold">25</span>
          </div>
          <input type="range" id="range-tolerance" min="5" max="90" value="25" oninput="document.getElementById('val-tolerance').innerText=this.value;processCutout()" class="w-full"/>
        </div>

        <!-- Edge Smoothing / Feathering -->
        <div>
          <div class="flex items-center justify-between mb-1">
            <span class="ctrl-label !mb-0">Edge Softness / Feather</span>
            <span id="val-feather" class="text-xs font-mono text-teal-400 font-bold">2 px</span>
          </div>
          <input type="range" id="range-feather" min="0" max="10" value="2" oninput="document.getElementById('val-feather').innerText=this.value+' px';processCutout()" class="w-full"/>
        </div>

        <!-- Quick Background Sample Color -->
        <div>
          <span class="ctrl-label">Sampled Key Color</span>
          <div class="flex items-center gap-2">
            <input type="color" id="key-color" value="#ffffff" onchange="processCutout()" class="w-10 h-9 rounded-lg bg-zinc-800 border border-zinc-700 cursor-pointer p-0.5"/>
            <button onclick="autoDetectCornerColor()" class="flex-1 preset-pill text-center py-2">
              Auto-Sample Corner Color
            </button>
          </div>
        </div>
      </div>

      <!-- Replace Background Color Card -->
      <div class="ctrl-card space-y-3">
        <label class="ctrl-label text-white font-bold">Replace Background Backdrop</label>
        <div class="grid grid-cols-4 gap-2">
          <button onclick="setBackgroundBackdrop('transparent')" class="preset-pill text-center active" id="bg-btn-transparent">
            Transparent
          </button>
          <button onclick="setBackgroundBackdrop('#ffffff')" class="preset-pill text-center" id="bg-btn-white">
            White
          </button>
          <button onclick="setBackgroundBackdrop('#0055A5')" class="preset-pill text-center" id="bg-btn-blue">
            Passport Blue
          </button>
          <button onclick="setBackgroundBackdrop('#000000')" class="preset-pill text-center" id="bg-btn-black">
            Black
          </button>
        </div>
        <div class="flex items-center gap-2 pt-2 border-t border-zinc-800">
          <span class="text-xs text-zinc-400 font-mono">Custom Color:</span>
          <input type="color" id="custom-backdrop-color" value="#10b981" onchange="setBackgroundBackdrop(this.value)" class="w-8 h-8 rounded bg-zinc-800 border border-zinc-700 cursor-pointer"/>
        </div>
      </div>

      <!-- Download Button -->
      <button id="btn-download" onclick="downloadCutout()" class="w-full bg-teal-400 hover:bg-teal-300 text-black py-3 rounded-xl font-bold text-sm transition-all shadow-lg flex items-center justify-center gap-2">
        <span class="material-symbols-outlined text-[20px]">download</span>
        Download Transparent Cutout (PNG)
      </button>

      <button onclick="resetToUpload()" class="w-full text-center py-2 text-xs font-mono text-zinc-500 hover:text-zinc-300 transition-colors">
        ↺ Upload Different Image
      </button>

    </div>

  </div>

</main>

<script>
  /* ──────────────────────────────────────────────────────────
     BROWSER-SIDE BACKGROUND REMOVER (JAVASCRIPT)
     ────────────────────────────────────────────────────────── */
  let origImg = null;
  let origW = 0, origH = 0;
  let backdrop = 'transparent';

  // Split Drag Handle
  const compareBox = document.getElementById('compare-box');
  let isDraggingSplit = false;

  function initSplitDrag() {
    const handle = document.getElementById('compare-handle');
    const onMove = (e) => {
      if (!isDraggingSplit) return;
      const rect = compareBox.getBoundingClientRect();
      const clientX = e.touches ? e.touches[0].clientX : e.clientX;
      let pos = ((clientX - rect.left) / rect.width) * 100;
      pos = Math.max(5, Math.min(95, pos));
      compareBox.style.setProperty('--split-pos', pos + '%');
    };
    window.addEventListener('mousemove', onMove);
    window.addEventListener('touchmove', onMove);
    window.addEventListener('mouseup', () => isDraggingSplit = false);
    window.addEventListener('touchend', () => isDraggingSplit = false);
    handle.addEventListener('mousedown', () => isDraggingSplit = true);
    handle.addEventListener('touchstart', () => isDraggingSplit = true);
  }
  initSplitDrag();

  // Dropzone Events
  const dz = document.getElementById('dropzone');
  dz.addEventListener('dragover', (e) => { e.preventDefault(); dz.classList.add('drag-over'); });
  dz.addEventListener('dragleave', () => dz.classList.remove('drag-over'));
  dz.addEventListener('drop', (e) => {
    e.preventDefault();
    dz.classList.remove('drag-over');
    if (e.dataTransfer.files[0]) handleFile(e.dataTransfer.files[0]);
  });

  document.addEventListener('paste', (e) => {
    const items = e.clipboardData?.items;
    if (!items) return;
    for (let item of items) {
      if (item.type.startsWith('image/')) {
        handleFile(item.getAsFile());
        break;
      }
    }
  });

  function handleFile(file) {
    if (!file || !file.type.startsWith('image/')) return alert('Please select a valid image file.');
    const reader = new FileReader();
    reader.onload = (e) => {
      const img = new Image();
      img.onload = () => {
        origImg = img;
        origW = img.naturalWidth;
        origH = img.naturalHeight;

        document.getElementById('img-original').src = e.target.result;
        document.getElementById('hero-area').classList.add('hidden');
        document.getElementById('upload-area').classList.add('hidden');
        document.getElementById('workspace').classList.remove('hidden');

        document.getElementById('btn-download').disabled = false;
        document.getElementById('btn-nav-download').disabled = false;

        autoDetectCornerColor();
      };
      img.src = e.target.result;
    };
    reader.readAsDataURL(file);
  }

  function autoDetectCornerColor() {
    if (!origImg) return;
    const tempCanvas = document.createElement('canvas');
    tempCanvas.width = origW;
    tempCanvas.height = origH;
    const ctx = tempCanvas.getContext('2d');
    ctx.drawImage(origImg, 0, 0);

    // Sample top-left corner color
    const p = ctx.getImageData(5, 5, 1, 1).data;
    const hex = rgbToHex(p[0], p[1], p[2]);
    document.getElementById('key-color').value = hex;
    processCutout();
  }

  function rgbToHex(r, g, b) {
    return '#' + [r, g, b].map(x => {
      const hex = x.toString(16);
      return hex.length === 1 ? '0' + hex : hex;
    }).join('');
  }

  function hexToRgb(hex) {
    const bigint = parseInt(hex.replace('#',''), 16);
    return {
      r: (bigint >> 16) & 255,
      g: (bigint >> 8) & 255,
      b: bigint & 255
    };
  }

  function setBackgroundBackdrop(color) {
    backdrop = color;
    document.querySelectorAll('[id^="bg-btn-"]').forEach(b => b.classList.remove('active'));
    if (color === 'transparent') document.getElementById('bg-btn-transparent')?.classList.add('active');
    else if (color === '#ffffff') document.getElementById('bg-btn-white')?.classList.add('active');
    else if (color === '#0055A5') document.getElementById('bg-btn-blue')?.classList.add('active');
    else if (color === '#000000') document.getElementById('bg-btn-black')?.classList.add('active');
    processCutout();
  }

  // Color-Key Transparency & Edge Matte Algorithm
  function processCutout() {
    if (!origImg) return;

    const c = document.getElementById('cutout-canvas');
    c.width = origW;
    c.height = origH;
    const ctx = c.getContext('2d');

    // Fill backdrop if solid color chosen
    if (backdrop !== 'transparent') {
      ctx.fillStyle = backdrop;
      ctx.fillRect(0, 0, origW, origH);
    } else {
      ctx.clearRect(0, 0, origW, origH);
    }

    // Temporary canvas for processing pixel data
    const tempCanvas = document.createElement('canvas');
    tempCanvas.width = origW;
    tempCanvas.height = origH;
    const tCtx = tempCanvas.getContext('2d');
    tCtx.drawImage(origImg, 0, 0);

    const imgData = tCtx.getImageData(0, 0, origW, origH);
    const data = imgData.data;

    const keyColorHex = document.getElementById('key-color').value;
    const key = hexToRgb(keyColorHex);
    const tolerance = parseInt(document.getElementById('range-tolerance').value);
    const feather = parseInt(document.getElementById('range-feather').value);

    // Euclidean color distance mask
    for (let i = 0; i < data.length; i += 4) {
      const r = data[i], g = data[i + 1], b = data[i + 2];
      const dist = Math.sqrt((r - key.r) ** 2 + (g - key.g) ** 2 + (b - key.b) ** 2);

      if (dist < tolerance) {
        data[i + 3] = 0; // Transparent
      } else if (dist < tolerance + feather * 8) {
        // Soft feather blend
        const alphaFactor = (dist - tolerance) / (feather * 8);
        data[i + 3] = Math.round(data[i + 3] * alphaFactor);
      }
    }

    tCtx.putImageData(imgData, 0, 0);
    ctx.drawImage(tempCanvas, 0, 0);
  }

  function downloadCutout() {
    const c = document.getElementById('cutout-canvas');
    const link = document.createElement('a');
    link.href = c.toDataURL('image/png');
    link.download = `yaswant_transparent_cutout.png`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  }

  function resetToUpload() {
    origImg = null;
    document.getElementById('file-input').value = '';
    document.getElementById('workspace').classList.add('hidden');
    document.getElementById('hero-area').classList.remove('hidden');
    document.getElementById('upload-area').classList.remove('hidden');
    document.getElementById('btn-download').disabled = true;
    document.getElementById('btn-nav-download').disabled = true;
  }
</script>
</body>
</html>
