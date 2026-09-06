<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'Online PDF Editor, Merger, Splitter & Watermark Suite — Yaswant Dev Tools',
  'Free client-side PDF Editor by Yaswant Pandey. Merge PDFs, split pages, rotate, reorder, delete pages, add watermarks, insert page numbers, and edit metadata 100% in your browser.',
  'pdf editor online, merge pdf online, split pdf, rotate pdf pages, pdf page remover, add watermark to pdf, pdf page number generator, free pdf tools online, client-side pdf editor, developer tools by Yaswant Pandey',
  URL_TOOLS . '/pdf-editor',
  ['type' => 'website', 'title' => 'Online PDF Editor, Merger & Splitter Suite — Yaswant Dev Tools'],
  $schema
);
?>
<div class="sidebar-push pl-0 lg:pl-72 flex flex-col min-h-screen">
  <?php nexus_sidebar('tools');
  nexus_topbar('tools'); ?>
  <main id="main-content" role="main" class="flex-1 pt-16 w-full max-w-max-width-content mx-auto p-lg space-y-lg">

    <!-- Breadcrumb -->
    <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs font-mono text-zinc-400">
      <a href="<?= URL_HOME ?>" class="hover:text-emerald-400 transition-colors">Home</a>
      <span class="text-zinc-600">/</span>
      <a href="<?= URL_TOOLS ?>" class="hover:text-emerald-400 transition-colors">Tools</a>
      <span class="text-zinc-600">/</span>
      <span class="text-zinc-300">PDF Editor & Manipulator</span>
    </nav>

    <!-- Main Tool Container -->
    <div class="bg-zinc-950 border border-zinc-800 rounded-2xl p-6 md:p-8 space-y-6 shadow-2xl">

      <!-- Tool Header -->
      <div
        class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 border-b border-zinc-800 pb-5">
        <div>
          <div
            class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-mono uppercase mb-2">
            <span class="material-symbols-outlined text-[15px]">picture_as_pdf</span> 100% In-Browser PDF Engine
          </div>
          <h1 class="text-xl md:text-3xl font-black text-white">PDF Editor & Manipulator Suite</h1>
          <p class="text-xs md:text-sm text-zinc-400 font-light mt-1">Merge multiple PDFs, organize & delete pages,
            rotate, add watermarks, insert page numbers, and edit document metadata with zero server upload.</p>
        </div>
        <div class="flex items-center gap-2">
          <button onclick="resetEditor()"
            class="bg-zinc-900 hover:bg-zinc-800 text-zinc-300 border border-zinc-700 px-3.5 py-2 rounded-xl font-mono text-xs font-bold transition-colors flex items-center gap-1.5">
            <span class="material-symbols-outlined text-[15px]">restart_alt</span> Reset All
          </button>
        </div>
      </div>

      <!-- Mode Selector Tabs -->
      <div class="flex flex-wrap items-center gap-2 border-b border-zinc-800 pb-3" id="tool-tabs">
        <button onclick="switchTab('organize')" id="tab-organize"
          class="tab-btn active bg-emerald-500/10 border border-emerald-500/40 text-emerald-400 px-4 py-2 rounded-xl font-mono text-xs font-bold transition-all flex items-center gap-2">
          <span class="material-symbols-outlined text-[16px]">view_module</span> Organize & Reorder Pages
        </button>
        <button onclick="switchTab('merge')" id="tab-merge"
          class="tab-btn text-zinc-400 hover:text-white bg-zinc-900/60 border border-zinc-800 hover:bg-zinc-800 px-4 py-2 rounded-xl font-mono text-xs font-bold transition-all flex items-center gap-2">
          <span class="material-symbols-outlined text-[16px]">call_merge</span> Merge PDFs
        </button>
        <button onclick="switchTab('watermark')" id="tab-watermark"
          class="tab-btn text-zinc-400 hover:text-white bg-zinc-900/60 border border-zinc-800 hover:bg-zinc-800 px-4 py-2 rounded-xl font-mono text-xs font-bold transition-all flex items-center gap-2">
          <span class="material-symbols-outlined text-[16px]">branding_watermark</span> Watermark & Page Numbers
        </button>
        <button onclick="switchTab('metadata')" id="tab-metadata"
          class="tab-btn text-zinc-400 hover:text-white bg-zinc-900/60 border border-zinc-800 hover:bg-zinc-800 px-4 py-2 rounded-xl font-mono text-xs font-bold transition-all flex items-center gap-2">
          <span class="material-symbols-outlined text-[16px]">edit_note</span> PDF Metadata
        </button>
      </div>

      <!-- ── SECTION 1: Organize / Reorder / Delete / Rotate ───────────────── -->
      <div id="section-organize" class="tab-section space-y-6">
        <!-- Drag and Drop Dropzone -->
        <div id="organize-dropzone" onclick="document.getElementById('organize-file-input').click()"
          class="border-2 border-dashed border-zinc-700 hover:border-emerald-500/60 bg-zinc-900/40 hover:bg-zinc-900/80 rounded-2xl p-8 text-center cursor-pointer transition-all space-y-3 group">
          <input type="file" id="organize-file-input" accept="application/pdf" class="hidden"
            onchange="handleSinglePDFUpload(this.files[0])">
          <div
            class="w-14 h-14 rounded-2xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 flex items-center justify-center mx-auto group-hover:scale-110 transition-transform">
            <span class="material-symbols-outlined text-3xl">upload_file</span>
          </div>
          <div>
            <p class="text-sm font-bold text-white">Click to Select a PDF file or Drag & Drop here</p>
            <p class="text-xs text-zinc-500 mt-1 font-mono">Supports all standard PDF files up to 200MB. Processed
              completely in browser memory.</p>
          </div>
        </div>

        <!-- Loaded PDF Info & Action Toolbar (Hidden until loaded) -->
        <div id="organize-toolbar"
          class="hidden flex flex-wrap items-center justify-between gap-3 bg-zinc-900/90 p-4 rounded-xl border border-zinc-800">
          <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-emerald-400 text-2xl">picture_as_pdf</span>
            <div>
              <p id="pdf-filename" class="text-xs font-bold text-white truncate max-w-xs md:max-w-md">filename.pdf</p>
              <p id="pdf-stats" class="text-[11px] font-mono text-zinc-400">Total Pages: 0</p>
            </div>
          </div>
          <div class="flex flex-wrap items-center gap-2">
            <button onclick="rotateAllPages(90)"
              class="bg-zinc-800 hover:bg-zinc-700 text-white px-3 py-1.5 rounded-lg text-xs font-mono font-bold transition-colors flex items-center gap-1">
              <span class="material-symbols-outlined text-[15px]">rotate_right</span> Rotate All 90°
            </button>
            <button onclick="clearSelectedPages()"
              class="bg-zinc-800 hover:bg-zinc-700 text-zinc-300 px-3 py-1.5 rounded-lg text-xs font-mono font-bold transition-colors">
              Reset Selection
            </button>
            <button onclick="exportModifiedPDF()"
              class="bg-emerald-500 hover:bg-emerald-400 text-black px-4 py-1.5 rounded-lg text-xs font-mono font-bold transition-all flex items-center gap-1.5 shadow-md">
              <span class="material-symbols-outlined text-[15px]">download</span> Export Modified PDF
            </button>
          </div>
        </div>

        <!-- Loading Spinner -->
        <div id="organize-loader" class="hidden text-center py-12 space-y-3">
          <div class="inline-block w-8 h-8 border-4 border-emerald-500 border-t-transparent rounded-full animate-spin">
          </div>
          <p class="text-xs font-mono text-zinc-400">Rendering PDF Page Thumbnails in Memory...</p>
        </div>

        <!-- Page Grid Container -->
        <div id="page-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
          <!-- Dynamically populated page thumbnails -->
        </div>
      </div>

      <!-- ── SECTION 2: PDF Merger ─────────────────────────────────────────── -->
      <div id="section-merge" class="tab-section hidden space-y-6">
        <div id="merge-dropzone" onclick="document.getElementById('merge-file-input').click()"
          class="border-2 border-dashed border-zinc-700 hover:border-emerald-500/60 bg-zinc-900/40 hover:bg-zinc-900/80 rounded-2xl p-8 text-center cursor-pointer transition-all space-y-3 group">
          <input type="file" id="merge-file-input" accept="application/pdf" multiple class="hidden"
            onchange="handleMultiplePDFUpload(this.files)">
          <div
            class="w-14 h-14 rounded-2xl bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 flex items-center justify-center mx-auto group-hover:scale-110 transition-transform">
            <span class="material-symbols-outlined text-3xl">call_merge</span>
          </div>
          <div>
            <p class="text-sm font-bold text-white">Click or Drag & Drop Multiple PDFs to Merge</p>
            <p class="text-xs text-zinc-500 mt-1 font-mono">Select 2 or more PDF documents to combine into a single
              file.</p>
          </div>
        </div>

        <div id="merge-list-container" class="hidden space-y-3">
          <div class="flex items-center justify-between text-xs font-mono text-zinc-400 px-1">
            <span>Files to Merge (Reorder by moving up/down)</span>
            <button onclick="clearMergeList()" class="text-rose-400 hover:underline">Clear List</button>
          </div>
          <div id="merge-file-list" class="space-y-2">
            <!-- List of files to merge -->
          </div>
          <div class="pt-3">
            <button onclick="executeMergePDFs()"
              class="bg-cyan-500 hover:bg-cyan-400 text-black px-6 py-2.5 rounded-xl font-mono text-xs font-bold transition-all flex items-center gap-2 shadow-lg">
              <span class="material-symbols-outlined text-[16px]">picture_as_pdf</span> Merge & Download PDF
            </button>
          </div>
        </div>
      </div>

      <!-- ── SECTION 3: Watermark & Page Numbers ───────────────────────────── -->
      <div id="section-watermark" class="tab-section hidden space-y-6">
        <div id="watermark-dropzone" onclick="document.getElementById('watermark-file-input').click()"
          class="border-2 border-dashed border-zinc-700 hover:border-emerald-500/60 bg-zinc-900/40 hover:bg-zinc-900/80 rounded-2xl p-6 text-center cursor-pointer transition-all space-y-2 group">
          <input type="file" id="watermark-file-input" accept="application/pdf" class="hidden"
            onchange="handleWatermarkPDFUpload(this.files[0])">
          <p class="text-sm font-bold text-white" id="watermark-filename-display">Upload PDF to Apply Watermark / Page
            Numbers</p>
          <p class="text-xs text-zinc-500 font-mono">Click to browse or drop file here</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-zinc-900/60 p-6 rounded-2xl border border-zinc-800">
          <!-- Watermark Text Config -->
          <div class="space-y-4">
            <h3 class="text-sm font-bold text-white flex items-center gap-2 border-b border-zinc-800 pb-2">
              <span class="material-symbols-outlined text-emerald-400 text-[18px]">branding_watermark</span> Text
              Watermark
            </h3>
            <div>
              <label class="block text-xs font-mono text-zinc-400 mb-1">Watermark Text</label>
              <input type="text" id="wm-text" placeholder="e.g. CONFIDENTIAL / DRAFT / YASWANT DEV"
                class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-3 py-2 text-xs text-white outline-none focus:border-emerald-500 font-mono">
            </div>
            <div class="grid grid-cols-2 gap-3">
              <div>
                <label class="block text-xs font-mono text-zinc-400 mb-1">Font Size (px)</label>
                <input type="number" id="wm-size" value="48" min="10" max="150"
                  class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-3 py-2 text-xs text-white outline-none font-mono">
              </div>
              <div>
                <label class="block text-xs font-mono text-zinc-400 mb-1">Opacity (0.1 - 1.0)</label>
                <input type="number" id="wm-opacity" value="0.3" min="0.1" max="1.0" step="0.1"
                  class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-3 py-2 text-xs text-white outline-none font-mono">
              </div>
            </div>
            <div>
              <label class="block text-xs font-mono text-zinc-400 mb-1">Position / Layout</label>
              <select id="wm-position"
                class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-3 py-2 text-xs text-white outline-none font-mono">
                <option value="diagonal">Center Diagonal (45° Angle)</option>
                <option value="center">Center Horizontal</option>
                <option value="top-right">Top Right</option>
                <option value="bottom-right">Bottom Right</option>
              </select>
            </div>
          </div>

          <!-- Page Numbers Config -->
          <div class="space-y-4">
            <h3 class="text-sm font-bold text-white flex items-center gap-2 border-b border-zinc-800 pb-2">
              <span class="material-symbols-outlined text-cyan-400 text-[18px]">format_list_numbered</span> Page Numbers
              Overlay
            </h3>
            <div class="flex items-center gap-2">
              <input type="checkbox" id="pn-enable" class="w-4 h-4 accent-emerald-500 cursor-pointer">
              <label for="pn-enable" class="text-xs font-bold text-white cursor-pointer">Add Page Numbers to Bottom of
                Pages</label>
            </div>
            <div>
              <label class="block text-xs font-mono text-zinc-400 mb-1">Format Pattern</label>
              <select id="pn-format"
                class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-3 py-2 text-xs text-white outline-none font-mono">
                <option value="page-x-of-y">Page X of Y</option>
                <option value="page-x">Page X</option>
                <option value="just-x">X</option>
              </select>
            </div>
            <div>
              <label class="block text-xs font-mono text-zinc-400 mb-1">Alignment</label>
              <select id="pn-align"
                class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-3 py-2 text-xs text-white outline-none font-mono">
                <option value="bottom-center">Bottom Center</option>
                <option value="bottom-right">Bottom Right</option>
                <option value="bottom-left">Bottom Left</option>
              </select>
            </div>
          </div>
        </div>

        <div>
          <button onclick="applyWatermarkAndPageNumbers()"
            class="bg-emerald-500 hover:bg-emerald-400 text-black px-6 py-2.5 rounded-xl font-mono text-xs font-bold transition-all flex items-center gap-2 shadow-lg">
            <span class="material-symbols-outlined text-[16px]">download</span> Apply & Export PDF
          </button>
        </div>
      </div>

      <!-- ── SECTION 4: PDF Metadata ───────────────────────────────────────── -->
      <div id="section-metadata" class="tab-section hidden space-y-6">
        <div id="meta-dropzone" onclick="document.getElementById('meta-file-input').click()"
          class="border-2 border-dashed border-zinc-700 hover:border-emerald-500/60 bg-zinc-900/40 hover:bg-zinc-900/80 rounded-2xl p-6 text-center cursor-pointer transition-all space-y-2 group">
          <input type="file" id="meta-file-input" accept="application/pdf" class="hidden"
            onchange="handleMetadataPDFUpload(this.files[0])">
          <p class="text-sm font-bold text-white" id="meta-filename-display">Upload PDF to View & Edit Metadata</p>
          <p class="text-xs text-zinc-500 font-mono">Click to browse or drop file here</p>
        </div>

        <div class="bg-zinc-900/60 p-6 rounded-2xl border border-zinc-800 space-y-4">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="block text-xs font-mono text-zinc-400 mb-1">Document Title</label>
              <input type="text" id="meta-title" placeholder="PDF Title"
                class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-3 py-2 text-xs text-white outline-none focus:border-emerald-500 font-mono">
            </div>
            <div>
              <label class="block text-xs font-mono text-zinc-400 mb-1">Author</label>
              <input type="text" id="meta-author" placeholder="Author Name"
                class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-3 py-2 text-xs text-white outline-none focus:border-emerald-500 font-mono">
            </div>
            <div>
              <label class="block text-xs font-mono text-zinc-400 mb-1">Subject</label>
              <input type="text" id="meta-subject" placeholder="Document Subject"
                class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-3 py-2 text-xs text-white outline-none focus:border-emerald-500 font-mono">
            </div>
            <div>
              <label class="block text-xs font-mono text-zinc-400 mb-1">Keywords (Comma Separated)</label>
              <input type="text" id="meta-keywords" placeholder="engineering, notes, report"
                class="w-full bg-zinc-950 border border-zinc-800 rounded-xl px-3 py-2 text-xs text-white outline-none focus:border-emerald-500 font-mono">
            </div>
          </div>
          <div class="pt-2">
            <button onclick="savePDFMetadata()"
              class="bg-emerald-500 hover:bg-emerald-400 text-black px-6 py-2.5 rounded-xl font-mono text-xs font-bold transition-all flex items-center gap-2 shadow-lg">
              <span class="material-symbols-outlined text-[16px]">save</span> Save Metadata & Export PDF
            </button>
          </div>
        </div>
      </div>

      <!-- Feature Highlights -->
      <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 border-t border-zinc-900 text-xs text-zinc-400">
        <div class="flex items-center gap-2 bg-zinc-900/40 p-3 rounded-xl border border-zinc-800/80">
          <span class="material-symbols-outlined text-emerald-400 text-[20px]">lock</span>
          <span><strong>100% Client-Side:</strong> Zero data uploaded to any server. Complete privacy.</span>
        </div>
        <div class="flex items-center gap-2 bg-zinc-900/40 p-3 rounded-xl border border-zinc-800/80">
          <span class="material-symbols-outlined text-cyan-400 text-[20px]">bolt</span>
          <span><strong>WebCrypto Powered:</strong> Native browser performance with zero latency.</span>
        </div>
        <div class="flex items-center gap-2 bg-zinc-900/40 p-3 rounded-xl border border-zinc-800/80">
          <span class="material-symbols-outlined text-indigo-400 text-[20px]">download</span>
          <span><strong>Instant PDF Export:</strong> Download merged or modified PDFs immediately.</span>
        </div>
      </div>

    </div>

    <!-- ── On-Page SEO Guide & FAQ ───────────────────────────────────────── -->
    <div class="bg-zinc-950 border border-zinc-800 rounded-2xl p-6 md:p-8 space-y-6">
      <h2 class="text-lg md:text-2xl font-bold text-white flex items-center gap-2">
        <span class="material-symbols-outlined text-emerald-400">help</span> Complete Guide to Online PDF Editing
      </h2>
      <div class="prose-blog text-xs md:text-sm text-zinc-400 space-y-4 font-light leading-relaxed">
        <p>Our online PDF Editor Suite is engineered for students, engineers, and professionals who need fast, secure
          PDF manipulation without installing bloated desktop software or uploading sensitive files to untrusted
          third-party servers.</p>

        <h3 class="text-sm font-bold text-white mt-4">Key Features Included:</h3>
        <ul class="list-disc list-inside space-y-1.5 text-zinc-300">
          <li><strong>Page Reordering & Deletion:</strong> Visual thumbnail canvas grid to move or trash unwanted pages.
          </li>
          <li><strong>PDF Merger:</strong> Combine multiple independent PDFs into a single continuous document.</li>
          <li><strong>Page Rotation:</strong> Fix upside-down or sideways scanned pages with 90° or 180° rotation.</li>
          <li><strong>Watermarking & Page Numbers:</strong> Add custom confidential text overlays or automatic "Page X
            of Y" footers.</li>
          <li><strong>Metadata Editing:</strong> Clean up PDF titles, author tags, and keywords for professional
            submissions.</li>
        </ul>
      </div>
    </div>

  </main>
  <?php nexus_footer(); ?>
