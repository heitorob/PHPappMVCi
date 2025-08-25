<?php
    spl_autoload_register(function ($nome_da_classe)
    {
        $arquivo = BASE_DIR . "/" . str_replace("\\", "/", $nome_da_classe) . ".php";
        //echo "route: $arquivo"; // debug
        if(file_exists($arquivo))
        {
            include $arquivo;
        }
        else
        {
            throw new Exception("Arquivo não encontrado: " . $arquivo);
        }
    });
?>