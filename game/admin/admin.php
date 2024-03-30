<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css">

    <!--=============== GAME CSS ===============-->
    <link rel="stylesheet" href="../css/game.css">

    <!--=============== BOOTSTRAP ===============-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <title>ADMIN PAGE</title>
</head>
<body id="body">
    <div class="bg__image" style="background: #333"></div>

    <!--==================== HEADER ====================-->
    <header class="header admin__header" id="header">
        <div class="header__content">
            <a href="admin.php" class="header__logo">Picnic Play</a>

            <div class="header__user">
                <div class="header__menu" id="header-menu">
                    <i class="ri-menu-fill"></i>
                </div>
            </div>
        </div>
    </header>

    <!--==================== NAV ====================-->
    <nav class="navigation" id="navigation">
        <div class="nav__menu">
            <a href="admin.php" class="nav__logo">ADMIN PAGE</a>

            <ul class="nav__list">
                <li class="nav__item">
                    <a class="nav__link active" href="admin.php">
                        <i class="ri-home-5-line"></i> <span>Home</span>
                    </a>
                </li>

                <li class="nav__item">
                    <a class="nav__link" href="view_user.php">
                        <i class="ri-user-line"></i> <span>View Users</span>
                    </a>
                </li>

                <li class="nav__item">
                    <a class="nav__link" href="add_game.php">
                        <i class="ri-gamepad-fill"></i> <span>Add Game</span>
                    </a>
                </li>

                <li class="nav__item">
                    <a class="nav__link" href="view_game.php">
                        <i class="ri-gamepad-line"></i> <span>View Games</span>
                    </a>
                </li>

                <li class="nav__item">
                    <a class="nav__link" href="add_blog.php">
                        <i class="ri-blogger-line"></i> <span>Add Blog</span>
                    </a>
                </li>

                <li class="nav__item">
                    <a class="nav__link" href="view_feedback.php">
                    <i class="ri-contacts-line"></i> <span>View Feedback</span>
                    </a>
                </li>
            </ul>

            <!-- USER -->
            <div class="nav__user pt-3" id="registered">
                <div class="nav__link">
                    <div class="user__container">
                        <i class="ri-user-fill"></i>
                        <div class="user__name ms-3">ADMIN</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="nav__close" id="nav-close">
            <i class="ri-close-line"></i>
        </div>
    </nav>

    <script src="../js/game.js"></script>
</body>
</html>