<?php

//'12'ehf8'2'dkjcn'36'd
$txt = trim(fgets(STDIN));
$pattern = '/(\')([0-9]+)(\')/';

// $matches[0] -  полное вхождение шаблона
// $matches[1] - вхождение первой подмаски,
// заключенной в круглые скобки и так далее...

// callback-функция
$txt = preg_replace_callback(
    $pattern,
    function ($matches) {
        return '\'' . strval($matches[2]*2) . '\''; },
    $txt);
echo $txt;
