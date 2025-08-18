<?php

namespace PHPappMVCi\Model;

use PHPappMVCi\DAO\UsuarioDAO;
use Exception;


final class Usuario extends Model{
    public ?int $Id = null;

    public ?string $nome {
        set{
            if(strlen($value) < 3)
                throw new Exception("Nome deve ter no minimo 3 caracteres");

                $this->nome = $value;
        } get => $this->nome ?? null;
    }

    
    public ?string $email {
        set{
            if(strlen($value) < 3)
                throw new Exception("Email deve ter no minimo 11 caracteres");

                $this->email = $value;
        } get => $this->email ?? null;
    }
    
    public ?string $senha {
        set{
            if(strlen($value) < 3)
                throw new Exception("senha deve ter no minimo 4 caracteres");

                $this->senha = $value;
        } get => $this->senha ?? null;
    }


    function save() : Usuario{
        return new UsuarioDAO()->save($this);
    }

    function getById(int $id) : ?Usuario{
        return new UsuarioDAO()->selectById($id);
    }

    function getAllRows() : array{
        $this->rows = new UsuarioDAO()->select();

        return $this->rows;
    }

    function delete(int $id) : bool{
        return new UsuarioDAO()->delete($id);
    }
}