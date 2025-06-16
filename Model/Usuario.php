<?php
namespace PHPappMVCi\Model;

use PHPappMVCi\DAO\UsuarioDAO;
use Exception;

final class Usuario extends Model
{
    public ?int $Id = null;
    public ?string $Email = null;
    public ?string $Senha = null;
    public ?string $Nome = null;

    public function setEmail(string $email): void
    {
        if (strlen($email) < 4) {
            throw new Exception("Email deve ter no mínimo 4 caracteres.");
        }

        $this->Email = $email;
    }

    public function setSenha(string $senha): void
    {
        if (empty($senha)) {
            throw new Exception("Preencha a senha.");
        }

        $this->Senha = $senha;
    }

    public function setNome(string $nome): void
    {
        if (strlen($nome) < 4) {
            throw new Exception("Nome deve ter no mínimo 4 caracteres.");
        }

        $this->Nome = $nome;
    }

    public function save(): Usuario
    {
        return (new UsuarioDAO())->save($this);
    }

    public function getById(int $id): ?Usuario
    {
        return (new UsuarioDAO())->selectById($id);
    }

    public function getAllRows(): array
    {
        return (new UsuarioDAO())->select();
    }

    public function delete(int $id): bool
    {
        return (new UsuarioDAO())->delete($id);
    }
}
?>