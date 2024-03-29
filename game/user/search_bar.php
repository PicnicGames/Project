<?php
require_once "../admin/utils.php";

$inp = get_post('inp');
if ($inp != '') {
    $res = res_sql_query("select * from game where title like '%$inp%'");
    for ($i = 0; $i < count($res); $i++) {
        // them code in ra vao day
    }
}
