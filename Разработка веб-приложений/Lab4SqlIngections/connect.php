<?php
// настройка опций для PDO
$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
// путь до нашего .ini файла для подключение к БД
$path = "config/parameters.ini";
// парсинг с .ini файла
$iniArray = parse_ini_file($path, true);
// проверяем наш .ini файл на целостность
if (
    !isset($iniArray['db']['host']) ||
    !isset($iniArray['db']['name']) ||
    !isset($iniArray['db']['login']) ||
    !isset($iniArray['db']['password'])
) {
    print "Ошибка! Файл конфигураций повреждён!" . "<br/>";
    die();
}
$dsn = "pgsql:host={$iniArray['db']['host']};dbname={$iniArray['db']['name']}";
// создаем подключение
try {
    $pdo = new PDO($dsn, $iniArray['db']['login'], $iniArray['db']['password'], $options);
} catch (PDOException $e) {
    echo $e->getMessage();
    die();
}
