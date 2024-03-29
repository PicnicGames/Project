<?php
require_once "php/utils.php";
session_start();
$game_choose = get_post('game_choose');
$game = res_sql_query("select * from game where id = $game_choose");
$id = $game[0]['id'];

$add_fav = "";
$add_fav = get_post('add_fav');
if ($add_fav != "" && isset($_SESSION['click_fav']) && $_SESSION['click_fav'] == 'none') {
    $res = res_sql_query("select * from favourite where id_game = $id");
    $flag = false;
    $user_id = $_SESSION['id_user'];
    sql_query("insert into favourite (id_user, id_game) values ($user_id, $id)");
    sql_query("update game set favourite = favourite + 1 where id = $id");
    $_SESSION['click_fav'] = 'clicked';
} else {
    $_SESSION['click_fav'] = 'none';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css">

    <!--=============== SWIPER CSS ===============-->
    <link rel="stylesheet" href="css/swiper-bundle.min.css">

    <!--=============== GAME CSS ===============-->
    <link rel="stylesheet" href="css/game.css">

    <!--=============== BOOTSTRAP ===============-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <title><?php echo $game[0]['title'];?></title>
</head>
<body id="body">
    <img src="https://c8.alamy.com/compfr/eh9pfy/jeu-de-cartes-a-jouer-en-famille-au-picnic-eh9pfy.jpg" alt="image" class="bg__image" id="bg-image">
    <div class="bg__blur"></div>
    
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <div class="header__content">
            <a href="index.html" class="header__logo">Picnic Play</a>

            <!-- NONE -->
            <div class="header__user">
            <div class="header__login" id="register">
                <button class="login__button" onclick="openModal()"><i class="ri-login-box-line"></i> <span>Log In</span></button>
            </div>

            <div class="header__menu" id="header-menu">
                <i class="ri-menu-fill"></i>
            </div>
            </div>
        </div>

        <form action="" class="header__search">
            <i class="ri-search-line"></i>
            <input type="search" placeholder="Search games or places . . ." class="header__input">
        </form>
    </header>

    <!--==================== NAV ====================-->
    <nav class="navigation" id="navigation">
        <div class="nav__menu">
            <a href="index.html" class="nav__logo">Picnic Play</a>

            <ul class="nav__list">
            <li class="nav__item">
                <a class="nav__button active" href="index.html">
                    <i class="ri-home-5-line"></i> <span>Home</span>
                </a>
            </li>

            <li class="nav__item">
                <a class="nav__button" href="allgames.html">
                    <i class="ri-gamepad-line"></i> <span>All Games</span>
                </a>
            </li>

            <li class="nav__item">
                <a class="nav__button" href="favorite.html">
                    <i class="ri-heart-3-line"></i> <span>Favorites</span>
                </a>
            </li>

            <li class="nav__item">
                <a class="nav__button" href="blog.html">
                    <i class="ri-blogger-line"></i> <span>Blog</span>
                </a>
            </li>

            <li class="nav__item">
                <a class="nav__button" href="contact.html">
                    <i class="ri-contacts-line"></i> <span>Contact</span>
                </a>
            </li>
            </ul>

            <!-- USER -->
            <div class="nav__user pt-3" id="registered">
            <a class="nav__button" href="user.html">
                <div class="user__container">
                    <img src="https://th.bing.com/th/id/OIP.vqPUCfFje_g0fJY110w3pgHaE8?w=251&h=180&c=7&r=0&o=5&pid=1.7" alt="" class="user__img me-3">
                    <div class="user__name">ADMIN</div>
                </div>
            </a>
            </div>
        </div>

        <button class="nav__button" id="logout" onclick="logOut()" style="display: none;">
            <i class="ri-logout-box-line"></i> <span>Log Out</span>
        </button>

        <div class="nav__close" id="nav-close">
            <i class="ri-close-line"></i>
        </div>
    </nav>

    <!--==================== GAME PAGE ====================-->
    <main class="main" id="game">
        <!--==================== GAME ====================-->
        <h1 class="game__tittle"><button onclick="displayHome()">Home</button><span> / </span><?php echo $game[0]['title'];?></h1>
        <section class="row">
            <article class="banner__card col-sm-7 mt-3">
            <?php
            $src = $game[0]['video'];
            echo "<iframe class='banner__img' id='banner-img' width='560' height='315' src='$src' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' allowfullscreen></iframe>";
            ?>
            </article>

            <article class="banner__card col-sm-5 mt-3">
            <div class="game__background">
                <div class="game__data">
                    <div class="game__desc">
                        <?php
                        echo $game[0]['description'];
                        ?>
                    </div>
                    <div class="game__catagory">
                        <button class="mx-auto">
                            <?php
                            echo $game[0]['player'];
                            ?>
                        </button>
                        <button class="mx-auto">
                            <?php
                            echo $game[0]['place'];
                            ?>
                        </button>
                    </div>
                    <div class="game__rating">
                        <h3 class="mt-3">Favorite: <?php echo $game[0]['favourite'];?></h3>
                    </div>
                    <form action="game.php" method="post">
                        <input type="hidden" name="add_fav" value="1">
                        <input type="hidden" name="game_choose" value='<?php echo $id;?>'>
                        <button type="submit" class="game__like__btn mt-3">
                            Favourite
                            <i class="ri-heart-3-line"></i>
                        </button>
                    </form>
                </div>
            </div>
            </article>
        </section>

        <!--==================== HOW TO PLAY ====================-->
        <section class="mt-3">
            <div class="game__background">
                <div class="game__content">
                    <?php
                    echo $game[0]['content'];
                    ?>
                </div>
            </div>
        </section>
    </main>

    <!--=============== SIGNIN SIGNUP ===============-->
    <div class="user__modal" id="user-modal">
        <div class="modal__background" id="modal-background" onclick="closeModal()" style="display: none;"></div>
        <div class="modal__container" id="modal-container">
            <button class="close__button" onclick="closeModal()">
            <i class="ri-close-line" id="modal-close"></i>
            </button>
            <div class="form__container signup__container" id="signup">
            <form action="#">
                <h2>Create Account</h2>
                <div class="social__container">
                    <a href="#" class="social">
                        <i class="ri-facebook-fill"></i>
                    </a>
                    <a href="#" class="social">
                        <i class="ri-google-fill"></i>
                    </a>
                </div>
                <span>or use your email for registration</span>
                <input type="text" placeholder="Username">
                <input type="email" placeholder="Email">
                <input type="password" placeholder="Password">
                <span class="form__mobile mt-1" onclick="signInMb()">Already have an account? Sign In now!</span>
                <button>Sign Up</button>
            </form>
            </div>
            <div class="form__container signin__container" id="signin">
            <form action="#">
                    <h2>Sign In</h2>
                    <div class="social__container">
                        <a href="#" class="social">
                        <i class="ri-facebook-fill"></i>
                        </a>
                        <a href="#" class="social">
                        <i class="ri-google-fill"></i>
                        </a>
                    </div>
                    <span>or use your account</span>
                    <input type="text" placeholder="Username or Email">
                    <input type="password" placeholder="Password">
                    <a href="#">Forgot your password?</a>
                    <span class="form__mobile mt-1" onclick="signUpMb()">Don't have an account? Sign Up now!</span>
                    <button onclick="logIn()">Sign In</button>
            </form>
            </div>
            <div class="overlay__container">
            <div class="overlay">
                <img src="https://i.pinimg.com/564x/c1/6e/3c/c16e3c093406cf65f93fe527244cec63.jpg" alt="" class="overlay__image" id="overlay-image">
                <div class="overlay__panel overlay__left">
                    <h1>Welcome to registration</h1>
                    <p class="italic">Already have an account</p>
                    <button class="ghost" id="signIn" onclick="signIn()">Sign In</button>

                </div>
                <div class="overlay__panel overlay__right">
                    <h1>Welcome</h1>
                    <p class="italic">Don't have an account?</p>
                    <button class="ghost" id="signUp" onclick="signUp()">Sign Up</button>
                </div>
            </div>
            </div>
        </div>
    </div>

    <!--=============== FOOTER  ===============-->
    <footer class="footer mt-5" id="footer">
        <div class="footer__container">
            <div class="footer__content">
            <h3 class="website-logo">Name</h3>
            <span class="footer-info">123414254614</span>
            <span class="footer-info">ajsdhf@loaishgfow.com</span>
            </div>
            <div class="footer__menu">
            <div class="footer__content">
                <span class="menu__title">Menu</span>
                <a href="#" class="menu__item">Home</a>
                <a href="#" class="menu__item">Course</a>
                <a href="#" class="menu__item">Testimonials</a>
            </div>
            <div class="footer__content">
                <span class="menu__title">legal</span>
                <a href="#" class="menu__item">Primary Policy</a>
                <a href="#" class="menu__item">Cookies</a>
                <a href="#" class="menu__item">Terms & Conditions</a>
            </div>
            </div>

            <div class="footer__content">
            <span class="menu__title">follow us</span>
            <div class="social-container">
                <a href="#" class="social__link"><i class="ri-facebook-circle-fill"></i></a>
                <a href="#" class="social__link"><i class="ri-instagram-fill"></i></a>
                <a href="#" class="social__link"><i class="ri-youtube-fill"></i></a>
                <a href="#" class="social__link"><i class="ri-tiktok-fill"></i></i></a>
            </div>
            </div>
        </div>
        <div class="copyright__container">
            <span class="copyright">&copy;2024, aksdfbo.com.</span>
        </div>
    </footer>

    <!--=============== SWIPER JS ===============-->
    <script src="js/swiper-bundle.min.js"></script>

    <!--=============== JS ===============-->
    <script src="js/game.js"></script>

    <script>
        const register = document.getElementById('register'),
            registered = document.getElementById('registered'),
            logout = document.getElementById('logout');

        function logIn() {
            register.style.display = "none";
            registered.style.display = "block";
        logout.style.display = "block";
        }
    </script>
</body>
</html>