new SimpleSlide({
  slide: "area", // nome do atributo data-slide="principal"
  time: 5000, // tempo de transição dos slides
  pauseOnHover: true, // pausa a transição automática
});

new SimpleAnime();

function scrollSuave() {
  const linksInternos = document.querySelectorAll('.js-menu a[href^="#"]');
  function scrollTosection(event) {
    event.preventDefault();
    const href = event.currentTarget.getAttribute("href");
    const section = document.querySelector(href);
    const topoSection = section.offsetTop - 83;
    window.scrollTo({
      top: topoSection,
      behavior: "smooth",
    });
  }
  linksInternos.forEach((link) => {
    link.addEventListener("click", scrollTosection);
  });
}
scrollSuave();

function animaScroll() {
  const sections = document.querySelectorAll(".js-animeScroll");
  const windowMetade = window.innerHeight * 0.7;
  function animeSection() {
    sections.forEach((section) => {
      const sectionTop = section.getBoundingClientRect().top - windowMetade;
      if (sectionTop < 0) {
        section.classList.add("ativo");
      } else {
        section.classList.remove("ativo");
      }
    });
  }
  window.addEventListener("scroll", animeSection);
  animeSection();
}
animaScroll();

function animaAccordion() {
  const dts = document.querySelectorAll(".js-accordion dt");
  if (dts.length) {
    dts[0].classList.add("ativo");
    dts[0].nextElementSibling.classList.add("ativo");
    dts[4].classList.add("ativo");
    dts[4].nextElementSibling.classList.add("ativo");

    function activeAccordion() {
      this.classList.toggle("ativo");
      this.nextElementSibling.classList.toggle("ativo");
    }

    dts.forEach((item) => {
      item.addEventListener("click", activeAccordion);
    });
  }
}
animaAccordion();

// Fechar Modal
const botaoFechar = document.querySelector('[data-modal="fechar"]');
const containerModal = document.querySelector('[data-modal="container"]');

function fecharModal(event) {
  event.preventDefault();
  containerModal.classList.remove("ativo");
  containerModal.setAttribute("data-close", "");
}

botaoFechar.addEventListener("click", fecharModal);
//

function animaModal() {
  const servico = document.querySelector(".servico");
  const modal = document.querySelector('[data-modal="container"]');
  const windowMetade = window.innerHeight * 0.8;

  function animeModal() {
    if (!containerModal.hasAttribute("data-close")) {
      const servicoTop = servico.getBoundingClientRect().top;
      if (servicoTop <= 80) {
        modal.classList.add("ativo");
        console.log(servicoTop);
      }
    }
  }

  window.addEventListener("scroll", animeModal);
  animeModal();
}
animaModal();


function initMenuMobile() {

    const menuButton = document.querySelector('[data-menu="button"]');
    const menuList = document.querySelector('[data-menu="list"]');
    const eventos = ['click', 'touchstart'];

    eventos.forEach((evento)=>{
        menuButton.addEventListener(evento, openMenu);
    })

    function openMenu() {
        menuButton.classList.toggle('ativo');
        menuList.classList.toggle('ativo');
    }
}
initMenuMobile();