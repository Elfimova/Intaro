$( document ).ready(function()
{
    $('#btn').click(
        function() {
            if(validateForm()){
                sendAjaxForm('result_form', 'ajax_form', 'action_ajax_form.php');
                return false;
            }
            return false;
        }
    );

    $('#inputName').click(
        function () {
            $('#inputName').removeClass('error__input');
            return false;
        }
    )
    $('#inputSurname').click(
        function () {
            $('#inputSurname').removeClass('error__input');
            return false;
        }
    )
    $('#inputPatronymic').click(
        function () {
            $('#inputPatronymic').removeClass('error__input');
            return false;
        }
    )
    $('#inputEmail').click(
        function () {
            $('#inputEmail').removeClass('error__input');
            return false;
        }
    )
    $('#inputPhone').click(
        function () {
            $('#inputPhone').removeClass('error__input');
            return false;
        }
    )
});
function validateForm()
{
    var flag = true;
    // Проверка на пустоту
    if($('#inputName').val().length == 0){
        flag=false;
        $('#inputName').addClass('error__input');
    }
    if($('#inputSurname').val().length == 0){
        flag=false;
        $('#inputSurname').addClass('error__input');
    }
    if($('#inputPatronymic').val().length == 0){
        flag=false;
        $('#inputPatronymic').addClass('error__input');
    }
    // дополнительная проверка Е-майла
    var reg = /^\w+([\.-]?\w+)*@(((([a-z0-9]{2,})|([a-z0-9][-][a-z0-9]+))[\.][a-z0-9])|([a-z0-9]+[-]?))+[a-z0-9]+\.([a-z]{2}|(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum))$/i;
    if($('#inputEmail').val().length == 0 || !reg.test( $('#inputEmail').val())){
        flag=false;
        $('#inputEmail').addClass('error__input');
    }
    // дополнительная проверка телефона
    var reg = /\+7\(\d{3}\)\d{3}-\d{2}-\d{2}/;
    if($('#inputPhone').val().length == 0 || !reg.test( $('#inputPhone').val())){
        flag=false;
        $('#inputPhone').addClass('error__input');
    }

    return flag;
}
function sendAjaxForm(result_form, ajax_form, url)
{
    $('#block__form').addClass('display_none');
    $('#new_view').removeClass('display_none');
    $.ajax({
        url:     url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
        success: function(response) { //Данные отправлены успешно
            result = $.parseJSON(response);
            if(!result.error){
                $('#message').addClass('message__success');
                $('#textMessage').html(
                    '<strong>Спасибо! </strong>'+result.message
                );
                $('#result_form').html(
                    'Имя: '+result.name+'<br>' +
                    'Фамилия: '+result.surname+ '<br>' +
                    'Отчество: '+result.patronymic+ '<br>' +
                    'E-mail: '+result.email+ '<br>' +
                    'Телефон: '+result.phone
                );
            } else {
                $('#message').addClass('message__error');
                $('#textMessage').html(
                    '<strong>Error! </strong>'+result.message
                );
            }
        },
        error: function(response) { // Ошибка при отправке данных
            $('#message').addClass('message__error');
            $('#textMessage').html(
                '<strong>Error! </strong> Ошибка при отправке данных.'
            );
        }
    });
}