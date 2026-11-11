<?php
session_start();
$c = require __DIR__ . '/config.php';
function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }
if (empty($_SESSION['jeton'])) { $_SESSION['jeton'] = bin2hex(random_bytes(16)); }

// Initiales pour le cadre photo si l'image est absente
$initiales = '';
foreach (explode(' ', $c['nom']) as $mot) { $initiales .= mb_strtoupper(mb_substr($mot, 0, 1)); }
$initiales = mb_substr($initiales, 0, 3);

// Filtres des projets : toutes les technologies utilisées
$tags = [];
foreach ($c['projets'] as $p) { foreach ($p['tags'] as $t) { $tags[$t] = true; } }
$tags = array_keys($tags);

$envoi = $_GET['envoi'] ?? '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($c['nom']) ?> | Portfolio</title>
  <meta name="description" content="<?= e($c['accroche']) ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:wght@500;700;800&family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<a class="lien-evitement" href="#contenu">Aller au contenu</a>

<header class="entete">
  <a class="logo" href="#accueil" aria-label="Accueil"><?= e($initiales) ?></a>
  <button class="burger" aria-label="Ouvrir le menu" aria-expanded="false" aria-controls="menu"><span></span><span></span><span></span></button>
  <nav id="menu" class="menu" aria-label="Navigation principale">
    <?php foreach ($c['menu'] as $id => $libelle): ?>
      <a href="#<?= e($id) ?>"><?= e($libelle) ?></a>
    <?php endforeach; ?>
  </nav>
</header>

