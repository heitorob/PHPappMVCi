<?php
    namespace PHPappMVCi\Model;

    use PHPappMVCi\DAO\CategoriaDAO;
    use Exception;

    final class Categoria extends Model
    {
        public ?int $Id = null;

        public ?string $Descricao
        {
            set
            {
                if(strlen($value) < 4)
                    throw new Exception("Descricao deve ter no mínimo 4 caracteres.");

                    $this->Descricao = $value;
            }

            get => $this->Descricao ?? null;
        }

        function save() : Categoria
        {
            return new CategoriaDAO()->save($this);
        }

        function getById(int $id) : ?Categoria
        {
            return new CategoriaDAO()->selectById($this);
        }

        function getAllRows() : array
        {
            return $this->rows = new CategoriaDAO()->select();
        }

        function delete(int $id) : bool
        {
            return new CategoriaDAO()->delete($id);
        }
    }
?>