<?php

    spl_autoload_register(function ($classen))
    {
        $arquivo = BASE_DIR . "/" $classen . ".php";

        if (file_exists($arquivo))
        {
            include $arquivo;
        }
        else
        {
            throw new Exception("Arquivo não encontrado");
        }
    }
?>