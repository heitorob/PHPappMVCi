<?php

use PHPappMVCi\Controller\AlunoController;
use PHPappMVCi\Controller\AutorController;
use PHPappMVCi\Controller\CategoriaController;
use PHPappMVCi\Controller\EmprestimoController;
use PHPappMVCi\Controller\InicialController;
use PHPappMVCi\Controller\LivroController;
use PHPappMVCi\Controller\LoginController;
use PHPappMVCi\Controller\UsuarioController;

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($url)
{
    case '/':
        InicialController::index();
        break;

    case '/login':
        LoginController::index();
        break;

    case '/logout':
        LoginController::logout();
        break;

    case '/usuario':
        UsuarioController::index();
        break;

    case '/usuario/cadastro':
        UsuarioController::cadastro();
        break;

    case '/usuario/delete':
        UsuarioController::delete();
        break;

    case '/aluno':
        AlunoController::index();
        break;

    case '/aluno/cadastro':
        AlunoController::cadastro();
        break;

    case '/aluno/delete':
        AlunoController::delete();
        break;

    case '/autor':
        AutorController::index();
        break;

    case '/autor/cadastro':
        AutorController::cadastro();
        break;

    case '/autor/delete':
        AutorController::delete();
        break;

    case '/categoria':
        CategoriaController::index();
        break;

    case '/categoria/cadastro':
        CategoriaController::cadastro();
        break;

    case '/categoria/delete':
        CategoriaController::delete();
        break;

    case '/livro':
        LivroController::index();
        break;

    case '/livro/cadastro':
        LivroController::cadastro();
        break;

    case '/livro/delete':
        LivroController::delete();
        break;

    case '/emprestimo':
        EmprestimoController::index();
        break;

    case '/emprestimo/cadastro':
        EmprestimoController::cadastro();
        break;

    case '/emprestimo/delete':
        EmprestimoController::delete();
        break;

    default:
        http_response_code(404);
        echo "Página não encontrada.";
        break;
}
?>