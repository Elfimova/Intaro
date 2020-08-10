<?php
// подключение к БД
require('connect.php');

// подгружаем данные из бд
global $pdo;
$sql = 'SELECT * FROM laws';
$request = $pdo->prepare($sql);
$request->execute();
$data = $request->fetchAll();

// регулярное выражение для поиска ссылки
$pattern = '/(http:\/\/asozd\.duma\.gov\.ru\/main\.nsf\/\(Spravka\)\?OpenAgent&RN=)((\d+)-(\d+))&(\d+)/';
for ($i=0;$i<count($data);$i++) {
    // если есть выражение - замена
    if (preg_match($pattern, $data[$i]['html'])) {
        $data[$i]['html'] = preg_replace_callback($pattern, function ($texts) {
            preg_match('/((\d+)-(\d+))/', $texts[0], $text);
            return 'http://sozd.parlament.gov.ru/bill/' . $text[0];
        }, $data[$i]['html']);
                echo $data[$i]['html'];
        global $pdo;
        $sql = 'UPDATE laws SET html=:html WHERE id_laws=:id';
        $request = $pdo->prepare($sql);
        $params = [
        ':id' => $data[$i]['id_laws'],
        ':html' => $data[$i]['html']
        ];
        $request->execute($params);
    }
}