<?php
namespace PHPappMVCi\DAO;

use PHPappMVCi\Model\Usuario;
use PHPappMVCi\DAO\DAO;

final class UsuarioDAO extends DAO{
    public function __construct(){
        parent::__construct();
    }

    public function save(Usuario $model_usuario) : Usuario{
        return ($model_usuario->Id ==null) ? $this->insert($model_usuario):
            $this->update($model_usuario);
    }

    public function insert(Usuario $model_usuario) : Usuario{
        $sql = "INSERT INTO usuario (nome, email, senha) VALUES (?,?,sha1(?)) ";
        $stmt = parent::$conexao->prepare($sql);

        $stmt->bindValue(1, $model_usuario->nome);
        $stmt->bindValue(2, $model_usuario->email);
        $stmt->bindValue(3, $model_usuario->senha);

        $stmt->execute();

        $model_usuario->Id = parent::$conexao->lastInsertId();

        return $model_usuario;
    }

    public function update(Usuario $model_usuario) : Usuario{
        $sql = "UPDATE Usuario SET nome=?, email=?, senha=sha1(?) WHERE id=? ";
        $stmt = parent::$conexao->prepare($sql);

        $stmt->bindValue(1, $model_usuario->nome);
        $stmt->bindValue(2, $model_usuario->email);
        $stmt->bindValue(3, $model_usuario->senha);
        $stmt->bindValue(3, $model_usuario->Id);
        $stmt->execute();
        $model_usuario->Id = parent::$conexao->lastInsertId();

        return $model_usuario;
    }


    public function selectById(int $id) : ?Usuario{
        $sql = "SELECT * FROM Usuario WHERE id=? ";
        
        
        $stmt = parent::$conexao->prepare($sql);

        $stmt->bindValue(1, $id);

        $stmt->execute();

        

        return $stmt->fetchObject();
    }

    public function select() : array{
        $sql = "SELECT * FROM usuarios";

        $stmt = parent::$conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "App\Model\Usuario");
    }

    public function delete(int $id) : bool{
        $sql = "DELETE from usuario WHERE id=?";
        $stmt = parent::$conexao->prepare($sql);
        $stmt->bindValue(1, $id);

        return $stmt->execute();
    }
}