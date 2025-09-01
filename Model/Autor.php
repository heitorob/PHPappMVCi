<?php
    namespace PHPappMVCi\Model;

    use PHPappMVCi\DAO\AutorDAO;
    use Exception;

    final class Autor extends Model
    {
        public ?int $Id = null;

        public ?string $Nome
        {
            set
            {
                if(strlen($value) < 4)
                    throw new Exception("Nome deve ter no mínimo 4 caracteres.");

                    $this->Nome = $value;
            }

            get => $this->Nome ?? null;
        }

        public ?string $Nascimento
        {
            set
            {
                if(empty($value))
                    throw new Exception("Preencha a data de nascimento.");

                    $this->Nascimento = $value;
            }

            get => $this->Nascimento ?? null;
        }

        public ?string $CPF
        {
            set
            {
                if(strlen($value) != 11)
                    throw new Exception("Preencha o CPF corretamente.");

                    $this->CPF = $value;
            }

            get => $this->CPF ?? null;
        }

        function save() : Autor
        {
            return new AutorDAO()->save($this);
        }

        function getById(int $id) : ?Autor
        {
            return new AutorDAO()->selectById($id);
        }

        function getAllRows() : array
        {
            return $this->rows = new AutorDAO()->select();
        }

        function delete(int $id) : bool
        {
            return new AutorDAO()->delete($id);
        }
    }
?>