<?php
    namespace PHPappMVCi\Controller;

    final class InicialController extends Controller
    {
        public static function index() : void
        {
            parent::isProtected();

            include '/View/Inicial/home.php';
        }
    }
?>