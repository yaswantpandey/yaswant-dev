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
<title>Rotate & Flip Image Online — Free Tool | Yaswant Image</title>
<meta name="description" content="Rotate images 90, 180, 270 degrees and flip horizontally or vertically online for free."/>
<link rel="canonical" href="https://image.yaswant.co.in/rotate.php"/>
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
  #dropzone{border:2px dashed rgba(244,63,94,.4);border-radius:1.5rem;background:rgba(244,63,94,.03);display:flex;flex-direction:column;align-items:center;justify-content:center;min-height:280px;cursor:pointer;position:relative}
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
    <span class="text-white font-bold text-sm">Yaswant <span class="text-rose-400">Rotate & Flip</span></span>
  </div>
</nav>

<main class="pt-20 flex-1 max-w-5xl w-full mx-auto px-4 pb-16">
  <div id="hero-area" class="text-center py-8">
    <h1 class="text-3xl sm:text-4xl font-black text-white mb-2">Rotate & Flip <span class="text-rose-400">Images</span> Free</h1>
    <p class="text-zinc-400 text-sm">Rotate 90°, 180°, 270° and mirror flip horizontally or vertically.</p>
  </div>

  <div id="upload-area" class="max-w-xl mx-auto mb-8">
    <div id="dropzone">
      <input type="file" id="file-input" accept="image/*" onchange="handleFile(this.files[0])"/>
      <div class="text-center pointer-events-none p-6">
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-3 bg-rose-500/10 border border-rose-500/30 text-rose-400">
          <span class="material-symbols-outlined text-[32px]">rotate_right</span>
        </div>
        <div class="text-white font-bold mb-1">Upload Photo to Rotate</div>
        <div class="text-zinc-500 text-xs">JPG, PNG, WebP</div>
      </div>
    </div>
  </div>

  <div id="workspace" class="hidden flex flex-col md:flex-row gap-6">
    <div class="flex-1 flex items-center justify-center bg-zinc-950 p-6 rounded-2xl border border-zinc-800 min-h-[400px]">
      <canvas id="rotate-canvas" class="max-w-full max-h-[500px] border border-zinc-700 shadow-2xl rounded-lg"></canvas>
    </div>

    <div class="md:w-80 flex flex-col gap-4">
      <div class="ctrl-card space-y-3">
        <span class="text-xs font-bold font-mono text-zinc-300">Orientation Controls</span>
        <div class="grid grid-cols-2 gap-2">
          <button onclick="rotate(90)" class="bg-zinc-800 hover:bg-zinc-700 p-2.5 rounded-lg text-xs font-mono flex items-center justify-center gap-1.5">
            <span class="material-symbols-outlined text-[16px]">rotate_90_degrees_cw</span> +90° CW
          </button>
          <button onclick="rotate(-90)" class="bg-zinc-800 hover:bg-zinc-700 p-2.5 rounded-lg text-xs font-mono flex items-center justify-center gap-1.5">
            <span class="material-symbols-outlined text-[16px]">rotate_90_degrees_ccw</span> -90° CCW
          </button>
          <button onclick="flip('h')" class="bg-zinc-800 hover:bg-zinc-700 p-2.5 rounded-lg text-xs font-mono flex items-center justify-center gap-1.5">
            <span class="material-symbols-outlined text-[16px]">swap_horiz</span> Flip Horiz
          </button>
          <button onclick="flip('v')" class="bg-zinc-800 hover:bg-zinc-700 p-2.5 rounded-lg text-xs font-mono flex items-center justify-center gap-1.5">
            <span class="material-symbols-outlined text-[16px]">swap_vert</span> Flip Vert
          </button>
        </div>
      </div>

      <button onclick="downloadRotated()" class="w-full bg-rose-500 hover:bg-rose-400 text-white py-3 rounded-xl font-bold text-sm transition-all shadow-lg flex items-center justify-center gap-2">
        <span class="material-symbols-outlined text-[18px]">download</span> Download Image
      </button>
      <button onclick="location.reload()" class="w-full text-center text-xs font-mono text-zinc-500 hover:text-zinc-300 py-1">↺ Upload Another</button>
    </div>
  </div>
</main>

<script>
  let img = null, angle = 0, flipH = 1, flipV = 1;

  function handleFile(file) {
    if (!file) return;
    const r = new FileReader();
    r.onload = (e) => {
      img = new Image();
      img.onload = () => {
        document.getElementById('hero-area').classList.add('hidden');
        document.getElementById('upload-area').classList.add('hidden');
        document.getElementById('workspace').classList.remove('hidden');
        drawCanvas();
      };
      img.src = e.target.result;
    };
    r.readAsDataURL(file);
  }

  function rotate(deg) { angle = (angle + deg) % 360; drawCanvas(); }
  function flip(dir) { if (dir === 'h') flipH *= -1; else flipV *= -1; drawCanvas(); }

  function drawCanvas() {
    if (!img) return;
    const c = document.getElementById('rotate-canvas');
    const rad = (angle * Math.PI) / 180;
    const isSideways = Math.abs(angle) === 90 || Math.abs(angle) === 270;

    c.width = isSideways ? img.naturalHeight : img.naturalWidth;
    c.height = isSideways ? img.naturalWidth : img.naturalHeight;

    const ctx = c.getContext('2d');
    ctx.clearRect(0, 0, c.width, c.height);
    ctx.save();
    ctx.translate(c.width / 2, c.height / 2);
    ctx.rotate(rad);
    ctx.scale(flipH, flipV);
    ctx.drawImage(img, -img.naturalWidth / 2, -img.naturalHeight / 2);
    ctx.restore();
  }

  function downloadRotated() {
    const c = document.getElementById('rotate-canvas');
    const link = document.createElement('a');
    link.href = c.toDataURL('image/jpeg', 0.92);
    link.download = `yaswant_rotated.jpg`;
    link.click();
  }
</script>
</body>
</html>
