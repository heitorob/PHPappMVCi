<?php
namespace PHPappMVCi\Controller;

use PHPappMVCi\Model\Login;

final class LoginController
{
    public static function index(): void
    {
        $erro = "";
        $model = new Login();

        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $model->Email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $model->Senha = $_POST['senha']; // Evitar sanitizar senha diretamente

            $usuario = $model->fazerLogin();

            if ($usuario !== null) {
                $_SESSION['usuario_logado'] = $usuario;

                if (isset($_POST['lembrar'])) {
                    setcookie(
                        "sistema_biblioteca_usuario",
                        $usuario->Email,
                        time() + 60 * 60 * 24 * 30
                    );
                }

                header("Location: /");
                exit;
            } else {
                $erro = "Email ou senha incorretos.";
            }
        }

        if (isset($_COOKIE['sistema_biblioteca_usuario']))
            $model->Email = $_COOKIE['sistema_biblioteca_usuario'];

        include 'View/Login/form_login.php';
    }

    public static function logout(): void
    {
        session_destroy();
        header("Location: /login");
        exit;
    }

    public static function getUsuario(): Login
    {
        return unserialize(serialize($_SESSION['usuario_logado']));
    }
}
?>
