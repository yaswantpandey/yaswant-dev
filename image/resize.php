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
<title>Precision Photo Resizer & KB Optimizer | Yaswant Image</title>
<meta name="description" content="Ultra-precise browser-side image resizer. Resize by pixels, percentage, cm, mm, inches, DPI. Auto-compress to exact target KB. 100% private, no server upload."/>
<meta name="keywords" content="photo resizer online, resize image to 50kb 100kb, passport photo resizer, resize image in cm mm inches dpi, image compression tool"/>
<link rel="canonical" href="https://image.yaswant.co.in/resize.php"/>
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
          brand: '#7c3aed',
          'brand-light': '#a78bfa',
          'brand-dark': '#6d28d9',
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
    border:2px dashed rgba(124,58,237,.35);border-radius:1.5rem;
    background:rgba(124,58,237,.03);
    display:flex;flex-direction:column;align-items:center;justify-content:center;
    min-height:300px;cursor:pointer;
    transition:all .25s ease;position:relative;overflow:hidden;
  }
  #dropzone:hover,#dropzone.drag-over{border-color:#a78bfa;background:rgba(124,58,237,.08);box-shadow:0 0 35px rgba(124,58,237,.15)}
  #dropzone input[type=file]{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%}

  /* Control cards */
  .ctrl-card{background:#121215;border:1px solid rgba(255,255,255,.08);border-radius:1rem;padding:1.25rem;box-shadow:0 8px 24px rgba(0,0,0,.4)}

  /* Inputs */
  .ctrl-input{
    width:100%;background:#18181c;border:1px solid rgba(255,255,255,.12);border-radius:.625rem;
    padding:.6rem .85rem;color:#fff;font-size:.85rem;outline:none;transition:all .2s;font-family:'Inter',sans-serif;
  }
  .ctrl-input:focus{border-color:#a78bfa;box-shadow:0 0 0 2px rgba(124,58,237,.25);background:#1f1f24}
  .ctrl-input[type=range]{padding:0;height:6px;appearance:none;background:linear-gradient(90deg,#7c3aed var(--val,80%),rgba(255,255,255,.1) var(--val,80%));border:none;cursor:pointer;border-radius:9999px}
  .ctrl-input[type=range]::-webkit-slider-thumb{appearance:none;width:18px;height:18px;background:#a78bfa;border-radius:9999px;cursor:pointer;box-shadow:0 0 10px rgba(124,58,237,.6)}

  .ctrl-select{
    width:100%;background:#18181c;border:1px solid rgba(255,255,255,.12);border-radius:.625rem;
    padding:.6rem .85rem;color:#fff;font-size:.85rem;outline:none;cursor:pointer;transition:all .2s;
  }
  .ctrl-select:focus{border-color:#a78bfa}

  .ctrl-label{font-size:.68rem;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#71717a;margin-bottom:.35rem;display:block}

  /* Preset Pills */
  .preset-pill{
    padding:.35rem .65rem;border-radius:.5rem;font-size:.7rem;font-weight:500;cursor:pointer;
    background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);color:#a1a1aa;
    transition:all .15s;white-space:nowrap;
  }
  .preset-pill:hover{background:rgba(124,58,237,.18);border-color:rgba(124,58,237,.45);color:#c4b5fd}
  .preset-pill.active{background:rgba(124,58,237,.25);border-color:#a78bfa;color:#fff}

  /* Action Buttons */
  #btn-download{
    background:linear-gradient(135deg,#7c3aed,#6d28d9);
    border:none;color:#fff;font-weight:700;font-size:.9rem;
    padding:.85rem 1.5rem;border-radius:1rem;cursor:pointer;
    display:flex;align-items:center;justify-content:center;gap:.5rem;
    width:100%;transition:all .2s;font-family:'Inter',sans-serif;
    box-shadow:0 4px 20px rgba(124,58,237,.35);
  }
  #btn-download:hover:not(:disabled){background:linear-gradient(135deg,#8b5cf6,#7c3aed);box-shadow:0 6px 30px rgba(124,58,237,.55);transform:translateY(-2px)}
  #btn-download:disabled{opacity:.4;cursor:not-allowed;transform:none}

  /* Comparison Split View */
  .compare-container{
    position:relative;width:100%;height:460px;overflow:hidden;border-radius:1rem;
    background:#050507;display:flex;align-items:center;justify-content:center;
    user-select:none;border:1px solid rgba(255,255,255,.08);
  }
  .compare-img-wrap{position:absolute;inset:0;width:100%;height:100%;display:flex;align-items:center;justify-content:center}
  .compare-img-wrap img, .compare-img-wrap canvas{max-width:100%;max-height:100%;object-fit:contain}
  .compare-before{z-index:10;clip-path:polygon(0 0, var(--split-pos, 50%) 0, var(--split-pos, 50%) 100%, 0 100%)}
  .compare-after{z-index:5}
  .compare-handle{
    position:absolute;top:0;bottom:0;left:var(--split-pos, 50%);width:3px;
    background:#a78bfa;z-index:30;transform:translateX(-50%);cursor:ew-resize;
    box-shadow:0 0 12px rgba(167,139,250,.8);
  }
  .compare-handle-knob{
    position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
    width:36px;height:36px;border-radius:9999px;background:#7c3aed;border:2px solid #fff;
    display:flex;align-items:center;justify-content:center;color:#fff;
    box-shadow:0 4px 14px rgba(0,0,0,.6);
  }

  /* Toggle Switch */
  .toggle-switch{position:relative;display:inline-flex;align-items:center;cursor:pointer;user-select:none}
  .toggle-switch input{opacity:0;width:0;height:0;position:absolute}
  .toggle-track{width:36px;height:20px;background:rgba(255,255,255,.15);border-radius:9999px;transition:background .2s}
  .toggle-switch input:checked+.toggle-track{background:#7c3aed}
  .toggle-thumb{position:absolute;left:2px;width:16px;height:16px;background:#fff;border-radius:9999px;transition:transform .2s}
  .toggle-switch input:checked~.toggle-thumb{transform:translateX(16px)}

  /* Badges & Shimmer */
  @keyframes shimmer{0%{background-position:0% 50%}50%{background-position:100% 50%}100%{background-position:0% 50%}}
  .grad-text{background:linear-gradient(135deg,#a78bfa,#06b6d4,#10b981,#a78bfa);background-size:300% 300%;-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;animation:shimmer 5s ease infinite}
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
      <div class="w-7 h-7 rounded-lg flex items-center justify-center bg-gradient-to-tr from-brand to-cyan-500 shadow-md">
        <span class="material-symbols-outlined text-[16px] text-white">photo_size_select_large</span>
      </div>
      <span>Yaswant <span class="text-purple-400">Image Precision</span></span>
    </a>
  </div>

  <div class="flex items-center gap-3">
    <div id="nav-badge" class="hidden sm:flex items-center gap-2 bg-emerald-500/10 border border-emerald-500/20 px-3 py-1 rounded-full text-xs text-emerald-400 font-mono">
      <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
      <span id="nav-savings-text">Ready</span>
    </div>
    <button id="btn-nav-download" onclick="downloadImage()" disabled class="bg-purple-600 hover:bg-purple-500 disabled:opacity-30 disabled:cursor-not-allowed text-white text-xs font-bold px-4 py-2 rounded-xl transition-all flex items-center gap-1.5 shadow-md">
      <span class="material-symbols-outlined text-[16px]">download</span> Download
    </button>
  </div>
</nav>

<main class="pt-20 flex-1 max-w-7xl w-full mx-auto px-4 md:px-6 pb-16">

  <!-- Header Banner (Pre-upload) -->
  <div id="hero-area" class="text-center py-6 md:py-10 max-w-2xl mx-auto">
    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-purple-500/10 border border-purple-500/20 text-purple-300 text-xs font-mono uppercase tracking-widest mb-4">
      <span class="material-symbols-outlined text-[14px]">bolt</span> Ultra-High Precision 2.0
    </div>
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white tracking-tight mb-3">
      Precision <span class="grad-text">Photo Resizer</span> & Optimizer
    </h1>
    <p class="text-zinc-400 text-sm md:text-base font-light leading-relaxed">
      Resize according to your exact needs: Custom Pixels, Percentage, CM, MM, Inches, DPI, or exact Target File Size in KB/MB.
    </p>
  </div>

  <!-- Upload Area -->
  <div id="upload-area" class="max-w-2xl mx-auto mb-10">
    <div id="dropzone">
      <input type="file" id="file-input" accept="image/*" onchange="handleFile(this.files[0])"/>
      <div class="text-center pointer-events-none p-6">
        <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4 bg-purple-500/10 border border-purple-500/30 text-purple-400 shadow-inner">
          <span class="material-symbols-outlined text-[36px]">add_photo_alternate</span>
        </div>
        <div class="text-white font-bold text-lg mb-1">Drag & Drop Image or Click to Browse</div>
        <div class="text-zinc-400 text-xs mb-4">Supports JPG, PNG, WebP, GIF, BMP · Instant local processing</div>
        <div class="flex items-center justify-center gap-2 text-[11px] font-mono text-zinc-500">
          <span class="bg-zinc-900 border border-zinc-800 px-2 py-0.5 rounded">Ctrl + V to Paste Image</span>
          <span class="bg-zinc-900 border border-zinc-800 px-2 py-0.5 rounded">Up to 50MB</span>
        </div>
      </div>
    </div>
  </div>

  <!-- Editor Workspace (Active once image is loaded) -->
  <div id="workspace" class="hidden flex flex-col lg:flex-row gap-6">

    <!-- ── Left: Interactive Preview & Prominent Output Display ── -->
    <div class="flex-1 flex flex-col gap-4">
      
      <!-- 🌟 PROMINENT REAL-TIME OUTPUT FILE SIZE BANNER 🌟 -->
      <div class="bg-gradient-to-r from-purple-950/40 via-zinc-900 to-emerald-950/40 border border-purple-500/30 rounded-2xl p-4 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 shadow-xl">
        <div class="flex items-center gap-3">
          <div class="w-12 h-12 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-bold shadow-inner">
            <span class="material-symbols-outlined text-[26px]">task_alt</span>
          </div>
          <div>
            <span class="text-[11px] font-mono text-zinc-400 uppercase tracking-wider block font-medium">Real-Time Resized Image Size</span>
            <div class="text-sm sm:text-base text-white font-sans flex items-center gap-2 flex-wrap">
              <span>Your Resized Image Size is:</span>
              <span id="prominent-new-size" class="text-emerald-400 font-mono text-xl sm:text-2xl font-black">Calculating...</span>
            </div>
          </div>
        </div>
        <div id="prominent-savings-badge" class="bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 px-3.5 py-1.5 rounded-xl text-xs font-mono font-bold whitespace-nowrap">
          Calculating savings...
        </div>
      </div>

      <!-- Top Toolbar for Preview Canvas -->
      <div class="flex items-center justify-between bg-zinc-900/80 p-2.5 rounded-xl border border-zinc-800 text-xs">
        <div class="flex items-center gap-2">
          <button id="btn-view-compare" onclick="toggleCompareMode(true)" class="px-3 py-1.5 rounded-lg font-mono font-bold bg-purple-600 text-white flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[15px]">compare</span> Split Compare
          </button>
          <button id="btn-view-single" onclick="toggleCompareMode(false)" class="px-3 py-1.5 rounded-lg font-mono text-zinc-400 hover:text-white flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[15px]">visibility</span> Output Only
          </button>
        </div>
        <div class="flex items-center gap-3 text-zinc-400 font-mono text-[11px]">
          <span id="zoom-indicator">Fit View</span>
          <button onclick="resetCompareSplit()" class="hover:text-purple-400" title="Center Split Line">
            <span class="material-symbols-outlined text-[16px]">restart_alt</span>
          </button>
        </div>
      </div>

      <!-- Comparison / Preview Box -->
      <div id="compare-box" class="compare-container" style="--split-pos: 50%">
        <!-- Before (Original) Layer -->
        <div class="compare-img-wrap compare-before" id="layer-before">
          <img id="img-original" src="" alt="Original Image"/>
          <span class="absolute top-3 left-3 bg-black/70 backdrop-blur-md border border-white/20 text-zinc-300 text-[10px] font-mono px-2 py-1 rounded shadow">
            ORIGINAL: <span id="label-orig-size" class="text-white font-bold">167 KB</span>
          </span>
        </div>

        <!-- After (Resized & Compressed) Layer -->
        <div class="compare-img-wrap compare-after" id="layer-after">
          <canvas id="preview-canvas"></canvas>
          <span class="absolute top-3 right-3 bg-purple-900/80 backdrop-blur-md border border-purple-500/40 text-purple-200 text-[10px] font-mono px-2 py-1 rounded shadow">
            RESIZED: <span id="label-new-size" class="text-emerald-400 font-bold">-- KB</span>
          </span>
        </div>

        <!-- Split Draggable Handle -->
        <div class="compare-handle" id="compare-handle">
          <div class="compare-handle-knob">
            <span class="material-symbols-outlined text-[18px]">unfold_more</span>
          </div>
        </div>
      </div>

      <!-- Detailed Real-Time Metrics -->
      <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
        <div class="bg-zinc-900/70 border border-zinc-800 p-3 rounded-xl">
          <span class="text-[10px] uppercase font-mono text-zinc-500 block">Original Dims & Size</span>
          <div id="stat-orig" class="text-xs font-mono font-bold text-white mt-0.5">-- × -- px</div>
          <span id="stat-orig-kb" class="text-[11px] font-mono text-zinc-400">0 KB</span>
        </div>
        <div class="bg-zinc-900/70 border border-zinc-800 p-3 rounded-xl">
          <span class="text-[10px] uppercase font-mono text-zinc-500 block">Target Dims</span>
          <div id="stat-new-dims" class="text-xs font-mono font-bold text-purple-300 mt-0.5">-- × -- px</div>
          <span id="stat-mp" class="text-[11px] font-mono text-zinc-400">0.0 MP</span>
        </div>
        <div class="bg-zinc-900/70 border border-zinc-800 p-3 rounded-xl">
          <span class="text-[10px] uppercase font-mono text-zinc-500 block">Resized Output Size</span>
          <div id="stat-new-kb" class="text-xs font-mono font-bold text-emerald-400 mt-0.5">Calculating...</div>
          <span id="stat-format-tag" class="text-[11px] font-mono text-zinc-400">JPEG</span>
        </div>
        <div class="bg-zinc-900/70 border border-zinc-800 p-3 rounded-xl">
          <span class="text-[10px] uppercase font-mono text-zinc-500 block">File Size Reduction</span>
          <div id="stat-reduction" class="text-xs font-mono font-bold text-emerald-400 mt-0.5">--% Saved</div>
          <span class="text-[11px] font-mono text-zinc-400">Lanczos Resampled</span>
        </div>
      </div>

    </div>

    <!-- ── Right: Precision Controls Sidebar ── -->
    <div class="lg:w-96 flex flex-col gap-4">

      <!-- Resize According to Needs Studio -->
      <div class="ctrl-card space-y-4">
        <div class="flex items-center justify-between border-b border-zinc-800 pb-2">
          <label class="ctrl-label !mb-0 text-white font-bold flex items-center gap-1.5">
            <span class="material-symbols-outlined text-purple-400 text-[16px]">tune</span> Resize by Your Need
          </label>
          <select id="unit-selector" onchange="changeUnitMode(this.value)" class="bg-zinc-800 border border-zinc-700 text-xs font-mono text-purple-300 rounded px-2 py-1 outline-none">
            <option value="px">Pixels (px)</option>
            <option value="pct">Percentage (%)</option>
            <option value="cm">Centimeters (cm)</option>
            <option value="mm">Millimeters (mm)</option>
            <option value="in">Inches (in)</option>
          </select>
        </div>

        <!-- Pixels Input Mode -->
        <div id="panel-unit-px" class="space-y-3">
          <div class="grid grid-cols-2 gap-3">
            <div>
              <span class="ctrl-label" id="label-w">Width</span>
              <div class="relative">
                <input type="number" id="inp-w" class="ctrl-input font-mono" placeholder="Width" min="1" max="10000" oninput="handleDimensionChange('w')"/>
                <span class="unit-tag absolute right-3 top-2.5 text-xs text-zinc-500 font-mono">px</span>
              </div>
            </div>
            <div>
              <span class="ctrl-label" id="label-h">Height</span>
              <div class="relative">
                <input type="number" id="inp-h" class="ctrl-input font-mono" placeholder="Height" min="1" max="10000" oninput="handleDimensionChange('h')"/>
                <span class="unit-tag absolute right-3 top-2.5 text-xs text-zinc-500 font-mono">px</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Percentage Input Mode -->
        <div id="panel-unit-pct" class="hidden space-y-3">
          <div class="flex items-center justify-between">
            <span class="ctrl-label !mb-0">Scale Percentage</span>
            <span id="pct-val-display" class="text-xs font-mono text-purple-400 font-bold">27%</span>
          </div>
          <input type="range" id="range-pct" class="ctrl-input" min="1" max="200" value="27" oninput="handlePercentageChange(this.value)" style="--val:13.5%"/>
          <div class="grid grid-cols-5 gap-1.5">
            <button class="preset-pill text-center" onclick="setPercentQuick(15)">15%</button>
            <button class="preset-pill text-center" onclick="setPercentQuick(27)">27%</button>
            <button class="preset-pill text-center" onclick="setPercentQuick(50)">50%</button>
            <button class="preset-pill text-center" onclick="setPercentQuick(75)">75%</button>
            <button class="preset-pill text-center" onclick="setPercentQuick(100)">100%</button>
          </div>
        </div>

        <!-- DPI Selector (for cm, mm, in) -->
        <div id="dpi-row" class="hidden flex items-center justify-between pt-2 border-t border-zinc-800">
          <span class="text-xs font-mono text-zinc-400">Target Print DPI:</span>
          <select id="dpi-selector" onchange="handleDpiChange(this.value)" class="bg-zinc-800 border border-zinc-700 text-xs font-mono text-white rounded px-2 py-1">
            <option value="72">72 DPI (Web Screen)</option>
            <option value="96">96 DPI (Default Desktop)</option>
            <option value="150">150 DPI (Draft Print)</option>
            <option value="300" selected>300 DPI (High-Res Photo / Passport)</option>
            <option value="600">600 DPI (Ultra Print)</option>
          </select>
        </div>

        <!-- Aspect Ratio Controls -->
        <div class="flex items-center justify-between pt-3 border-t border-zinc-800/80 text-xs">
          <label class="toggle-switch flex items-center gap-2 text-zinc-300">
            <input type="checkbox" id="lock-ratio" checked/>
            <div class="toggle-track"></div>
            <div class="toggle-thumb"></div>
            <span>Maintain Aspect Ratio</span>
          </label>
          <button onclick="swapWidthHeight()" class="preset-pill flex items-center gap-1" title="Swap Width and Height">
            <span class="material-symbols-outlined text-[14px]">swap_horiz</span> Swap
          </button>
        </div>

      </div>

      <!-- Auto-Fit to Exact Target Size (Max KB / MB) -->
      <div class="ctrl-card space-y-3">
        <div class="flex items-center justify-between">
          <label class="ctrl-label !mb-0 text-white font-bold flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[16px] text-emerald-400">compress</span> Resize to Exact Target Size
          </label>
          <label class="toggle-switch">
            <input type="checkbox" id="toggle-target-kb" onchange="handleTargetKbToggle()"/>
            <div class="toggle-track"></div>
            <div class="toggle-thumb"></div>
          </label>
        </div>

        <div id="target-kb-panel" class="hidden space-y-3 pt-2">
          <div class="flex gap-2">
            <input type="number" id="inp-target-kb" class="ctrl-input font-mono flex-1" placeholder="e.g. 50" value="50" oninput="processTargetKb()"/>
            <select id="target-kb-unit" onchange="processTargetKb()" class="bg-zinc-800 border border-zinc-700 text-xs font-mono text-white rounded-lg px-3">
              <option value="KB">KB</option>
              <option value="MB">MB</option>
            </select>
          </div>
          <div class="flex flex-wrap gap-1.5">
            <button class="preset-pill text-[10px]" onclick="setTargetQuick(20)">Max 20 KB</button>
            <button class="preset-pill text-[10px]" onclick="setTargetQuick(50)">Max 50 KB</button>
            <button class="preset-pill text-[10px]" onclick="setTargetQuick(100)">Max 100 KB</button>
            <button class="preset-pill text-[10px]" onclick="setTargetQuick(200)">Max 200 KB</button>
            <button class="preset-pill text-[10px]" onclick="setTargetQuick(500)">Max 500 KB</button>
          </div>
          <p class="text-[11px] text-zinc-400 italic leading-tight">Iterative binary optimizer calculates the exact quality to keep file strictly under your chosen KB limit.</p>
        </div>
      </div>

      <!-- Quick Need Presets (Govt IDs, Passport, Socials) -->
      <div class="ctrl-card space-y-3">
        <div class="flex items-center justify-between">
          <label class="ctrl-label !mb-0 text-white font-bold">Standard Need Presets</label>
          <span class="text-[10px] font-mono text-zinc-500">1-Click Apply</span>
        </div>
        <div class="grid grid-cols-2 gap-2 max-h-44 overflow-y-auto pr-1 text-xs">
          <button class="preset-pill text-left flex items-center justify-between" onclick="applyPresetExact(413, 531, 'px', 'Passport 3.5×4.5cm')">
            <span>Passport Photo</span> <span class="font-mono text-[10px] text-zinc-500">3.5×4.5</span>
          </button>
          <button class="preset-pill text-left flex items-center justify-between" onclick="applyPresetExact(213, 213, 'px', 'PAN / Govt Sign')">
            <span>Govt / Exam Sign</span> <span class="font-mono text-[10px] text-zinc-500">&lt;20KB</span>
          </button>
          <button class="preset-pill text-left flex items-center justify-between" onclick="applyPresetExact(1080, 1080, 'px', 'Instagram Square')">
            <span>Instagram Square</span> <span class="font-mono text-[10px] text-zinc-500">1:1</span>
          </button>
          <button class="preset-pill text-left flex items-center justify-between" onclick="applyPresetExact(1080, 1920, 'px', 'Insta / WhatsApp Story')">
            <span>Story / Reel</span> <span class="font-mono text-[10px] text-zinc-500">9:16</span>
          </button>
          <button class="preset-pill text-left flex items-center justify-between" onclick="applyPresetExact(1280, 720, 'px', 'YouTube Thumbnail')">
            <span>YouTube Thumb</span> <span class="font-mono text-[10px] text-zinc-500">720p</span>
          </button>
          <button class="preset-pill text-left flex items-center justify-between" onclick="applyPresetExact(1920, 1080, 'px', 'Full HD 1080p')">
            <span>Full HD 1080p</span> <span class="font-mono text-[10px] text-zinc-500">16:9</span>
          </button>
        </div>
      </div>

      <!-- Format & Compression Engine -->
      <div class="ctrl-card space-y-3">
        <label class="ctrl-label text-white font-bold">Output Quality</label>
        <div>
          <span class="ctrl-label">Format</span>
          <select id="out-format" class="ctrl-select font-mono text-xs" onchange="handleFormatChange(this.value)">
            <option value="image/jpeg">JPG / JPEG (Smallest File Size)</option>
            <option value="image/webp">WebP (Next-Gen Web Image)</option>
            <option value="image/png">PNG (Lossless Quality)</option>
          </select>
        </div>

        <div id="quality-control-block">
          <div class="flex items-center justify-between mb-1">
            <span class="ctrl-label !mb-0">Quality Slider</span>
            <span id="quality-val" class="text-xs font-mono text-purple-400 font-bold">85%</span>
          </div>
          <input type="range" id="quality-range" class="ctrl-input" min="5" max="100" value="85" style="--val:85%" oninput="handleQualitySlider(this.value)"/>
        </div>
      </div>

      <!-- Download Button -->
      <button id="btn-download" onclick="downloadImage()">
        <span class="material-symbols-outlined text-[20px]">download</span>
        Download Resized Image
      </button>

      <!-- Upload Another Image -->
      <button onclick="resetToUpload()" class="w-full text-center py-2 text-xs font-mono text-zinc-500 hover:text-zinc-300 transition-colors">
        ↺ Choose Another Image
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
     PRECISION RESIZING & OPTIMIZATION ENGINE (JAVASCRIPT)
     ────────────────────────────────────────────────────────── */
  let origImg = null;
  let origW = 0, origH = 0;
  let origFileSize = 0;
  let currentUnit = 'px';
  let targetDPI = 300;
  let currentBlob = null;
  let activeFormat = 'image/jpeg';
  let isComparing = true;

  // Split handle dragging
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

  function toggleCompareMode(enable) {
    isComparing = enable;
    const layerBefore = document.getElementById('layer-before');
    const handle = document.getElementById('compare-handle');
    const btnCompare = document.getElementById('btn-view-compare');
    const btnSingle = document.getElementById('btn-view-single');

    if (enable) {
      layerBefore.classList.remove('hidden');
      handle.classList.remove('hidden');
      compareBox.style.setProperty('--split-pos', '50%');
      btnCompare.className = 'px-3 py-1.5 rounded-lg font-mono font-bold bg-purple-600 text-white flex items-center gap-1.5';
      btnSingle.className = 'px-3 py-1.5 rounded-lg font-mono text-zinc-400 hover:text-white flex items-center gap-1.5';
    } else {
      layerBefore.classList.add('hidden');
      handle.classList.add('hidden');
      btnSingle.className = 'px-3 py-1.5 rounded-lg font-mono font-bold bg-purple-600 text-white flex items-center gap-1.5';
      btnCompare.className = 'px-3 py-1.5 rounded-lg font-mono text-zinc-400 hover:text-white flex items-center gap-1.5';
    }
  }

  function resetCompareSplit() {
    compareBox.style.setProperty('--split-pos', '50%');
  }

  // File Upload Handlers
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
    if (!file || !file.type.startsWith('image/')) return alert('Please upload a valid image file.');
    origFileSize = file.size;

    // Auto-detect format: preserve PNG only if PNG, else JPEG for optimal sizing
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
        document.getElementById('inp-w').value = origW;
        document.getElementById('inp-h').value = origH;
        document.getElementById('range-pct').value = 100;
        document.getElementById('pct-val-display').innerText = '100%';

        document.getElementById('hero-area').classList.add('hidden');
        document.getElementById('upload-area').classList.add('hidden');
        document.getElementById('workspace').classList.remove('hidden');

        document.getElementById('btn-download').disabled = false;
        document.getElementById('btn-nav-download').disabled = false;

        updateOrigStats();
        renderPreciseOutput();
      };
      img.src = e.target.result;
    };
    reader.readAsDataURL(file);
  }

  function updateOrigStats() {
    const kb = (origFileSize / 1024).toFixed(1);
    document.getElementById('label-orig-size').innerText = (origFileSize > 1024*1024 ? (origFileSize/1024/1024).toFixed(2) + ' MB' : kb + ' KB');
    document.getElementById('stat-orig').innerText = origW + ' × ' + origH + ' px';
    document.getElementById('stat-orig-kb').innerText = (kb > 1024 ? (kb/1024).toFixed(2) + ' MB' : kb + ' KB');
  }

  // Unit Switching (px, %, cm, mm, in)
  function changeUnitMode(unit) {
    currentUnit = unit;
    const isPct = (unit === 'pct');
    const isPhysical = (unit === 'cm' || unit === 'mm' || unit === 'in');

    document.getElementById('panel-unit-px').classList.toggle('hidden', isPct);
    document.getElementById('panel-unit-pct').classList.toggle('hidden', !isPct);
    document.getElementById('dpi-row').classList.toggle('hidden', !isPhysical);

    const tagEls = document.querySelectorAll('.unit-tag');
    tagEls.forEach(el => el.innerText = unit);

    if (isPhysical) {
      convertPxToPhysical(unit);
    } else if (unit === 'px') {
      document.getElementById('inp-w').value = Math.round(targetPhysicalToPx(document.getElementById('inp-w').value, 'w') || origW);
      document.getElementById('inp-h').value = Math.round(targetPhysicalToPx(document.getElementById('inp-h').value, 'h') || origH);
    }
    renderPreciseOutput();
  }

  function convertPxToPhysical(unit) {
    const curW = parseInt(document.getElementById('inp-w').value) || origW;
    const curH = parseInt(document.getElementById('inp-h').value) || origH;
    const dpi = targetDPI;

    if (unit === 'in') {
      document.getElementById('inp-w').value = (curW / dpi).toFixed(2);
      document.getElementById('inp-h').value = (curH / dpi).toFixed(2);
    } else if (unit === 'cm') {
      document.getElementById('inp-w').value = ((curW / dpi) * 2.54).toFixed(2);
      document.getElementById('inp-h').value = ((curH / dpi) * 2.54).toFixed(2);
    } else if (unit === 'mm') {
      document.getElementById('inp-w').value = Math.round((curW / dpi) * 25.4);
      document.getElementById('inp-h').value = Math.round((curH / dpi) * 25.4);
    }
  }

  function targetPhysicalToPx(val, axis) {
    const v = parseFloat(val) || 0;
    const dpi = targetDPI;
    if (currentUnit === 'in') return v * dpi;
    if (currentUnit === 'cm') return (v / 2.54) * dpi;
    if (currentUnit === 'mm') return (v / 25.4) * dpi;
    return v;
  }

  function handleDpiChange(dpi) {
    targetDPI = parseInt(dpi);
    renderPreciseOutput();
  }

  // Dimension Input Handler
  function handleDimensionChange(axis) {
    if (!origImg) return;
    const locked = document.getElementById('lock-ratio').checked;
    const wInp = document.getElementById('inp-w');
    const hInp = document.getElementById('inp-h');

    if (locked) {
      const ratio = origW / origH;
      if (axis === 'w') {
        const val = parseFloat(wInp.value) || 0;
        hInp.value = (currentUnit === 'px' || currentUnit === 'mm') ? Math.round(val / ratio) : (val / ratio).toFixed(2);
      } else {
        const val = parseFloat(hInp.value) || 0;
        wInp.value = (currentUnit === 'px' || currentUnit === 'mm') ? Math.round(val * ratio) : (val * ratio).toFixed(2);
      }
    }
    renderPreciseOutput();
  }

  function swapWidthHeight() {
    const w = document.getElementById('inp-w').value;
    document.getElementById('inp-w').value = document.getElementById('inp-h').value;
    document.getElementById('inp-h').value = w;
    renderPreciseOutput();
  }

  // Percentage Handlers
  function handlePercentageChange(val) {
    document.getElementById('pct-val-display').innerText = val + '%';
    const min = 1, max = 200;
    document.getElementById('range-pct').style.setProperty('--val', ((val - min)/(max - min)*100) + '%');
    
    const targetW = Math.round((origW * val) / 100);
    const targetH = Math.round((origH * val) / 100);
    document.getElementById('inp-w').value = targetW;
    document.getElementById('inp-h').value = targetH;
    renderPreciseOutput();
  }

  function setPercentQuick(pct) {
    document.getElementById('range-pct').value = pct;
    handlePercentageChange(pct);
  }

  // Quality & Format Handlers
  function handleQualitySlider(val) {
    document.getElementById('quality-val').innerText = val + '%';
    document.getElementById('quality-range').style.setProperty('--val', val + '%');
    renderPreciseOutput();
  }

  function handleFormatChange(fmt) {
    activeFormat = fmt;
    document.getElementById('quality-control-block').classList.toggle('hidden', fmt === 'image/png');
    renderPreciseOutput();
  }

  // Target KB Auto-Optimizer
  function handleTargetKbToggle() {
    const enabled = document.getElementById('toggle-target-kb').checked;
    document.getElementById('target-kb-panel').classList.toggle('hidden', !enabled);
    if (enabled) processTargetKb();
    else renderPreciseOutput();
  }

  function setTargetQuick(kb) {
    document.getElementById('inp-target-kb').value = kb;
    document.getElementById('target-kb-unit').value = 'KB';
    processTargetKb();
  }

  function processTargetKb() {
    if (!origImg) return;
    const targetVal = parseFloat(document.getElementById('inp-target-kb').value) || 50;
    const unit = document.getElementById('target-kb-unit').value;
    const targetBytes = (unit === 'MB') ? targetVal * 1024 * 1024 : targetVal * 1024;

    // Binary search for optimal quality between 0.05 and 0.98
    let low = 0.05, high = 0.98, bestQ = 0.75;
    const testCanvas = document.createElement('canvas');
    const targetW = getCalculatedPxW();
    const targetH = getCalculatedPxH();
    testCanvas.width = targetW;
    testCanvas.height = targetH;
    const ctx = testCanvas.getContext('2d');
    if (activeFormat !== 'image/png') {
      ctx.fillStyle = '#ffffff';
      ctx.fillRect(0, 0, targetW, targetH);
    }
    ctx.drawImage(origImg, 0, 0, targetW, targetH);

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

    const qPct = Math.round(bestQ * 100);
    document.getElementById('quality-range').value = qPct;
    handleQualitySlider(qPct);
  }

  function applyPresetExact(w, h, unit, name) {
    changeUnitMode('px');
    document.getElementById('unit-selector').value = 'px';
    document.getElementById('inp-w').value = w;
    document.getElementById('inp-h').value = h;
    renderPreciseOutput();
  }

  function getCalculatedPxW() {
    if (currentUnit === 'px') return Math.max(1, parseInt(document.getElementById('inp-w').value) || origW);
    return Math.max(1, Math.round(targetPhysicalToPx(document.getElementById('inp-w').value, 'w')));
  }

  function getCalculatedPxH() {
    if (currentUnit === 'px') return Math.max(1, parseInt(document.getElementById('inp-h').value) || origH);
    return Math.max(1, Math.round(targetPhysicalToPx(document.getElementById('inp-h').value, 'h')));
  }

  // ── High-Precision Multi-Step Lanczos Resampling ──
  function renderPreciseOutput() {
    if (!origImg) return;

    const targetW = getCalculatedPxW();
    const targetH = getCalculatedPxH();
    const quality = parseInt(document.getElementById('quality-range').value) / 100;

    // Step-down downsampling if scale factor is steep
    let src = origImg;
    let sw = origW, sh = origH;

    while (sw / 2 > targetW && sh / 2 > targetH) {
      sw = Math.floor(sw / 2);
      sh = Math.floor(sh / 2);
      const stepCanvas = document.createElement('canvas');
      stepCanvas.width = sw;
      stepCanvas.height = sh;
      const sCtx = stepCanvas.getContext('2d');
      sCtx.imageSmoothingEnabled = true;
      sCtx.imageSmoothingQuality = 'high';
      sCtx.drawImage(src, 0, 0, sw, sh);
      src = stepCanvas;
    }

    // Final Working Canvas
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
    ctx.drawImage(src, 0, 0, targetW, targetH);

    // Render to Preview Canvas
    const pc = document.getElementById('preview-canvas');
    pc.width = targetW;
    pc.height = targetH;
    const pCtx = pc.getContext('2d');
    pCtx.drawImage(wc, 0, 0);

    // Compute Exact Blob Size
    wc.toBlob((blob) => {
      if (!blob) return;
      currentBlob = blob;
      const bytes = blob.size;
      const kb = (bytes / 1024).toFixed(1);
      const sizeStr = (bytes > 1024 * 1024) ? (bytes / 1024 / 1024).toFixed(2) + ' MB' : kb + ' KB';

      // 🌟 Update Prominent Top Output Banner 🌟
      document.getElementById('prominent-new-size').innerText = sizeStr;
      document.getElementById('label-new-size').innerText = sizeStr;
      document.getElementById('stat-new-kb').innerText = sizeStr;
      document.getElementById('stat-new-dims').innerText = targetW + ' × ' + targetH + ' px';
      document.getElementById('stat-mp').innerText = ((targetW * targetH) / 1000000).toFixed(2) + ' MP';
      document.getElementById('stat-format-tag').innerText = activeFormat.split('/')[1].toUpperCase();

      // Reduction calculation
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
    }, activeFormat, quality);
  }

  // Download Trigger
  function downloadImage() {
    if (!currentBlob) return;
    const w = getCalculatedPxW();
    const h = getCalculatedPxH();
    const ext = (activeFormat === 'image/webp') ? 'webp' : (activeFormat === 'image/png' ? 'png' : 'jpg');
    const bytes = currentBlob.size;
    const kb = (bytes / 1024).toFixed(1);
    const sizeStr = (bytes > 1024 * 1024) ? (bytes / 1024 / 1024).toFixed(2) + ' MB' : kb + ' KB';

    const link = document.createElement('a');
    link.href = URL.createObjectURL(currentBlob);
    link.download = `yaswant_${w}x${h}_${sizeStr.replace(' ','')}.${ext}`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);

    // Show quick visual notification
    const btn = document.getElementById('btn-download');
    const originalText = btn.innerHTML;
    btn.innerHTML = `<span class="material-symbols-outlined text-[20px]">check_circle</span> Saved! (${sizeStr})`;
    btn.classList.add('!bg-emerald-600');
    setTimeout(() => {
      btn.innerHTML = originalText;
      btn.classList.remove('!bg-emerald-600');
    }, 2500);
  }

  function resetToUpload() {
    origImg = null;
    currentBlob = null;
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
