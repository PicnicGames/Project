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
const home = document.getElementById('home'),
   all_games = document.getElementById('all-games'),
   game = document.getElementById('game'),
   blog = document.getElementById('blog'),
   blog_main = document.getElementById('blog-main'),
   user = document.getElementById('user'),
   contact = document.getElementById('contact'),
   bg_image = document.getElementById('bg-image'),
   banner_img = document.getElementById('banner-img'),
   footer = document.getElementById('footer'),
   profile = document.getElementById('profile'),
   password = document.getElementById('password'),
   nav_button = document.querySelectorAll('.nav__button'),
   profile_button = document.getElementById('profile-button'),
   password_button = document.getElementById('password-button'); 

      nav_button.forEach(nav_button => {
         nav_button.addEventListener('click', () => {
            document.querySelector('.active')?.classList.remove('active');
            nav_button.classList.add('active');
         })
      })
/* HOME */
function displayHome() {
   document.body.scrollTop = 0;
   document.documentElement.scrollTop = 0;
   document.body.style.overflow = "unset";
   home.style.display = "block";
   all_games.style.display = "none";
   game.style.display = "none";
   blog.style.display = "none";
   user.style.display = "none";
   contact.style.display = "none";
   bg_image.setAttribute('src', 'https://th.bing.com/th/id/OIP.vqPUCfFje_g0fJY110w3pgHaE8?w=251&h=180&c=7&r=0&o=5&pid=1.7');
   banner_img.setAttribute('src', '');
   nav.style.borderRight = "none";
   nav.style.backgroundColor = "unset";
   footer.style.display = "block";
}

/* ALL GAMES */
function displayAllGames() {
   document.body.scrollTop = 0;
   document.documentElement.scrollTop = 0;
   document.body.style.overflow = "unset";
   home.style.display = "none";
   all_games.style.display = "grid";
   game.style.display = "none";
   blog.style.display = "none";
   user.style.display = "none";
   contact.style.display = "none";
   bg_image.setAttribute('src', 'https://th.bing.com/th/id/OIP.vqPUCfFje_g0fJY110w3pgHaE8?w=251&h=180&c=7&r=0&o=5&pid=1.7');
   banner_img.setAttribute('src', '');
   nav.style.borderRight = "none";
   nav.style.backgroundColor = "unset";
   footer.style.display = "block";
}

/* GAME */
function displayGame() {
   document.body.scrollTop = 0;
   document.documentElement.scrollTop = 0;
   document.body.style.overflow = "unset";
   home.style.display = "none";
   all_games.style.display = "none";
   game.style.display = "grid";
   blog.style.display = "none";
   user.style.display = "none";
   contact.style.display = "none";
   bg_image.setAttribute('src', 'https://th.bing.com/th/id/OIP.vqPUCfFje_g0fJY110w3pgHaE8?w=251&h=180&c=7&r=0&o=5&pid=1.7');
   banner_img.setAttribute('src', 'https://www.youtube.com/embed/fKxG8KjH1Qg?si=my98frxNpfHw-9QW');
   nav.style.borderRight = "none";
   nav.style.backgroundColor = "unset";
   footer.style.display = "block";
}

/* BLOG */
function displayBlog() {
   document.body.scrollTop = 0;
   document.documentElement.scrollTop = 0;
   document.body.style.overflow = "unset";
   home.style.display = "none";
   all_games.style.display = "none";
   game.style.display = "none";
   blog.style.display = "flex";
   blog.style.flexDirection = "column";
   blog.style.alignItems = "center";
   blog_main.style.display = "none";
   bg_image.style.background = "#000";
   user.style.display = "none";
   contact.style.display = "none";
   bg_image.setAttribute("src", "");
   bg_image.style.background = "#000";
   banner_img.setAttribute("src", "");
   nav.style.borderRight = "1px solid rgba(255, 255, 255, 0.3)";
   nav.style.backgroundColor = "#000";
   footer.style.display = "none";
}

