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
        <title>USER</title>
    </head>
    <body>
        <div class="container mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>MESSAGE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once "utils.php";
                    $sql = "select * from contact";
                    $res = res_sql_query($sql);
                    for ($i = 0; $i < count($res); $i++) {
                        $row = $res[$i];
                        echo "<tr>
                            <th>". $i+1 ."</th>
                            <th>".$row['first_name'].$row['last_name']."</th>
                            <th>".$row['email']."</th>
                            <th>".$row['content']."</th>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>