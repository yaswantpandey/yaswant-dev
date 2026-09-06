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
<title>Free Online Image Editing Suite — Resize, Compress, Remove BG | Yaswant Image</title>
<meta name="description" content="100% free browser-side image tools by Yaswant Pandey: Precision Photo Resizer, Smart Image Compressor to 50KB/100KB, Background Remover, Meme Generator, and Photo Collage Maker."/>
<meta name="keywords" content="photo resizer online, resize image in kb, resize image to 50kb 100kb, compress image online without losing quality, free background remover online, transparent png maker, meme generator online, photo collage maker online, crop image online, convert jpg to webp, image tools by Yaswant Pandey"/>
<meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
<meta property="og:title" content="Free Online Image Editing Suite — Yaswant Image"/>
<meta property="og:description" content="Free, fast, browser-based image editing tools — resize, compress, remove BG, meme & collage maker."/>
<link rel="canonical" href="https://image.yaswant.co.in"/>
<link rel="icon" type="image/svg+xml" href="https://yaswant.co.in/favicon.svg"/>
<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin/>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@400,0&display=swap"/>
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: { extend: {
      fontFamily: { sans: ['Inter','sans-serif'] },
      colors: {
        brand: '#7c3aed',
        'brand-light': '#8b5cf6',
        'brand-dark': '#6d28d9'
      }
    }}
  }
