<?php
    namespace PHPappMVCi\Controller;

    use PHPappMVCi\Model\Categoria;
    use Exception;

    final class CategoriaConrtoller extends Controller
    {
        public static function index() : void
        {
            parent::isProtected();

            $model = new Categoria();

            try
            {
                $model->getAllRows();
            }
            catch(Exception $e)
            {
                $model->setError("Ocorreu um erro ao buscar os categorias:");
                $model->setError($e->getMessage());
            }

            parent::render('Categoria/lista_categoria.php', $model);
        }

        public static function cadasrto() : void
        {
            parent::isProtected();

            $model = new Categoria();

            try
            {
                if(parent::isPost())
                {
                    $model->Id = !empty($_POST['id']) ? $_POST['id'] : null;
                    $model->Descricao = $_POST['descricao'];
                    $model->save();

                    parent::redirect("/categoria");
                }
                else
                {
                    if(isset($_GET['id']))
                    {
                        $model = $model->getById( (int) $_GET['id']);
                    }
                }
            }
            catch(Exception $e)
            {
                $model->setError($e->getMessage());
            }

            parent::render('Categoria/form_categoria.php', $model);   
        }

        public static function delete() : void
        {
            parent::isProtected();

            $model = new Categoria();

            try
            {
                $model->delete( (int) $_GET['id']);
                parent::redirect("/categoria");
            }
            catch (Exception $e)
            {
                $model->setError("Ocorreu um erro ao excluir o categoria:");
                $model->setError($e->getMessage());
            }

            parent::render('Categoria/form_categoria.php', $model);   
        }
    }
?>