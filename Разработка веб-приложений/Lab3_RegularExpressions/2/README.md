Команды для работы с postgres в OSPanel:

createdb.exe --username=postgres db_laws

pg_dump.exe --username=postgres db_laws > dump_laws.sql

psql --dbname=db_laws --quiet --file="C:\OSPanel\domains\2\dump_laws.sql" --username=postgres >nul