</script>
<style>
  *,:before,:after{box-sizing:border-box}
  body{margin:0;font-family:'Inter',sans-serif;background:#09090b;color:#fff;-webkit-font-smoothing:antialiased}
  ::-webkit-scrollbar{width:5px;height:5px}
  ::-webkit-scrollbar-track{background:#18181b}
  ::-webkit-scrollbar-thumb{background:#3f3f46;border-radius:9999px}

  /* Grid dot background */
  .dot-grid{background-image:radial-gradient(rgba(255,255,255,.08) 1px,transparent 1px);background-size:28px 28px}

  /* Tool card */
  .tool-card{
    background:rgba(255,255,255,.04);
    border:1px solid rgba(255,255,255,.08);
    border-radius:1.25rem;
    padding:2rem;
    text-align:center;
    cursor:pointer;
    transition:transform .2s,border-color .2s,box-shadow .2s,background .2s;
    text-decoration:none;
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:1rem;
  }
  .tool-card:hover{
    transform:translateY(-4px);
    border-color:rgba(124,58,237,.45);
    box-shadow:0 16px 48px rgba(124,58,237,.18);
    background:rgba(124,58,237,.07);
  }
  .tool-icon{
    width:64px;height:64px;border-radius:1rem;
    display:flex;align-items:center;justify-content:center;
    font-size:32px;margin:0 auto;
    border:1px solid rgba(255,255,255,.12);
  }
  /* Shimmer gradient heading */
  @keyframes shimmer{0%{background-position:0% 50%}50%{background-position:100% 50%}100%{background-position:0% 50%}}
  .gradient-text{
    background:linear-gradient(135deg,#7c3aed,#06b6d4,#10b981,#7c3aed);
    background-size:300% 300%;
    -webkit-background-clip:text;-webkit-text-fill-color:transparent;
    background-clip:text;
    animation:shimmer 5s ease infinite;
  }
  /* Pulse ring */
  @keyframes pulse-ring{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.5;transform:scale(1.4)}}
  .dot-live{animation:pulse-ring 2s ease infinite}

  /* Upload drop zone */
  .dropzone{
    border:2px dashed rgba(124,58,237,.35);
    border-radius:1.25rem;
    background:rgba(124,58,237,.04);
    transition:border-color .2s,background .2s;
    cursor:pointer;
  }
  .dropzone:hover,.dropzone.drag-over{
    border-color:#7c3aed;
    background:rgba(124,58,237,.09);
  }

  /* Feature badge */
  .feat-badge{
    display:inline-flex;align-items:center;gap:.375rem;
    background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);
    border-radius:9999px;padding:.3rem .875rem;font-size:.7rem;color:#a1a1aa;
    font-weight:500;letter-spacing:.04em;
  }

  /* How it works step */
  .step-num{
    width:2.5rem;height:2.5rem;border-radius:9999px;
    background:linear-gradient(135deg,#7c3aed,#06b6d4);
    display:flex;align-items:center;justify-content:center;
    font-weight:800;font-size:.875rem;color:#fff;
    flex-shrink:0;
  }

  /* Mobile responsive */
  @media(max-width:640px){
    .tool-card{padding:1.25rem}
    .tool-icon{width:52px;height:52px}
  }
</style>
</head>
<body class="dot-grid min-h-screen">

<!-- Top Navigation -->
<nav class="fixed top-0 left-0 right-0 h-14 z-50 flex items-center justify-between px-4 md:px-8" style="background:rgba(9,9,11,.85);backdrop-filter:blur(16px);border-bottom:1px solid rgba(255,255,255,.07)">
  <a href="https://image.yaswant.co.in" class="flex items-center gap-2.5 text-white font-bold text-base">
    <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:linear-gradient(135deg,#7c3aed,#06b6d4)">
      <span class="material-symbols-outlined text-[18px] text-white">image</span>
    </div>
    <span>Yaswant <span class="text-purple-400">Image</span></span>
  </a>
  <div class="flex items-center gap-3">
    <a href="https://yaswant.co.in" class="text-zinc-400 hover:text-white text-xs font-medium transition-colors hidden sm:block">Back to Main</a>
    <a href="resize.php" class="bg-purple-600 hover:bg-purple-500 text-white text-xs font-bold px-4 py-2 rounded-xl transition-all">
      Resize Image
    </a>
  </div>
</nav>

<!-- ── Hero ──────────────────────────────────────────── -->
<section class="pt-28 pb-20 px-4 md:px-8 text-center relative overflow-hidden">
  <!-- Orbs -->
  <div class="absolute inset-0 pointer-events-none overflow-hidden">
    <div class="absolute top-0 left-1/4 w-96 h-96 rounded-full blur-[120px]" style="background:radial-gradient(circle,rgba(124,58,237,.22) 0%,transparent 70%)"></div>
    <div class="absolute top-1/3 right-0 w-80 h-80 rounded-full blur-[100px]" style="background:radial-gradient(circle,rgba(6,182,212,.15) 0%,transparent 70%)"></div>
  </div>

  <div class="relative z-10 max-w-4xl mx-auto">
    <div class="feat-badge mx-auto mb-6">
      <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 dot-live" aria-hidden="true"></span>
      Free · No Signup · Works in Browser
    </div>

    <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-black leading-[1.04] tracking-tighter text-white mb-5">
      Edit Your Images<br/>
      <span class="gradient-text">Fast & Free</span>
    </h1>

    <p class="text-base md:text-xl text-zinc-400 font-light max-w-xl mx-auto mb-10 leading-relaxed">
      Resize, compress, convert, crop, and rotate images instantly in your browser. No uploads to servers — 100% private.
    </p>

    <a href="resize.php" class="inline-flex items-center gap-2 text-white font-bold px-8 py-4 rounded-2xl text-sm shadow-2xl transition-all transform hover:-translate-y-1 hover:shadow-purple-500/25" style="background:linear-gradient(135deg,#7c3aed,#6d28d9);box-shadow:0 0 40px rgba(124,58,237,.3)">
      <span class="material-symbols-outlined text-[20px]">photo_size_select_large</span>
      Start Resizing Images
    </a>
  </div>
</section>

<!-- ── Tool Grid ──────────────────────────────────────── -->
<section class="py-16 px-4 md:px-8 max-w-6xl mx-auto">
  <div class="text-center mb-12">
    <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">All Image Tools</h2>
    <p class="text-zinc-500 text-sm">Choose a tool below — no installation, no account required.</p>
  </div>

  <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">

    <!-- Resize Images -->
    <a href="resize.php" class="tool-card" id="tool-resize">
      <div class="tool-icon" style="background:linear-gradient(135deg,rgba(124,58,237,.2),rgba(99,102,241,.1))">
        <span class="material-symbols-outlined text-purple-400 text-[28px]">photo_size_select_large</span>
      </div>
      <div>
        <div class="text-white font-semibold text-sm mb-1">Resize Image</div>
        <div class="text-zinc-500 text-xs leading-relaxed">Change width & height by px or %</div>
      </div>
      <span class="text-[10px] font-bold px-2 py-0.5 rounded-full" style="background:rgba(124,58,237,.15);color:#a78bfa;">Free</span>
    </a>

    <!-- Compress -->
    <a href="compress.php" class="tool-card" id="tool-compress">
      <div class="tool-icon" style="background:linear-gradient(135deg,rgba(16,185,129,.2),rgba(6,182,212,.1))">
        <span class="material-symbols-outlined text-emerald-400 text-[28px]">compress</span>
      </div>
      <div>
        <div class="text-white font-semibold text-sm mb-1">Compress Image</div>
        <div class="text-zinc-500 text-xs leading-relaxed">Reduce file size without quality loss</div>
      </div>
      <span class="text-[10px] font-bold px-2 py-0.5 rounded-full" style="background:rgba(16,185,129,.15);color:#34d399;">Free</span>
    </a>

    <!-- Crop -->
    <a href="crop.php" class="tool-card" id="tool-crop">
      <div class="tool-icon" style="background:linear-gradient(135deg,rgba(6,182,212,.2),rgba(99,102,241,.1))">
        <span class="material-symbols-outlined text-cyan-400 text-[28px]">crop</span>
      </div>
      <div>
        <div class="text-white font-semibold text-sm mb-1">Crop Image</div>
        <div class="text-zinc-500 text-xs leading-relaxed">Trim borders & select regions</div>
      </div>
      <span class="text-[10px] font-bold px-2 py-0.5 rounded-full" style="background:rgba(6,182,212,.15);color:#22d3ee;">Free</span>
    </a>

    <!-- Convert -->
    <a href="convert.php" class="tool-card" id="tool-convert">
      <div class="tool-icon" style="background:linear-gradient(135deg,rgba(245,158,11,.2),rgba(239,68,68,.1))">
        <span class="material-symbols-outlined text-amber-400 text-[28px]">transform</span>
      </div>
      <div>
        <div class="text-white font-semibold text-sm mb-1">Convert Image</div>
        <div class="text-zinc-500 text-xs leading-relaxed">JPG ↔ PNG ↔ WebP ↔ BMP</div>
      </div>
      <span class="text-[10px] font-bold px-2 py-0.5 rounded-full" style="background:rgba(245,158,11,.15);color:#fbbf24;">Free</span>
    </a>

    <!-- Rotate -->
    <a href="rotate.php" class="tool-card" id="tool-rotate">
      <div class="tool-icon" style="background:linear-gradient(135deg,rgba(239,68,68,.2),rgba(245,158,11,.1))">
        <span class="material-symbols-outlined text-rose-400 text-[28px]">rotate_right</span>
      </div>
      <div>
        <div class="text-white font-semibold text-sm mb-1">Rotate Image</div>
        <div class="text-zinc-500 text-xs leading-relaxed">Rotate 90°, 180°, flip horizontal</div>
      </div>
      <span class="text-[10px] font-bold px-2 py-0.5 rounded-full" style="background:rgba(239,68,68,.15);color:#fb7185;">Free</span>
    </a>

    <!-- Watermark -->
    <a href="watermark.php" class="tool-card" id="tool-watermark">
      <div class="tool-icon" style="background:linear-gradient(135deg,rgba(99,102,241,.2),rgba(124,58,237,.1))">
        <span class="material-symbols-outlined text-indigo-400 text-[28px]">copyright</span>
      </div>
      <div>
        <div class="text-white font-semibold text-sm mb-1">Add Watermark</div>
        <div class="text-zinc-500 text-xs leading-relaxed">Text or image watermark overlay</div>
      </div>
      <span class="text-[10px] font-bold px-2 py-0.5 rounded-full" style="background:rgba(99,102,241,.15);color:#a5b4fc;">Free</span>
    </a>

    <!-- Brightness/Filters -->
    <a href="filters.php" class="tool-card" id="tool-filters">
      <div class="tool-icon" style="background:linear-gradient(135deg,rgba(251,146,60,.2),rgba(239,68,68,.1))">
        <span class="material-symbols-outlined text-orange-400 text-[28px]">tune</span>
      </div>
      <div>
        <div class="text-white font-semibold text-sm mb-1">Filters & Adjust</div>
        <div class="text-zinc-500 text-xs leading-relaxed">Brightness, contrast, saturation</div>
      </div>
      <span class="text-[10px] font-bold px-2 py-0.5 rounded-full" style="background:rgba(251,146,60,.15);color:#fb923c;">Free</span>
    </a>

    <!-- Remove BG -->
    <a href="remove-bg.php" class="tool-card" id="tool-remove-bg">
      <div class="tool-icon" style="background:linear-gradient(135deg,rgba(16,185,129,.2),rgba(6,182,212,.1))">
        <span class="material-symbols-outlined text-teal-400 text-[28px]">auto_fix_high</span>
      </div>
      <div>
        <div class="text-white font-semibold text-sm mb-1">Remove Background</div>
        <div class="text-zinc-500 text-xs leading-relaxed">Transparent PNG in 1 click</div>
      </div>
      <span class="text-[10px] font-bold px-2 py-0.5 rounded-full" style="background:rgba(16,185,129,.15);color:#34d399;">Free</span>
    </a>

    <!-- Meme Maker -->
    <a href="meme.php" class="tool-card" id="tool-meme">
      <div class="tool-icon" style="background:linear-gradient(135deg,rgba(245,158,11,.2),rgba(251,146,60,.1))">
        <span class="material-symbols-outlined text-yellow-400 text-[28px]">sentiment_very_satisfied</span>
      </div>
      <div>
        <div class="text-white font-semibold text-sm mb-1">Meme Generator</div>
        <div class="text-zinc-500 text-xs leading-relaxed">Add captions & stickers to images</div>
      </div>
      <span class="text-[10px] font-bold px-2 py-0.5 rounded-full" style="background:rgba(245,158,11,.15);color:#fbbf24;">Free</span>
    </a>

    <!-- Photo Collage -->
    <a href="collage.php" class="tool-card" id="tool-collage">
      <div class="tool-icon" style="background:linear-gradient(135deg,rgba(124,58,237,.2),rgba(239,68,68,.1))">
        <span class="material-symbols-outlined text-violet-400 text-[28px]">grid_view</span>
      </div>
      <div>
        <div class="text-white font-semibold text-sm mb-1">Photo Collage</div>
        <div class="text-zinc-500 text-xs leading-relaxed">Combine multiple images in a grid</div>
      </div>
      <span class="text-[10px] font-bold px-2 py-0.5 rounded-full" style="background:rgba(124,58,237,.15);color:#c4b5fd;">Free</span>
    </a>

  </div>
</section>

<!-- ── How It Works ───────────────────────────────── -->
<section class="py-16 px-4 md:px-8" style="background:rgba(255,255,255,.02);border-top:1px solid rgba(255,255,255,.06);border-bottom:1px solid rgba(255,255,255,.06)">
  <div class="max-w-4xl mx-auto text-center mb-12">
    <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">How It Works</h2>
    <p class="text-zinc-500 text-sm">3 simple steps. No account. No server upload.</p>
  </div>
  <div class="max-w-3xl mx-auto grid grid-cols-1 sm:grid-cols-3 gap-8">
    <div class="flex flex-col items-center text-center gap-3">
      <div class="step-num">1</div>
      <div class="text-white font-semibold text-sm">Upload Your Image</div>
      <div class="text-zinc-500 text-xs leading-relaxed">Drag & drop or click to browse. Supports JPG, PNG, WebP, GIF, BMP.</div>
    </div>
    <div class="flex flex-col items-center text-center gap-3">
      <div class="step-num">2</div>
      <div class="text-white font-semibold text-sm">Set Options</div>
      <div class="text-zinc-500 text-xs leading-relaxed">Choose dimensions, quality, format or filters. All processing is client-side.</div>
    </div>
    <div class="flex flex-col items-center text-center gap-3">
      <div class="step-num">3</div>
      <div class="text-white font-semibold text-sm">Download Result</div>
      <div class="text-zinc-500 text-xs leading-relaxed">1-click download in your preferred format. No watermarks, no limits.</div>
    </div>
  </div>
</section>

<!-- ── Features Strip ─────────────────────────────── -->
<section class="py-14 px-4 md:px-8 max-w-5xl mx-auto">
  <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
    <div class="flex flex-col items-center gap-2">
      <div class="w-12 h-12 rounded-2xl flex items-center justify-center" style="background:rgba(124,58,237,.12);border:1px solid rgba(124,58,237,.2)">
        <span class="material-symbols-outlined text-purple-400 text-[22px]">lock</span>
      </div>
      <div class="text-white font-semibold text-sm">100% Private</div>
      <div class="text-zinc-500 text-xs">Images never leave your device</div>
    </div>
    <div class="flex flex-col items-center gap-2">
      <div class="w-12 h-12 rounded-2xl flex items-center justify-center" style="background:rgba(16,185,129,.12);border:1px solid rgba(16,185,129,.2)">
        <span class="material-symbols-outlined text-emerald-400 text-[22px]">bolt</span>
      </div>
      <div class="text-white font-semibold text-sm">Lightning Fast</div>
      <div class="text-zinc-500 text-xs">Processes instantly in browser</div>
    </div>
    <div class="flex flex-col items-center gap-2">
      <div class="w-12 h-12 rounded-2xl flex items-center justify-center" style="background:rgba(6,182,212,.12);border:1px solid rgba(6,182,212,.2)">
        <span class="material-symbols-outlined text-cyan-400 text-[22px]">devices</span>
      </div>
      <div class="text-white font-semibold text-sm">Works Everywhere</div>
      <div class="text-zinc-500 text-xs">Mobile, tablet & desktop</div>
    </div>
    <div class="flex flex-col items-center gap-2">
      <div class="w-12 h-12 rounded-2xl flex items-center justify-center" style="background:rgba(245,158,11,.12);border:1px solid rgba(245,158,11,.2)">
        <span class="material-symbols-outlined text-amber-400 text-[22px]">card_giftcard</span>
      </div>
      <div class="text-white font-semibold text-sm">Always Free</div>
      <div class="text-zinc-500 text-xs">No signup, no hidden fees</div>
    </div>
  </div>
</section>

<!-- ── Footer ─────────────────────────────────────── -->
<footer class="text-center py-10 px-4 pb-24 sm:pb-10" style="border-top:1px solid rgba(255,255,255,.07)">
  <div class="flex items-center justify-center gap-2 mb-3">
    <div class="w-6 h-6 rounded-lg flex items-center justify-center" style="background:linear-gradient(135deg,#7c3aed,#06b6d4)">
      <span class="material-symbols-outlined text-[14px] text-white">image</span>
    </div>
    <span class="text-white font-bold text-sm">Yaswant Image</span>
  </div>
  <p class="text-zinc-600 text-xs mb-4">A free, private, browser-based image editing suite.</p>
  <div class="flex flex-wrap items-center justify-center gap-4 text-xs text-zinc-500">
    <a href="https://yaswant.co.in" class="hover:text-white transition-colors">Main Site</a>
    <a href="https://tools.yaswant.co.in" class="hover:text-white transition-colors">Dev Tools</a>
    <a href="https://blog.yaswant.co.in" class="hover:text-white transition-colors">Blog</a>
    <span>© <?= date('Y') ?> Yaswant Dev</span>
  </div>
</footer>

<!-- Mobile App Bottom Navigation Bar for Image Suite -->
<nav class="sm:hidden fixed bottom-0 left-0 right-0 z-40 bg-[#070709]/92 backdrop-blur-2xl border-t border-zinc-800/80 shadow-[0_-8px_30px_rgba(0,0,0,0.8)] px-2 pt-1 pb-[calc(0.5rem+env(safe-area-inset-bottom,0px))] select-none" role="navigation" aria-label="Mobile Navigation">
  <div class="max-w-md mx-auto grid grid-cols-4 items-center justify-around">
    <a href="https://yaswant.co.in" class="flex flex-col items-center justify-center py-1 rounded-xl transition-transform active:scale-90 text-zinc-400 hover:text-white">
      <div class="w-10 h-7 flex items-center justify-center rounded-full">
        <span class="material-symbols-outlined text-[20px]">home</span>
      </div>
      <span class="text-[10px] tracking-tight mt-0.5">Main</span>
    </a>
    <a href="resize.php" class="flex flex-col items-center justify-center py-1 rounded-xl transition-transform active:scale-90 text-purple-400 font-semibold">
      <div class="w-10 h-7 flex items-center justify-center rounded-full bg-purple-500/15 border border-purple-500/30">
        <span class="material-symbols-outlined text-[20px]">photo_size_select_large</span>
      </div>
      <span class="text-[10px] tracking-tight mt-0.5">Resize</span>
    </a>
    <a href="compress.php" class="flex flex-col items-center justify-center py-1 rounded-xl transition-transform active:scale-90 text-emerald-400 font-semibold">
      <div class="w-10 h-7 flex items-center justify-center rounded-full bg-emerald-500/15 border border-emerald-500/30">
        <span class="material-symbols-outlined text-[20px]">compress</span>
      </div>
      <span class="text-[10px] tracking-tight mt-0.5">Compress</span>
    </a>
    <a href="remove-bg.php" class="flex flex-col items-center justify-center py-1 rounded-xl transition-transform active:scale-90 text-cyan-400 font-semibold">
      <div class="w-10 h-7 flex items-center justify-center rounded-full bg-cyan-500/15 border border-cyan-500/30">
        <span class="material-symbols-outlined text-[20px]">auto_fix_high</span>
      </div>
      <span class="text-[10px] tracking-tight mt-0.5">Remove BG</span>
    </a>
  </div>
</nav>

</body>
</html>
