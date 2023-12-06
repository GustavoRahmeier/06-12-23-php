<?php

namespace App\Models\DAO;

use App\Models\Usuario;
use App\Core\Database;

class UsuarioDAO
{
    private $table = 'teste';
    private $db;
    private $connection;

    public function __construct()
    {
        $this->db = new Database();
        $this->connection = $this->db->getConnection();
    }

    public function listarTodos()
    {
        try {
            $sql = "SELECT * FROM $this->table ORDER BY id";
            $stmt = $this->connection->query($sql);
            $usuarios = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            $this->db->closeConnection();

            return $usuarios;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function recuperarUsuarioPorId($usuarioId)
    {
        try {
            $sql = "SELECT * FROM $this->table WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$usuarioId]);
            $usuario = $stmt->fetch(\PDO::FETCH_ASSOC);

            $this->db->closeConnection();
            
<<<<<<< HEAD
            if ($Usuario) {
                $UsuarioData = new Usuario($Usuario["nome"], $Usuario["email"], $Usuario["id"]);
                return $UsuarioData;
=======
            if ($usuario) {
                $usuarioData = new Usuario($usuario["nome"], $usuario["id"]);
                return $usuarioData;
>>>>>>> 95111eea41a938d1fa8a4b346f86377e8d6cc5b4
            } else {
                return null;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function salvar(Usuario $usuario)
    {
        try {
            $sql = "INSERT INTO $this->table (nome, email) VALUES (?)";
            $stmt = $this->connection->prepare($sql);

            $stmt->execute([$usuario->getNome()]);

            $this->db->closeConnection();

            if ($stmt->rowCount() > 0) {
                $usuarioId = $this->connection->lastInsertId();
                $usuarioData = $this->recuperarUsuarioPorId($usuarioId);
                return $usuarioData;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function atualizar($usuario)
    {
        try {
            $sql = "UPDATE $this->table SET nome = ?, email = ? WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
<<<<<<< HEAD
            $stmt->execute([$Usuario->getNome(), $Usuario->getEmail(), $Usuario->getId()]);
=======
            $stmt->execute([$usuario->getNome(), $usuario->getId()]);
>>>>>>> 95111eea41a938d1fa8a4b346f86377e8d6cc5b4
            
            $this->db->closeConnection();

            if ($stmt->rowCount() > 0) {
                $usuarioApagar = $this->recuperarUsuarioPorId($usuario->getId());
                return $usuarioApagar;
            } else {
                return null;
            }
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function apagar($id)
    {
        try {
            $usuarioApagar = $this->recuperarUsuarioPorId($id);
            
            if ($usuarioApagar) {
                $sql = "DELETE FROM $this->table WHERE id = ?";
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([$id]);
                $this->db->closeConnection();
            } 
            return $usuarioApagar;
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}