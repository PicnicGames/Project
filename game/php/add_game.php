<?php
require_once "utils.php";

$title = "";
$title = get_post("title");
$cont = get_post("cont");
$vimg = get_post("vimg");
$himg = get_post("himg");
$vid = get_post("vid");
$player = get_post("player");
$place = get_post("place");

if ($title != "") {
    $sql = "insert into game (title, content, vertical_img, horizontal_img, video, type) values ('$title', '$cont', '$vimg', '$himg', '$vid', '$type')";
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
        <title>ADD</title>
    </head>
    <body>
        <div class="container mt-3">
            <form method="post">
                <div class="form-group">
                    <label for="name">Title:</label>
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="des">Content:</label>
                    <input type="text" name="cont" class="form-control">
                </div>
                <div class="form-group">
                    <label for="des">Vertical Image:</label>
                    <input type="text" name="vimg" class="form-control">
                </div>
                <div class="form-group">
                    <label for="des">Horizontal Image:</label>
                    <input type="text" name="himg" class="form-control">
                </div>
                <div class="form-group">
                    <label for="des">Video:</label>
                    <input type="text" name="vid" class="form-control">
                </div>
                <div class="form-group">
                    <label for="des">Type:</label>
                    <input type="text" name="type" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success mt-3">Add</button>
                </div>
                <div class="form-group">
                    <a class="btn btn-primary mt-3" href="../admin.php">Back</a>
                </div>
            </form>
        </div>
    </body>
</html>