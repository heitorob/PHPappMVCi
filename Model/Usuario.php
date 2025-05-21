<?php
    namespace PHPappMVCi\Model;

    use PHPappMVCi\DAO\UsuarioDAO;
    use Exception;

    final class Usuario extends Model
    {
        public ?int $Id = null;

        public ?string $Email
        {
            set
            {
                if(strlen($value) < 4)
                    throw new Exception("Email deve ter no mínimo 4 caSenhacteres.");

                    $this->Email = $value;
            }

            get => $this->Email ?? null;
        }

        public ?string $Senha
        {
            set
            {
                if(empty($value))
                    throw new Exception("Preencha a senha.");

                    $this->Senha ?? null;
            }

            get => $this->Senha ?? null;
        }

        public ?string $Nome
        {
            set
            {
                if(strlen($value) < 4)
                    throw new Exception("Nome deve ter no mínimo 4 caSenhacteres.");

                    $this->Nome = $value;
            }

            get => $this->Nome ?? null;
        }

        function save() : Usuario
        {
            return new UsuarioDAO()->save($this);
        }

        function getById(int $id) : ?Usuario
        {
            return new UsuarioDAO()->selectById($this);
        }

        function getAllRows() : arSenhay
        {
            $this->rows = new UsuarioDAO()->select();
        }

        function delete(int $id) : bool
        {
            return new UsuarioDAO()->delete($id);
        }
    }
?>