</div>

<!-- Include PDF-LIB and PDF.js libraries via CDN -->
<script src="https://unpkg.com/pdf-lib@1.17.1/dist/pdf-lib.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
  // Set PDF.js worker
  pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

  // Global State
  let currentFileArrayBuffer = null;
  let currentFileName = '';
  let pdfLibDoc = null;
  let pageStates = []; // Array of { originalIndex, rotation }
  let mergeFiles = []; // Array of File objects
  let watermarkFileArrayBuffer = null;
  let watermarkFileName = '';
  let metaFileArrayBuffer = null;
  let metaFileName = '';

  // Tab Switcher
  function switchTab(tabId) {
    document.querySelectorAll('.tab-btn').forEach(btn => {
      btn.classList.remove('active', 'bg-emerald-500/10', 'border-emerald-500/40', 'text-emerald-400');
      btn.classList.add('text-zinc-400', 'bg-zinc-900/60', 'border-zinc-800');
    });
    const activeBtn = document.getElementById('tab-' + tabId);
    if (activeBtn) {
      activeBtn.classList.add('active', 'bg-emerald-500/10', 'border-emerald-500/40', 'text-emerald-400');
      activeBtn.classList.remove('text-zinc-400', 'bg-zinc-900/60', 'border-zinc-800');
    }

    document.querySelectorAll('.tab-section').forEach(sec => sec.classList.add('hidden'));
    const activeSec = document.getElementById('section-' + tabId);
    if (activeSec) activeSec.classList.remove('hidden');
  }

  // Handle Single PDF Upload for Organize Section
  async function handleSinglePDFUpload(file) {
    if (!file || file.type !== 'application/pdf') {
      alert('Please upload a valid PDF document.');
      return;
    }
    currentFileName = file.name;
    document.getElementById('pdf-filename').innerText = file.name;
    document.getElementById('organize-loader').classList.remove('hidden');
    document.getElementById('page-grid').innerHTML = '';
    document.getElementById('organize-toolbar').classList.add('hidden');

    try {
      currentFileArrayBuffer = await file.arrayBuffer();
      // Load PDF.js document for thumbnail rendering
      const pdfJsDoc = await pdfjsLib.getDocument({ data: currentFileArrayBuffer.slice(0) }).promise;
      const numPages = pdfJsDoc.numPages;
      document.getElementById('pdf-stats').innerText = `Total Pages: ${numPages} | File Size: ${(file.size / 1024 / 1024).toFixed(2)} MB`;

      pageStates = [];
      const gridContainer = document.getElementById('page-grid');

      for (let i = 1; i <= numPages; i++) {
        pageStates.push({ originalIndex: i - 1, rotation: 0 });
        const page = await pdfJsDoc.getPage(i);
        const viewport = page.getViewport({ scale: 0.3 });

        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        canvas.height = viewport.height;
        canvas.width = viewport.width;
        canvas.className = 'w-full h-auto rounded-lg border border-zinc-800 bg-white shadow';

        await page.render({ canvasContext: context, viewport: viewport }).promise;

        const pageCard = document.createElement('div');
        pageCard.id = `page-card-${i - 1}`;
        pageCard.className = 'bg-zinc-900 border border-zinc-800 rounded-xl p-2.5 flex flex-col space-y-2 relative group hover:border-emerald-500/50 transition-all';
        pageCard.innerHTML = `
          <div class="flex items-center justify-between text-[11px] font-mono text-zinc-400">
            <span class="font-bold text-white">Page ${i}</span>
            <button onclick="rotatePage(${i - 1})" class="hover:text-emerald-400" title="Rotate 90°">
              <span class="material-symbols-outlined text-[15px]">rotate_right</span>
            </button>
          </div>
          <div class="relative overflow-hidden flex items-center justify-center bg-zinc-950 rounded-lg p-1 min-h-[140px]">
            <div id="canvas-wrap-${i - 1}" class="transition-transform duration-300"></div>
          </div>
          <div class="flex items-center justify-between gap-1 pt-1">
            <div class="flex items-center gap-1">
              <button onclick="movePage(${i - 1}, -1)" class="p-1 bg-zinc-800 hover:bg-zinc-700 rounded text-zinc-300" title="Move Left/Up">
                <span class="material-symbols-outlined text-[13px]">arrow_back</span>
              </button>
              <button onclick="movePage(${i - 1}, 1)" class="p-1 bg-zinc-800 hover:bg-zinc-700 rounded text-zinc-300" title="Move Right/Down">
                <span class="material-symbols-outlined text-[13px]">arrow_forward</span>
              </button>
            </div>
            <button onclick="deletePageCard(${i - 1})" class="p-1 bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 rounded" title="Delete Page">
              <span class="material-symbols-outlined text-[14px]">delete</span>
            </button>
          </div>
        `;

        gridContainer.appendChild(pageCard);
        document.getElementById(`canvas-wrap-${i - 1}`).appendChild(canvas);
      }

      document.getElementById('organize-loader').classList.add('hidden');
      document.getElementById('organize-toolbar').classList.remove('hidden');
    } catch (err) {
      console.error(err);
      alert('Error rendering PDF: ' + err.message);
      document.getElementById('organize-loader').classList.add('hidden');
    }
  }

  // Rotate individual page thumbnail visually & update state
  function rotatePage(index) {
    const pState = pageStates.find(p => p.originalIndex === index);
    if (pState) {
      pState.rotation = (pState.rotation + 90) % 360;
      const wrap = document.getElementById(`canvas-wrap-${index}`);
      if (wrap) wrap.style.transform = `rotate(${pState.rotation}deg)`;
    }
  }

  // Rotate all pages by angle
  function rotateAllPages(angle) {
    pageStates.forEach(p => {
      p.rotation = (p.rotation + angle) % 360;
      const wrap = document.getElementById(`canvas-wrap-${p.originalIndex}`);
      if (wrap) wrap.style.transform = `rotate(${p.rotation}deg)`;
    });
  }

  // Delete page card
  function deletePageCard(index) {
    pageStates = pageStates.filter(p => p.originalIndex !== index);
    const card = document.getElementById(`page-card-${index}`);
    if (card) card.remove();
    document.getElementById('pdf-stats').innerText = `Remaining Pages: ${pageStates.length}`;
  }

  // Move page left/right in state
  function movePage(index, direction) {
    const idx = pageStates.findIndex(p => p.originalIndex === index);
    if (idx < 0) return;
    const targetIdx = idx + direction;
    if (targetIdx < 0 || targetIdx >= pageStates.length) return;

    // Swap in array
    const temp = pageStates[idx];
    pageStates[idx] = pageStates[targetIdx];
    pageStates[targetIdx] = temp;

    // Swap DOM nodes
    const grid = document.getElementById('page-grid');
    const cards = Array.from(grid.children);
    grid.innerHTML = '';
    pageStates.forEach(p => {
      const cardNode = cards.find(c => c.id === `page-card-${p.originalIndex}`);
      if (cardNode) grid.appendChild(cardNode);
    });
  }

  // Clear selection
  function clearSelectedPages() {
    if (currentFileArrayBuffer) {
      const file = new File([currentFileArrayBuffer], currentFileName, { type: 'application/pdf' });
      handleSinglePDFUpload(file);
    }
  }

  // Export Modified PDF using PDF-LIB
  async function exportModifiedPDF() {
    if (!currentFileArrayBuffer || pageStates.length === 0) {
      alert('No pages to export.');
      return;
    }
    try {
      const srcDoc = await PDFLib.PDFDocument.load(currentFileArrayBuffer);
      const newDoc = await PDFLib.PDFDocument.create();

      for (const pState of pageStates) {
        const [copiedPage] = await newDoc.copyPages(srcDoc, [pState.originalIndex]);
        if (pState.rotation !== 0) {
          const currentRot = copiedPage.getRotation().angle;
          copiedPage.setRotation(PDFLib.degrees((currentRot + pState.rotation) % 360));
        }
        newDoc.addPage(copiedPage);
      }

      const pdfBytes = await newDoc.save();
      downloadBlob(pdfBytes, 'modified_' + currentFileName, 'application/pdf');
    } catch (err) {
      alert('Error exporting PDF: ' + err.message);
    }
  }

  // ── MERGE PDF LOGIC ──
  function handleMultiplePDFUpload(files) {
    if (!files || files.length === 0) return;
    for (let f of files) {
      if (f.type === 'application/pdf') {
        mergeFiles.push(f);
      }
    }
    renderMergeList();
  }

  function renderMergeList() {
    const listEl = document.getElementById('merge-file-list');
    const container = document.getElementById('merge-list-container');
    listEl.innerHTML = '';

    if (mergeFiles.length === 0) {
      container.classList.add('hidden');
      return;
    }

    container.classList.remove('hidden');
    mergeFiles.forEach((file, index) => {
      const row = document.createElement('div');
      row.className = 'flex items-center justify-between bg-zinc-900 p-3 rounded-xl border border-zinc-800 text-xs';
      row.innerHTML = `
        <div class="flex items-center gap-2 truncate">
          <span class="font-mono text-zinc-500 font-bold">#${index + 1}</span>
          <span class="material-symbols-outlined text-cyan-400 text-[18px]">picture_as_pdf</span>
          <span class="text-white font-medium truncate max-w-xs">${file.name}</span>
          <span class="font-mono text-zinc-500 text-[11px]">(${(file.size / 1024 / 1024).toFixed(2)} MB)</span>
        </div>
        <div class="flex items-center gap-1">
          <button onclick="moveMergeFile(${index}, -1)" class="p-1 bg-zinc-800 hover:bg-zinc-700 rounded text-zinc-300"><span class="material-symbols-outlined text-[13px]">arrow_upward</span></button>
          <button onclick="moveMergeFile(${index}, 1)" class="p-1 bg-zinc-800 hover:bg-zinc-700 rounded text-zinc-300"><span class="material-symbols-outlined text-[13px]">arrow_downward</span></button>
          <button onclick="removeMergeFile(${index})" class="p-1 bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 rounded"><span class="material-symbols-outlined text-[13px]">close</span></button>
        </div>
      `;
      listEl.appendChild(row);
    });
  }

  function moveMergeFile(index, direction) {
    const target = index + direction;
    if (target < 0 || target >= mergeFiles.length) return;
    const temp = mergeFiles[index];
    mergeFiles[index] = mergeFiles[target];
    mergeFiles[target] = temp;
    renderMergeList();
  }

  function removeMergeFile(index) {
    mergeFiles.splice(index, 1);
    renderMergeList();
  }

  function clearMergeList() {
    mergeFiles = [];
    renderMergeList();
  }

  async function executeMergePDFs() {
    if (mergeFiles.length < 2) {
      alert('Please upload at least 2 PDF files to merge.');
      return;
    }
    try {
      const mergedPdf = await PDFLib.PDFDocument.create();

      for (const file of mergeFiles) {
        const arrayBuf = await file.arrayBuffer();
        const pdf = await PDFLib.PDFDocument.load(arrayBuf);
        const copiedPages = await mergedPdf.copyPages(pdf, pdf.getPageIndices());
        copiedPages.forEach(page => mergedPdf.addPage(page));
      }

      const mergedBytes = await mergedPdf.save();
      downloadBlob(mergedBytes, 'merged_document.pdf', 'application/pdf');
    } catch (err) {
      alert('Error merging PDFs: ' + err.message);
    }
  }

  // ── WATERMARK & PAGE NUMBERS LOGIC ──
  async function handleWatermarkPDFUpload(file) {
    if (!file || file.type !== 'application/pdf') return;
    watermarkFileArrayBuffer = await file.arrayBuffer();
    watermarkFileName = file.name;
    document.getElementById('watermark-filename-display').innerText = 'Loaded: ' + file.name;
  }

  async function applyWatermarkAndPageNumbers() {
    if (!watermarkFileArrayBuffer) {
      alert('Please upload a PDF file first.');
      return;
    }

    try {
      const pdfDoc = await PDFLib.PDFDocument.load(watermarkFileArrayBuffer);
      const font = await pdfDoc.embedFont(PDFLib.StandardFonts.HelveticaBold);
      const pages = pdfDoc.getPages();
      const totalPages = pages.length;

      const wmText = document.getElementById('wm-text').value.trim();
      const wmSize = parseFloat(document.getElementById('wm-size').value) || 48;
      const wmOpacity = parseFloat(document.getElementById('wm-opacity').value) || 0.3;
      const wmPos = document.getElementById('wm-position').value;

      const addPN = document.getElementById('pn-enable').checked;
      const pnFormat = document.getElementById('pn-format').value;

      pages.forEach((page, i) => {
        const { width, height } = page.getSize();

        // 1. Draw Watermark if text entered
        if (wmText) {
          const textWidth = font.widthOfTextAtSize(wmText, wmSize);
          const textHeight = font.heightAtSize(wmSize);

          let x = (width - textWidth) / 2;
          let y = (height - textHeight) / 2;
          let rotateAngle = 0;

          if (wmPos === 'diagonal') rotateAngle = 45;
          else if (wmPos === 'top-right') { x = width - textWidth - 30; y = height - textHeight - 40; }
          else if (wmPos === 'bottom-right') { x = width - textWidth - 30; y = 40; }

          page.drawText(wmText, {
            x, y,
            size: wmSize,
            font: font,
            color: PDFLib.rgb(0.5, 0.5, 0.5),
            opacity: wmOpacity,
            rotate: PDFLib.degrees(rotateAngle)
          });
        }

        // 2. Draw Page Numbers if enabled
        if (addPN) {
          let str = `Page ${i + 1} of ${totalPages}`;
          if (pnFormat === 'page-x') str = `Page ${i + 1}`;
          else if (pnFormat === 'just-x') str = `${i + 1}`;

          const pnSize = 10;
          const strWidth = font.widthOfTextAtSize(str, pnSize);
          let px = (width - strWidth) / 2;
          const py = 20;

          page.drawText(str, {
            x: px, y: py,
            size: pnSize,
            font: font,
            color: PDFLib.rgb(0.2, 0.2, 0.2),
            opacity: 0.8
          });
        }
      });

      const pdfBytes = await pdfDoc.save();
      downloadBlob(pdfBytes, 'watermarked_' + watermarkFileName, 'application/pdf');
    } catch (err) {
      alert('Error applying watermark: ' + err.message);
    }
  }

  // ── METADATA LOGIC ──
  async function handleMetadataPDFUpload(file) {
    if (!file || file.type !== 'application/pdf') return;
    metaFileArrayBuffer = await file.arrayBuffer();
    metaFileName = file.name;
    document.getElementById('meta-filename-display').innerText = 'Loaded: ' + file.name;

    try {
      const pdfDoc = await PDFLib.PDFDocument.load(metaFileArrayBuffer);
      document.getElementById('meta-title').value = pdfDoc.getTitle() || '';
      document.getElementById('meta-author').value = pdfDoc.getAuthor() || '';
      document.getElementById('meta-subject').value = pdfDoc.getSubject() || '';
      document.getElementById('meta-keywords').value = (pdfDoc.getKeywords() || []).join(', ');
    } catch (err) {
      console.error(err);
    }
  }

  async function savePDFMetadata() {
    if (!metaFileArrayBuffer) {
      alert('Please upload a PDF file first.');
      return;
    }

    try {
      const pdfDoc = await PDFLib.PDFDocument.load(metaFileArrayBuffer);
      pdfDoc.setTitle(document.getElementById('meta-title').value.trim());
      pdfDoc.setAuthor(document.getElementById('meta-author').value.trim());
      pdfDoc.setSubject(document.getElementById('meta-subject').value.trim());

      const kwStr = document.getElementById('meta-keywords').value.trim();
      if (kwStr) {
        pdfDoc.setKeywords(kwStr.split(',').map(s => s.trim()));
      }

      const pdfBytes = await pdfDoc.save();
      downloadBlob(pdfBytes, 'meta_updated_' + metaFileName, 'application/pdf');
    } catch (err) {
      alert('Error updating metadata: ' + err.message);
    }
  }

  // Utility Helper to trigger browser blob download
  function downloadBlob(bytes, filename, mimeType) {
    const blob = new Blob([bytes], { type: mimeType });
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = filename;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  }

  // Reset Editor State
  function resetEditor() {
    currentFileArrayBuffer = null;
    pageStates = [];
    mergeFiles = [];
    document.getElementById('page-grid').innerHTML = '';
    document.getElementById('organize-toolbar').classList.add('hidden');
    renderMergeList();
  }
</script>