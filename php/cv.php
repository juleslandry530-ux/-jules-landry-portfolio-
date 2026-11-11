<?php
// Page d'affichage du CV : on voit le CV, puis on peut le télécharger.
// - Le PDF (cv_pdf dans config.php) est affiché directement dans la page.
// - Sans PDF, le Word est affiché via Office en ligne (uniquement quand le site est en ligne).
$c = require __DIR__ . '/config.php';
function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

$docx = $c['cv'] ?? '';
$pdf  = $c['cv_pdf'] ?? '';
$aDocx = $docx !== '' && is_file(__DIR__ . '/' . $docx);
$aPdf  = $pdf  !== '' && is_file(__DIR__ . '/' . $pdf);

$hote   = $_SERVER['HTTP_HOST'] ?? 'localhost';
$local  = (bool)preg_match('/^(localhost|127\.|192\.168\.|10\.|\[::1\])/', $hote);
$schema = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$base   = $schema . '://' . $hote . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\') . '/';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CV | <?= e($c['nom']) ?></title>
  <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@500;700;800&family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
<main>
  <section class="bloc" style="border-top:0">
    <h2>Mon CV</h2>

    <div class="actions-cv">
      <?php if ($aDocx): ?><a class="btn btn-plein" href="telecharger.php">Télécharger le CV (Word)</a><?php endif; ?>
      <?php if ($aPdf):  ?><a class="btn btn-plein" href="telecharger.php?f=pdf">Télécharger le CV (PDF)</a><?php endif; ?>
      <a class="btn btn-contour" href="index.php#accueil">Retour au portfolio</a>
    </div>

    <?php if ($aPdf): ?>
      <iframe class="apercu-cv" src="<?= e($pdf) ?>" title="CV de <?= e($c['nom']) ?>"></iframe>

    <?php elseif ($aDocx && !$local): ?>
      <iframe class="apercu-cv" src="https://view.officeapps.live.com/op/embed.aspx?src=<?= urlencode($base . $docx) ?>" title="CV de <?= e($c['nom']) ?>"></iframe>

    <?php elseif ($aDocx): ?>
      <div class="note-cv">
        <p>Un fichier Word ne peut pas s'afficher directement dans un navigateur sur ton ordinateur.</p>
        <p>Pour voir le CV dans cette page, enregistre-le aussi en PDF dans le dossier <strong>cv/</strong> sous le nom
           <strong><?= e(basename($pdf ?: 'CV-YAO-Jules-Landry.pdf')) ?></strong>. Le bouton de téléchargement Word fonctionne déjà.</p>
      </div>

    <?php else: ?>
      <div class="note-cv"><p>Le CV n'a pas encore été déposé dans le dossier <strong>cv/</strong>.</p></div>
    <?php endif; ?>
  </section>
</main>
</body>
</html>
