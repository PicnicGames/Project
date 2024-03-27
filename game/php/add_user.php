<?php
require_once "utils.php";

$name = $des = $place = $type = "";
$name = get_post('name');
$des = get_post('desc');
$place = get_post('place');
$type = get_post('type');

if ($name != "") {
    $sql = "insert into games (gamename, description, place, type) values ('$name', '$des', '$place', '$type')";
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
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="des">Description:</label>
                    <input type="text" name="desc" class="form-control">
                </div>
                <div class="form-group">
                    <label for="place">Place:</label>
                    <input type="text" name="place" class="form-control">
                </div>
                <div class="form-group">
                    <label for="type">Type:</label>
                    <input type="text" name="type" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success mt-3">Add</button>
                </div>
            </form>
        </div>
    </body>
</html>