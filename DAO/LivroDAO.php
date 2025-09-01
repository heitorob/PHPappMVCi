<?php

namespace PHPappMVCi\DAO;

use PHPappMVCi\Model\Livro;

final class LivroDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function save(Livro $model): Livro
    {
        return ($model->Id == null) ? $this->insert($model) :
            $this->update($model);
    }

    public function insert(Livro $model): Livro
    {
        // insere na tabela livro
        $sql = "INSERT INTO livro (id_categoria, titulo, isbn, editora, ano) 
            VALUES (?, ?, ?, ?, ?)";

        $stmt = parent::$conexao->prepare($sql);

        $stmt->bindValue(1, $model->Id_Categoria);
        $stmt->bindValue(2, $model->Titulo);
        $stmt->bindValue(3, $model->Isbn);
        $stmt->bindValue(4, $model->Editora);
        $stmt->bindValue(5, $model->Ano);
        $stmt->execute();

        // pega o ID gerado
        $model->Id = parent::$conexao->lastInsertId();

        // insere vínculos com autores, se houver
        if (!empty($model->Id_Autores) && is_array($model->Id_Autores)) {
            $sqlAssoc = "INSERT INTO Livro_Autor_Assoc (id_livro, id_autor) VALUES (?, ?)";
            $stmtAssoc = parent::$conexao->prepare($sqlAssoc);

            foreach ($model->Id_Autores as $id_autor) {
                $stmtAssoc->execute([$model->Id, $id_autor]);
            }
        }

        return $model;
    }

    public function update(Livro $model): Livro
    {
        // atualiza dados do livro
        $sql = "UPDATE livro 
            SET id_categoria = ?, titulo = ?, isbn = ?, editora = ?, ano = ?
            WHERE id = ?";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->Id_Categoria);
        $stmt->bindValue(2, $model->Titulo);
        $stmt->bindValue(3, $model->Isbn);
        $stmt->bindValue(4, $model->Editora);
        $stmt->bindValue(5, $model->Ano);
        $stmt->bindValue(6, $model->Id);
        $stmt->execute();

        // apaga vínculos antigos
        $sqlDelete = "DELETE FROM Livro_Autor_Assoc WHERE id_livro = ?";
        $stmtDelete = parent::$conexao->prepare($sqlDelete);
        $stmtDelete->execute([$model->Id]);

        // insere vínculos novos
        if (!empty($model->Id_Autores) && is_array($model->Id_Autores)) {
            $sqlAssoc = "INSERT INTO Livro_Autor_Assoc (id_livro, id_autor) VALUES (?, ?)";
            $stmtAssoc = parent::$conexao->prepare($sqlAssoc);

            foreach ($model->Id_Autores as $id_autor) {
                $stmtAssoc->execute([$model->Id, $id_autor]);
            }
        }

        return $model;
    }

    public function selectById(int $id): ?Livro
    {
        $sql = "SELECT * FROM livro WHERE id=? ";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchObject("PHPappMVCi\Model\Livro");
    }

    public function select(): array
    {
        $sql = "SELECT * FROM livro ";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "PHPappMVCi\Model\Livro");
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM livro WHERE id=? ";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}
