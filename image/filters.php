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
<title>Photo Filters & Adjustments Online — Free | Yaswant Image</title>
<meta name="description" content="Adjust brightness, contrast, saturation, grayscale, and blur filters on your photos online."/>
<link rel="canonical" href="https://image.yaswant.co.in/filters.php"/>
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
  #dropzone{border:2px dashed rgba(249,115,22,.4);border-radius:1.5rem;background:rgba(249,115,22,.03);display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:280px;cursor:pointer;position:relative}
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
    <span class="text-white font-bold text-sm">Yaswant <span class="text-orange-400">Photo Filters</span></span>
  </div>
</nav>

<main class="pt-20 flex-1 max-w-5xl w-full mx-auto px-4 pb-16">
  <div id="hero-area" class="text-center py-8">
    <h1 class="text-3xl sm:text-4xl font-black text-white mb-2">Photo <span class="text-orange-400">Filters & Adjust</span> Free</h1>
    <p class="text-zinc-400 text-sm">Enhance photos with Brightness, Contrast, Saturation, Sepia, and Grayscale filters.</p>
  </div>

  <div id="upload-area" class="max-w-xl mx-auto mb-8">
    <div id="dropzone">
      <input type="file" id="file-input" accept="image/*" onchange="handleFile(this.files[0])"/>
      <div class="text-center pointer-events-none p-6">
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-3 bg-orange-500/10 border border-orange-500/30 text-orange-400">
          <span class="material-symbols-outlined text-[32px]">tune</span>
        </div>
        <div class="text-white font-bold mb-1">Upload Photo to Apply Filters</div>
        <div class="text-zinc-500 text-xs">JPG, PNG, WebP</div>
      </div>
    </div>
  </div>

  <div id="workspace" class="hidden flex flex-col md:flex-row gap-6">
    <div class="flex-1 flex items-center justify-center bg-zinc-950 p-6 rounded-2xl border border-zinc-800 min-h-[400px]">
      <canvas id="filter-canvas" class="max-w-full max-h-[500px] border border-zinc-700 shadow-2xl rounded-lg"></canvas>
    </div>

    <div class="md:w-80 flex flex-col gap-4">
      <div class="ctrl-card space-y-3">
        <label class="text-xs font-mono text-zinc-400">Brightness (<span id="v-bright">100%</span>)</label>
        <input type="range" id="f-bright" min="0" max="200" value="100" oninput="applyFilters()" class="w-full"/>

        <label class="text-xs font-mono text-zinc-400">Contrast (<span id="v-contrast">100%</span>)</label>
        <input type="range" id="f-contrast" min="0" max="200" value="100" oninput="applyFilters()" class="w-full"/>

        <label class="text-xs font-mono text-zinc-400">Saturation (<span id="v-saturate">100%</span>)</label>
        <input type="range" id="f-saturate" min="0" max="200" value="100" oninput="applyFilters()" class="w-full"/>

        <label class="text-xs font-mono text-zinc-400">Grayscale (<span id="v-gray">0%</span>)</label>
        <input type="range" id="f-gray" min="0" max="100" value="0" oninput="applyFilters()" class="w-full"/>
      </div>

      <button onclick="downloadFiltered()" class="w-full bg-orange-500 hover:bg-orange-400 text-black py-3 rounded-xl font-bold text-sm transition-all shadow-lg flex items-center justify-center gap-2">
        <span class="material-symbols-outlined text-[18px]">download</span> Download Filtered Image
      </button>
      <button onclick="location.reload()" class="w-full text-center text-xs font-mono text-zinc-500 hover:text-zinc-300 py-1">↺ Upload Another</button>
    </div>
  </div>
</main>

<script>
  let img = null;

  function handleFile(file) {
    if (!file) return;
    const r = new FileReader();
    r.onload = (e) => {
      img = new Image();
      img.onload = () => {
        document.getElementById('hero-area').classList.add('hidden');
        document.getElementById('upload-area').classList.add('hidden');
        document.getElementById('workspace').classList.remove('hidden');
        applyFilters();
      };
      img.src = e.target.result;
    };
    r.readAsDataURL(file);
  }

  function applyFilters() {
    if (!img) return;
    const bright = document.getElementById('f-bright').value;
    const contrast = document.getElementById('f-contrast').value;
    const sat = document.getElementById('f-saturate').value;
    const gray = document.getElementById('f-gray').value;

    document.getElementById('v-bright').innerText = bright + '%';
    document.getElementById('v-contrast').innerText = contrast + '%';
    document.getElementById('v-saturate').innerText = sat + '%';
    document.getElementById('v-gray').innerText = gray + '%';

    const c = document.getElementById('filter-canvas');
    c.width = img.naturalWidth; c.height = img.naturalHeight;
    const ctx = c.getContext('2d');
    ctx.filter = `brightness(${bright}%) contrast(${contrast}%) saturate(${sat}%) grayscale(${gray}%)`;
    ctx.drawImage(img, 0, 0);
  }

  function downloadFiltered() {
    const c = document.getElementById('filter-canvas');
    const link = document.createElement('a');
    link.href = c.toDataURL('image/jpeg', 0.92);
    link.download = `yaswant_filtered.jpg`;
    link.click();
  }
</script>
</body>
</html>
