<?php
    namespace PHPappMVCi\Model;

    use PHPappMVCi\DAO\LivroDAO;
    use Exception;

    final class Livro extends Model
    {
        public ?int $Id = null;

        public array $rows_categorias = [];
        public array $rows_autores = [];

        public $Id_Categoria;
        public $Id_Autores;

        public ?string $Titulo
        {
            set
            {
                if(strlen($value) < 4)
                    throw new Exception("Título deve ter pelo menos 4 caracteres.");

                    $this->Titulo = $value;
            }
            get => $this->Titulo ?? null;
        }

        public ?string $Isbn
        {
            set
            {
                if(strlen($value) < 3)
                    throw new Exception("ISBN deve ter pelo menos 3 caracteres.");

                    $this->Isbn = $value;
            }
            get => $this->Isbn ?? null;
        }

        public ?string $Editora
        {
            set
            {
                if(strlen($value) < 4)
                    throw new Exception("Editora deve ter pelo menos 4 caracteres.");

                    $this->Editora = $value;
            }
            get => $this->Editora ?? null;
        }

        public ?string $Ano
        {
            set
            {
                if(strlen($value) < 3)
                    throw new Exception("Ano deve ter pelo menos 3 caracteres.");

                    $this->Ano = $value;
            }
            get => $this->Ano ?? null;
        }

        function save() : Livro
        {
            return new LivroDAO()->save($this);
        }

        function getById(int $id) : ?Livro
        {
            return new LivroDAO()->selectById($id);
        }

        function getAllRows() : array
        {
            $this->rows = new LivroDAO()->select();

            return $this->rows;
        }

        function delete(int $id) : bool
        {
            return new LivroDAO()->delete($id);
        }
    }
?>