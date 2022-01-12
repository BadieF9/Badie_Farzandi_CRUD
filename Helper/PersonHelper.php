<?php

namespace CRUD\Helper;

use PDO;
use PDOException;

class PersonHelper
{

    private PDO $db;

    public function __construct()
    {
        $database = new DBConnector();
        $this->db = $database->getDB();
    }

    public function insert($req)
    {
        $sql = 'INSERT INTO person(firstName, lastName, username) VALUES(:firstName, :lastName, :username)';

        $statement = $this->db->prepare($sql);

        $statement->execute([
            ':username' => $req['username'],
            ':firstName' => $req['firstName'],
            ':lastName' => $req['lastName'],
        ]);
        http_response_code(201);
        echo "Person created successfully";
    }

    public function fetch(int $id)
    {
        try 
        {
            return (($this->db->query("SELECT * FROM person where id = $id"))->fetch());
        } catch (PDOException $exception)
        {
            throw new PDOException($exception->getMessage());
        }
    }

    public function fetchAll()
    {
        try 
        {
            return (($this->db->query("SELECT * FROM person"))->fetchAll());
        } catch (PDOException $exception)
        {
            throw new PDOException($exception->getMessage());
        }
    }

    public function update($req)
    {
        try {
            $statement = $this->db->prepare("UPDATE person SET lastname=:lastName, firstName=:firstName, userName=:userName WHERE id=:id");
            $data = json_decode(file_get_contents("php://input"));
            $statement->execute([
                ':id' => $data->id,
                ':userName' => $data->username,
                ':firstName' => $data->firstName,
                ':lastName' => $data->lastName
            ]);
            echo "user with id: ". $data->id ." updated successfully.";
          } catch(PDOException $e) {
            throw new PDOException($e->getMessage());
          }
    }

    public function delete($req)
    {
        try {
            $statement = $this->db->prepare("DELETE FROM person WHERE id=:id");
            $data = json_decode(file_get_contents("php://input"));
            $statement->execute([
                ':id' => $data->id
            ]);
            echo "user with id: ". $data->id ." deleted successfully.";
          } catch(PDOException $e) {
            throw new PDOException($e->getMessage());
          }
    }

}