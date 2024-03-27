<?php
require_once "utils.php";

function check_user($name_or_email, $password) {
    $sql = "select * from user where name = '$name_or_email' or email = '$name_or_email'";
    $res = res_sql_query($sql);
    if (count($res) != 1) {
        return false;
    } else {
        if (password_verify( $password, $res[0]["password"]) ) {
            return true;
        } else {
            return false;
        }
    }
}
