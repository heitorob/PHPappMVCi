<?php
namespace PHPappMVCi\DAO;

use PHPappMVCi\Model\Usuario;

final class UsuarioDAO extends DAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function save(Usuario $model): Usuario
    {
        return $model->Id === null ? $this->insert($model) : $this->update($model);
    }

    public function insert(Usuario $model): Usuario
    {
        $sql = "INSERT INTO usuario (email, senha, nome) VALUES (?, sha1(?), ?)";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->Email);
        $stmt->bindValue(2, $model->Senha);
        $stmt->bindValue(3, $model->Nome);
        $stmt->execute();

        $model->Id = parent::$conexao->lastInsertId();
        return $model;
    }

    public function update(Usuario $model): Usuario
    {
        $sql = "UPDATE usuario SET email=?, senha=?, nome=? WHERE id=?";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $model->Email);
        $stmt->bindValue(2, $model->Senha);
        $stmt->bindValue(3, $model->Nome);
        $stmt->bindValue(4, $model->Id);
        $stmt->execute();

        return $model;
    }

    public function selectById(int $id): ?Usuario
    {
        $sql = "SELECT * FROM usuario WHERE id=?";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        return $stmt->fetchObject("PHPappMVCi\Model\Usuario") ?: null;
    }

    public function select(): array
    {
        $sql = "SELECT * FROM usuario";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_CLASS, "PHPappMVCi\Model\Usuario");
    }

    public function delete(int $id): bool
    {
        $sql = "DELETE FROM usuario WHERE id=?";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);
        return $stmt->execute();
    }
}
?>