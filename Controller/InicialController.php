<?php
    namespace PHPappMVCi\Controller;

    use PHPappMVCi\Controller\Controller;

    final class InicialController extends Controller
    {
        public static function index() : void
        {
            parent::isProtected();

            include VIEWS . '/Inicial/home.php';
        }
    }
?>