<?php
require_once "utils.php";

$name = $player = $place = $des =  $content ="";

$name = get_post('name');
$player = get_post('desc');
$place = get_post('place');
$des = get_post('player');
$content = get_post('place');

if ($name != "") {
    $sql = "insert into games (gamename, player, place, description, content) values ('$name', '$player', '$place', '$des' , '$content')";
    sql_query($sql);
}

?>

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

    <title>ADD GAMES</title>
</head>
<body id="body">
    <div class="bg__image" style="background-color:#333"></div>

    <!--==================== NAV ====================-->
    <nav class="navigation" id="navigation">
        <div class="nav__menu">
            <a href="/project/subgame/admin.php" class="nav__logo">ADMIN PAGE</a>

            <ul class="nav__list">
                <li class="nav__item">
                    <a class="nav__button" href="../admin.php">
                        <i class="ri-home-5-line"></i> <span>Home</span>
                    </a>
                </li>

                <li class="nav__item">
                    <a class="nav__button active" href="add_game.php">
                        <i class="ri-gamepad-line"></i> <span>Add Game</span>
                    </a>
                </li>

                <li class="nav__item">
                    <a class="nav__button" href="view_game.php">
                        <i class="ri-heart-3-line"></i> <span>View Games</span>
                    </a>
                </li>

                <li class="nav__item">
                    <a class="nav__button" href="view_user.php">
                        <i class="ri-blogger-line"></i> <span>View Users</span>
                    </a>
                </li>

                <li class="nav__item">
                    <a class="nav__button" href="view_feedback.php">
                        <i class="ri-blogger-line"></i> <span>View Feedback</span>
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

        <div class="nav__close" id="nav-close">
            <i class="ri-close-line"></i>
        </div>
    </nav>

    <main class="main">
        <section class="add__game">
            <h1 class="mb-5">add game</h1>
            <form method="post">
                <div class="row">
                    <div class="col-sm">
                        <input type="text" name="name" placeholder="Name">
                    </div>
                    <div class="col-sm">
                        <input type="text" name="player" placeholder="Player">
                    </div>
                    <div class="col-sm">
                        <input type="text" name="place" placeholder="Place">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm">
                        <input type="text" name="name" placeholder="Vertical Image">
                    </div>
                    <div class="col-sm">
                        <input type="text" name="player" placeholder="Horizontal Image">
                    </div>
                    <div class="col-sm">
                        <input type="text" name="place" placeholder="Video">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-4">
                        <textarea name="desc" id="" cols="30" rows="10" placeholder="Description"></textarea>
                    </div>
                    <div class="col-sm-8">
                        <textarea name="content" id="" cols="30" rows="10" placeholder="Content"></textarea>
                    </div>
                </div>
                <button class="mt-3" type="submit">Add</button>
            </form>
        </section>
    </main>
</body>
</html>