<?php
require_once "php/utils.php";
$name = $email = "";
session_start();

if (isset($_SESSION['loggedin'])) {
    $id = $_SESSION['id_user'];
    $user = res_sql_query("select * from user where id = $id");
    $name = $user[0]['username'];
    $email = $user[0]['email'];

    $old_pwd = $new_pwd = $conf_pwd = "";
    $old_pwd = get_post("old_pwd");
    $new_pwd = get_post("new_pwd");
    $conf_pwd = get_post("conf_pwd");
    if (password_verify($old_pwd, $user[0]['password'])) {
        header('Location: admin.php');
        $pwd = hash_pwd($new_pwd);
        sql_query("update user set password = '$pwd' where id = $id");
    }
} else {
    $name = $name_email = "";
    $name = get_post('name');
    $email = get_post('email');
    $pwd = get_post('pwd');
    $name_email = get_post('name_email');

    if ($name != '') {
    $pwd = hash_pwd($pwd);
    sql_query("insert into user (username, email, password) values ('$name', '$email', '$pwd')");
    }

    if ($name_email != "") {
        $db_user = res_sql_query("select * from user where username = '$name_email' or email = '$name_email'");
        if (count($db_user) != 1) {
            $_SESSION['loggedin'] = false;
        } else {
            if (password_verify($pwd, $db_user[0]['password'])) {
                    $_SESSION['loggedin'] = true;
                    $_SESSION['id_user'] = $db_user[0]['id'];
            } else {
                    $_SESSION['loggedin'] = false;
            }
        }
    }
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

    <title>USER</title>
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
                <a class="nav__button" href="home.php">
                    <i class="ri-home-5-line"></i> <span>Home</span>
                </a>
            </li>

            <li class="nav__item">
                <a class="nav__button" href="allgames.html" id="button">
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
                    <img src="https://c8.alamy.com/compfr/eh9pfy/jeu-de-cartes-a-jouer-en-famille-au-picnic-eh9pfy.jpg" alt="" class="user__img me-3">
                    <div class="user__name"><?php echo "$name";?></div>
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

    <!--=============== USER  ===============-->
    <main class="main" id="user">
        <div class="row user m-5">
            <div class="col-sm-3 user__nav pt-5">
            <div class="user__infor">
                    <img src="https://c8.alamy.com/compfr/eh9pfy/jeu-de-cartes-a-jouer-en-famille-au-picnic-eh9pfy.jpg" alt="" class="user__img">
                    <h2 class="user__name my-3"><?php echo "$name";?></h2>
            </div>
            <ul class="nav__list ms-auto">
                <li class="nav__item">
                    <button class="user__button active" id="profile-button" onclick="displayProfile()">Profile</button>
                </li>
                <li class="nav__item">
                    <button class="user__button" id="password-button" onclick="displayPassword()">Password</button>
                </li>
            </ul>
            </div>
            <div class="col-sm-7 user__content mx-auto pb-5">
            <div class="user__profile" id="profile">
                    <h2 class="my-3">Profile</h2>
                    <div class="user__form mt-5">
                        <form action="">
                            <div class="row">
                                <div class="col-sm-5">
                                    <label>User Name:</label>
                                </div>
                                <div class="col-sm-7">
                                    <p><?php echo "$name";?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <label>Email:</label>
                                </div>
                                <div class="col-sm-7">
                                    <p><?php echo "$email";?></p>
                                </div>
                            </div>
                        </form>
                    </div>
            </div>
            <div class="user__password" id="password" style="display: none;">
                    <h2 class="my-3">Password</h2>
                    <div class="user__form mt-5">
                        <form method="post">
                            <div class="row mt-3">
                                <div class="col-sm-3">
                                    <label>Old password:</label>
                                </div>
                                <div class="col-sm-5">
                                    <input required name="old_pwd" type="text">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-3">
                                    <label>New password:</label>
                                </div>
                                <div class="col-sm-5">
                                    <input required name="new_pwd" type="text">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-3">
                                    <label>Confirm password:</label>
                                </div>
                                <div class="col-sm-5">
                                    <input required name="conf_pwd" type="text">
                                </div>
                            </div>
                            <button class="form__button mt-5">Change Password</button>
                        </form>
                    </div>
            </div>
            </div>
        </div>
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