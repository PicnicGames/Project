<?php
require_once "utils.php";

$id_edit_game = $title = $player = $place = $vimg = $himg = $vid = $desc = $cont = "";

$title = get_post('title');
$player = get_post('player');
$place = get_post('place');
$vimg = get_post('vimg');
$himg = get_post('himg');
$vid = get_post('vid');
$desc = get_post('desc');
$cont = get_post('cont');
$id_edit_game = get_get('id_edit_game');

if ($id_edit_game != "") {
    if ($title != "") {
        $sql = "update game set title = '$title' where id = $id_edit_game";
        sql_query($sql);
    }
    if ($player != "") {
        sql_query("update game set player = '$player' where id = $id_edit_game");
    }
    if ($place != "") {
        sql_query("update game set place = '$place' where id = $id_edit_game");
    }
    if ($vimg != "") {
        sql_query("update game set vertical_img = '$vimg' where id = $id_edit_game");
    }
    if ($himg != "") {
        sql_query("update game set horizontal_img = '$himg' where id = $id_edit_game");
    }
    if ($vid != "") {
        sql_query("update game set video = '$vid' where id = $id_edit_game");
    }
    if ($desc != "") {
        sql_query("update game set description = '$desc' where id = $id_edit_game");
    }
    if ($cont != "") {
        sql_query("update game set content = '$cont' where id = $id_edit_game");
    }
}

$res = res_sql_query("select * from game where id = $id_edit_game");
$row = $res[0];
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

    <title>EDIT GAME
        <?php
        echo $id_edit_game;
        ?>
    </title>
</head>
<body id="body">
    <div class="bg__image" style="background: #333"></div>

    <!--==================== HEADER ====================-->
    <header class="header admin__header" id="header">
        <div class="header__content">
            <a href="admin.php" class="header__logo">ADMIN PAGE</a>

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
                    <a class="nav__link" href="admin.php">
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
                    <a class="nav__link" href="view_blog.php">
                        <i class="ri-blogger-fill"></i> <span>View Blog</span>
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

    <main class="main">
        <section class="add">
            <h1 class="mb-5">Edit game</h1>
            <form method="post">
                <div class="row">
                    <div class="col-sm">
                        <input type="text" name="title" placeholder="Title" value="<?php echo $row['title']?>">
                    </div>
                    <div class="col-sm">
                        <input type="text" name="player" placeholder="Player" value="<?php echo $row['player']?>">
                    </div>
                    <div class="col-sm">
                        <input type="text" name="place" placeholder="Place" value="<?php echo $row['place']?>">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm">
                        <input type="text" name="vimg" placeholder="Vertical Image" value="<?php echo $row['vertical_img']?>">
                    </div>
                    <div class="col-sm">
                        <input type="text" name="himg" placeholder="Horizontal Image" value="<?php echo $row['horizontal_img']?>">
                    </div>
                    <div class="col-sm">
                        <input type="text" name="vid" placeholder="Video" value="<?php echo $row['video']?>">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-4">
                        <textarea name="desc" id="" cols="30" rows="10" placeholder="Description"><?php echo $row['description']?></textarea>
                    </div>
                    <div class="col-sm-8">
                        <textarea name="cont" id="" cols="30" rows="10" placeholder="Content"><?php echo $row['content']?></textarea>
                    </div>
                </div>
                <button class="mt-3" type="submit">Edit</button>
            </form>
        </section>
    </main>

    <script src="../js/game.js"></script>
</body>
</html>