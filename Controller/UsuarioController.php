<?php
namespace PHPappMVCi\Controller;

use PHPappMVCi\Model\Usuario;
use Exception;

final class UsuarioController extends Controller
    {
        // public static function index() : void
        // {
        //     parent::isProtected(); 

        //     $model_usuario = new Usuario();
            
        //     try {
        //         $model_usuario->getAllRows();
    
        //     } catch(Exception $e) {
        //         $model_usuario->setError("Ocorreu um erro ao buscar os autores: ");
        //         $model_usuario->setError($e->getMessage());
        //     }
    
        //     parent::render('Autor/lista_autor.php', $model_usuario); 

        // }
        public static function cadastro() : void
        {
            //parent::isProtected(); 
    
            $model_usuario = new Usuario();
            
            try
            {
                if(parent::isPost())
                {
                    $model_usuario->Id = !empty($_POST['id']) ? $_POST['id'] : null;
                    $model_usuario->nome = $_POST['nome'];
                    $model_usuario->email= $_POST['email'];
                    $model_usuario->senha = $_POST['senha'];
                    $model_usuario->save();
    
                    parent::redirect("/");
    
                } else {
        
                    if(isset($_GET['id']))
                    {              
                        $model_usuario = $model_usuario->getById( (int) $_GET['id'] );
                    }
                }
    
            } catch(Exception $e) {
    
                $model_usuario->setError($e->getMessage());
            }
    
            parent::render('Usuario/form_usuario.php', $model_usuario);        
        }
    
        public static function delete() : void
        {
            parent::isProtected(); 
    
            $model_usuario = new Usuario();
            
            try 
            {
                $model_usuario->delete( (int) $_GET['id']);
                parent::redirect("/Autor");
    
            } catch(Exception $e) {
                $model_usuario->setError("Ocorreu um erro ao excluir o autor:");
                $model_usuario->setError($e->getMessage());
            } 
            
            parent::render('Autor/lista_autores.php', $model_usuario);  
        }
    }