function displayBlogMain() {
   blog_main.style.display = "block";
   bg_image.style.background = "#111";
   document.body.style.overflow = "hidden";
}

function closeBlogMain() {
   blog_main.style.display = "none";
   bg_image.style.background = "#000";
   document.body.style.overflow = "unset";
}

/* USER */
function displayUser() {
   document.body.scrollTop = 0;
   document.documentElement.scrollTop = 0;
   document.body.style.overflow = "unset";
   home.style.display = "none";
   all_games.style.display = "none";
   game.style.display = "none";
   blog.style.display = "none";
   user.style.display = "grid";
   contact.style.display = "none";
   bg_image.setAttribute('src', 'https://th.bing.com/th/id/OIP.vqPUCfFje_g0fJY110w3pgHaE8?w=251&h=180&c=7&r=0&o=5&pid=1.7');
   banner_img.setAttribute('src', '');
   nav.style.borderRight = "none";
   nav.style.backgroundColor = "unset";
   footer.style.display = "block";
}

function displayProfile() {
   document.body.scrollTop = 0;
   document.documentElement.scrollTop = 0;
   document.body.style.overflow = "unset";
   profile.style.display = 'block';
   password.style.display = 'none';
   profile_button.classList.add('active');
   password_button.classList.remove('active');
}

function displayPassword() {
   document.body.scrollTop = 0;
   document.documentElement.scrollTop = 0;
   document.body.style.overflow = "unset";
   profile.style.display = 'none';
   password.style.display = 'block';
   profile_button.classList.remove('active');
   password_button.classList.add('active');
}

/* CONTACT */
function displayContact() {
   document.body.scrollTop = 0;
   document.documentElement.scrollTop = 0;
   document.body.style.overflow = "unset";
   home.style.display = "none";
   all_games.style.display = "none";
   game.style.display = "none";
   blog.style.display = "none";
   user.style.display = "none";
   contact.style.display = "block";
   bg_image.setAttribute('src', 'https://th.bing.com/th/id/OIP.vqPUCfFje_g0fJY110w3pgHaE8?w=251&h=180&c=7&r=0&o=5&pid=1.7');
   banner_img.setAttribute('src', '');
   nav.style.borderRight = "none";
   nav.style.backgroundColor = "unset";
   footer.style.display = "block";
}

/*=============== GAME PAGE ===============*/
/* GAME RATING */
var str = document.getElementById('game-rating').textContent;
str = str.replace(/(\d+)/g,function(a){return Array(+a+1).join('★')});
document.getElementById('game-rating').innerHTML = str;

/*=============== SIGNIN SIGNUP ===============*/
const modal = document.getElementById('user-modal'),
   bg_modal = document.getElementById('modal-background'),
   user_modal = document.getElementById('modal-container'),
   overlay_img = document.getElementById('overlay-image'),
   modal_close = document.getElementById('modal-close');

/* OPEN MODAL */
function openModal() {
   modal.style.zIndex = 'var(--z-login)'
   bg_modal.style.display = 'block';
   user_modal.classList.add('open-modal__container');
   user_modal.classList.remove('close-modal__container');
}

/* CLOSE MODAL */
function closeModal() {
   modal.style.zIndex = '-2'
   bg_modal.style.display = 'none';
   user_modal.classList.remove('open-modal__container');
   user_modal.classList.add('close-modal__container');
}

/* OPEN SIGNUP */
function signUp() {
   user_modal.classList.add('right-panel__active');
   overlay_img.src = 'https://i.pinimg.com/564x/c0/99/ac/c099ac0bb14e3fd693285cd28938ca76.jpg';
   modal_close.style.color = "#000";
};

/* OPEN SIGNIN */
function signIn() {
   user_modal.classList.remove('right-panel__active');
   overlay_img.src = 'https://i.pinimg.com/564x/c1/6e/3c/c16e3c093406cf65f93fe527244cec63.jpg';
   modal_close.style.color = "#fff";
};