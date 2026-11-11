<?php
/* ============================================================
   CONFIG.PHP : TOUT le contenu du portfolio est ici.
   Modifie les textes, ajoute des projets, des compétences,
   etc., sans toucher à index.php.
   ============================================================ */
return [

  // ---------- Identité ----------
  'nom'      => 'YAO Jules Landry',
  'titre'    => 'Développeur web en progression, orienté applications de gestion',
  'accroche' => "Je crée des applications de gestion et des pages web simples et utiles, et j'apprends un peu plus à chaque projet.",
  'photo'    => 'img/logo-yjl.png',   // image du grand cadre arrondi (logo YJL)
  'dispo'    => 'Ouvert aux petits projets et missions',

  // ---------- Menu (id de section => libellé) ----------
  // Pour ajouter une section : ajoute une ligne ici + un bloc <section id="..."> dans index.php
  'menu' => [
    'apropos'     => 'À propos',
    'competences' => 'Compétences',
    'services'    => 'Services',
    'projets'     => 'Mes pages & projets',
    'parcours'    => 'Parcours',
    'contact'     => 'Contact',
  ],

  // ---------- À propos ----------
  'bio' => [
    "Je suis développeur de niveau intermédiaire. Je construis des applications simples et fonctionnelles en français, pour des besoins concrets : écoles, petits commerces, petites entreprises.",
    "Je pratique le frontend (HTML, CSS, JavaScript), le backend (PHP, MySQL) et les logiciels de bureau avec WinDev et HFSQL. Je ne prétends pas tout maîtriser, mais je sais mener un projet jusqu'au bout.",
    "Je continue à progresser : chaque projet me fait découvrir de nouvelles méthodes, et je préfère un outil simple qui marche à une solution compliquée.",
  ],
  'infos' => [   // 'Libellé' => 'Valeur'
    'Pays'         => "Côte d'Ivoire",
    'Langue'       => 'Français',
    'Niveau'        => 'Intermédiaire, en progression',
    'Disponibilité'=> 'Freelance & missions',
  ],
  'chiffres' => [ // petits chiffres clés : modifie ou supprime
    ['8', 'projets terminés'],
    ['3', 'projets en cours'],
    ['9', 'technologies pratiquées'],
  ],

  // ---------- Compétences : [nom, niveau 0-100] (à ajuster selon toi) ----------
  'competences' => [
    ['groupe' => 'Frontend', 'items' => [['HTML', 50], ['CSS', 45], ['JavaScript', 30]]],
    ['groupe' => 'Backend',  'items' => [['PHP', 40], ['MySQL', 40]]],
    ['groupe' => 'Bureau & autres langages', 'items' => [['WinDev', 50], ['HFSQL', 45], ['C', 45], ['Java', 40]]],
  ],
  'qualites' => ['Motivé', 'Sérieux', 'Apprend vite', 'À l\'écoute'],

  // ---------- Services ----------
  'services' => [
    ['Petites applications de gestion', 'Stock, facturation ou suivi de clients, pour des besoins simples et bien définis.'],
    ['Pages web simples', 'Pages claires, lisibles sur téléphone, faciles à mettre à jour.'],
    ['Bases de données', 'Création de tables MySQL ou HFSQL, requêtes courantes et saisie de données.'],
    ['Modules WinDev', 'Petites applications de bureau avec formulaires, listes et états imprimables.'],
  ],

  // ---------- Mes pages & projets (ajoute un bloc [ ... ] pour chaque nouvelle page) ----------
  // 'statut' : 'Terminé' ou 'En cours'. 'lien' : adresse de la page (ex: 'projets/quiz/index.php'), '' = pas de lien.
  'projets' => [

    // ----- Terminés -----
    [
      'titre'  => 'Quiz App',
      'texte'  => "Application de quiz avec questions, scores et données enregistrées dans une base MySQL.",
      'tags'   => ['PHP', 'CSS', 'JavaScript', 'MySQL'],
      'statut' => 'Terminé',
      'lien'   => '',
    ],
    [
      'titre'  => 'Memory Game',
      'texte'  => "Jeu de mémoire : retourne les cartes et retrouve les paires.",
      'tags'   => ['HTML', 'CSS', 'JavaScript'],
      'statut' => 'Terminé',
      'lien'   => '',
    ],
    [
      'titre'  => 'Guess Number',
      'texte'  => "Jeu pour deviner un nombre choisi au hasard.",
      'tags'   => ['HTML', 'CSS', 'JavaScript'],
      'statut' => 'Terminé',
      'lien'   => '',
    ],
    [
      'titre'  => 'Calculatrice',
      'texte'  => "Calculatrice simple utilisable directement dans le navigateur.",
      'tags'   => ['HTML', 'CSS', 'JavaScript'],
      'statut' => 'Terminé',
      'lien'   => '',
    ],
    [
      'titre'  => 'Lecteur de musique',
      'texte'  => "Lecteur audio dans le navigateur pour écouter de la musique.",
      'tags'   => ['HTML', 'CSS', 'JavaScript'],
      'statut' => 'Terminé',
      'lien'   => '',
    ],
    [
      'titre'  => "Galerie d'images automatique",
      'texte'  => "Galerie dont les images défilent automatiquement.",
      'tags'   => ['HTML', 'CSS', 'JavaScript'],
      'statut' => 'Terminé',
      'lien'   => '',
    ],
    [
      'titre'  => "Fenêtre d'image et description",
      'texte'  => "Affichage d'une image dans une fenêtre, accompagnée de sa description.",
      'tags'   => ['HTML', 'CSS', 'JavaScript'],
      'statut' => 'Terminé',
      'lien'   => '',
    ],
    [
      'titre'  => 'Gestion de produits',
      'texte'  => "Application de gestion de produits : enregistrement et suivi des articles.",
      'tags'   => ['WinDev', 'HFSQL'],     // à corriger si tu l'as faite avec d'autres technologies
      'statut' => 'Terminé',
      'lien'   => '',
    ],

    // ----- En cours -----
    [
      'titre'  => 'Chat App',
      'texte'  => "Application de messagerie en ligne pour discuter avec d'autres utilisateurs.",
      'tags'   => ['PHP', 'JavaScript', 'CSS'],
      'statut' => 'En cours',
      'lien'   => '',
    ],
    [
      'titre'  => 'Gestion école',
      'texte'  => "Logiciel de bureau pour gérer une école.",
      'tags'   => ['WinDev', 'HFSQL'],
      'statut' => 'En cours',
      'lien'   => '',
    ],
    [
      'titre'  => 'Gestion de notes',
      'texte'  => "Application web pour saisir et consulter les notes.",
      'tags'   => ['PHP', 'CSS', 'JavaScript'],
      'statut' => 'En cours',
      'lien'   => '',
    ],
  ],

  // ---------- Parcours : ['date ou repère', 'titre', 'texte'] ----------
  'parcours' => [
    ['Aujourd\'hui', 'Développeur en progression', 'Je réalise des projets web et de gestion pour apprendre et gagner en expérience.'],
    ['Formation', 'BTS en Informatique, Développeur d\'Application', 'Academies Elites, Yopougon ancien Bel-Air.'],
    ['À venir', 'Première expérience : stage', "Le stage n'a pas encore commencé. Ma mission : aider les autres et en tirer le plus possible pour progresser."],
    ['Projet personnel', 'Projet personnel marquant', 'Gestion de produits, le projet qui m\'a le plus marqué.'],
  ],

  // ---------- CV à télécharger ----------
  // Remplace simplement le fichier dans le dossier cv/ (garde le même nom),
  // ou change le nom ici (docx, doc ou pdf fonctionnent). Si le fichier n'existe pas, le bouton disparaît.
  'cv'         => 'cv/CV-YAO-Jules-Landry.docx',   // ton CV Word : sert au téléchargement
  'cv_pdf'     => 'cv/CV-YAO-Jules-Landry.pdf',    // le même CV en PDF : sert à l'affichage dans la page cv.php
  'cv_libelle' => 'Voir et télécharger mon CV',

  // ---------- Contact ----------
  'email_reception' => 'landryjules03@gmail.com',   // les messages du formulaire arrivent ici
  'contact' => [
    'email'     => 'landryjules03@gmail.com',
    'telephone' => '+225 05 07 91 51 00',
    'whatsapp'  => '2250507915100',          // chiffres seulement, avec l'indicatif
    'github'    => '',                       // ex: https://github.com/ton-nom
    'linkedin'  => '',
  ],
];
