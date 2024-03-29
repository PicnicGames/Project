<?php
require_once "../admin/utils.php";
session_start();

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

    <title>GAMES</title>
</head>
<body id="body">
    <img src="https://c8.alamy.com/compfr/eh9pfy/jeu-de-cartes-a-jouer-en-famille-au-picnic-eh9pfy.jpg" class="bg__image"></img>
    <div class="bg__blur"></div>

    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <div class="header__content">
            <a href="home_user.php" class="header__logo">Picnic Play</a>

            <!-- NONE -->
            <div class="header__user">
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
                <a class="nav__link active" href="favourite_user.php">
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
                    <div class="user__name ms-3"><?php echo "$uname";?></div>
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

    <!--==================== FAVOURITE PAGE ====================-->
    <main class="main" id="all-games">
        <!--==================== GAMES ====================-->
        <section class="main__content">
            <h1 class="page__title"><a href="home_user.php" class="page__link">Home</a><span> / Family Games</span></h1>

            <?php
                $all_game = res_sql_query("select * from favourite order by id_game desc");

                for ($j = 0; $j < 2; $j++) {
                    echo "
                        <div class='row mb-3'>
                    ";
                    for ($i = $j*4; $i < min(count($all_game), $j*4+4); $i++) {
                        $row = $all_game[$i];
                        $id = $row["id"];
                        $row_img = $row["vertical_img"];
                        echo "
                        <article class='col-sm-3'>
                            <form action='' method='post'>
                                <input type='hidden' value='$id' name='game_choose'>
                                <button type='submit' class='card__link'>
                                    <img src='$row_img' alt='image' class='card__img'>
                                    <div class='card__shadow'></div>
                                    
                                    <div class='card__data'>
                                        <h3 class='card__name'>".$row['title']."</h3>
                                        <span class='card__category'>".$row['player']."</span>
                                        <span class='card__category'>".$row['place']."</span>
                                    </div>
                                    
                                    <i class='ri-heart-3-line card__like'></i>
                                </button>
                            </form>
                        </article>";
                    };
                    echo "
                        </div>
                    ";
                }

                for ($j = 2; $j < ceil(count($all_game) / 4); $j++) {
                    echo "
                        <div class='row mb-3 hide__content'>
                    ";
                    for ($i = $j*4; $i < min(count($all_game), $j*4+4); $i++) {
                        $row = $all_game[$i];
                        $id = $row["id"];
                        $row_img = $row["vertical_img"];
                        echo "
                        <article class='col-sm-3'>
                            <form action='' method='post'>
                                <input type='hidden' value='$id' name='game_choose'>
                                <button type='submit' class='card__link'>
                                    <img src='$row_img' alt='image' class='card__img'>
                                    <div class='card__shadow'></div>
                                    
                                    <div class='card__data'>
                                        <h3 class='card__name'>".$row['title']."</h3>
                                        <span class='card__category'>".$row['player']."</span>
                                        <span class='card__category'>".$row['place']."</span>
                                    </div>
                                    
                                    <i class='ri-heart-3-line card__like'></i>
                                </button>
                            </form>
                        </article>";
                    };
                    echo "
                        </div>
                    ";
                }
            ?>
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