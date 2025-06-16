<?php
namespace PHPappMVCi\Controller;

use PHPappMVCi\Model\Usuario;
use Exception;

final class UsuarioController extends Controller
{
    public static function index(): void
    {
        parent::isProtected();

        $model = new Usuario();

        try {
            $usuarios = $model->getAllRows();
            $model->rows = $usuarios;
        } catch (Exception $e) {
            $model->setError("Ocorreu um erro ao buscar os usuários: " . $e->getMessage());
        }

        parent::render('Usuario/lista_usuario.php', $model);
    }

    public static function cadastro(): void
    {
        // parent::isProtected();

        $model = new Usuario();

        try {
            if (parent::isPost()) {
                $model->Id = !empty($_POST['id']) ? (int) $_POST['id'] : null;
                $model->setEmail($_POST['email']);
                $model->setSenha($_POST['senha']);
                $model->setNome($_POST['nome']);

                $model->save();
                parent::redirect("/login");
            } elseif (isset($_GET['id'])) {
                $model = $model->getById((int) $_GET['id']);
            }
        } catch (Exception $e) {
            $model->setError($e->getMessage());
        }

        parent::render('Usuario/form_usuario.php', $model);
    }

    public static function delete(): void
    {
        parent::isProtected();

        $model = new Usuario();

        try {
            if (!isset($_GET['id'])) {
                throw new Exception("ID não informado.");
            }

            $model->delete((int) $_GET['id']);
            parent::redirect("/usuario");
        } catch (Exception $e) {
            $model->setError("Erro ao excluir o usuário: " . $e->getMessage());
            parent::render('Usuario/form_usuario.php', $model);
        }
    }
}
?>