<main id="contenu">

  <!-- ===================== ACCUEIL ===================== -->
  <section id="accueil" class="hero">
    <div class="hero-texte">
      <p class="pastille"><span class="point"></span><?= e($c['dispo']) ?></p>
      <h1><?= e($c['nom']) ?></h1>
      <p class="titre"><?= e($c['titre']) ?></p>
      <p class="accroche"><?= e($c['accroche']) ?></p>
      <div class="boutons">
        <a class="btn btn-plein" href="#projets">Voir mes projets</a>
        <a class="btn btn-contour" href="#contact">Me contacter</a>
        <a class="btn btn-contour" href="cv.php"><?= e($c['cv_libelle']) ?></a>
      </div>
    </div>
    <div class="hero-photo">
      <div class="cadre-photo">
        <img src="<?= e($c['photo']) ?>" alt="Logo YJL de <?= e($c['nom']) ?>" width="420" height="420"
             onerror="this.style.display='none';this.parentNode.classList.add('sans-photo')">
        <span class="initiales" aria-hidden="true"><?= e($initiales) ?></span>
      </div>
    </div>
  </section>

  <!-- ===================== À PROPOS ===================== -->
  <section id="apropos" class="bloc">
    <h2>À propos</h2>
    <div class="deux-col">
      <div class="prose">
        <?php foreach ($c['bio'] as $para): ?><p><?= e($para) ?></p><?php endforeach; ?>
        <ul class="qualites">
          <?php foreach ($c['qualites'] as $q): ?><li><?= e($q) ?></li><?php endforeach; ?>
        </ul>
      </div>
      <div>
        <dl class="infos">
          <?php foreach ($c['infos'] as $lib => $val): ?>
            <div><dt><?= e($lib) ?></dt><dd><?= e($val) ?></dd></div>
          <?php endforeach; ?>
        </dl>
        <div class="chiffres">
          <?php foreach ($c['chiffres'] as $ch): ?>
            <div><strong><?= e($ch[0]) ?></strong><span><?= e($ch[1]) ?></span></div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </section>

  <!-- ===================== COMPÉTENCES ===================== -->
  <section id="competences" class="bloc">
    <h2>Compétences</h2>
    <div class="grille-3">
      <?php foreach ($c['competences'] as $g): ?>
        <div class="groupe">
          <h3><?= e($g['groupe']) ?></h3>
          <?php foreach ($g['items'] as $it): ?>
            <div class="barre">
              <div class="barre-ligne"><span><?= e($it[0]) ?></span><span><?= (int)$it[1] ?>%</span></div>
              <div class="piste" role="progressbar" aria-valuenow="<?= (int)$it[1] ?>" aria-valuemin="0" aria-valuemax="100" aria-label="<?= e($it[0]) ?>"><div class="rempli" style="--niveau: <?= (int)$it[1] ?>%"></div></div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- ===================== SERVICES ===================== -->
  <section id="services" class="bloc">
    <h2>Services</h2>
    <div class="grille-2">
      <?php foreach ($c['services'] as $s): ?>
        <article class="service">
          <h3><?= e($s[0]) ?></h3>
          <p><?= e($s[1]) ?></p>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- ===================== PROJETS / PAGES CRÉÉES ===================== -->
  <section id="projets" class="bloc">
    <h2>Mes pages & projets</h2>
    <p class="intro">Des pages et applications que j'ai créées moi-même. Filtre par technologie :</p>
    <div class="filtres" role="group" aria-label="Filtrer les projets">
      <button class="filtre actif" data-filtre="tous">Tous</button>
      <?php foreach ($tags as $t): ?>
        <button class="filtre" data-filtre="<?= e($t) ?>"><?= e($t) ?></button>
      <?php endforeach; ?>
    </div>
    <div class="grille-2" id="liste-projets">
      <?php foreach ($c['projets'] as $p): ?>
        <article class="projet statut-<?= $p['statut'] === 'Terminé' ? 'fini' : 'cours' ?>" data-tags="<?= e(implode('|', $p['tags'])) ?>">
          <div class="projet-haut">
            <h3><?= e($p['titre']) ?></h3>
            <span class="statut"><?= e($p['statut']) ?></span>
          </div>
          <p><?= e($p['texte']) ?></p>
          <ul class="tags"><?php foreach ($p['tags'] as $t): ?><li><?= e($t) ?></li><?php endforeach; ?></ul>
          <?php if (!empty($p['lien'])): ?>
            <a class="lien" href="<?= e($p['lien']) ?>">Ouvrir la page</a>
          <?php endif; ?>
        </article>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- ===================== PARCOURS ===================== -->
  <section id="parcours" class="bloc">
    <h2>Parcours</h2>
    <ol class="chrono">
      <?php foreach ($c['parcours'] as $etape): ?>
        <li>
          <span class="date"><?= e($etape[0]) ?></span>
          <h3><?= e($etape[1]) ?></h3>
          <p><?= e($etape[2]) ?></p>
        </li>
      <?php endforeach; ?>
    </ol>
  </section>

  <!-- ===================== NOUVELLE SECTION : modèle à copier =====================
  <section id="mon-id" class="bloc">
    <h2>Titre de la section</h2>
    <p>Ton contenu...</p>
  </section>
  Puis ajoute 'mon-id' => 'Titre' dans 'menu' de config.php.
  ============================================================================== -->

  <!-- ===================== CONTACT ===================== -->
  <section id="contact" class="bloc">
    <h2>Contact</h2>
    <div class="deux-col">
      <div class="prose">
        <p>Un projet, une question, un besoin d'application ? Écris-moi, je réponds rapidement.</p>
        <ul class="coordonnees">
          <?php if ($c['contact']['email']): ?><li>Email : <a href="mailto:<?= e($c['contact']['email']) ?>"><?= e($c['contact']['email']) ?></a></li><?php endif; ?>
          <?php if ($c['contact']['telephone']): ?><li>Téléphone : <a href="tel:<?= e(preg_replace('/\s+/', '', $c['contact']['telephone'])) ?>"><?= e($c['contact']['telephone']) ?></a></li><?php endif; ?>
          <?php if ($c['contact']['whatsapp']): ?><li>WhatsApp : <a href="https://wa.me/<?= e($c['contact']['whatsapp']) ?>" target="_blank" rel="noopener">Écrire sur WhatsApp</a></li><?php endif; ?>
          <li>CV : <a href="cv.php"><?= e($c['cv_libelle']) ?></a></li>
          <?php if ($c['contact']['github']): ?><li>GitHub : <a href="<?= e($c['contact']['github']) ?>" target="_blank" rel="noopener">Mon profil</a></li><?php endif; ?>
          <?php if ($c['contact']['linkedin']): ?><li>LinkedIn : <a href="<?= e($c['contact']['linkedin']) ?>" target="_blank" rel="noopener">Mon profil</a></li><?php endif; ?>
        </ul>
      </div>
      <form id="form-contact" action="contact.php" method="post" novalidate>
        <input type="hidden" name="jeton" value="<?= e($_SESSION['jeton']) ?>">
        <div class="piege" aria-hidden="true"><label>Ne pas remplir <input type="text" name="site" tabindex="-1" autocomplete="off"></label></div>
        <label>Nom<input type="text" name="nom" required maxlength="80" autocomplete="name"></label>
        <label>Email<input type="email" name="email" required maxlength="120" autocomplete="email"></label>
        <label>Sujet<input type="text" name="sujet" maxlength="120"></label>
        <label>Message<textarea name="message" rows="5" required maxlength="3000"></textarea></label>
        <button class="btn btn-plein" type="submit">Envoyer le message</button>
        <p id="retour" class="retour" role="status" aria-live="polite">
          <?php if ($envoi === 'ok'): ?>Message envoyé. Merci !<?php elseif ($envoi === 'erreur'): ?>Le message n'a pas pu être envoyé. Vérifie les champs.<?php endif; ?>
        </p>
      </form>
    </div>
  </section>

</main>

<footer class="pied">
  <p>© <span id="annee"><?= date('Y') ?></span> <?= e($c['nom']) ?>. Tous droits réservés.</p>
  <a href="#accueil">Retour en haut</a>
</footer>

<script src="js/main.js"></script>
</body>
</html>
