<?php
require_once "../admin/utils.php";
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
    if ($old_pwd != "") {
        if (password_verify($old_pwd, $user[0]['password'])) {
            header('Location: admin.php');
            $pwd = hash_pwd($new_pwd);
            sql_query("update user set password = '$pwd' where id = $id");
        }
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
        if (password_verify($pwd, $db_user[0]['password'])) {
           $_SESSION['loggedin'] = true;
           $_SESSION['id_user'] = $db_user[0]['id'];
        } else {
           $_SESSION['loggedin'] = false;
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
    <link rel="stylesheet" href="../css/swiper-bundle.min.css">

    <!--=============== GAME CSS ===============-->
    <link rel="stylesheet" href="../css/game.css">

    <!--=============== BOOTSTRAP ===============-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <title>USER</title>
</head>
<body>
    <img src="https://c8.alamy.com/compfr/eh9pfy/jeu-de-cartes-a-jouer-en-famille-au-picnic-eh9pfy.jpg" class="bg__image"></img>
    <div class="bg__blur"></div>
    
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <div class="header__content">
            <a href="home_user.php" class="header__logo">Picnic Play</a>

            <div class="header__user">
                <div class="header__menu" id="header-menu">
                    <i class="ri-menu-fill"></i>
                </div>
            </div>
        </div>

        <form action="search_user.php" class="header__search">
            <i class="ri-search-line"></i>
            <input type="search" placeholder="Search games or places . . ." class="header__input">
        </form>
    </header>

    <!--==================== NAV ====================-->
    <nav class="navigation" id="navigation">
        <div class="nav__menu">
            <a href="home_user.php" class="nav__logo">Picnic Play</a>

            <ul class="nav__list">
            <li class="nav__item">
                <a class="nav__link" href="home_user.php">
                    <i class="ri-home-5-line"></i> <span>Home</span>
                </a>
            </li>

            <li class="nav__item">
                <a class="nav__link" href="allgames_user.php">
                    <i class="ri-gamepad-line"></i> <span>All Games</span>
                </a>
            </li>

            <li class="nav__item">
                <a class="nav__link" href="favourite_user.php">
                    <i class="ri-heart-3-line"></i> <span>Favourites</span>
                </a>
            </li>

            <li class="nav__item">
                <a class="nav__link" href="blog_user.php">
                    <i class="ri-blogger-line"></i> <span>Blog</span>
                </a>
            </li>

            <li class="nav__item">
                <a class="nav__link" href="contact_user.php">
                    <i class="ri-contacts-line"></i> <span>Contact Us</span>
                </a>
            </li>
            </ul>

            <!-- USER -->
            <div class="nav__user pt-3">
                <a class="nav__link" href="user_user.php">
                    <div class="user__container">
                        <i class="ri-user-line"></i>
                        <div class="user__name ms-3"><?php echo "$name";?></div>
                    </div>
                </a>
            </div>
        </div>

        <a href="../none/home_none.php" class="nav__link">
            <i class="ri-logout-box-line"></i> <span>Log Out</span>
        </a>

        <div class="nav__close" id="nav-close">
            <i class="ri-close-line"></i>
        </div>
    </nav>

    <!--=============== USER  ===============-->
    <main class="main" id="user">
        <h1 class="page__title"><a href="home_user.php" class="page__link">Home</a><span> / User</span></h1>
        <div class="row user mx-5">
            <div class="col-sm-3 user__nav pt-5">
                <div class="user__infor">
                    <img src="https://static.vecteezy.com/system/resources/previews/002/318/271/non_2x/user-profile-icon-free-vector.jpg" alt="" class="user__img">
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
                                <div class="row mt-3">
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

    <!--=============== FOOTER  ===============-->
    <footer class="footer">
        <div class="footer__container">
            <div class="footer__content">
                <h3 class="website-logo">Picnic Play</h3>
                <span class="footer-info">123414254614</span>
                <span class="footer-info">ajsdhf@loaishgfow.com</span>
            </div>

            <div class="footer__content">
                <span class="menu__title">Menu</span>
                <a href="#" class="menu__item">Home</a>
                <a href="#" class="menu__item">Game</a>
                <a href="#" class="menu__item">Contact Us</a>
            </div>

            <div class="footer__content">
                <span class="menu__title">legal</span>
                <a href="#" class="menu__item">Primary Policy</a>
                <a href="#" class="menu__item">Cookies</a>
                <a href="#" class="menu__item">Terms & Conditions</a>
            </div>

            <div class="footer__content">
                <span class="menu__title">follow us</span>
                <div class="social-container">
                <a href="#" class="social__link"><i class="ri-facebook-circle-fill"></i></a>
                <a href="#" class="social__link"><i class="ri-instagram-fill"></i></a>
                <a href="#" class="social__link"><i class="ri-youtube-fill"></i></a>
                <a href="#" class="social__link"><i class="ri-tiktok-fill"></i></a>
                </div>
            </div>
        </div>

        <div class="copyright__container">
            <span class="copyright">&copy;2024, aksdfbo.com.</span>
        </div>
    </footer>

    <!--=============== SWIPER JS ===============-->
    <script src="../js/swiper-bundle.min.js"></script>

    <!--=============== JS ===============-->
    <script src="../js/game.js"></script>
</body>
</html>