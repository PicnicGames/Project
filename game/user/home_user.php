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

   <title>PICNIC PLAY</title>
</head>
<body id="body">
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

      <form action="" class="header__search">
         <i class="ri-search-line"></i>
         <input type="search" placeholder="Search games or places . . ." class="header__input">
      
         
      </header>
      
      <!--==================== NAV ====================-->
      <nav class="navigation" id="navigation">
         <div class="nav__menu">
            <a href="home_user.php" class="nav__logo">Picnic Play</a>
            
            <ul class="nav__list">
            </form>
         <li class="nav__item">
            <a class="nav__link active" href="home_user.php">
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

   <!--==================== DASHBOARD ====================-->
   <main class="main" id="home">
      <!--==================== BANNER ====================-->
      <section class="banner">
         <div class="banner__list">
            <article class="banner__card">
                <img src="https://his.gov.tr/uploads/__articles/large/mavi.jpg" alt="image" class="banner__img" id="banner-img">
            </article>
            <article class="banner__card">
               <img src="https://th.bing.com/th/id/R.31219dbff8c62b9470735fadf1bd2e92?rik=pAP6%2fwrpOR4Jiw&pid=ImgRaw&r=0" alt="image" class="banner__img" id="banner-img">
            </article>
            <article class="banner__card">
                <img src="https://th.bing.com/th/id/R.f79d13ff978ac51b4fed734e92c73b7f?rik=%2buh8rQ8naRGNtg&pid=ImgRaw&r=0" alt="image" class="banner__img" id="banner-img">
            </article>
            <article class="banner__card">
                <img src="https://www.debate.com.mx/__export/1428593810755/sites/debate/img/ahora/2015/04/09/imagen_imagen_dsc_0602.jpg_172596871.jpg" alt="image" class="banner__img" id="banner-img">
            </article>
            <article class="banner__card">
                <img src="https://th.bing.com/th/id/R.9856a99fb6dd0e4a92d7bbbae38a6d52?rik=0Y3s3Ekz7V6U9g&pid=ImgRaw&r=0" alt="image" class="banner__img" id="banner-img">
            </article>
            <article class="banner__card">
                <img src="https://th.bing.com/th/id/R.f5b62df24d2efb8d0e13d17d3963b969?rik=1Fljw0JV0CWxRg&pid=ImgRaw&r=0" alt="image" class="banner__img" id="banner-img">
            </article>
         </div>

         <div class="banner__button">
            <button id="prev"><i class="ri-arrow-left-wide-line"></i></button>
            <button id="next"><i class="ri-arrow-right-wide-line"></i></button>
         </div>

         <ul class="banner__dots">
            <li class="dot dot__active"></li>
            <li class="dot"></li>
            <li class="dot"></li>
            <li class="dot"></li>
            <li class="dot"></li>
            <li class="dot"></li>
         </ul>
      </section>

      <!--==================== TRENDING ====================-->
      <section class="main__content mb-3 hide__content show__content">
         <a href="trending_user.php" class="page__link">Trending</a>

         <div class="new__swiper swiper">
            <div class="swiper-wrapper">
               <?php
                  $top_game = res_sql_query("select * from game order by favourite, id desc");

                  for ($i = 0; $i < min(count($top_game), 6); $i++) {
                     $row = $top_game[$i];
                     $id = $row["id"];
                     $row_img = $row["vertical_img"];
                     echo "
                     <article class='new__card card__article swiper-slide'>
                        <form action='game_user.php' method='post'>
                           <input type='hidden' value='$id' name='game_choose'>
                           <button type='submit' class='card__link'>
                              <img src='$row_img' alt='image' class='card__img'>
                              <div class='card__shadow'></div>
                              
                              <div class='new__data card__data'>
                                 <h3 class='card__name'>".$row['title']."</h3>
                                 <span class='card__category'>".$row['player']."</span>
                                 <span class='card__category'>".$row['place']."</span>
                              </div>
                           </button>
                        </form>   
                     </article>";
                  }
               ?>
            </div>
         </div>

         <!-- Pagination -->
         <div class="swiper-pagination"></div>
      </section>

      <!--==================== GAMES ====================-->
      <section class="main__content mb-3 hide__content" id="family">
         <a href="family_user.php" class="page__link">Family</a>

         <div class="movie__swiper swiper">
            <div class="swiper-wrapper">
               <?php
                  $top_game = res_sql_query("select * from game where player = 'family' or player = 'everyone' order by id desc");

                  for ($i = 0; $i < min(count($top_game), 6); $i++) {
                     $row = $top_game[$i];
                     $id = $row["id"];
                     $row_img = $row["vertical_img"];
                     echo "
                     <article class='card__article swiper-slide'>
                        <form action='game_user.php' method='post'>
                           <input type='hidden' value='$id' name='game_choose'>
                           <button type='submit' class='card__link'>
                              <img src='$row_img' alt='image' class='card__img'>
                              <div class='card__shadow'></div>
                              
                              <div class='card__data'>
                                 <h3 class='card__name'>".$row['title']."</h3>
                                 <span class='card__category'>".$row['player']."</span>
                                 <span class='card__category'>".$row['place']."</span>
                              </div>
                           </button>
                        </form>   
                     </article>";
                  }
               ?>
            </div>
         </div>
      </section>

      <section class="main__content mb-3 hide__content">
         <a href="kid_user.php" class="page__link">Kid</a>

         <div class="movie__swiper swiper">
            <div class="swiper-wrapper">
               <?php
                  $top_game = res_sql_query("select * from game where player = 'kid' or player = 'everyone' order by id desc");

                  for ($i = 0; $i < min(count($top_game), 6); $i++) {
                     $row = $top_game[$i];
                     $id = $row["id"];
                     $row_img = $row["vertical_img"];
                     echo "
                     <article class='card__article swiper-slide'>
                        <form action='game_user.php' method='post'>
                           <input type='hidden' value='$id' name='game_choose'>
                           <button type='submit' class='card__link'>
                              <img src='$row_img' alt='image' class='card__img'>
                              <div class='card__shadow'></div>
                              
                              <div class='card__data'>
                                 <h3 class='card__name'>".$row['title']."</h3>
                                 <span class='card__category'>".$row['player']."</span>
                                 <span class='card__category'>".$row['place']."</span>
                              </div>
                           </button>
                        </form>   
                     </article>";
                  }
               ?>
            </div>
         </div>
      </section>

      <section class="main__content mb-3 hide__content">
         <a href="male_user.php" class="page__link">Male</a>

         <div class="movie__swiper swiper">
            <div class="swiper-wrapper">
               <?php
                  $top_game = res_sql_query("select * from game where player = 'male' or player = 'everyone' order by id desc");

                  for ($i = 0; $i < min(count($top_game), 6); $i++) {
                     $row = $top_game[$i];
                     $id = $row["id"];
                     $row_img = $row["vertical_img"];
                     echo "
                     <article class='card__article swiper-slide'>
                        <form action='game_user.php' method='post'>
                           <input type='hidden' value='$id' name='game_choose'>
                           <button type='submit' class='card__link'>
                              <img src='$row_img' alt='image' class='card__img'>
                              <div class='card__shadow'></div>
                              
                              <div class='card__data'>
                                 <h3 class='card__name'>".$row['title']."</h3>
                                 <span class='card__category'>".$row['player']."</span>
                                 <span class='card__category'>".$row['place']."</span>
                              </div>
                           </button>
                        </form>   
                     </article>";
                  }
               ?>
            </div>
         </div>
      </section>

      <section class="main__content mb-3 hide__content">
         <a href="female_user.php" class="page__link">Female</a>

         <div class="movie__swiper swiper">
            <div class="swiper-wrapper">
               <?php
                  $top_game = res_sql_query("select * from game where player = 'female' or player = 'everyone' order by id desc");

                  for ($i = 0; $i < min(count($top_game), 6); $i++) {
                     $row = $top_game[$i];
                     $id = $row["id"];
                     $row_img = $row["vertical_img"];
                     echo "
                     <article class='card__article swiper-slide'>
                        <form action='game_user.php' method='post'>
                           <input type='hidden' value='$id' name='game_choose'>
                           <button type='submit' class='card__link'>
                              <img src='$row_img' alt='image' class='card__img'>
                              <div class='card__shadow'></div>
                              
                              <div class='card__data'>
                                 <h3 class='card__name'>".$row['title']."</h3>
                                 <span class='card__category'>".$row['player']."</span>
                                 <span class='card__category'>".$row['place']."</span>
                              </div>
                           </button>
                        </form>   
                     </article>";
                  }
               ?>
            </div>
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