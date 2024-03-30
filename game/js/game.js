/*=============== MAINPAGE ===============*/
window.addEventListener('scroll', show);
console.log(window.innerHeight);
function show() {  
   var contents = document.querySelectorAll('.hide__content');

   for(var i = 0; i < contents.length; i++) {
      var windowHeight = window.innerHeight;
      var showTop = contents[i].getBoundingClientRect().top;

      if(showTop < windowHeight) {
         contents[i].classList.add('show__content');
      }
   }
}

/*=============== SHOW MENU ===============*/
const nav = document.getElementById('navigation'),
      headerMenu = document.getElementById('header-menu'),
      navClose = document.getElementById('nav-close');

/* Menu show */
if(headerMenu){
   headerMenu.addEventListener('click', () =>{
      nav.classList.add('show__menu');
   })
}

/* Menu hidden */
if(navClose){
    navClose.addEventListener('click', () =>{
      nav.classList.remove('show__menu');
   })
}

/*=============== BANNER ===============*/
let list = document.querySelector('.banner .banner__list'),
   items = document.querySelectorAll('.banner .banner__list .banner__card'),
   dots = document.querySelectorAll('.banner .banner__dots .dot'),
   prev = document.getElementById('prev'),
   next = document.getElementById('next');

let active = 0;
let lengthItems = items.length - 1;

next.onclick = function() {
   if(active + 1 > lengthItems) {
      active = 0;
   } else {
      active = active + 1;
   }
   reloadSlider();
}

prev.onclick = function() {
   if(active - 1 < 0) {
      active = lengthItems;
   } else {
      active = active - 1;
   }
   reloadSlider();
}

let autoSlide = setInterval(() => {next.click()}, 5000);

function reloadSlider() {
   let checkLeft = items[active].offsetLeft;
   list.style.left = -checkLeft + 'px';

   let lastActiveDot = document.querySelector('.banner .banner__dots .dot__active');
   lastActiveDot.classList.remove('dot__active');
   dots[active].classList.add('dot__active');
   clearInterval(autoSlide);
   autoSlide = setInterval(() => {next.click()}, 5000);
}

dots.forEach((li, key) => {
   li.addEventListener('click', function() {
      active = key;
      reloadSlider();
   })
})

/*=============== SWIPER TRENDING ===============*/
let swiperNew = new Swiper('.new__swiper', {
   loop: true,
   grabCursor: true,
   centeredSlides: true,
   slidesPerView: 2,

   pagination: {
      el: '.swiper-pagination',
      clickable: true,
   },

   breakpoints:{
      440: {
         centeredSlides: false,
         slidesPerView: 'auto',
      },
      768: {
         centeredSlides: false,
         slidesPerView: 4,
      },
      1200: {
         centeredSlides: false,
         slidesPerView: 5,
      },
   },
})

/*=============== SWIPER MOVIE ===============*/
let swiperMovie = new Swiper('.movie__swiper', {
   loop: true,
   grabCursor: true,
   slidesPerView: 2,
   spaceBetween: 24,

   breakpoints:{
      440: {
         slidesPerView: 'auto',
      },
      768: {
         slidesPerView: 4,
      },
      1200: {
         slidesPerView: 5,
      },
   },
})

/*=============== BUTTON ===============*/
/* USER */
function displayProfile() {
   document.getElementById('profile').style.display = 'block';
   document.getElementById('password').style.display = 'none';
   document.getElementById('profile-button').classList.add('active');
   document.getElementById('password-button').classList.remove('active');
}

function displayPassword() {
   document.getElementById('profile').style.display = 'none';
   document.getElementById('password').style.display = 'block';
   document.getElementById('profile-button').classList.remove('active');
   document.getElementById('password-button').classList.add('active');
}

/*=============== SIGNIN SIGNUP ===============*/
/* OPEN MODAL */
function openModal() {
   document.getElementById('user-modal').style.zIndex = 'var(--z-login)';
   document.getElementById('modal-background').style.display = 'block';
   document.getElementById('modal-container').classList.add('open-modal__container');
   document.getElementById('modal-container').classList.remove('close-modal__container');
}

/* CLOSE MODAL */
function closeModal() {
   document.getElementById('user-modal').style.zIndex = '-2'
   document.getElementById('modal-background').style.display = 'none';
   document.getElementById('modal-container').classList.remove('open-modal__container');
   document.getElementById('modal-container').classList.add('close-modal__container');
}

/* OPEN SIGNUP */
function signUp() {
   document.getElementById('modal-container').classList.add('right-panel__active');
   document.getElementById('overlay-image').src = 'https://i.pinimg.com/564x/c0/99/ac/c099ac0bb14e3fd693285cd28938ca76.jpg';
   document.getElementById('modal-close').style.color = "#000";
};

/* OPEN SIGNIN */
function signIn() {
   document.getElementById('modal-container').classList.remove('right-panel__active');
   document.getElementById('overlay-image').src = 'https://i.pinimg.com/564x/c1/6e/3c/c16e3c093406cf65f93fe527244cec63.jpg';
   document.getElementById('modal-close').style.color = "#fff";
};

/* OPEN SIGNUP MOBILE */
function signUpMb() {
   document.getElementById('signin').style.opacity = "0";
   document.getElementById('signin').style.zIndex = "0";
   document.getElementById('signup').style.opacity = "1";
   document.getElementById('signup').style.zIndex = "1";
};

/* OPEN SIGNIN MOBILE*/
function signInMb() {
   document.getElementById('signin').style.opacity = "1";
   document.getElementById('signin').style.opacity = "1";
   document.getElementById('signup').style.opacity = "0";
   document.getElementById('signup').style.zIndex = "0";
};