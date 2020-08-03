# Laba5 
Для запуска потребуется:
Open Server;  
    Версии модулей:  
    -	PHP-7.3-x64;  
    -	PostgreSQL-9.3-x64;  
1. Восстановить Дамп в папке dump через консоль OpenServer

1.1 createdb.exe —username=postgres ИМЯ_БАЗЫ 
1.2 psql —dbname=ИМЯ_БАЗЫ —quiet —file="ПУТЬ_К_ФАЙЛУ_data_dump.sql" —username=postgres >nul
 
2. Редактировать config/parameters.ini;  
3. Добавить в домены папку с файлами;  
4. Запустить.

>*Поскольку мы работаем на локальном сервере, письма не будут отправлены на почту напрямую, а будут в папке ..\OSPanel\userdata\temp\email 