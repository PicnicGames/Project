<?php
require_once "utils.php";
$id = "";
$id = get_post('id');
if ($id != '') {
    $sql = "delete from game where id = $id";
    $sql2 = "delete from favourite where id_game = $id";
    sql_query($sql2);
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

    <title>GAMES</title>
</head>
<body id="body">
    <div class="bg__image" style="background: #333"></div>

    <!--==================== HEADER ====================-->
    <header class="header admin__header" id="header">
        <div class="header__content">
            <a href="admin.php" class="header__logo">ADMIN PHP</a>

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
                    <a class="nav__link active" href="view_game.php">
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

    <main class="main">
        <section class="view__game">
        <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Player</th>
                        <th>Place</th>
                        <th>Description</th>
                        <th>Content</th>
                        <th>Favourite</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once "utils.php";
                    $sql = "select * from game order by title";
                    $res = res_sql_query($sql);
                    for ($i = 0; $i < count($res); $i++) {
                        $row = $res[$i];
                        $id = $row["id"];
                        $sql2 = "select count(id_user) 'num' from favourite where id_game = $id";
                        $num = res_sql_query($sql2, true);
                        echo "<tr>
                            <td>". $i+1 ."</td>
                            <td>".$row['title']."</td>
                            <td>".$row['player']."</td>
                            <td>".$row['place']."</td>
                            <td>".$row['description']."</td>
                            <td>".$row['content']."</td>
                            <td>".$num['num']."</td>
                            <td>
                                <form method='get' action='edit_game.php'>
                                    <input type='hidden' name='id_edit_game' value='" . $id . "'>
                                    <button type='submit' class='btn btn-warning'>Edit</button>
                                </form>
                            </td>
                            <td>
                                <form method='post'>
                                    <input type='hidden' name='id' value='" . $id . "'>
                                    <button type='submit' class='btn btn-danger'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <script src="../js/game.js"></script>
</body>
</html>