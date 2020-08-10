<?php
// подключение к БД
require('connect.php');

// подгружаем данные из бд
global $pdo;
$sql = 'SELECT * FROM laws';
$request = $pdo->prepare($sql);
$request->execute();
$data = $request->fetchAll();

//Запросы
$fd = fopen("hello.txt", 'w') or die("не удалось создать файл");
fwrite($fd, $str);
fclose($fd);

$sql1 = 'select * from laws WHERE id_laws=:sql_2;';
$sql1_2 = '1 OR 1=1';
$sql2 = 'select * from laws WHERE html LIKE :sql_2;';
$sql2_2 = '%депутат%; DROP TABLE laws';

$fd = fopen("result.txt", 'w') or die("не удалось создать файл");
$str = "SQL-инъекции:\n" . substr($sql1, 0, -7) . $sql1_2 . ";\n" . substr($sql2, 0, -7)  . $sql2_2. ";\n" .
    "Результаты выполненения SQL-инъекций:\n" . SqlInjections($sql1, $sql1_2) . "\n" . SqlInjections($sql2, $sql2_2);
echo $str;
fwrite($fd, $str);
fclose($fd);
//Вызываем функцию для проверки sql-инъекций

function SqlInjections(string $sql, string $sql_2)
{
    try {
        global $pdo;
        $request = $pdo->prepare($sql);
        $params = [
            ':sql_2' => $sql_2,
        ];
        $request->execute($params);
        $datas = $request->fetchAll();
        if($datas)
            return true;
        else
            return 'Warning!!!SQL-injection!';
    }
    catch (Exception $e)
    {
        return $e->getMessage();
    }
}
