/* ============ main.js : comportements du portfolio ============ */
document.addEventListener('DOMContentLoaded', function () {

  // ---- Menu mobile ----
  var burger = document.querySelector('.burger');
  var menu = document.getElementById('menu');
  burger.addEventListener('click', function () {
    var ouvert = menu.classList.toggle('ouvert');
    burger.setAttribute('aria-expanded', ouvert);
    burger.setAttribute('aria-label', ouvert ? 'Fermer le menu' : 'Ouvrir le menu');
  });
  menu.querySelectorAll('a').forEach(function (a) {
    a.addEventListener('click', function () {
      menu.classList.remove('ouvert');
      burger.setAttribute('aria-expanded', 'false');
    });
  });

  // ---- Filtre des projets par technologie ----
  var filtres = document.querySelectorAll('.filtre');
  var projets = document.querySelectorAll('.projet');
  filtres.forEach(function (f) {
    f.addEventListener('click', function () {
      filtres.forEach(function (x) { x.classList.remove('actif'); });
      f.classList.add('actif');
      var choix = f.dataset.filtre;
      projets.forEach(function (p) {
        var tags = p.dataset.tags.split('|');
        p.classList.toggle('cache', choix !== 'tous' && tags.indexOf(choix) === -1);
      });
    });
  });

  // ---- Formulaire de contact (envoi sans recharger la page) ----
  var form = document.getElementById('form-contact');
  var retour = document.getElementById('retour');
  form.addEventListener('submit', function (ev) {
    ev.preventDefault();
    retour.className = 'retour';
    var nom = form.nom.value.trim(), email = form.email.value.trim(), msg = form.message.value.trim();
    if (nom.length < 2) { return afficher('Indique ton nom.', false); }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) { return afficher('Adresse email invalide.', false); }
    if (msg.length < 10) { return afficher('Le message est trop court (10 caractères minimum).', false); }

    var bouton = form.querySelector('button[type="submit"]');
    bouton.disabled = true;
    afficher('Envoi en cours...', true, true);

    fetch(form.action, { method: 'POST', body: new FormData(form), headers: { 'X-Requested-With': 'fetch' } })
      .then(function (r) { return r.json(); })
      .then(function (d) {
        afficher(d.message, d.ok);
        if (d.ok) { form.reset(); }
      })
      .catch(function () { afficher("Impossible d'envoyer le message. Vérifie ta connexion.", false); })
      .finally(function () { bouton.disabled = false; });
  });
  function afficher(texte, ok, neutre) {
    retour.textContent = texte;
    retour.className = 'retour' + (neutre ? '' : (ok ? ' ok' : ' erreur'));
  }

  // ---- Année du pied de page ----
  var an = document.getElementById('annee');
  if (an) { an.textContent = new Date().getFullYear(); }
});
