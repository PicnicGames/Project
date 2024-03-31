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
      header('Location: ../user/home_user.php');
   } else {
       $_SESSION['loggedin'] = false;
       echo"<script>alert('Wrong Information!!!');</script>";
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

    <!--=============== GOOGLE API ===============-->
    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <title>GAMES</title>
</head>
<body id="body">
    <img src="https://c8.alamy.com/compfr/eh9pfy/jeu-de-cartes-a-jouer-en-famille-au-picnic-eh9pfy.jpg" class="bg__image"></img>
    <div class="bg__blur"></div>
    
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <div class="header__content">
            <a href="home_none.php" class="header__logo">Picnic Play</a>

            <div class="header__nav">
                <div class="header__login" id="register">
                    <button class="login__button" onclick="openModal()"><i class="ri-login-box-line"></i> <span>Log In</span></button>
                </div>

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
                    <a class="nav__link active" href="blog_none.php">
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

    <!--=============== BLOG ===============-->
    <main class="main" id="blog">
        <h1 class="page__title"><a href="home_none.php" class="page__link">Home</a><span> / Blog</span></h1>

        <?php
            $blog = res_sql_query("select * from blog order by id desc");

            $row = $blog[0];
            $time = strtotime($row['created_at']);
            echo "
            <script>
                function displayBlogMain0() {
                    document.getElementById('blog0').style.zIndex = 10;
                    document.getElementById('mainblog-0').style.display = 'block';
                    document.getElementById('blog-bg0').style.display = 'block';
                }
                function closeBlogMain0() {
                    document.getElementById('blog0').style.zIndex = 'unset';
                    document.getElementById('mainblog-0').style.display = 'none';
                    document.getElementById('blog-bg0').style.display = 'none';
                    }                     
            </script>
            <section class='blog' id='blog0'>
                <!--=============== BLOG PREVIEW ===============-->
                <div class='blog__preview'>
                    <div class='blog__content mt-3'>
                        <div class='blog__header mt-3'>
                            <img src='https://static.vecteezy.com/system/resources/previews/002/318/271/non_2x/user-profile-icon-free-vector.jpg' class='user__img me-3'>
                            <div class='blog__user'>
                                <h3 class='user__name'>ADMIN</h3>
                                <span class='user__timestamp'>".date('h:i:s d/m/Y',$time)."</span>
                            </div>
                            </div>
                        <div class='blog__body mt-3'>
                            <img src='https://th.bing.com/th/id/OIP.qp5XTQBgsL0JbWw1bOsfDwHaC5?rs=1&pid=ImgDetMain' class='blog__img'>
                            <div class='blog__title mt-3'>".$row['title']."</div>
                        </div>
                    </div>
                    <div class='blog__footer mt-3'>
                        <button onclick='displayBlogMain0()'>See more<i class='ri-arrow-right-s-line'></i></button>
                    </div>
                </div>
            
                <!--=============== MAIN BLOG ===============-->
                <div class='blog__main' id='mainblog-0' style='display: none;'>
                    <div class='blog__container'>
                        <button onclick='closeBlogMain0()'><i class='ri-close-line'></i></button>
                        <div class='blog__header mt-3'>
                            <img src='https://static.vecteezy.com/system/resources/previews/002/318/271/non_2x/user-profile-icon-free-vector.jpg' class='user__img me-3'>
                            <div class='blog__user'>
                                <h3 class='user__name'>ADMIN</h3>
                                <span class='user__timestamp'>".date('h:i:s d/m/Y',$time)."</span>
                            </div>
                        </div>
                        <div class='blog__body mt-3'>
                            <img src='https://th.bing.com/th/id/OIP.qp5XTQBgsL0JbWw1bOsfDwHaC5?rs=1&pid=ImgDetMain' class='blog__img'>
                            <h1 class='blog__heading my-3'>".$row['title']."</h1>
                            <div class='blog__content'>".$row['content']."</div>
                        </div>
                    </div>
                </div>
            </section>";
            
            if(count($blog) > 1) {
                for ($i = 1; $i < count($blog); $i++) {
                    $row = $blog[$i];
                    $id = $row["id"];
                    $time = strtotime($row['created_at']);
                    echo "
                    <script>
                        function displayBlogMain$id() {
                            document.getElementById('blog$id').style.zIndex = 10;
                            document.getElementById('mainblog-$id').style.display = 'block';
                            document.getElementById('blog-bg$id').style.display = 'block';
                        }
                        function closeBlogMain$id() {
                            document.getElementById('blog$id').style.zIndex = 'unset';
                            document.getElementById('mainblog-$id').style.display = 'none';
                            document.getElementById('blog-bg$id').style.display = 'none';
                         }                     
                    </script>
                    <section class='blog hide__content' id='blog$id'>
                        <!--=============== BLOG PREVIEW ===============-->
                        <div class='blog__preview'>
                            <div class='blog__content mt-3'>
                                <div class='blog__header mt-3'>
                                    <img src='https://static.vecteezy.com/system/resources/previews/002/318/271/non_2x/user-profile-icon-free-vector.jpg' class='user__img me-3'>
                                    <div class='blog__user'>
                                        <h3 class='user__name'>ADMIN</h3>
                                        <span class='user__timestamp'>".date('h:i:s d/m/Y',$time)."</span>
                                    </div>
                                    </div>
                                <div class='blog__body mt-3'>
                                    <img src='https://th.bing.com/th/id/OIP.qp5XTQBgsL0JbWw1bOsfDwHaC5?rs=1&pid=ImgDetMain' class='blog__img'>
                                    <div class='blog__title mt-3'>".$row['title']."</div>
                                </div>
                            </div>
                            <div class='blog__footer mt-3'>
                                <button onclick='displayBlogMain$id()'>See more<i class='ri-arrow-right-s-line'></i></button>
                            </div>
                        </div>
                    
                        <!--=============== MAIN BLOG ===============-->
                        <div class='blog__main' id='mainblog-$id' style='display: none;'>
                            <div class='blog__container'>
                                <button onclick='closeBlogMain$id()'><i class='ri-close-line'></i></button>
                                <div class='blog__header mt-3'>
                                    <img src='https://static.vecteezy.com/system/resources/previews/002/318/271/non_2x/user-profile-icon-free-vector.jpg' class='user__img me-3'>
                                    <div class='blog__user'>
                                        <h3 class='user__name'>ADMIN</h3>
                                        <span class='user__timestamp'>".date('h:i:s d/m/Y',$time)."</span>
                                    </div>
                                </div>
                                <div class='blog__body mt-3'>
                                    <img src='https://th.bing.com/th/id/OIP.qp5XTQBgsL0JbWw1bOsfDwHaC5?rs=1&pid=ImgDetMain' class='blog__img'>
                                    <h1 class='blog__heading my-3'>".$row['title']."</h1>
                                    <div class='blog__content'>".$row['content']."</div>
                                </div>
                            </div>
                        </div>
                    </section>";
                }
            }
        ?>
    </main>

    <?php
        for($i = 0; $i < count($blog); $i++) {
            echo "<div class='blog__bg' id='blog-bg$i' onclick='closeBlogMain$i()' style='display: none;'></div>";
        }
    ?>

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