<?php
session_start();
$c = require __DIR__ . '/config.php';
$ajax = ($_SERVER['HTTP_X_REQUESTED_WITH'] ?? '') === 'fetch';

function repondre($ok, $msg, $ajax) {
  if ($ajax) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['ok' => $ok, 'message' => $msg], JSON_UNESCAPED_UNICODE);
  } else {
    header('Location: index.php?envoi=' . ($ok ? 'ok' : 'erreur') . '#contact');
  }
  exit;
}
function propre($v) { return trim(str_replace(["\r", "\n"], ' ', strip_tags((string)$v))); }

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { repondre(false, 'Méthode non autorisée.', $ajax); }
if (!hash_equals($_SESSION['jeton'] ?? '', $_POST['jeton'] ?? '')) { repondre(false, 'Session expirée : recharge la page.', $ajax); }
if (!empty($_POST['site'])) { repondre(true, 'Message envoyé. Merci !', $ajax); }   // piège anti-robot
if (time() - ($_SESSION['dernier_envoi'] ?? 0) < 30) { repondre(false, 'Patiente quelques secondes avant un nouvel envoi.', $ajax); }

$nom     = propre($_POST['nom'] ?? '');
$email   = propre($_POST['email'] ?? '');
$sujet   = propre($_POST['sujet'] ?? '') ?: 'Nouveau message du portfolio';
$message = trim(strip_tags($_POST['message'] ?? ''));

if (mb_strlen($nom) < 2)                          { repondre(false, 'Indique ton nom.', $ajax); }
if (!filter_var($email, FILTER_VALIDATE_EMAIL))   { repondre(false, 'Adresse email invalide.', $ajax); }
if (mb_strlen($message) < 10)                     { repondre(false, 'Le message est trop court (10 caractères minimum).', $ajax); }

// 1) Sauvegarde dans data/messages.txt (dossier protégé par .htaccess)
$dossier = __DIR__ . '/data';
if (!is_dir($dossier)) { mkdir($dossier, 0755, true); }
$ligne = date('Y-m-d H:i:s') . " | $nom | $email | $sujet\n$message\n----------\n";
$sauve = file_put_contents($dossier . '/messages.txt', $ligne, FILE_APPEND | LOCK_EX) !== false;

// 2) Envoi par email (peut échouer en local : le message reste sauvegardé)
$entetes = "From: portfolio@" . ($_SERVER['SERVER_NAME'] ?? 'localhost') . "\r\n"
         . "Reply-To: $email\r\n"
         . "Content-Type: text/plain; charset=UTF-8\r\n";
@mail($c['email_reception'], '=?UTF-8?B?' . base64_encode($sujet) . '?=', "De : $nom <$email>\n\n$message", $entetes);

if ($sauve) {
  $_SESSION['dernier_envoi'] = time();
  repondre(true, 'Message envoyé. Merci !', $ajax);
}
repondre(false, "Erreur d'enregistrement. Réessaie plus tard.", $ajax);
