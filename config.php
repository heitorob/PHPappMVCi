<?php
    define('BASE_DIR', dirname(__FILE__, 2));
    define('VIEWS', BASE_DIR . '/PHPappMVCi/View');

    $_ENV['db']['host'] = "localhost:3307";
    $_ENV['db']['user'] = "root";
    $_ENV['db']['pass'] = ""; // Toda vez que a senha do banco de dados for alterada, alterar aqui.
    $_ENV['db']['database'] = "biblioteca_do_butao";
?>