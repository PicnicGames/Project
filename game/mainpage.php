<?php
require_once "php/utils.php";
session_start();

$name = $email = $pwd = $name_email = "";
$name = get_post("name");
$email = get_post("email");
$pwd = get_post("pwd");
$name_email = get_post("name_email");

if ($name != "") {
   $cur_time = date("Y-m-d H:i:s");
   $pwd = hash_pwd($pwd);
   $data = res_sql_query("select * from user where email = '$email'");
   if (count($data) == 0) {
      $sql = "insert into user (username, email, password, created_at) values ('$name','$email','$pwd','$cur_time')";
      sql_query($sql);
   }
}

if ($name_email != "") {
   $data = res_sql_query("select * from user where email = '$name_email' or username = '$name_email'");

   if (password_verify($pwd, $data[0]['pwd'])) {
      $_SESSION['loggedin'] = true;
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
      <title>GAME</title>
   </head>
   <body id="body">
      <img src="/Assets/background_img/_3fa7c2cc-6397-44bd-abf5-74fb81d07c23.jpg" alt="image" class="bg__image" id="bg-image">
      <div class="bg__blur"></div>
      
      <!--==================== HEADER ====================-->
      <header class="header" id="header">
         <div class="header__content">
            <div href="#" class="header__logo">LOGO</div>

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
            <div class="nav__logo">LOGO</div>

            <ul class="nav__list">
               <li class="nav__item">
                  <button class="nav__button active" onclick="displayHome()">
                     <i class="ri-home-5-line"></i> <span>Home</span>
                  </button>
               </li>

               <li class="nav__item">
                  <button class="nav__button" id="button" onclick="displayAllGames()">
                     <i class="ri-gamepad-line"></i> <span>All Games</span>
                  </button>
               </li>

               <li class="nav__item">
                  <button class="nav__button" onclick="displayAllGames()">
                     <i class="ri-heart-3-line"></i> <span>Favorites</span>
                  </button>
               </li>

               <li class="nav__item">
                  <button class="nav__button" onclick="displayBlog()">
                     <i class="ri-blogger-line"></i> <span>Blog</span>
                  </button>
               </li>

               <li class="nav__item">
                  <button class="nav__button" onclick="displayContact()">
                     <i class="ri-contacts-line"></i> <span>Contact</span>
                  </button>
               </li>
            </ul>

            <!-- USER -->
            <div class="nav__user pt-3" id="registered" style="display: none;">
               <button onclick="displayUser()">
                  <div class="user__container">
                     <img src="https://th.bing.com/th/id/OIP.vqPUCfFje_g0fJY110w3pgHaE8?w=251&h=180&c=7&r=0&o=5&pid=1.7" alt="" class="user__img me-3">
                     <div class="user__name">ADMIN</div>
                  </div>
               </button>
            </div>
         </div>

         <button class="nav__button" id="logout" onclick="logOut()" style="display: none;">
            <i class="ri-logout-box-line"></i> <span>Log Out</span>
         </button>

         <div class="nav__close" id="nav-close">
            <i class="ri-close-line"></i>
         </div>
      </nav>

      <!--==================== DASHBOARD ====================-->
      <main class="main" id="home">
         <!--==================== BANNER ====================-->
         <section class="banner">
            <article class="banner__card">
               <?php
               $sql = "select * from game order by (select count(id_user) from savedgame, game where id = id_game) desc";
               $res = res_sql_query($sql);
               $_POST['top_game'] = $res;
               $top = $res[0];
               $top_img = $top["horizontal_img"];
               $top_name = $top["title"];
               $top_type = $top["type"];
               echo "<img src='$top_img' alt='image' class='banner__img'>
               <div class='banner__shadow'></div>

               <div class='banner__data'>
                  <h2 class='banner__title'>$top_name</h2>
                  <span class='banner__category'>$top_type</span>
               </div>";
               ?>
            </article>
         </section>

         <!--==================== TRENDING ====================-->
         <section class="main__content">
            <button type="submit" value="Trending" class="card__title" onclick="displayAllGames()">Trending</button>

            <div class="new__swiper swiper">
               <div class="swiper-wrapper">
                  <article class="new__card card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                        <?php
                           $top1 = $_POST['top_game'][0];
                           $top1_img = $top1["vertical_img"];
                           $top1_name = $top1["title"];
                           $top1_type = $top1["type"];
                           echo "
                           <img src='$top1_img' alt='image' class='card__img'>
                           <div class='card__shadow'></div>
      
                           <div class='new__data card__data'>
                              <h3 class='card__name'>$top1_name</h3>
                              <span class='card__category'>$top1_type</span>
                           </div>";
                        ?>
                     </button>
                  </article>

                  <article class="new__card card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                        <?php
                           $top2 = $_POST['top_game'][1];
                           $top2_img = $top2["vertical_img"];
                           $top2_name = $top2["title"];
                           $top2_type = $top2["type"];
                           echo "
                           <img src='$top2_img' alt='image' class='card__img'>
                           <div class='card__shadow'></div>
      
                           <div class='new__data card__data'>
                              <h3 class='card__name'>$top2_name</h3>
                              <span class='card__category'>$top2_type</span>
                           </div>";
                        ?>
                     </button>
                  </article>

                  <article class="new__card card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                     <?php
                           $top3 = $_POST['top_game'][2];
                           $top3_img = $top3["vertical_img"];
                           $top3_name = $top3["title"];
                           $top3_type = $top3["type"];
                           echo "
                           <img src='$top3_img' alt='image' class='card__img'>
                           <div class='card__shadow'></div>
      
                           <div class='new__data card__data'>
                              <h3 class='card__name'>$top3_name</h3>
                              <span class='card__category'>$top3_type</span>
                           </div>";
                        ?>
                     </button>
                  </article>

                  <article class="new__card card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                     <?php
                           $top4 = $_POST['top_game'][3];
                           $top4_img = $top4["vertical_img"];
                           $top4_name = $top4["title"];
                           $top4_type = $top4["type"];
                           echo "
                           <img src='$top4_img' alt='image' class='card__img'>
                           <div class='card__shadow'></div>
      
                           <div class='new__data card__data'>
                              <h3 class='card__name'>$top4_name</h3>
                              <span class='card__category'>$top4_type</span>
                           </div>";
                        ?>
                     </button>
                  </article>

                  <article class="new__card card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                     <?php
                           $top5 = $_POST['top_game'][4];
                           $top5_img = $top5["vertical_img"];
                           $top5_name = $top5["title"];
                           $top5_type = $top5["type"];
                           echo "
                           <img src='$top5_img' alt='image' class='card__img'>
                           <div class='card__shadow'></div>
      
                           <div class='new__data card__data'>
                              <h3 class='card__name'>$top5_name</h3>
                              <span class='card__category'>$top5_type</span>
                           </div>";
                        ?>
                     </button>
                  </article>
                  
                  <article class="new__card card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                     <?php
                           $top6 = $_POST['top_game'][5];
                           $top6_img = $top6["vertical_img"];
                           $top6_name = $top6["title"];
                           $top6_type = $top6["type"];
                           echo "
                           <img src='$top6_img' alt='image' class='card__img'>
                           <div class='card__shadow'></div>
      
                           <div class='new__data card__data'>
                              <h3 class='card__name'>$top6_name</h3>
                              <span class='card__category'>$top6_type</span>
                           </div>";
                        ?>
                     </button>
                  </article>
               </div>
            </div>

            <!-- Pagination -->
            <div class="swiper-pagination"></div>
         </section>

         <!--==================== GAMES ====================-->
         <section class="main__content">
            <button type="submit" value="Family" class="card__title" onclick="displayAllGames()">Family</button>

            <div class="movie__swiper swiper">
               <div class="swiper-wrapper">
                  <?php
                     for ($i = 0; $i<count($_POST['top_game']); $i++) {
                        $row = $_POST['top_game'][$i];
                        $tmp_img = $row['vertical_img'];
                        $tmp_name = $row['vertical_img'];
                        $tmp_type = $row['vertical_img'];
                        echo "<article class='card__article swiper-slide'>
                        <button class='card__link' onclick='displayGame()''>
                           <img src='$tmp_img' alt='image' class='card__img'>
                           <div class='card__shadow'></div>
      
                           <div class='card__data'>
                              <h3 class='card__name'>$tmp_name</h3>
                              <span class='card__category'>$tmp_type</span>
                           </div>
      
                           <i class='ri-heart-3-line card__like'></i>
                        </button>
                     </article>
                        ";
                     }
                  ?>
               </div>
            </div>
         </section>

         <section class="main__content">
            <button type="submit" value="Kid" class="card__title" onclick="displayAllGames()">Kid</button>

            <div class="movie__swiper swiper">
               <div class="swiper-wrapper">
                  <article class="card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                        <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                        <div class="card__shadow"></div>
   
                        <div class="card__data">
                           <h3 class="card__name">Chess</h3>
                           <span class="card__category">Tactic</span>
                        </div>
   
                        <i class="ri-heart-3-line card__like"></i>
                     </button>
                  </article>

                  <article class="card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                        <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                        <div class="card__shadow"></div>
   
                        <div class="card__data">
                           <h3 class="card__name">Chess</h3>
                           <span class="card__category">Tactic</span>
                        </div>
   
                        <i class="ri-heart-3-line card__like"></i>
                     </button>
                  </article>

                  <article class="card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                        <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                        <div class="card__shadow"></div>
   
                        <div class="card__data">
                           <h3 class="card__name">Chess</h3>
                           <span class="card__category">Tactic</span>
                        </div>
   
                        <i class="ri-heart-3-line card__like"></i>
                     </button>
                  </article>

                  <article class="card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                        <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                        <div class="card__shadow"></div>
   
                        <div class="card__data">
                           <h3 class="card__name">Chess</h3>
                           <span class="card__category">Tactic</span>
                        </div>
   
                        <i class="ri-heart-3-line card__like"></i>
                     </button>
                  </article>

                  <article class="card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                        <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                        <div class="card__shadow"></div>
   
                        <div class="card__data">
                           <h3 class="card__name">Chess</h3>
                           <span class="card__category">Tactic</span>
                        </div>
   
                        <i class="ri-heart-3-line card__like"></i>
                     </button>
                  </article>
                   
                  <article class="card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                        <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                        <div class="card__shadow"></div>
   
                        <div class="card__data">
                           <h3 class="card__name">Chess</h3>
                           <span class="card__category">Tactic</span>
                        </div>
   
                        <i class="ri-heart-3-line card__like"></i>
                     </button>
                  </article>
               </div>
            </div>
         </section>

         <section class="main__content">
            <button type="submit" value="Male" class="card__title" onclick="displayAllGames()">Male</button>

            <div class="movie__swiper swiper">
               <div class="swiper-wrapper">
                  <article class="card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                        <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                        <div class="card__shadow"></div>
   
                        <div class="card__data">
                           <h3 class="card__name">Chess</h3>
                           <span class="card__category">Tactic</span>
                        </div>
   
                        <i class="ri-heart-3-line card__like"></i>
                     </button>
                  </article>

                  <article class="card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                        <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                        <div class="card__shadow"></div>
   
                        <div class="card__data">
                           <h3 class="card__name">Chess</h3>
                           <span class="card__category">Tactic</span>
                        </div>
   
                        <i class="ri-heart-3-line card__like"></i>
                     </button>
                  </article>

                  <article class="card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                        <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                        <div class="card__shadow"></div>
   
                        <div class="card__data">
                           <h3 class="card__name">Chess</h3>
                           <span class="card__category">Tactic</span>
                        </div>
   
                        <i class="ri-heart-3-line card__like"></i>
                     </button>
                  </article>

                  <article class="card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                        <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                        <div class="card__shadow"></div>
   
                        <div class="card__data">
                           <h3 class="card__name">Chess</h3>
                           <span class="card__category">Tactic</span>
                        </div>
   
                        <i class="ri-heart-3-line card__like"></i>
                     </button>
                  </article>

                  <article class="card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                        <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                        <div class="card__shadow"></div>
   
                        <div class="card__data">
                           <h3 class="card__name">Chess</h3>
                           <span class="card__category">Tactic</span>
                        </div>
   
                        <i class="ri-heart-3-line card__like"></i>
                     </button>
                  </article>
                   
                  <article class="card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                        <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                        <div class="card__shadow"></div>
   
                        <div class="card__data">
                           <h3 class="card__name">Chess</h3>
                           <span class="card__category">Tactic</span>
                        </div>
   
                        <i class="ri-heart-3-line card__like"></i>
                     </button>
                  </article>
               </div>
            </div>
         </section>

         <section class="main__content">
            <button type="submit" value="Female" class="card__title" onclick="displayAllGames()">Female</button>

            <div class="movie__swiper swiper">
               <div class="swiper-wrapper">
                  <article class="card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                        <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                        <div class="card__shadow"></div>
   
                        <div class="card__data">
                           <h3 class="card__name">Chess</h3>
                           <span class="card__category">Tactic</span>
                        </div>
   
                        <i class="ri-heart-3-line card__like"></i>
                     </button>
                  </article>

                  <article class="card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                        <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                        <div class="card__shadow"></div>
   
                        <div class="card__data">
                           <h3 class="card__name">Chess</h3>
                           <span class="card__category">Tactic</span>
                        </div>
   
                        <i class="ri-heart-3-line card__like"></i>
                     </button>
                  </article>

                  <article class="card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                        <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                        <div class="card__shadow"></div>
   
                        <div class="card__data">
                           <h3 class="card__name">Chess</h3>
                           <span class="card__category">Tactic</span>
                        </div>
   
                        <i class="ri-heart-3-line card__like"></i>
                     </button>
                  </article>

                  <article class="card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                        <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                        <div class="card__shadow"></div>
   
                        <div class="card__data">
                           <h3 class="card__name">Chess</h3>
                           <span class="card__category">Tactic</span>
                        </div>
   
                        <i class="ri-heart-3-line card__like"></i>
                     </button>
                  </article>

                  <article class="card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                        <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                        <div class="card__shadow"></div>
   
                        <div class="card__data">
                           <h3 class="card__name">Chess</h3>
                           <span class="card__category">Tactic</span>
                        </div>
   
                        <i class="ri-heart-3-line card__like"></i>
                     </button>
                  </article>
                   
                  <article class="card__article swiper-slide">
                     <button class="card__link" onclick="displayGame()">
                        <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                        <div class="card__shadow"></div>
   
                        <div class="card__data">
                           <h3 class="card__name">Chess</h3>
                           <span class="card__category">Tactic</span>
                        </div>
   
                        <i class="ri-heart-3-line card__like"></i>
                     </button>
                  </article>
               </div>
            </div>
         </section>
      </main>

      <!--==================== ALL GAMES PAGE ====================-->
      <main class="main" id="all-games" style="display: none;">
         <!--==================== BANNER ====================-->
         <section class="banner">
            <article class="banner__card">
               <img src="https://th.bing.com/th/id/OIP.vqPUCfFje_g0fJY110w3pgHaE8?w=251&h=180&c=7&r=0&o=5&pid=1.7" alt="image" class="banner__img">
               <div class="banner__shadow"></div>

               <div class="banner__data">
                  <h2 class="banner__title">Trending</h2>
                  <span class="banner__category">Treding games right now!</span>
               </div>
            </article>
         </section>

         <!--==================== GAMES ====================-->
         <section class="main__content">
            <button type="submit" value="Family" class="card__title" onclick="displayAllGames()">Trending</button>

            <div class="row">
               <article class="col-sm mb-5">
                  <button class="card__link" onclick="displayGame()">
                     <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                     <div class="card__shadow"></div>

                     <div class="card__data">
                        <h3 class="card__name">Chess</h3>
                        <span class="card__category">Tactic</span>
                     </div>

                     <i class="ri-heart-3-line card__like"></i>
                  </button>
               </article>

               <article class="col-sm mb-5">
                  <button class="card__link" onclick="displayGame()">
                     <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                     <div class="card__shadow"></div>

                     <div class="card__data">
                        <h3 class="card__name">Chess</h3>
                        <span class="card__category">Tactic</span>
                     </div>

                     <i class="ri-heart-3-line card__like"></i>
                  </button>
               </article>

               <article class="col-sm mb-5">
                  <button class="card__link" onclick="displayGame()">
                     <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                     <div class="card__shadow"></div>

                     <div class="card__data">
                        <h3 class="card__name">Chess</h3>
                        <span class="card__category">Tactic</span>
                     </div>

                     <i class="ri-heart-3-line card__like"></i>
                  </button>
               </article>

               <article class="col-sm mb-5">
                  <button class="card__link" onclick="displayGame()">
                     <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                     <div class="card__shadow"></div>

                     <div class="card__data">
                        <h3 class="card__name">Chess</h3>
                        <span class="card__category">Tactic</span>
                     </div>

                     <i class="ri-heart-3-line card__like"></i>
                  </button>
               </article>
            </div>

            <div class="row">
               <article class="col-sm mb-5">
                  <button class="card__link" onclick="displayGame()">
                     <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                     <div class="card__shadow"></div>

                     <div class="card__data">
                        <h3 class="card__name">Chess</h3>
                        <span class="card__category">Tactic</span>
                     </div>

                     <i class="ri-heart-3-line card__like"></i>
                  </button>
               </article>

               <article class="col-sm mb-5">
                  <button class="card__link" onclick="displayGame()">
                     <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                     <div class="card__shadow"></div>

                     <div class="card__data">
                        <h3 class="card__name">Chess</h3>
                        <span class="card__category">Tactic</span>
                     </div>

                     <i class="ri-heart-3-line card__like"></i>
                  </button>
               </article>

               <article class="col-sm mb-5">
                  <button class="card__link" onclick="displayGame()">
                     <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                     <div class="card__shadow"></div>

                     <div class="card__data">
                        <h3 class="card__name">Chess</h3>
                        <span class="card__category">Tactic</span>
                     </div>

                     <i class="ri-heart-3-line card__like"></i>
                  </button>
               </article>

               <article class="col-sm mb-5">
                  <button class="card__link" onclick="displayGame()">
                     <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="image" class="card__img">
                     <div class="card__shadow"></div>

                     <div class="card__data">
                        <h3 class="card__name">Chess</h3>
                        <span class="card__category">Tactic</span>
                     </div>

                     <i class="ri-heart-3-line card__like"></i>
                  </button>
               </article>
            </div>
         </section>
      </main>

      <!--==================== GAME PAGE ====================-->
      <main class="main" id="game" style="display: none;">
         <!--==================== GAME ====================-->
         <h1 class="game__tittle"><button onclick="displayHome()">Home</button><span> / </span>Chess</h1>
         <section class="row">
            <article class="banner__card col-sm-7 mt-3">
               <iframe class="banner__img" id="banner-img" width="560" height="315" src="https://www.youtube.com/embed/fKxG8KjH1Qg?si=my98frxNpfHw-9QW" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </article>

            <article class="banner__card col-sm-5 mt-3">
               <div class="game__background">
                  <div class="game__data">
                     <div class="game__desc">Chess is a two-player game with the goal of checkmating the opponent's king. It has roots in 7th-century India and modern rules were standardized in the 19th century. It's globally popular and also known as international or Western chess to differentiate it from similar games like xiangqi and shogi.</div>
                     <div class="game__catagory">
                        <button class="mx-auto">Strategy</button>
                        <button class="mx-auto">Everyone</button>
                        <button class="mx-auto">Everywhere</button>
                     </div>
                     <div class="game__rating">
                        <h3 id="game-rating">Game Rating: 5</h3>
                        <h3 class="mt-3">Favorite: 1K</h3>
                     </div>
                     <button class="game__like__btn mt-3">
                        Favourite
                        <i class="ri-heart-3-line"></i>
                     </button>
                  </div>
               </div>
            </article>
         </section>

         <!--==================== HOW TO PLAY ====================-->
         <section class="mt-3">
             <div class="game__background">
                 <div class="game__content">
                     Sure, here are the basic steps to play chess:
                     <br><br>
                     1. **Set Up The Chess Board**: Each player has the white (or light) color square in the bottom right-hand side. The second row is filled with pawns. The rooks go in the corners, then the knights next to them, followed by the bishops, and finally the queen (white queen on white, black queen on black), and the king on the remaining square¹.
                     <br>
                     2. **Move The Pieces**: Each of the 6 different kinds of pieces moves differently. Pieces cannot move through other pieces (though the knight can jump over other pieces), and can never move onto a square with one of their own pieces. However, they can be moved to take the place of an opponent's piece which is then captured¹.
                     <br>
                     3. **Special Rules**: Learn the special rules like castling, pawn promotion, and en passant¹.
                     <br>
                     4. **First Move**: White always moves first³.
                     <br>
                     5. **Winning the Game**: The goal of chess is to checkmate your opponent's king. This means the opponent's king is in a position to be captured (in "check") and there is no way to remove the threat of capture on the next move².
                     <br>
                     6. **Basic Strategies**: Practice and learn some basic strategies. This includes understanding the value of each piece, controlling the center of the board, protecting your king, and knowing when to trade pieces¹.
                     <br>
                     7. **Practice**: The best way to improve is by playing lots of games¹.
                     <br>
                     For more detailed instructions, you might want to check out some online resources or chess learning platforms¹⁴.
                     <br><br>
                     Source:
                     <br>(1) How to Play Chess: 7 Rules To Get You Started. https://www.chess.com/learn-how-to-play-chess.
                     <br>(2) How to Play Chess: The Ultimate Chessable Guide. https://www.chessable.com/blog/how-to-play-chess-the-ultimate-chessable-guide/.
                     <br>(3) How to Play Chess: Setup, Rules, & Gameplay - wikiHow. https://www.wikihow.com/Play-Chess.
                     <br>(4) Learn Chess Online: Lessons, Openings and more - Chess.com. https://www.chess.com/learn.
                 </div>
             </div>
         </section>
      </main>

      <!--=============== BLOG  ===============-->
      <main class="main" id="blog" style="display: none;">
         <section class="blog">
            <div class="blog__header mt-3">
                <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="" class="user__img me-3">
                <div class="blog__user">
                   <h3 class="user__name">ADMIN</h3>
                   <span class="user__timestamp">18:00 20/03/2024</span>
                </div>
             </div>
             <div class="blog__body mt-3">
                <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="" class="blog__img">
                <div class="blog__content mt-2">Announcement</div>
             </div>
             <div class="blog__footer mt-3">
                <button onclick="displayBlogMain()">See more<i class="ri-arrow-right-s-line"></i></button>
             </div>
         </section>
 
         <section class="blog">
            <div class="blog__header mt-3">
               <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="" class="user__img me-3">
               <div class="blog__user">
                  <h3 class="user__name">ADMIN</h3>
                  <span class="user__timestamp">18:00 20/03/2024</span>
               </div>
            </div>
            <div class="blog__body mt-3">
               <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="" class="blog__img">
               <div class="blog__content mt-2">Announcement</div>
            </div>
            <div class="blog__footer mt-3">
               <button onclick="displayBlogMain()">See more<i class="ri-arrow-right-s-line"></i></button>
            </div>
         </section>

         <section class="blog">
            <div class="blog__header mt-3">
               <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="" class="user__img me-3">
               <div class="blog__user">
                  <h3 class="user__name">ADMIN</h3>
                  <span class="user__timestamp">18:00 20/03/2024</span>
               </div>
            </div>
            <div class="blog__body mt-3">
               <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="" class="blog__img">
               <div class="blog__content mt-2">Announcement</div>
            </div>
            <div class="blog__footer mt-3">
               <button onclick="displayBlogMain()">See more<i class="ri-arrow-right-s-line"></i></button>
            </div>
         </section>
         
         <div class="blog__main__bg" onclick="closeBlogMain()"></div>
         <section class="blog__main" id="blog-main" style="display: none;">
            <button onclick="closeBlogMain()"><i class="ri-close-line"></i></button>
            <div class="blog__header mt-3">
               <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="" class="user__img me-3">
               <div class="blog__user">
                  <h3 class="user__name">ADMIN</h3>
                  <span class="user__timestamp">18:00 20/03/2024</span>
               </div>
            </div>
            <div class="blog__body mt-3">
               <h1 class="blog__heading mt-2">Announcement</h1>
               <div class="blog__content mt-3">Chess is a two-player game with the goal of checkmating the opponent's king. It has roots in 7th-century India and modern rules were standardized in the 19th century. It's globally popular and also known as international or Western chess to differentiate it from similar games like xiangqi and shogi.</div>
            </div>
         </section>
      </main>

      <!--=============== USER  ===============-->
      <main class="main" id="user" style="display: none;">
         <div class="row user m-5">
            <div class="col-sm-3 user__nav pt-5">
               <div class="user__infor">
                     <img src="https://i.pinimg.com/236x/fe/c7/d0/fec7d04fae1856e2eb2b6d594695c336.jpg" alt="" class="user__img">
                     <h2 class="user__name my-3">ADMIN</h2>
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
                     <h2 class="user__heading">Profile</h2>
                     <div class="user__form">
                        <form action="">
                           <p class="mt-5">User Name:</p>
                           <p>ADMIN</p>
                           <p class="mt-5">Email:</p>
                           <p>ADMIN@gmail.com</p>
                           <button class="form__button mt-5">Edit Profile</button>
                        </form>
                     </div>
               </div>
               <div class="user__password" id="password" style="display: none;">
                     <h2 class="user__heading mb-5">Password</h2>
                     <div class="user__form">
                        <form action="">
                           <p class="mt-3">Old password:</p>
                           <input type="text">
                           <p class="mt-3">New password:</p>
                           <input type="text">
                           <p class="mt-3">Confirm password:</p>
                           <input type="text">
                           <button class="form__button mt-5">Change Password</button>
                        </form>
                     </div>
               </div>
            </div>
         </div>
      </main>

      <!--==================== CONTAECT ====================-->
      <main class="main" id="contact" style="display: none;">
         <section class="conact__container row">
            <div class="col contact__map">
               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29797.920264509758!2d105.82973073919662!3d21.003055517035317!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac428c3336e5%3A0xb7d4993d5b02357e!2sAptech%20Computer%20Education!5e0!3m2!1svi!2s!4v1711421403758!5m2!1svi!2s" width="500" height="550" style="border:0; border-radius: 1rem;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="col">
               <div class="contact__header mb-5">
                     <h1 class="contact__heading">contact us</h1>
               </div>

               <div class="contact__body">
                     <form action="">
                        <div class="row my-3">
                           <div class="col px-0 me-3 contact__input">
                                 <input type="text" placeholder="First Name">
                                 <i class="ri-id-card-line"></i>
                           </div>
                           <div class="col px-0 contact__input">
                                 <input type="text" placeholder="Last Name">
                                 <i class="ri-id-card-line"></i>
                           </div>
                        </div>
                        <div class="row my-3 contact__input">
                           <input type="email" placeholder="Email">
                           <span><i class="ri-mail-line"></i></span>
                        </div>
                        <div class="row my-3 contact__input">
                           <textarea name="" id="" cols="30" rows="8" placeholder="Message"></textarea>
                           <span><i class="ri-inbox-line"></i></span>
                        </div>
                     </form>
               </div>

               <div class="contact__footer row">
                     <button>Send</button>
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
               <form method="post">
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
                     <input name="name_email" type="email" placeholder="Username or Email">
                     <input name="pwd" type="password" placeholder="Password">
                     <a href="#">Forgot your password?</a>
                     <span class="form__mobile mt-1" onclick="signUpMb()">Don't have an account? Sign Up now!</span>
                     <button type="submit" onclick="logIn()">Sign In</button>
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
   </body>
</html>