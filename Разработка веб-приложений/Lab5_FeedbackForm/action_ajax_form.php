require('connect.php');

$datetime1 = new DateTime('2012-02-15 23:00:00');
$datetime2 = new DateTime('2012-02-16 10:00:00');
$interval = $datetime2->getTimestamp() - $datetime1->getTimestamp();
//$interval = diff(new DateTime('2012-02-15 23:00:00'), new DateTime('2012-02-16 20:00:00'));
echo "cекунд: {$interval}";

global $pdo;
// проверим есть ли такой пользователь если да, то проверить, что заявка была более часа назад
$sql = 'SELECT * FROM "user" WHERE email=:email';
$params = [
    ':email' => $_POST['email']
];
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$data = $stmt->fetchObject();
if(!$data){
    // закидываем всё в бд
    $sql = 'INSERT INTO "user"(name, surname, patronymic, email, phone, date_add) 
            VALUES(
            :name, 
            :surname, 
            :patronymic, 
            :email, 
            :phone, 
            timezone(\'GMT-03\', CURRENT_TIMESTAMP)) 
            RETURNING date_add, email_manager';
    $params = [
        ':name' => $_POST['name'],
        ':surname' => $_POST['surname'],
        ':patronymic' => $_POST['patronymic'],
        ':email' => $_POST['email'],
        ':phone' => $_POST['phone']
    ];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $data = $stmt->fetchObject();

    // Формируем массив для JSON ответа
    $result = array(
        'error' => false,
        'name' => $_POST["name"],
        'surname' => $_POST["surname"],
        'patronymic' => $_POST["patronymic"],
        'email' => $_POST["email"],
        'phone' => $_POST["phone"],
        'message' => 'Спасибо за вашу заявку! Наши специалисты свяжутся с вами после '.
            date('H:i:s', strtotime($data->date_add) - strtotime('01:30:00')) .
            ' ' . date('d.m.Y', strtotime($data->date_add))


    );
    // отправляем данные на почту дефолтную
    mail(
        $data->email_manager,
        'Форма с сайта',
    $result['name'] . ' '
    . $result['surname'] . ' '
    . $result['patronymic'] . ', '
    . $result['email'] . ', '
    . $result['phone']
    );
    // Переводим массив в JSON
    echo json_encode($result);
} elseif (strtotime(date('d.m.Y', strtotime($data->data_add))) <=
    strtotime(date('d.m.Y')) and
    strtotime(date('H:i:s', strtotime($data->date_add) - strtotime('01:30:00'))) <=
    strtotime(date('d.m.Y H:i:s'))) {
    $sql = 'UPDATE "user" 
    SET name=:name, 
    surname=:surname, 
    patronymic=:patronymic, 
    phone=:phone, 
    date_add=timezone(\'GMT-03\', CURRENT_TIMESTAMP) 
    WHERE email=:email RETURNING date_add, email_manager';
    $params = [
        ':name' => $_POST['name'],
        ':surname' => $_POST['surname'],
        ':patronymic' => $_POST['patronymic'],
        ':email' => $_POST['email'],
        ':phone' => $_POST['phone'],
    ];
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $data = $stmt->fetchObject();
    // Формируем массив для JSON ответа
    $result = array(
        'error' => false,
        'name' => $_POST["name"],
        'surname' => $_POST["surname"],
        'patronymic' => $_POST["patronymic"],
        'email' => $_POST["email"],
        'phone' => $_POST["phone"],
        'message' => 'Ваши данные были изменены в соответствии с новой заявкой. Мы свяжемся с вами после ' .
            date('H:i:s', strtotime($data->date_add) - strtotime('01:30:00')) .
            ' ' . date('d.m.Y', strtotime($data->date_add))
    );
    // отправляем данные на почту дефолтную
    mail(
        '\'' . $data->email_manager . '\'',
        'Заявка',
        $result['name'] . ' '
        . $result['surname'] . ' '
        . $result['patronymic'] . ', '
        . $result['email'] . ', '
        . $result['phone']
    );
    // Переводим массив в JSON
    echo json_encode($result);
} else {
    $result = array(
        'error' => true,
        'message' => 'После отправки вашей заявки прошло совсем немного времени. Во избежания спама, вы сможете отправить новую заявку после ' .
            date('H:i:s', strtotime($data->date_add) - strtotime('01:30:00')) .
            ' ' . date('d.m.Y', strtotime($data->date_add)) . ' Благодарим за понимание!'
    );
    // Переводим массив в JSON
    echo json_encode($result);
}
