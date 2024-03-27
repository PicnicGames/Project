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

        <!--=============== SWIPER CSS ===============-->
        <link rel="stylesheet" href="css/swiper-bundle.min.css">

        <!--=============== GAME CSS ===============-->
        <link rel="stylesheet" href="css/game.css">

        <!--=============== BOOTSTRAP ===============-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <title>Game</title>
    </head>
    <body>
        <div class="container mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>GAMENAME</th>
                        <th>DESCRIPTION</th>
                        <th>PLACE</th>
                        <th>TYPE</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once "utils.php";
                    $sql = "select * from games";
                    $res = res_sql_query($sql);
                    for ($i = 0; $i < count($res); $i++) {
                        $row = $res[$i];
                        $id = $row["id"];
                        $sql2 = "select count(id_user) 'num' from favourite where id_game = $id";
                        $num = res_sql_query($sql2, true);
                        echo "<tr>
                            <td>". $i+1 ."</td>
                            <td>".$row['gamename']."</td>
                            <td>".$row['description']."</td>
                            <td>".$row['place']."</td>
                            <td>".$row['type']."</td>
                            <td>
                                <form method='post'>
                                    <input type='hidden' name='id' value='" . $row["id"] . "'>
                                    <button type='submit' class='btn btn-danger'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>