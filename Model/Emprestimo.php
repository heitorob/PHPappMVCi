<?php
    namespace PHPappMVCi\Model;

    use PHPappMVCi\DAO\EmprestimoDAO;
    use Exception;

    final class Emprestimo extends Model
    {
        public ?int $Id = null;
        public ?int $Id_Usuario = null;
        public ?int $Id_Livro = null;
        public ?int $Id_Aluno = null;

        public ?string $DataEmprestimo = null;
        public ?string $Devolucao = null;

        public ?Aluno $DadosAluno = null;
        public ?Livro $DadosLivro = null;

        public array $rows_alunos = [];
        public array $rows_livros = [];

        function save() : Emprestimo
        {
            return new EmprestimoDAO()->save($this);
        }

        function getById(int $id) : ?Emprestimo
        {
            return new EmprestimoDAO()->selectById($id);
        }

        function getAllRows() : array
        {
            $this->rows = new EmprestimoDAO()->select();

            return $this->rows;
        }

        function delete(int $id) : bool
        {
            return new EmprestimoDAO()->delete($id);
        }
    }
?>