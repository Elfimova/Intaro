<?php
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans+Condensed:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background-image: url(1.jpg)">
<header class="header">
    <nav class="header__nav">
        <a class="header__link" href="#" style="font-size: 26px;line-height: 13px;letter-spacing: 0.174em;font-weight: 900;font-style: italic;">Feedback form</a>
    </nav>
</header>
<section class="main">
    <div class="container container_optimalHeight">
        <div id="block__form" class="block__form">
            <h1 class="main__title">Пожалуйста, заполните форму обратной связи для дальнейшего сотрудничества!</h1>
            <form id="ajax_form" class="main__form" method="post" action="">
                <div class="form__row">
                    <label for="inputName" class="form__label">Имя:</label>
                    <input type="text" name="name" class="form__input" id="inputName" placeholder="Иван">
                </div>
                <div class="form__row">
                    <label for="inputSurname" class="form__label">Фамилия:</label>
                    <input type="text" name="surname" class="form__input" id="inputSurname" placeholder="Иванов">
                </div>
                <div class="form__row">
                    <label for="inputPatronymic" class="form__label">Отчество:</label>
                    <input type="text" name="patronymic" class="form__input" id="inputPatronymic" placeholder="Иванович">
                </div>
                <div class="form__row">
                    <label for="inputEmail" class="form__label">E-mail:</label>
                    <input type="email" name="email" class="form__input" id="inputEmail" placeholder="1234@gmail.com">
                </div>
                <div class="form__row">
                    <label for="inputPhone" class="form__label">Телефон:</label>
                    <input type="tel" name="phone" class="form__input" id="inputPhone" placeholder="+7(999)123-4567">
                </div>
                <div class="form__button">
                    <button type="submit" id="btn" class="button">Отправить</button>
                </div>
            </form>
        </div>

        <div id="new_view" class="block__result display_none">
            <h1 class="main__title">Спасибо за сотрудничество!</h1>
            <div id="message" class="message">
                <p id="textMessage" class="message__text"></p>
            </div>
            <img src="vinni.png" heigth="350" width="240">
            <div id="result_form" class="font_default"></div>
        </div>
    </div>
</section>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</html>