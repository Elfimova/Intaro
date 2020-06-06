<?php
require('DBH.php');
$path_to_xml = "index.xml";
//получаем информацию из файла
$xml_data = file_get_contents($path_to_xml);
str_to_sql($xml_data);


function str_to_sql ($xml_text) {
    global $DBH;
    // Проверяем что xml соответствует стандарту
    if(@simplexml_load_string($xml_text)) {
        // Преобразуем в SimpleXMLElement
        $xmls = simplexml_load_string($xml_text);
        // Запишем для удобства запрос в переменную
        $psql_insert = "INSERT INTO students (s_name, s_surname, s_patronymic, s_speciality) 
                    VALUES (:s_name, :s_surname, :s_patronymic, :s_speciality)";
        // Проходим до всем строкам
        foreach($xmls as $xml){
            // Записываем в бд с помошью PDO::prepare
            $psql_record = $DBH->prepare($psql_insert);
            $psql_record->execute(array(':s_name' => $xml->s_name, ':s_surname' => $xml->s_surname,
                ':s_patronymic' => $xml->s_patronymic, ':s_speciality'=> $xml->s_speciality));
            if ($psql_record)
                echo 'Well done!'. "\n";
            else
                echo 'Sorry, there is a problem'. "\n";
        }
    } else {
        echo "Файл не соответствует стандарту xml".PHP_EOL;
    }
}
