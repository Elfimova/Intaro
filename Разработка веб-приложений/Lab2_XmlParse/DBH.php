<?php
$param_array = parse_ini_file("parameters.ini", true);
try {
    $DBH = new PDO("pgsql:host={$param_array['db']['host']};user={$param_array['db']['user']};
    password={$param_array['db']['password']};dbname={$param_array['db']['dbname']}");
} catch (PDOException $e) {
    echo $e->getMessage();
    file_put_contents('PDOErr.txt', $e->getMessage(), FILE_APPEND);
}
