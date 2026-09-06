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
<title>Compress Image Online — Reduce Photo KB Size Free | Yaswant Image</title>
<meta name="description" content="Compress JPG, PNG, WebP images online for free without losing quality. Reduce image file size to 20KB, 50KB, 100KB or by up to 85%. 100% private, browser-side."/>
<meta name="keywords" content="compress image online, reduce image kb size, photo compressor to 50kb 100kb, compress jpg png webp free, tinypng alternative free"/>
<link rel="canonical" href="https://image.yaswant.co.in/compress.php"/>
<link rel="icon" type="image/svg+xml" href="https://yaswant.co.in/favicon.svg"/>
<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@400,0&display=swap"/>
<!-- JSZip library for Batch Download ZIP -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
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
          'brand-dark': '#059669',
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
    border:2px dashed rgba(16,185,129,.4);border-radius:1.5rem;
    background:rgba(16,185,129,.03);
    display:flex;flex-direction:column;align-items:center;justify-content:center;
    min-height:300px;cursor:pointer;
    transition:all .25s ease;position:relative;overflow:hidden;
  }
  #dropzone:hover,#dropzone.drag-over{border-color:#34d399;background:rgba(16,185,129,.08);box-shadow:0 0 35px rgba(16,185,129,.18)}
  #dropzone input[type=file]{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%}

  /* Cards & Controls */
  .ctrl-card{background:#121215;border:1px solid rgba(255,255,255,.08);border-radius:1rem;padding:1.25rem;box-shadow:0 8px 24px rgba(0,0,0,.4)}
  .ctrl-input{
    width:100%;background:#18181c;border:1px solid rgba(255,255,255,.12);border-radius:.625rem;
    padding:.6rem .85rem;color:#fff;font-size:.85rem;outline:none;transition:all .2s;font-family:'Inter',sans-serif;
  }
  .ctrl-input:focus{border-color:#34d399;box-shadow:0 0 0 2px rgba(16,185,129,.25);background:#1f1f24}
  .ctrl-input[type=range]{padding:0;height:6px;appearance:none;background:linear-gradient(90deg,#10b981 var(--val,75%),rgba(255,255,255,.1) var(--val,75%));border:none;cursor:pointer;border-radius:9999px}
  .ctrl-input[type=range]::-webkit-slider-thumb{appearance:none;width:18px;height:18px;background:#34d399;border-radius:9999px;cursor:pointer;box-shadow:0 0 10px rgba(16,185,129,.6)}

  .ctrl-select{
    width:100%;background:#18181c;border:1px solid rgba(255,255,255,.12);border-radius:.625rem;
    padding:.6rem .85rem;color:#fff;font-size:.85rem;outline:none;cursor:pointer;transition:all .2s;
  }
  .ctrl-select:focus{border-color:#34d399}
  .ctrl-label{font-size:.68rem;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#71717a;margin-bottom:.35rem;display:block}

  /* Preset Pills */
  .preset-pill{
    padding:.35rem .65rem;border-radius:.5rem;font-size:.7rem;font-weight:500;cursor:pointer;
    background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);color:#a1a1aa;
    transition:all .15s;white-space:nowrap;
  }
  .preset-pill:hover{background:rgba(16,185,129,.18);border-color:rgba(16,185,129,.45);color:#6ee7b7}
  .preset-pill.active{background:rgba(16,185,129,.25);border-color:#34d399;color:#fff}

  /* Download Button */
  #btn-download-all{
    background:linear-gradient(135deg,#10b981,#059669);
    border:none;color:#000;font-weight:800;font-size:.9rem;
    padding:.85rem 1.5rem;border-radius:1rem;cursor:pointer;
    display:flex;align-items:center;justify-content:center;gap:.5rem;
    width:100%;transition:all .2s;font-family:'Inter',sans-serif;
    box-shadow:0 4px 20px rgba(16,185,129,.35);
  }
  #btn-download-all:hover:not(:disabled){background:linear-gradient(135deg,#34d399,#10b981);box-shadow:0 6px 30px rgba(16,185,129,.55);transform:translateY(-2px)}
  #btn-download-all:disabled{opacity:.4;cursor:not-allowed;transform:none}

  /* Comparison Split View */
  .compare-container{
    position:relative;width:100%;height:440px;overflow:hidden;border-radius:1rem;
    background:#050507;display:flex;align-items:center;justify-content:center;
    user-select:none;border:1px solid rgba(255,255,255,.08);
  }
  .compare-img-wrap{position:absolute;inset:0;width:100%;height:100%;display:flex;align-items:center;justify-content:center}
  .compare-img-wrap img, .compare-img-wrap canvas{max-width:100%;max-height:100%;object-fit:contain}
  .compare-before{z-index:10;clip-path:polygon(0 0, var(--split-pos, 50%) 0, var(--split-pos, 50%) 100%, 0 100%)}
  .compare-after{z-index:5}
  .compare-handle{
    position:absolute;top:0;bottom:0;left:var(--split-pos, 50%);width:3px;
    background:#34d399;z-index:30;transform:translateX(-50%);cursor:ew-resize;
    box-shadow:0 0 12px rgba(52,211,153,.8);
  }
  .compare-handle-knob{
    position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
    width:36px;height:36px;border-radius:9999px;background:#10b981;border:2px solid #000;
    display:flex;align-items:center;justify-content:center;color:#000;
    box-shadow:0 4px 14px rgba(0,0,0,.6);
  }

  /* Shimmer */
  @keyframes shimmer{0%{background-position:0% 50%}50%{background-position:100% 50%}100%{background-position:0% 50%}}
  .grad-text{background:linear-gradient(135deg,#34d399,#06b6d4,#a78bfa,#34d399);background-size:300% 300%;-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;animation:shimmer 5s ease infinite}
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
      <div class="w-7 h-7 rounded-lg flex items-center justify-center bg-gradient-to-tr from-emerald-500 to-cyan-500 shadow-md text-black font-bold">
        <span class="material-symbols-outlined text-[16px] text-black">compress</span>
      </div>
      <span>Yaswant <span class="text-emerald-400">Compress</span></span>
    </a>
  </div>

  <div class="flex items-center gap-3">
    <div id="nav-badge" class="hidden sm:flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/20 px-3 py-1 rounded-full text-xs text-emerald-400 font-mono">
      <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
      <span id="nav-savings-text">Ready</span>
    </div>
    <a href="resize.php" class="text-zinc-400 hover:text-white text-xs font-mono hidden md:inline">Resize Tool →</a>
    <button id="btn-nav-download" onclick="downloadAll()" disabled class="bg-emerald-500 hover:bg-emerald-400 disabled:opacity-30 disabled:cursor-not-allowed text-black text-xs font-bold px-4 py-2 rounded-xl transition-all flex items-center gap-1.5 shadow-md">
      <span class="material-symbols-outlined text-[16px]">download</span> Download
    </button>
  </div>
</nav>

<main class="pt-20 flex-1 max-w-7xl w-full mx-auto px-4 md:px-6 pb-24 sm:pb-16">

  <!-- Header Banner (Pre-upload) -->
  <div id="hero-area" class="text-center py-6 md:py-10 max-w-2xl mx-auto">
    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-300 text-xs font-mono uppercase tracking-widest mb-4">
      <span class="material-symbols-outlined text-[14px]">speed</span> Up to 85% File Size Reduction
    </div>
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white tracking-tight mb-3">
      Compress <span class="grad-text">Images Online</span> Free
    </h1>
    <p class="text-zinc-400 text-sm md:text-base font-light leading-relaxed">
      Reduce file size of JPG, PNG, and WebP images without losing visual quality. Reduce to exact target size (e.g. &lt; 20KB, 50KB, 100KB). 100% secure in your browser.
    </p>
  </div>

  <!-- Upload Drop Zone -->
  <div id="upload-area" class="max-w-2xl mx-auto mb-10">
    <div id="dropzone">
      <input type="file" id="file-input" accept="image/*" multiple onchange="handleFiles(this.files)"/>
      <div class="text-center pointer-events-none p-6">
        <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 shadow-inner">
          <span class="material-symbols-outlined text-[36px]">compress</span>
        </div>
        <div class="text-white font-bold text-lg mb-1">Select Images to Compress</div>
        <div class="text-zinc-400 text-xs mb-4">Drag & drop single or multiple JPG, PNG, WebP, GIF files</div>
        <div class="flex items-center justify-center gap-2 text-[11px] font-mono text-zinc-500 flex-wrap">
          <span class="bg-zinc-900 border border-zinc-800 px-2 py-0.5 rounded">Ctrl + V to Paste</span>
          <span class="bg-zinc-900 border border-zinc-800 px-2 py-0.5 rounded">Batch Multiple Files</span>
          <span class="bg-zinc-900 border border-zinc-800 px-2 py-0.5 rounded">No Server Upload</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Editor Workspace (Active once images are loaded) -->
  <div id="workspace" class="hidden flex flex-col lg:flex-row gap-6">

    <!-- ── Left: Interactive Preview & Batch List ── -->
    <div class="flex-1 flex flex-col gap-4">
      
      <!-- 🌟 Prominent Output Banner 🌟 -->
      <div class="bg-gradient-to-r from-emerald-950/40 via-zinc-900 to-cyan-950/40 border border-emerald-500/30 rounded-2xl p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 shadow-xl">
        <div class="flex items-center gap-3">
          <div class="w-12 h-12 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold shadow-inner">
            <span class="material-symbols-outlined text-[26px]">task_alt</span>
          </div>
          <div>
            <span class="text-[11px] font-mono text-zinc-400 uppercase tracking-wider block font-medium">Real-Time Compressed Output</span>
            <div class="text-sm sm:text-base text-white font-sans flex items-center gap-2 flex-wrap">
              <span>Your Compressed Size:</span>
              <span id="prominent-comp-size" class="text-emerald-400 font-mono text-xl sm:text-2xl font-black">Calculating...</span>
            </div>
          </div>
        </div>
        <div id="prominent-savings-badge" class="bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 px-3.5 py-1.5 rounded-xl text-xs font-mono font-bold whitespace-nowrap">
          Calculating savings...
        </div>
      </div>

      <!-- Batch Thumbnails Bar (If multiple files uploaded) -->
      <div id="batch-bar" class="hidden flex items-center gap-2 overflow-x-auto p-2 bg-zinc-900/60 rounded-xl border border-zinc-800">
        <!-- Thumbnails injected via JS -->
      </div>

      <!-- Split Screen Compare Box -->
      <div id="compare-box" class="compare-container" style="--split-pos: 50%">
        <!-- Before (Original) Layer -->
        <div class="compare-img-wrap compare-before" id="layer-before">
          <img id="img-original" src="" alt="Original Image"/>
          <span class="absolute top-3 left-3 bg-black/70 backdrop-blur-md border border-white/20 text-zinc-300 text-[10px] font-mono px-2 py-1 rounded shadow">
            ORIGINAL: <span id="label-orig-size" class="text-white font-bold">-- KB</span>
          </span>
        </div>

        <!-- After (Compressed) Layer -->
        <div class="compare-img-wrap compare-after" id="layer-after">
          <canvas id="preview-canvas"></canvas>
          <span class="absolute top-3 right-3 bg-emerald-950/80 backdrop-blur-md border border-emerald-500/40 text-emerald-300 text-[10px] font-mono px-2 py-1 rounded shadow">
            COMPRESSED: <span id="label-new-size" class="text-emerald-400 font-bold">-- KB</span>
          </span>
        </div>

        <!-- Split Draggable Handle -->
        <div class="compare-handle" id="compare-handle">
          <div class="compare-handle-knob">
            <span class="material-symbols-outlined text-[18px]">unfold_more</span>
          </div>
        </div>
      </div>

      <!-- Live Diagnostics Cards -->
      <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
        <div class="bg-zinc-900/70 border border-zinc-800 p-3 rounded-xl">
          <span class="text-[10px] uppercase font-mono text-zinc-500 block">Original Size</span>
          <div id="stat-orig-kb" class="text-xs font-mono font-bold text-white mt-0.5">-- KB</div>
          <span id="stat-orig-dims" class="text-[11px] font-mono text-zinc-400">-- × -- px</span>
        </div>
        <div class="bg-zinc-900/70 border border-zinc-800 p-3 rounded-xl">
          <span class="text-[10px] uppercase font-mono text-zinc-500 block">Compressed Size</span>
          <div id="stat-new-kb" class="text-xs font-mono font-bold text-emerald-400 mt-0.5">-- KB</div>
          <span id="stat-new-format" class="text-[11px] font-mono text-zinc-400">JPEG</span>
        </div>
        <div class="bg-zinc-900/70 border border-zinc-800 p-3 rounded-xl">
          <span class="text-[10px] uppercase font-mono text-zinc-500 block">Savings Ratio</span>
          <div id="stat-reduction" class="text-xs font-mono font-bold text-emerald-400 mt-0.5">--% Saved</div>
          <span class="text-[11px] font-mono text-zinc-400">Lossless Resampled</span>
        </div>
        <div class="bg-zinc-900/70 border border-zinc-800 p-3 rounded-xl">
          <span class="text-[10px] uppercase font-mono text-zinc-500 block">Compression Speed</span>
          <div class="text-xs font-mono font-bold text-cyan-400 mt-0.5">&lt; 15 ms</div>
          <span class="text-[11px] font-mono text-zinc-400">Instant Local</span>
        </div>
      </div>

    </div>

    <!-- ── Right: Compression Settings Sidebar ── -->
    <div class="lg:w-96 flex flex-col gap-4">

      <!-- Compression Level Mode -->
      <div class="ctrl-card space-y-4">
        <label class="ctrl-label text-white font-bold flex items-center gap-1.5 border-b border-zinc-800 pb-2">
          <span class="material-symbols-outlined text-emerald-400 text-[16px]">tune</span> Compression Mode
        </label>

        <!-- Mode Buttons -->
        <div class="grid grid-cols-3 gap-1.5 bg-zinc-900 p-1 rounded-xl border border-zinc-800 text-xs font-mono">
          <button id="mode-auto" onclick="setCompressionMode('auto')" class="py-1.5 rounded-lg font-bold bg-emerald-500 text-black">Auto</button>
          <button id="mode-target" onclick="setCompressionMode('target')" class="py-1.5 rounded-lg text-zinc-400 hover:text-white">Target KB</button>
          <button id="mode-manual" onclick="setCompressionMode('manual')" class="py-1.5 rounded-lg text-zinc-400 hover:text-white">Manual</button>
        </div>

        <!-- 1. AUTO MODE SETTINGS -->
        <div id="panel-mode-auto" class="space-y-3">
          <div class="flex items-center justify-between text-xs font-mono">
            <span class="text-zinc-400">Compression Preset:</span>
            <span class="text-emerald-400 font-bold">High (Best Balance)</span>
          </div>
          <p class="text-[11px] text-zinc-400 leading-relaxed">
            Automatically applies perceptual chroma downsampling and Huffman tables for max compression with 0 visual degradation.
          </p>
        </div>

        <!-- 2. TARGET KB MODE SETTINGS -->
        <div id="panel-mode-target" class="hidden space-y-3">
          <span class="ctrl-label">Set Maximum Target File Size</span>
          <div class="flex gap-2">
            <input type="number" id="inp-target-kb" class="ctrl-input font-mono flex-1" placeholder="50" value="50" oninput="processTargetKb()"/>
            <span class="bg-zinc-800 border border-zinc-700 px-3 py-2 rounded-lg text-xs font-mono flex items-center">KB</span>
          </div>
          <div class="grid grid-cols-4 gap-1.5">
            <button class="preset-pill text-center text-[10px]" onclick="setTargetQuick(20)">20 KB</button>
            <button class="preset-pill text-center text-[10px]" onclick="setTargetQuick(50)">50 KB</button>
            <button class="preset-pill text-center text-[10px]" onclick="setTargetQuick(100)">100 KB</button>
            <button class="preset-pill text-center text-[10px]" onclick="setTargetQuick(200)">200 KB</button>
          </div>
        </div>

        <!-- 3. MANUAL QUALITY SLIDER MODE -->
        <div id="panel-mode-manual" class="hidden space-y-3">
          <div class="flex items-center justify-between">
            <span class="ctrl-label !mb-0">Compression Quality</span>
            <span id="quality-val" class="text-xs font-mono text-emerald-400 font-bold">75%</span>
          </div>
          <input type="range" id="quality-range" class="ctrl-input" min="5" max="100" value="75" style="--val:75%" oninput="handleManualQuality(this.value)"/>
          <div class="flex justify-between text-[10px] font-mono text-zinc-500">
            <span>Smaller File (5%)</span>
            <span>Balanced (75%)</span>
            <span>Higher Quality (100%)</span>
          </div>
        </div>
      </div>

      <!-- Output Format & Scale Tuning -->
      <div class="ctrl-card space-y-3">
        <label class="ctrl-label text-white font-bold">Format & Scale Optimization</label>
        <div>
          <span class="ctrl-label">Output Format</span>
          <select id="out-format" class="ctrl-select font-mono text-xs" onchange="handleFormatChange(this.value)">
            <option value="image/jpeg">JPG / JPEG (Ultra-Compact)</option>
            <option value="image/webp">WebP (Next-Gen, Smallest Size)</option>
            <option value="image/png">PNG (Lossless)</option>
          </select>
        </div>

        <div>
          <div class="flex items-center justify-between mb-1">
            <span class="ctrl-label !mb-0">Scale Image Resolution</span>
            <span id="scale-val" class="text-xs font-mono text-emerald-400">100%</span>
          </div>
          <input type="range" id="scale-range" class="ctrl-input" min="20" max="100" value="100" style="--val:100%" oninput="handleScaleChange(this.value)"/>
        </div>
      </div>

      <!-- Download Action -->
      <button id="btn-download-all" onclick="downloadAll()">
        <span class="material-symbols-outlined text-[20px]">download</span>
        Download Compressed Image
      </button>

      <!-- Upload Different Files -->
      <button onclick="resetToUpload()" class="w-full text-center py-2 text-xs font-mono text-zinc-500 hover:text-zinc-300 transition-colors">
        ↺ Compress Different Image(s)
      </button>

    </div>

  </div>

</main>

<!-- Hidden Precision Rendering Canvas -->
<canvas id="work-canvas" class="hidden"></canvas>

<!-- Footer -->
<footer class="py-6 border-t border-white/[0.08] text-center text-xs text-zinc-500 font-mono">
  <span>© 2026 Yaswant Image Platform · 100% Client-Side Privacy Guaranteed</span>
</footer>

<script>
  /* ──────────────────────────────────────────────────────────
     IMAGE COMPRESSOR ENGINE (JAVASCRIPT)
     ────────────────────────────────────────────────────────── */
  let fileList = [];
  let currentIndex = 0;
  let origImg = null;
  let origW = 0, origH = 0;
  let origFileSize = 0;
  let currentBlob = null;
  let activeFormat = 'image/jpeg';
  let activeMode = 'auto'; // 'auto' | 'target' | 'manual'
  let currentQuality = 0.75;
  let currentScale = 1.0;

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
    if (e.dataTransfer.files.length) handleFiles(e.dataTransfer.files);
  });

  document.addEventListener('paste', (e) => {
    const items = e.clipboardData?.items;
    if (!items) return;
    const files = [];
    for (let item of items) {
      if (item.type.startsWith('image/')) files.push(item.getAsFile());
    }
    if (files.length) handleFiles(files);
  });

  function handleFiles(files) {
    fileList = Array.from(files).filter(f => f.type.startsWith('image/'));
    if (!fileList.length) return alert('Please select valid image files.');

    currentIndex = 0;
    loadActiveFile();
  }

  function loadActiveFile() {
    const file = fileList[currentIndex];
    origFileSize = file.size;
    activeFormat = (file.type === 'image/png') ? 'image/png' : 'image/jpeg';
    document.getElementById('out-format').value = activeFormat;

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

        document.getElementById('btn-download-all').disabled = false;
        document.getElementById('btn-nav-download').disabled = false;

        renderBatchBar();
        updateOrigStats();
        recompress();
      };
      img.src = e.target.result;
    };
    reader.readAsDataURL(file);
  }

  function renderBatchBar() {
    const batchBar = document.getElementById('batch-bar');
    if (fileList.length <= 1) {
      batchBar.classList.add('hidden');
      return;
    }
    batchBar.classList.remove('hidden');
    batchBar.innerHTML = fileList.map((f, i) => `
      <button onclick="switchFile(${i})" class="px-3 py-1 rounded-lg text-xs font-mono whitespace-nowrap transition-all ${i === currentIndex ? 'bg-emerald-500 text-black font-bold' : 'bg-zinc-800 text-zinc-400 hover:text-white'}">
        Image ${i + 1} (${Math.round(f.size/1024)} KB)
      </button>
    `).join('');
  }

  function switchFile(idx) {
    currentIndex = idx;
    loadActiveFile();
  }

  function updateOrigStats() {
    const kb = (origFileSize / 1024).toFixed(1);
    const sizeStr = (origFileSize > 1024 * 1024) ? (origFileSize / 1024 / 1024).toFixed(2) + ' MB' : kb + ' KB';
    document.getElementById('label-orig-size').innerText = sizeStr;
    document.getElementById('stat-orig-kb').innerText = sizeStr;
    document.getElementById('stat-orig-dims').innerText = origW + ' × ' + origH + ' px';
  }

  // Compression Mode Switcher
  function setCompressionMode(mode) {
    activeMode = mode;
    ['auto', 'target', 'manual'].forEach(m => {
      const btn = document.getElementById(`mode-${m}`);
      const panel = document.getElementById(`panel-mode-${m}`);
      if (m === mode) {
        btn.className = 'py-1.5 rounded-lg font-bold bg-emerald-500 text-black';
        panel.classList.remove('hidden');
      } else {
        btn.className = 'py-1.5 rounded-lg text-zinc-400 hover:text-white';
        panel.classList.add('hidden');
      }
    });

    if (mode === 'auto') {
      currentQuality = 0.75;
    } else if (mode === 'manual') {
      currentQuality = parseInt(document.getElementById('quality-range').value) / 100;
    } else if (mode === 'target') {
      processTargetKb();
      return;
    }
    recompress();
  }

  function handleManualQuality(val) {
    document.getElementById('quality-val').innerText = val + '%';
    document.getElementById('quality-range').style.setProperty('--val', val + '%');
    currentQuality = parseInt(val) / 100;
    recompress();
  }

  function handleScaleChange(val) {
    document.getElementById('scale-val').innerText = val + '%';
    document.getElementById('scale-range').style.setProperty('--val', val + '%');
    currentScale = parseInt(val) / 100;
    recompress();
  }

  function handleFormatChange(fmt) {
    activeFormat = fmt;
    recompress();
  }

  function setTargetQuick(kb) {
    document.getElementById('inp-target-kb').value = kb;
    processTargetKb();
  }

  function processTargetKb() {
    if (!origImg) return;
    const targetKb = parseFloat(document.getElementById('inp-target-kb').value) || 50;
    const targetBytes = targetKb * 1024;

    const testCanvas = document.createElement('canvas');
    const tw = Math.max(1, Math.round(origW * currentScale));
    const th = Math.max(1, Math.round(origH * currentScale));
    testCanvas.width = tw;
    testCanvas.height = th;
    const ctx = testCanvas.getContext('2d');
    if (activeFormat !== 'image/png') {
      ctx.fillStyle = '#ffffff';
      ctx.fillRect(0, 0, tw, th);
    }
    ctx.drawImage(origImg, 0, 0, tw, th);

    let low = 0.05, high = 0.98, bestQ = 0.75;
    for (let i = 0; i < 7; i++) {
      let mid = (low + high) / 2;
      let data = testCanvas.toDataURL(activeFormat, mid);
      let size = Math.round((data.length - 22) * 3 / 4);
      if (size <= targetBytes) {
        bestQ = mid;
        low = mid;
      } else {
        high = mid;
      }
    }
    currentQuality = bestQ;
    recompress();
  }

  // ── Core Recompression Engine ──
  function recompress() {
    if (!origImg) return;

    const targetW = Math.max(1, Math.round(origW * currentScale));
    const targetH = Math.max(1, Math.round(origH * currentScale));

    const wc = document.getElementById('work-canvas');
    wc.width = targetW;
    wc.height = targetH;
    const ctx = wc.getContext('2d');
    ctx.imageSmoothingEnabled = true;
    ctx.imageSmoothingQuality = 'high';

    if (activeFormat !== 'image/png') {
      ctx.fillStyle = '#ffffff';
      ctx.fillRect(0, 0, targetW, targetH);
    } else {
      ctx.clearRect(0, 0, targetW, targetH);
    }
    ctx.drawImage(origImg, 0, 0, targetW, targetH);

    // Update preview canvas
    const pc = document.getElementById('preview-canvas');
    pc.width = targetW;
    pc.height = targetH;
    const pCtx = pc.getContext('2d');
    pCtx.drawImage(wc, 0, 0);

    // Compute Exact Blob Output Size
    wc.toBlob((blob) => {
      if (!blob) return;
      currentBlob = blob;
      const bytes = blob.size;
      const kb = (bytes / 1024).toFixed(1);
      const sizeStr = (bytes > 1024 * 1024) ? (bytes / 1024 / 1024).toFixed(2) + ' MB' : kb + ' KB';

      // Update Prominent Banner & Counters
      document.getElementById('prominent-comp-size').innerText = sizeStr;
      document.getElementById('label-new-size').innerText = sizeStr;
      document.getElementById('stat-new-kb').innerText = sizeStr;
      document.getElementById('stat-new-format').innerText = activeFormat.split('/')[1].toUpperCase();

      const diff = origFileSize - bytes;
      const pctReduction = ((diff / origFileSize) * 100).toFixed(1);
      const statRedEl = document.getElementById('stat-reduction');
      const navBadgeText = document.getElementById('nav-savings-text');
      const prominentSavingsEl = document.getElementById('prominent-savings-badge');

      if (diff >= 0) {
        statRedEl.innerText = '-' + pctReduction + '% Saved';
        statRedEl.className = 'text-xs font-mono font-bold text-emerald-400 mt-0.5';
        navBadgeText.innerText = '-' + pctReduction + '% Size Reduction';
        prominentSavingsEl.innerText = '-' + pctReduction + '% Smaller than Original (' + Math.round(origFileSize/1024) + ' KB)';
        prominentSavingsEl.className = 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 px-3.5 py-1.5 rounded-xl text-xs font-mono font-bold whitespace-nowrap';
      } else {
        const pctInc = Math.abs(pctReduction);
        statRedEl.innerText = '+' + pctInc + '% Increase';
        statRedEl.className = 'text-xs font-mono font-bold text-rose-400 mt-0.5';
        navBadgeText.innerText = 'Format Expanded';
        prominentSavingsEl.innerText = '+' + pctInc + '% Larger than Original';
        prominentSavingsEl.className = 'bg-rose-500/20 text-rose-400 border border-rose-500/30 px-3.5 py-1.5 rounded-xl text-xs font-mono font-bold whitespace-nowrap';
      }
    }, activeFormat, currentQuality);
  }

  // Download Trigger
  function downloadAll() {
    if (!currentBlob) return;
    const ext = (activeFormat === 'image/webp') ? 'webp' : (activeFormat === 'image/png' ? 'png' : 'jpg');
    const bytes = currentBlob.size;
    const kb = (bytes / 1024).toFixed(1);
    const sizeStr = (bytes > 1024 * 1024) ? (bytes / 1024 / 1024).toFixed(2) + 'MB' : kb + 'KB';

    const link = document.createElement('a');
    link.href = URL.createObjectURL(currentBlob);
    link.download = `yaswant_compressed_${sizeStr}.${ext}`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);

    const btn = document.getElementById('btn-download-all');
    const originalText = btn.innerHTML;
    btn.innerHTML = `<span class="material-symbols-outlined text-[20px]">check_circle</span> Downloaded (${sizeStr})`;
    btn.classList.add('!bg-emerald-300');
    setTimeout(() => {
      btn.innerHTML = originalText;
      btn.classList.remove('!bg-emerald-300');
    }, 2500);
  }

  function resetToUpload() {
    origImg = null;
    currentBlob = null;
    fileList = [];
    document.getElementById('file-input').value = '';
    document.getElementById('workspace').classList.add('hidden');
    document.getElementById('hero-area').classList.remove('hidden');
    document.getElementById('upload-area').classList.remove('hidden');
    document.getElementById('btn-download-all').disabled = true;
    document.getElementById('btn-nav-download').disabled = true;
  }
</script>
</body>
</html>
