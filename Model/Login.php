<?php
    namespace PHPappMVCi\Model;

    use PHPappMVCi\DAO\LoginDAO;

    final class Login
    {
        public $Id, $Email, $Senha, $Nome;

        public function fazerLogin() : ?Login
        {
            return new LoginDAO()->autenticar($this);
        }
    }
?>