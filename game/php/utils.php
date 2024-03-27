<?php

define('HOST','localhost');
define('USERNAME','root');
define('PASSWORD','');
define('DATABASE','data');

function get_post($key) {
    $val = "";
    if (isset($_POST[$key])) {
        $val = $_POST[$key];
    }
    return $val;
}

function sql_query($sql) {
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    mysqli_set_charset($conn,"utf8");

    mysqli_query($conn, $sql);
    $conn->close();
}

function res_sql_query($sql, $isSingleRec = false) {
    $conn = mysqli_connect(HOST, USERNAME, PASSWORD, DATABASE);
    mysqli_set_charset($conn,"utf8");

    $res = mysqli_query($conn, $sql);
    if ($isSingleRec) {
        $data = mysqli_fetch_array($res, 1);
    } else {
        $data = [];
        while (($row = mysqli_fetch_array($res, 1)) != null) {
            $data[] = $row;
        }
    }
    $conn->close();
    return $data;
}
