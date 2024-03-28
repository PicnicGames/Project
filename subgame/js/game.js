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
      } else {
         contents[i].classList.remove('show__content');
      }
   }
}

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

/*=============== BUTTON ===============*/
const blog_main = document.getElementById('blog-main'),
      profile = document.getElementById('profile'),
      password = document.getElementById('password'),
      user_button = document.querySelectorAll('.user__button'),
      profile_button = document.getElementById('profile-button'),
      password_button = document.getElementById('password-button'); 

   user_button.forEach(user_button => {
      user_button.addEventListener('click', () => {
         document.querySelector('.active')?.classList.remove('active');
         user_button.classList.add('active');
      })
   })

/* BLOG */
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
function displayProfile() {
   document.body.scrollTop = 0;
   document.documentElement.scrollTop = 0;
   document.body.style.overflow = "unset";
   profile.style.display = 'block';
   password.style.display = 'none';
}

function displayPassword() {
   document.body.scrollTop = 0;
   document.documentElement.scrollTop = 0;
   document.body.style.overflow = "unset";
   profile.style.display = 'none';
   password.style.display = 'block';
}

/*=============== SIGNIN SIGNUP ===============*/
const modal = document.getElementById('user-modal'),
   bg_modal = document.getElementById('modal-background'),
   user_modal = document.getElementById('modal-container'),
   overlay_img = document.getElementById('overlay-image'),
   modal_close = document.getElementById('modal-close'),
   signin = document.getElementById('signin'),
   signup = document.getElementById('signup');

/* OPEN MODAL */
function openModal() {
   modal.style.zIndex = 'var(--z-login)';
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

/* OPEN SIGNUP MOBILE */
function signUpMb() {
   signin.style.opacity = "0";
   signin.style.zIndex = "0";
   signup.style.opacity = "1";
   signup.style.zIndex = "1";
};

/* OPEN SIGNIN MOBILE*/
function signInMb() {
   signin.style.opacity = "1";
   signin.style.opacity = "1";
   signup.style.opacity = "0";
   signup.style.zIndex = "0";
};

const register = document.getElementById('register'),
      registered = document.getElementById('registered'),
      logout = document.getElementById('logout');

function logIn() {
   register.style.display = "block";
   registered.style.display = "none";
   logout.style.display = "none";
}