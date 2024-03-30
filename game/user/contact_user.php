<?php
require_once "../admin/utils.php";
session_start();

$fname = $lname = $email = $msg = "";
$fname = get_post('fname');
$lname = get_post('lname');
$email = get_post('email');
$msg = get_post('msg');

if ($email != "") {
    sql_query("insert into contact (first_name, last_name, email, content) values ('$fname','$lname','$email','$msg')");
}

$name = $name_email = $uname = "";
$name = get_post('name');
$email = get_post('email');
$pwd = get_post('pwd');
$name_email = get_post('name_email');

if (isset($_SESSION['id_user'])) {
   $id = $_SESSION['id_user'];
   $user = res_sql_query("select * from user where id = $id");
   $uname = $user[0]['username'];
}

if ($name != '') {
   $pwd = hash_pwd($pwd);
   $cur_time = date('Y-m-d H:i:s');
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

    <title>CONTACT</title>
</head>
<body id="body">
    <img src="https://c8.alamy.com/compfr/eh9pfy/jeu-de-cartes-a-jouer-en-famille-au-picnic-eh9pfy.jpg" alt="image" class="bg__image" id="bg-image">
    <div class="bg__blur"></div>
    
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <div class="header__content">
            <a href="home_user.php" class="header__logo">Picnic Play</a>

            <div class="header__nav">
                <a class="nav__link" href="user_user.php">
                <div class="header__user">
                    <i class="ri-user-line"></i>
                    <div class="user__name ms-3"><?php echo "$uname";?></div>
                </div>
                </a>

                <div class="header__menu" id="header-menu">
                <i class="ri-menu-fill"></i>
                </div>
         </div>
        </div>

        <form action="search_user.php" method="post" class="header__search">
            <i class="ri-search-line"></i>
            <input type="search" name="inp" placeholder="Search games . . ." class="header__input">
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
                <a class="nav__link active" href="contact_user.php">
                    <i class="ri-contacts-line"></i> <span>Contact Us</span>
                </a>
            </li>
            </ul>
        </div>

        <a href="../none/home_none.php" class="nav__link">
            <i class="ri-logout-box-line"></i> <span>Log Out</span>
        </a>

        <div class="nav__close" id="nav-close">
            <i class="ri-close-line"></i>
        </div>
    </nav>

    <!--==================== CONTACT ====================-->
    <main class="main" id="contact">
        <h1 class="page__title"><a href="home_user.php" class="page__link">Home</a><span> / Contact Us</span></h1>
        <section class="contact__container">
            <div class="contact__map me-5">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29797.920264509758!2d105.82973073919662!3d21.003055517035317!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac428c3336e5%3A0xb7d4993d5b02357e!2sAptech%20Computer%20Education!5e0!3m2!1svi!2s!4v1711421403758!5m2!1svi!2s" width="500" height="550" style="border:0; border-radius: 1rem;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="contact__content">
            <div class="contact__header">
                    <h1 class="contact__heading">contact us</h1>
            </div>

            <form method="post">
                <div class="contact__body">
                    <div class="row my-3">
                    <div class="col px-0 me-3 contact__input">
                            <input required name="fname" type="text" placeholder="First Name">
                            <i class="ri-id-card-line"></i>
                    </div>
                    <div class="col px-0 contact__input">
                            <input required name="lname" type="text" placeholder="Last Name">
                            <i class="ri-id-card-line"></i>
                    </div>
                    </div>
                    <div class="row my-3 contact__input">
                    <input required name="email" type="email" placeholder="Email">
                    <span><i class="ri-mail-line"></i></span>
                    </div>
                    <div class="row my-3 contact__input">
                    <textarea required name="msg" name="" id="" cols="30" rows="8" placeholder="Message"></textarea>
                    <span><i class="ri-inbox-line"></i></span>
                    </div>
                </div>
                
                <div class="contact__footer row">
                    <button type="submit">Send</button>
                </div>
            </form>
            </div>
        </section>
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
                <a href="home_user.php" class="menu__item">Home</a>
                <a href="allgames_user.php" class="menu__item">Games</a>
                <a href="contact_user.php" class="menu__item">Contact Us</a>
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