<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'GPA / SGPA Semester Grade Calculator — Developer Utilities',
  'Interactive academic semester credit grade and SGPA score calculator.',
  'sgpa calculator, gpa calculator, grade calculator, developer tools',
  URL_TOOLS . '/23-gpa-sgpa-grade-calculator.php',
  [],
  $schema
);
?>
<div class="sidebar-push pl-0 lg:pl-72 flex flex-col min-h-screen">
  <?php nexus_sidebar('tools'); nexus_topbar('tools'); ?>
  <main id="main-content" role="main" class="flex-1 pt-16 w-full max-w-max-width-content mx-auto p-lg space-y-lg">
    <a href="<?= URL_TOOLS ?>" class="inline-flex items-center gap-xs font-mono text-xs text-emerald-400 hover:underline">
      <span class="material-symbols-outlined text-[16px]">arrow_back</span> Back to All Tools
    </a>
    
    <div class="bg-surface-container-high border border-outline-variant/30 rounded-2xl p-lg space-y-md shadow-xl">
      <div class="flex items-center justify-between border-b border-outline-variant/20 pb-sm">
        <h1 class="font-headline-md text-xl font-bold text-on-surface flex items-center gap-xs">
          <span class="material-symbols-outlined text-emerald-400">calculate</span> SGPA / GPA Calculator
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Developer Tool</span>
      </div>

      <div id="gpa-rows" class="space-y-xs max-h-72 overflow-y-auto pr-xs">
        <div class="grid grid-cols-12 gap-xs items-center">
          <input type="text" placeholder="Subject Name" value="Data Structures" class="col-span-6 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-sm py-xs text-xs text-on-surface outline-none"/>
          <select class="col-span-3 gpa-credit bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-sm py-xs text-xs text-on-surface outline-none">
            <option value="4" selected>4 Credits</option><option value="3">3 Credits</option><option value="2">2 Credits</option><option value="1">1 Credit</option>
          </select>
          <select class="col-span-3 gpa-grade bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-sm py-xs text-xs text-on-surface outline-none">
            <option value="10" selected>O (10)</option><option value="9">A+ (9)</option><option value="8">A (8)</option><option value="7">B+ (7)</option><option value="6">B (6)</option>
          </select>
        </div>
      </div>

      <div class="flex items-center justify-between pt-xs">
        <button onclick="addGpaRow()" class="text-xs font-mono text-emerald-400 flex items-center gap-xs">+ Add Subject</button>
        <button onclick="calculateGPA()" class="bg-emerald-500 text-black text-xs px-md py-xs rounded-xl font-bold font-mono">Calculate SGPA</button>
      </div>

      <div id="gpa-result" class="bg-surface-container-lowest p-md rounded-xl text-center border border-outline-variant/20">
        <span class="text-xs text-on-surface-variant font-mono uppercase">Calculated Semester SGPA</span>
        <h2 id="gpa-val" class="text-4xl font-bold text-emerald-400 font-mono mt-xs">0.00</h2>
      </div>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  function addGpaRow() {
    const container = document.getElementById('gpa-rows');
    const div = document.createElement('div');
    div.className = 'grid grid-cols-12 gap-xs items-center mt-xs';
    div.innerHTML = `
    <input type="text" placeholder="Subject Name" class="col-span-6 bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-sm py-xs text-xs text-on-surface outline-none"/>
    <select class="col-span-3 gpa-credit bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-sm py-xs text-xs text-on-surface outline-none">
      <option value="4">4 Credits</option><option value="3" selected>3 Credits</option><option value="2">2 Credits</option><option value="1">1 Credit</option>
    </select>
    <select class="col-span-3 gpa-grade bg-surface-container-lowest border border-outline-variant/30 rounded-xl px-sm py-xs text-xs text-on-surface outline-none">
      <option value="10">O (10)</option><option value="9" selected>A+ (9)</option><option value="8">A (8)</option><option value="7">B+ (7)</option><option value="6">B (6)</option>
    </select>`;
    container.appendChild(div);
  }

  function calculateGPA() {
    const credits = document.querySelectorAll('.gpa-credit');
    const grades = document.querySelectorAll('.gpa-grade');
    let totalCredits = 0;
    let totalPoints = 0;
    credits.forEach((c, i) => {
      const cred = parseFloat(c.value);
      const gr = parseFloat(grades[i].value);
      totalCredits += cred;
      totalPoints += (cred * gr);
    });
    const sgpa = (totalPoints / totalCredits).toFixed(2);
    document.getElementById('gpa-val').innerText = sgpa;
  }

  document.addEventListener('DOMContentLoaded', calculateGPA);
</script>
