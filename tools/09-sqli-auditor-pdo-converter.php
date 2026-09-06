<?php require_once __DIR__ . '/../includes/layout.php';

$schema = schema_tools();
nexus_head(
  'SQL Injection Auditor & PDO Converter — Cyber Security Tools',
  'Audit SQL query strings for SQLi attack signatures and convert raw SQL into secure PHP PDO prepared statements.',
  'sqli auditor, pdo prepared statement, security tools',
  URL_TOOLS . '/09-sqli-auditor-pdo-converter.php',
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
          <span class="material-symbols-outlined text-emerald-400">terminal</span> SQL Injection Auditor & PDO Converter
        </h1>
        <span class="text-xs font-mono bg-emerald-500/10 text-emerald-400 px-3 py-1 rounded-full border border-emerald-500/20">Security Tool</span>
      </div>

      <p class="font-body-md text-xs text-on-surface-variant">Analyze SQL queries for vulnerability vectors and get safe parameterized PDO query fixes.</p>

      <textarea id="sqli-input" oninput="auditSqlInjection()" rows="4" placeholder="Enter SQL query e.g. SELECT * FROM users WHERE user = 'admin' OR '1'='1'..." class="w-full bg-surface-container-lowest border border-outline-variant/30 rounded-xl p-md text-xs font-mono text-on-surface outline-none"></textarea>
      
      <div class="space-y-xs font-mono text-xs">
        <div class="flex justify-between items-center">
          <span class="text-zinc-400 text-[10px] uppercase">SQLi Risk Assessment:</span>
          <span id="sqli-risk" class="text-emerald-400 font-bold">Safe Query</span>
        </div>
        <div class="bg-surface-container-lowest p-sm rounded border border-outline-variant/20">
          <span class="text-zinc-500 text-[10px] block mb-1 uppercase">PDO Prepared Statement Fix:</span>
          <pre id="pdo-fix-out" class="text-cyan-400 break-all whitespace-pre-wrap"></pre>
        </div>
      </div>
    </div>
  </main>
  <?php nexus_footer(); ?>
</div>

<script>
  function auditSqlInjection() {
    const sql = document.getElementById('sqli-input').value;
    const risk = document.getElementById('sqli-risk');
    const fix  = document.getElementById('pdo-fix-out');

    if (!sql) {
      risk.innerText = 'Safe Query'; risk.className = 'text-emerald-400 font-bold';
      fix.innerText = ''; return;
    }

    const sqliPatterns = /('|\"|\bOR\b|\bUNION\b|\bSELECT\b|\bDROP\b|--|\/\*|\bSLEEP\b)/gi;
    const matches = sql.match(sqliPatterns);

    if (matches && matches.length > 1) {
      risk.innerText = `HIGH RISK (${matches.length} SQLi Attack Vectors Detected)`;
      risk.className = 'text-red-400 font-bold animate-pulse';
    } else {
      risk.innerText = 'Low / Clean Query';
      risk.className = 'text-emerald-400 font-bold';
    }

    fix.innerText = `// Safe Prepared Statement Fix:\n$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :user AND status = :status");\n$stmt->execute(['user' => $userInput, 'status' => 'active']);\n$results = $stmt->fetchAll();`;
  }
</script>
