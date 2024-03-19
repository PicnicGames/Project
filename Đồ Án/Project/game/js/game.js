/*=============== MAINPAGE ===============*/
/*=============== SHOW MENU ===============*/
const nav = document.getElementById('navigation'),
      headerMenu = document.getElementById('header-menu'),
      navClose = document.getElementById('nav-close')

/* Menu show */
if(headerMenu){
   headerMenu.addEventListener('click', () =>{
      nav.classList.add('show__menu')
   })
}

/* Menu hidden */
if(navClose){
    navClose.addEventListener('click', () =>{
      nav.classList.remove('show__menu')
   })
}

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

/*=============== ADD BLUR HEADER ===============*/
const blurHeader = () =>{
   const header = document.getElementById('header')
   // Add a class if the bottom offset is greater than 50 of the viewport
   this.scrollY >= 50 ? header.classList.add('blur-header') 
                      : header.classList.remove('blur-header')
}
window.addEventListener('scroll', blurHeader)

/*=============== BUTTON ===============*/
/* HOME */
function displayHome() {
   document.body.scrollTop = 0;
   document.documentElement.scrollTop = 0;
   document.getElementById('home').style.display = "block";
   document.getElementById('all-games').style.display = "none";
   document.getElementById('game').style.display = "none";
}

/* ALL GAMES */
function displayAllGames() {
   document.body.scrollTop = 0;
   document.documentElement.scrollTop = 0;
   document.getElementById('home').style.display = "none";
   document.getElementById('all-games').style.display = "block";
   document.getElementById('game').style.display = "none";
}

/* GAME */
function displayGame() {
   document.body.scrollTop = 0;
   document.documentElement.scrollTop = 0;
   document.getElementById('home').style.display = "none";
   document.getElementById('all-games').style.display = "none";
   document.getElementById('game').style.display = "block";
}

/*=============== GAME PAGE ===============*/
/* GAME RATING */
var str = document.getElementById('game-rating').textContent;
str = str.replace(/(\d+)/g,function(a){return Array(+a+1).join('★')});
document.getElementById('game-rating').innerHTML = str;

/*=============== SIGNIN SIGNUP ===============*/
/* OPEN MODAL */
function openModal() {
   document.getElementById('user-modal').style.display = 'flex'
}

/* CLOSE MODAL */
function closeModal() {
   document.getElementById('user-modal').style.display = 'none'
}

/* OPEN SIGNUP */
function signUp() {
   document.getElementById('modal-container').classList.add('right-panel__active');
   document.getElementById('overlay-image').src = 'https://i.pinimg.com/564x/c0/99/ac/c099ac0bb14e3fd693285cd28938ca76.jpg';
   document.getElementById('close').style.color = "#000"
};

/* OPEN SIGNIN */
function signIn() {
   document.getElementById('modal-container').classList.remove('right-panel__active');
   document.getElementById('overlay-image').src = 'https://i.pinimg.com/564x/c1/6e/3c/c16e3c093406cf65f93fe527244cec63.jpg';
   document.getElementById('close').style.color = "#fff"
};