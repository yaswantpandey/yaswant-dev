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
<title>Photo Collage Maker Online — Combine Photos Free | Yaswant Image</title>
<meta name="description" content="Create stunning photo collages online for free. Combine 2 to 9 photos into beautiful grids with custom borders, rounded corners, and spacing."/>
<meta name="keywords" content="photo collage maker online, combine photos into grid, image collage creator free, picture collage online"/>
<link rel="canonical" href="https://image.yaswant.co.in/collage.php"/>
<link rel="icon" type="image/svg+xml" href="https://yaswant.co.in/favicon.svg"/>
<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap"/>
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
          brand: '#8b5cf6',
          'brand-light': '#c4b5fd',
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

  /* Controls & Cards */
  .ctrl-card{background:#121215;border:1px solid rgba(255,255,255,.08);border-radius:1rem;padding:1.25rem;box-shadow:0 8px 24px rgba(0,0,0,.4)}
  .ctrl-label{font-size:.68rem;font-weight:600;text-transform:uppercase;letter-spacing:.06em;color:#71717a;margin-bottom:.35rem;display:block}

  .layout-card{
    background:#18181c;border:2px solid transparent;border-radius:.65rem;
    padding:.5rem;cursor:pointer;transition:all .2s;text-align:center;
  }
  .layout-card:hover{border-color:#8b5cf6;background:#201f27}
  .layout-card.active{border-color:#a78bfa;background:#2e1065;box-shadow:0 0 14px rgba(139,92,246,.3)}

  .preset-pill{
    padding:.35rem .65rem;border-radius:.5rem;font-size:.7rem;font-weight:500;cursor:pointer;
    background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);color:#a1a1aa;
    transition:all .15s;white-space:nowrap;
  }
  .preset-pill:hover{background:rgba(139,92,246,.18);border-color:rgba(139,92,246,.45);color:#c4b5fd}
  .preset-pill.active{background:rgba(139,92,246,.25);border-color:#a78bfa;color:#fff}

  /* Shimmer */
  @keyframes shimmer{0%{background-position:0% 50%}50%{background-position:100% 50%}100%{background-position:0% 50%}}
  .grad-text{background:linear-gradient(135deg,#c4b5fd,#8b5cf6,#ec4899,#c4b5fd);background-size:300% 300%;-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;animation:shimmer 5s ease infinite}
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
      <div class="w-7 h-7 rounded-lg flex items-center justify-center bg-gradient-to-tr from-violet-500 to-pink-500 shadow-md text-white font-bold">
        <span class="material-symbols-outlined text-[16px]">grid_view</span>
      </div>
      <span>Yaswant <span class="text-purple-400">Photo Collage</span></span>
    </a>
  </div>

  <div class="flex items-center gap-3">
    <a href="resize.php" class="text-zinc-400 hover:text-white text-xs font-mono hidden md:inline">Resize Tool</a>
    <a href="compress.php" class="text-zinc-400 hover:text-white text-xs font-mono hidden md:inline">Compress Tool</a>
    <button id="btn-download" onclick="downloadCollage()" class="bg-purple-600 hover:bg-purple-500 text-white text-xs font-bold px-4 py-2 rounded-xl transition-all flex items-center gap-1.5 shadow-md">
      <span class="material-symbols-outlined text-[16px]">download</span> Download Collage
    </button>
  </div>
</nav>

<main class="pt-20 flex-1 max-w-7xl w-full mx-auto px-4 md:px-6 pb-16">

  <!-- Header Banner -->
  <div class="text-center py-6 max-w-2xl mx-auto">
    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-purple-500/10 border border-purple-500/20 text-purple-300 text-xs font-mono uppercase tracking-widest mb-3">
      <span class="material-symbols-outlined text-[14px]">auto_awesome</span> Creative Grid Studio
    </div>
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-white tracking-tight mb-2">
      Photo <span class="grad-text">Collage Maker</span> Free
    </h1>
    <p class="text-zinc-400 text-xs sm:text-sm font-light">
      Combine 2 to 6 photos into modern layouts. Customize border spacing, rounded corners, aspect ratios, and background colors.
    </p>
  </div>

  <!-- Workspace Grid -->
  <div class="flex flex-col lg:flex-row gap-6">

    <!-- ── Left: Interactive Collage Canvas Preview ── -->
    <div class="flex-1 flex flex-col gap-4">
      
      <!-- Canvas Box -->
      <div class="bg-zinc-950 p-4 rounded-2xl border border-zinc-800 flex items-center justify-center min-h-[480px] shadow-2xl relative">
        <canvas id="collage-canvas" class="max-w-full max-h-[520px] rounded-xl shadow-2xl border border-zinc-800"></canvas>
      </div>

      <!-- Upload Photos Selector Strip -->
      <div class="bg-zinc-900/60 p-3 rounded-xl border border-zinc-800 flex items-center justify-between flex-wrap gap-2 text-xs font-mono">
        <label class="cursor-pointer bg-purple-600 hover:bg-purple-500 text-white font-bold px-3 py-1.5 rounded-lg flex items-center gap-1.5 transition-all shadow">
          <input type="file" id="multi-file-input" accept="image/*" multiple onchange="handleUploadedPhotos(this.files)" class="hidden"/>
          <span class="material-symbols-outlined text-[16px]">add_photo_alternate</span> Add / Replace Photos
        </label>
        <span id="photo-count-badge" class="text-zinc-400">4 Photos Loaded</span>
      </div>

    </div>

    <!-- ── Right: Layout & Customizer Sidebar ── -->
    <div class="lg:w-96 flex flex-col gap-4">

      <!-- Grid Layout Presets -->
      <div class="ctrl-card space-y-3">
        <label class="ctrl-label text-white font-bold flex items-center gap-1.5 border-b border-zinc-800 pb-2">
          <span class="material-symbols-outlined text-purple-400 text-[16px]">grid_on</span> Choose Collage Layout
        </label>

        <div class="grid grid-cols-3 gap-2">
          <div class="layout-card active" onclick="setLayout('2x2', this)">
            <span class="material-symbols-outlined text-[24px] text-purple-300">grid_view</span>
            <span class="text-[10px] font-mono text-zinc-400 block mt-0.5">2×2 Grid (4)</span>
          </div>
          <div class="layout-card" onclick="setLayout('2-side', this)">
            <span class="material-symbols-outlined text-[24px] text-purple-300">view_column</span>
            <span class="text-[10px] font-mono text-zinc-400 block mt-0.5">Side by Side (2)</span>
          </div>
          <div class="layout-card" onclick="setLayout('2-vert', this)">
            <span class="material-symbols-outlined text-[24px] text-purple-300">table_rows</span>
            <span class="text-[10px] font-mono text-zinc-400 block mt-0.5">Top-Bottom (2)</span>
          </div>
          <div class="layout-card" onclick="setLayout('3-col', this)">
            <span class="material-symbols-outlined text-[24px] text-purple-300">view_week</span>
            <span class="text-[10px] font-mono text-zinc-400 block mt-0.5">3 Columns (3)</span>
          </div>
          <div class="layout-card" onclick="setLayout('1top-2bot', this)">
            <span class="material-symbols-outlined text-[24px] text-purple-300">view_quilt</span>
            <span class="text-[10px] font-mono text-zinc-400 block mt-0.5">1 Top + 2 Bot (3)</span>
          </div>
          <div class="layout-card" onclick="setLayout('3x2', this)">
            <span class="material-symbols-outlined text-[24px] text-purple-300">view_module</span>
            <span class="text-[10px] font-mono text-zinc-400 block mt-0.5">3×2 Grid (6)</span>
          </div>
        </div>
      </div>

      <!-- Aspect Ratio & Dimensions -->
      <div class="ctrl-card space-y-3">
        <label class="ctrl-label text-white font-bold">Aspect Ratio & Canvas Shape</label>
        <div class="grid grid-cols-4 gap-1.5">
          <button class="preset-pill active text-center" onclick="setAspectRatio('1:1', this)">1:1 Square</button>
          <button class="preset-pill text-center" onclick="setAspectRatio('4:5', this)">4:5 Insta</button>
          <button class="preset-pill text-center" onclick="setAspectRatio('16:9', this)">16:9 Wide</button>
          <button class="preset-pill text-center" onclick="setAspectRatio('9:16', this)">9:16 Story</button>
        </div>
      </div>

      <!-- Spacing, Borders & Colors -->
      <div class="ctrl-card space-y-3">
        <label class="ctrl-label text-white font-bold">Spacing & Borders</label>

        <!-- Gap Spacing -->
        <div>
          <div class="flex justify-between items-center mb-1">
            <span class="ctrl-label !mb-0">Inner Gap Spacing (<span id="val-gap">12px</span>)</span>
          </div>
          <input type="range" id="range-gap" min="0" max="30" value="12" oninput="document.getElementById('val-gap').innerText=this.value+'px';renderCollage()" class="w-full"/>
        </div>

        <!-- Corner Rounding -->
        <div>
          <div class="flex justify-between items-center mb-1">
            <span class="ctrl-label !mb-0">Rounded Corners (<span id="val-radius">16px</span>)</span>
          </div>
          <input type="range" id="range-radius" min="0" max="40" value="16" oninput="document.getElementById('val-radius').innerText=this.value+'px';renderCollage()" class="w-full"/>
        </div>

        <!-- Background Color -->
        <div class="flex items-center justify-between pt-2 border-t border-zinc-800">
          <span class="text-xs font-mono text-zinc-400">Background Color:</span>
          <div class="flex items-center gap-2">
            <input type="color" id="bg-color" value="#121215" onchange="renderCollage()" class="w-8 h-8 rounded bg-zinc-800 border border-zinc-700 cursor-pointer p-0.5"/>
            <button onclick="document.getElementById('bg-color').value='#ffffff';renderCollage()" class="preset-pill text-[10px]">White</button>
            <button onclick="document.getElementById('bg-color').value='#000000';renderCollage()" class="preset-pill text-[10px]">Black</button>
          </div>
        </div>
      </div>

      <!-- Download Button -->
      <button onclick="downloadCollage()" class="w-full bg-purple-600 hover:bg-purple-500 text-white py-3 rounded-xl font-bold text-sm transition-all shadow-lg flex items-center justify-center gap-2">
        <span class="material-symbols-outlined text-[20px]">download</span>
        Download Collage (PNG)
      </button>

    </div>

  </div>

</main>

<!-- Footer -->
<footer class="py-6 border-t border-white/[0.08] text-center text-xs text-zinc-500 font-mono">
  <span>© 2026 Yaswant Collage Studio · Create Modern Multi-Photo Grids</span>
</footer>

<script>
  /* ──────────────────────────────────────────────────────────
     PHOTO COLLAGE MAKER ENGINE (JAVASCRIPT)
     ────────────────────────────────────────────────────────── */
  let loadedImages = [];
  let currentLayout = '2x2';
  let currentAspect = '1:1';

  // Sample default starter images
  const sampleUrls = [
    'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=600',
    'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600',
    'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?w=600',
    'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=600'
  ];

  function loadInitialSamples() {
    let loaded = 0;
    sampleUrls.forEach((url, i) => {
      const img = new Image();
      img.crossOrigin = 'anonymous';
      img.onload = () => {
        loadedImages[i] = img;
        loaded++;
        if (loaded === sampleUrls.length) renderCollage();
      };
      img.src = url;
    });
  }
  loadInitialSamples();

  function handleUploadedPhotos(files) {
    if (!files || !files.length) return;
    loadedImages = [];
    let loaded = 0;
    const fileArr = Array.from(files).slice(0, 6);

    fileArr.forEach((file, i) => {
      const reader = new FileReader();
      reader.onload = (e) => {
        const img = new Image();
        img.onload = () => {
          loadedImages[i] = img;
          loaded++;
          if (loaded === fileArr.length) {
            document.getElementById('photo-count-badge').innerText = `${loadedImages.length} Photos Loaded`;
            renderCollage();
          }
        };
        img.src = e.target.result;
      };
      reader.readAsDataURL(file);
    });
  }

  function setLayout(layout, el) {
    currentLayout = layout;
    document.querySelectorAll('.layout-card').forEach(c => c.classList.remove('active'));
    if (el) el.classList.add('active');
    renderCollage();
  }

  function setAspectRatio(aspect, el) {
    currentAspect = aspect;
    document.querySelectorAll('.preset-pill').forEach(c => c.classList.remove('active'));
    if (el) el.classList.add('active');
    renderCollage();
  }

  function getCanvasDimensions() {
    const base = 1200;
    if (currentAspect === '1:1') return { w: base, h: base };
    if (currentAspect === '4:5') return { w: base, h: Math.round(base * 5 / 4) };
    if (currentAspect === '16:9') return { w: base, h: Math.round(base * 9 / 16) };
    if (currentAspect === '9:16') return { w: Math.round(base * 9 / 16), h: base };
    return { w: base, h: base };
  }

  function renderCollage() {
    if (!loadedImages.length) return;

    const c = document.getElementById('collage-canvas');
    const { w, h } = getCanvasDimensions();
    c.width = w;
    c.height = h;

    const ctx = c.getContext('2d');
    const bgColor = document.getElementById('bg-color').value;
    const gap = parseInt(document.getElementById('range-gap').value) * 2; // scale for high-res canvas
    const radius = parseInt(document.getElementById('range-radius').value) * 2;

    // Canvas Background
    ctx.fillStyle = bgColor;
    ctx.fillRect(0, 0, w, h);

    // Compute Slots based on selected layout
    const slots = computeSlots(currentLayout, w, h, gap);

    slots.forEach((slot, i) => {
      const img = loadedImages[i % loadedImages.length];
      if (!img) return;

      ctx.save();
      // Rounded clipping path
      roundRect(ctx, slot.x, slot.y, slot.w, slot.h, radius);
      ctx.clip();

      // Cover crop draw image in slot
      drawImageCover(ctx, img, slot.x, slot.y, slot.w, slot.h);
      ctx.restore();
    });
  }

  function computeSlots(layout, W, H, G) {
    const slots = [];
    const p = G; // padding

    if (layout === '2x2') {
      const sw = (W - p * 3) / 2;
      const sh = (H - p * 3) / 2;
      slots.push({ x: p, y: p, w: sw, h: sh });
      slots.push({ x: p * 2 + sw, y: p, w: sw, h: sh });
      slots.push({ x: p, y: p * 2 + sh, w: sw, h: sh });
      slots.push({ x: p * 2 + sw, y: p * 2 + sh, w: sw, h: sh });
    } else if (layout === '2-side') {
      const sw = (W - p * 3) / 2;
      const sh = H - p * 2;
      slots.push({ x: p, y: p, w: sw, h: sh });
      slots.push({ x: p * 2 + sw, y: p, w: sw, h: sh });
    } else if (layout === '2-vert') {
      const sw = W - p * 2;
      const sh = (H - p * 3) / 2;
      slots.push({ x: p, y: p, w: sw, h: sh });
      slots.push({ x: p, y: p * 2 + sh, w: sw, h: sh });
    } else if (layout === '3-col') {
      const sw = (W - p * 4) / 3;
      const sh = H - p * 2;
      slots.push({ x: p, y: p, w: sw, h: sh });
      slots.push({ x: p * 2 + sw, y: p, w: sw, h: sh });
      slots.push({ x: p * 3 + sw * 2, y: p, w: sw, h: sh });
    } else if (layout === '1top-2bot') {
      const topW = W - p * 2;
      const topH = (H - p * 3) / 2;
      const botW = (W - p * 3) / 2;
      const botH = topH;
      slots.push({ x: p, y: p, w: topW, h: topH });
      slots.push({ x: p, y: p * 2 + topH, w: botW, h: botH });
      slots.push({ x: p * 2 + botW, y: p * 2 + topH, w: botW, h: botH });
    } else if (layout === '3x2') {
      const sw = (W - p * 4) / 3;
      const sh = (H - p * 3) / 2;
      for (let r = 0; r < 2; r++) {
        for (let col = 0; col < 3; col++) {
          slots.push({
            x: p + col * (sw + p),
            y: p + r * (sh + p),
            w: sw,
            h: sh
          });
        }
      }
    }
    return slots;
  }

  function drawImageCover(ctx, img, dx, dy, dw, dh) {
    const imgRatio = img.naturalWidth / img.naturalHeight;
    const slotRatio = dw / dh;
    let sx = 0, sy = 0, sw = img.naturalWidth, sh = img.naturalHeight;

    if (imgRatio > slotRatio) {
      sw = img.naturalHeight * slotRatio;
      sx = (img.naturalWidth - sw) / 2;
    } else {
      sh = img.naturalWidth / slotRatio;
      sy = (img.naturalHeight - sh) / 2;
    }
    ctx.drawImage(img, sx, sy, sw, sh, dx, dy, dw, dh);
  }

  function roundRect(ctx, x, y, width, height, radius) {
    ctx.beginPath();
    ctx.moveTo(x + radius, y);
    ctx.lineTo(x + width - radius, y);
    ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
    ctx.lineTo(x + width, y + height - radius);
    ctx.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
    ctx.lineTo(x + radius, y + height);
    ctx.quadraticCurveTo(x, y + height, x, y + height - radius);
    ctx.lineTo(x, y + radius);
    ctx.quadraticCurveTo(x, y, x + radius, y);
    ctx.closePath();
  }

  function downloadCollage() {
    const c = document.getElementById('collage-canvas');
    const link = document.createElement('a');
    link.href = c.toDataURL('image/png');
    link.download = `yaswant_collage_${currentAspect.replace(':','x')}.png`;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);

    const btn = document.getElementById('btn-download');
    const orig = btn.innerHTML;
    btn.innerHTML = '<span class="material-symbols-outlined text-[18px]">check_circle</span> Downloaded!';
    setTimeout(() => btn.innerHTML = orig, 2000);
  }
</script>
</body>
</html>
