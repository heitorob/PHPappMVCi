<?php
    namespace PHPappMVCi\DAO;

    use PHPappMVCi\Model\Livro;

    final class LivroDAO extends DAO
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function save(Livro $model) : Livro
        {
            return ($model->Id == null) ? $this->insert($model) :
                $this->update($model);
        }

        public function insert(Livro $model) : Livro
        {
            $sql = "INSERT INTO livro (id_categoria, id_autores, titulo, isbn, editora, ano) VALUES (?, ?, ?, ?, ?, ?) ";

            $stmt = parent::$conexao->prepare($sql);

            $stmt->bindValue(1, $model->Id_Categoria);
            $stmt->bindValue(2, $model->Id_Autores);
            $stmt->bindValue(3, $model->Titulo);
            $stmt->bindValue(4, $model->Isbn);
            $stmt->bindValue(5, $model->Editora);
            $stmt->bindValue(6, $model->Ano);
            $stmt->execute();

            $model->Id = parent::$conexao->lastInsertId();

            return $model;
        }

        public function update(Livro $model) : Livro
        {
            $sql = "UPDATE livro SET id_categoria=?, id_autores=?, titulo=?, isbn=?, editora=?, ano=? WHERE id=? ";

            $stmt = parent::$conexao->prepare($sql);
            $stmt->bindValue(1, $model->Id_Categoria);
            $stmt->bindValue(2, $model->Id_Autores);
            $stmt->bindValue(3, $model->Titulo);
            $stmt->bindValue(4, $model->Isbn);
            $stmt->bindValue(5, $model->Editora);
            $stmt->bindValue(6, $model->Ano);
            $stmt->bindValue(7, $model->Id);
            $stmt->execute();

            return $model;
        }

        public function selectById(int $id) : ?Livro
        {
            $sql = "SELECT * FROM livro WHERE id=? ";

            $stmt = parent::$conexao->prepare($sql);
            $stmt->bindValue(1, $model->Id);
            $stmt->execute();

            return $stmt->fetchObject("PHPappMVCi\Model\Livro");
        }

        public function select() : array
        {
            $sql = "SELECT * FROM livro ";

            $stmt = parent::$conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(DAO::FETCH_CLASS, "PHPappMVCi\Model\Livro");
        }

        public function delete(int $id) : bool
        {
            $sql = "DELETE FROM livros WHERE id=? ";

            $stmt = parent::$conexao->prepare($sql);
            $stmt->bindValue(1, $model->Id);
            return $stmt->execute();
        }
    }
?>