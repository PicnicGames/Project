<?php
require_once "../admin/utils.php";
session_start();
session_destroy();

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
   sql_query("insert into user (username, email, password) values ('$name', '$email', '$pwd')");
}

if ($name_email != "") {
   $db_user = res_sql_query("select * from user where username = '$name_email' or email = '$name_email'");
   if (password_verify($pwd, $db_user[0]['password'])) {
      $_SESSION['loggedin'] = true;
      $_SESSION['id_user'] = $db_user[0]['id'];
   } else {
      $_SESSION['loggedin'] = false;
      echo"<script>alert('Wrong Information!!!');</script>";
   }
}

$game_choose = get_post('game_choose');
$game = res_sql_query("select * from game where id = $game_choose");
$id = $game[0]['id'];
$title = $game[0]['title'];

$add_fav = "";
$add_fav = get_post('add_fav');
if ($add_fav != "") {
    $id_user = $_SESSION['id_user'];
    $res = res_sql_query("select count(id_user) 'num' from favourite where id_game = $id and id_user = $id_user");
    if ($res[0]['num'] != 0) {
        sql_query("delete from favourite where id_game = $id and id_user = $id_user");
        sql_query("update game set favourite = favourite - 1 where id = $id");
        echo "
        <script>
            var like_button =document.getElementById('like-button');
            
            like_button.innerHTML = 'Favourited <i class='ri-heart-3-fill'></i>'
        </script>";
    } else {
        sql_query("insert into favourite (id_user, id_game) values ($id_user, $id)");
        sql_query("update game set favourite = favourite + 1 where id = $id");
        echo "
        <script>
            var like_button =document.getElementById('like-button');
            
            like_button.innerHTML = 'Favourite <i class='ri-heart-3-line'></i>'
        </script>";
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

    <title><?php echo $game[0]['title'];?></title>
</head>
<body id="body">
    <img src="https://c8.alamy.com/compfr/eh9pfy/jeu-de-cartes-a-jouer-en-famille-au-picnic-eh9pfy.jpg" alt="image" class="bg__image" id="bg-image">
    <div class="bg__blur"></div>
    
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <div class="header__content">
            <a href="home_none.php" class="header__logo">Picnic Play</a>

            <div class="header__nav">
                <div class="header__menu" id="header-menu">
                    <i class="ri-menu-fill"></i>
                </div>
            </div>
        </div>

        <form action="search_none.php" method="post" class="header__search">
            <i class="ri-search-line"></i>
            <input type="search" name="inp" placeholder="Search games . . ." class="header__input">
        </form>
    </header>

    <!--==================== NAV ====================-->
    <nav class="navigation" id="navigation">
        <div class="nav__menu">
            <a href="home_none.php" class="nav__logo">Picnic Play</a>

            <ul class="nav__list">
                <li class="nav__item">
                    <a class="nav__link" href="home_none.php">
                        <i class="ri-home-5-line"></i> <span>Home</span>
                    </a>
                </li>

                <li class="nav__item">
                    <a class="nav__link" href="allgames_none.php">
                        <i class="ri-gamepad-line"></i> <span>All Games</span>
                    </a>
                </li>

                <li class="nav__item">
                    <button class="nav__link" onclick="openModal()">
                        <i class="ri-heart-3-line"></i> <span>Favourites</span>
                    </button>
                </li>

                <li class="nav__item">
                    <a class="nav__link" href="blog_none.php">
                        <i class="ri-blogger-line"></i> <span>Blog</span>
                    </a>
                </li>

                <li class="nav__item">
                    <a class="nav__link" href="contact_none.php">
                        <i class="ri-contacts-line"></i> <span>Contact Us</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="nav__close" id="nav-close">
            <i class="ri-close-line"></i>
        </div>
    </nav>

    <!--==================== GAME ====================-->
    <main class="main" id="game">
        <h1 class="page__title"><a href="home_none.php" class="page__link">Home</a><span> / <?php echo $game[0]['title'];?></span></h1>
        
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
                        <span>
                            <?php
                            echo $game[0]['player'];
                            ?>
                        </span>
                        <span>
                            <?php
                            echo $game[0]['place'];
                            ?>
                        </span>
                    </div>
                    <div class="game__rating">
                        <h3 class="mt-3">Favorite: <?php
                        $res = res_sql_query("select count(id_user) 'num' from favourite where id_game = $id");
                        echo $res[0]['num'];
                        ?></h3>
                    </div>
                    <form action="game_none.php" method="post">
                        <input type="hidden" name="add_fav" value="1">
                        <input type="hidden" name="game_choose" value='<?php echo $id;?>'>
                        <?php
                            if (isset($_SESSION['id_user']) && $_SESSION['id_user'] != "") {
                                $id_user = $_SESSION['id_user'];
                                $game = res_sql_query("select * from favourite where id_user = $id_user and id_game = $game_choose");
                                if(count($game) != 0) {
                                    echo"<button type='submit' class='like__button mt-3' id='like-button'>
                                    Favourited
                                    <i class='ri-heart-3-fill'></i>
                                </button>";
                                } else {
                                    echo"<button type='submit' class='like__button mt-3' id='like-button'>
                                    Favourite
                                    <i class='ri-heart-3-line'></i>
                                </button>";
                                }
                            }
                        ?>
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
                    $str = str_replace("\n", "<br>" ,$game[0]['content']);
                    echo $str;
                    ?>
                </div>
            </div>
        </section>
    </main>

    <!--=============== SIGNIN SIGNUP ===============-->
   <div class="user__modal" id="user-modal">
      <div class="modal__background" id="modal-background" onclick="closeModal()" style="display: none;"></div>
      <div class="modal__container close-modal__container" id="modal-container">
         <button class="close__button" onclick="closeModal()">
            <i class="ri-close-line" id="modal-close"></i>
         </button>
         <div class="form__container signup__container" id="signup">
            <form method="post">
               <h2>Create Account</h2>
               <span>or use your email for registration</span>
               <input name="name" type="text" placeholder="Username">
               <input name="email" type="email" placeholder="Email">
               <input name="pwd" type="password" placeholder="Password">
               <span class="form__mobile mt-1" onclick="signInMb()">Already have an account? Sign In now!</span>
               <button type="submit">Sign Up</button>
            </form>
         </div>
         <div class="form__container signin__container" id="signin">
            <form method="post">
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
               <input name="name_email" type="text" placeholder="Username or Email">
               <input name="pwd" type="password" placeholder="Password">
               <a href="#">Forgot your password?</a>
               <span class="form__mobile mt-1" onclick="signUpMb()">Don't have an account? Sign Up now!</span>
               <button type="submit">Sign In</button>
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
    <footer class="footer">
        <div class="footer__container">
            <div class="footer__content">
                <h3 class="website-logo">Picnic Play</h3>
                <span class="footer-info">123414254614</span>
                <span class="footer-info">ajsdhf@loaishgfow.com</span>
            </div>

            <div class="footer__content">
                <span class="menu__title">Menu</span>
                <a href="home_none.php" class="menu__item">Home</a>
                <a href="allgames_none.php" class="menu__item">Games</a>
                <a href="contact_none.php" class="menu__item">Contact Us</a>
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