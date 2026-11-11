document.addEventListener('DOMContentLoaded', function () {
  var burger = document.querySelector('.burger'), menu = document.getElementById('menu');
  burger.addEventListener('click', function () {
    var ouvert = menu.classList.toggle('ouvert');
    burger.setAttribute('aria-expanded', ouvert);
    burger.setAttribute('aria-label', ouvert ? 'Fermer le menu' : 'Ouvrir le menu');
  });
  menu.querySelectorAll('a').forEach(function (a) {
    a.addEventListener('click', function () { menu.classList.remove('ouvert'); burger.setAttribute('aria-expanded', 'false'); });
  });
  var filtres = document.querySelectorAll('.filtre'), projets = document.querySelectorAll('.projet');
  filtres.forEach(function (f) {
    f.addEventListener('click', function () {
      filtres.forEach(function (x) { x.classList.remove('actif'); });
      f.classList.add('actif');
      var choix = f.dataset.filtre;
      projets.forEach(function (p) { p.classList.toggle('cache', choix !== 'tous' && p.dataset.tags.split('|').indexOf(choix) === -1); });
    });
  });
});
