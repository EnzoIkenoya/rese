const header = document.getElementById("header");
const menu = document.getElementById("header__menu");
const title = document.getElementById("header__title");
const nav = document.getElementById("header__nav");

menu.addEventListener('click', () => {
  header.classList.toggle('open');
  menu.classList.toggle('open');
  title.classList.toggle('open');
  nav.classList.toggle('open');
});