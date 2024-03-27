<?php
require_once "utils.php";

function add_user($name, $email, $password) {
    $pwd = hash_pwd($password);
    $cur_time = date("Y-m-d H:i:s");
    $sql = "insert into user (username, email, password, created_at) values ('$name','$email','$pwd','$cur_time')";
    sql_query($sql);
}