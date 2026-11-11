<?php
// Télécharge le CV indiqué dans config.php ('cv'). Dépose ton CV dans le dossier cv/.
$c = require __DIR__ . '/config.php';
$cle = (($_GET['f'] ?? '') === 'pdf') ? 'cv_pdf' : 'cv';   // ?f=pdf -> PDF, sinon Word
$chemin = __DIR__ . '/' . ltrim($c[$cle] ?? '', '/');

if (!is_file($chemin)) {
  http_response_code(404);
  ?><!DOCTYPE html>
<html lang="fr"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>CV indisponible</title><link rel="stylesheet" href="css/style.css"></head>
<body><main><section class="bloc"><h2>CV indisponible</h2>
<p>Le fichier du CV n'a pas encore été déposé dans le dossier <strong>cv/</strong>.</p>
<p><a class="btn btn-plein" href="index.php#accueil">Retour au portfolio</a></p></section></main></body></html>
<?php
  exit;
}

$types = [
  'pdf'  => 'application/pdf',
  'doc'  => 'application/msword',
  'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
];
$ext = strtolower(pathinfo($chemin, PATHINFO_EXTENSION));
header('Content-Type: ' . ($types[$ext] ?? 'application/octet-stream'));
header('Content-Disposition: attachment; filename="' . basename($chemin) . '"');
header('Content-Length: ' . filesize($chemin));
readfile($chemin);
