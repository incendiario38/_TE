<?php

require_once 'Model/PhoneModel.php';

class PhoneDB extends DB
{
    public function getALL() {
        try {
            $sql = 'SELECT * FROM phones';

            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'PhoneModel');
            return$statement->fetchAll();
        } catch (PDOException $error) {
            echo $sql . $error->getMessage();
            return [];
        }
    }

    public function get($id) {
        try {
            $sql = 'SELECT * FROM phones WHERE id_phone = :id_phone';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'PhoneModel');
            return $statement->fetch();
        } catch (PDOException $error) {
            echo $sql . $error->getMessage();
            return null;
        }
    }

    public function add(PhoneModel $phone) {
        try {
            $sql = 'INSERT INTO phones (id_phone, peopleid, phone) values (nextval(\'phones_id_phone_seq\'), ?, ?)';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $phone->peopleid, PDO::PARAM_INT);
            $statement->bindParam(2, $phone->phone, PDO::PARAM_STR);
            $statement->execute();
        } catch (PDOException $error) {
            echo $sql . $error->getMessage();
            return false;
        }

        return true;
    }

    public function update(PhoneModel $phone) {
        try {
            $sql = 'UPDATE phones SET phone = :phone WHERE id_phone= :id_phone';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $phone->phone, PDO::PARAM_STR);
            $statement->bindParam(2, $phone->id_phone, PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException $error) {
            echo $sql . $error->getMessage();
            return false;
        }

        return true;
    }

    public function deleteByPeopleId($id) {
        try {
            $sql = 'DELETE FROM phones WHERE peopleid = ?';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException $error) {
            echo $sql . $error->getMessage();
            return false;
        }

        return true;
    }

    public function getAllByPeopleId($id_people)
    {
        try {
            $sql = 'SELECT * FROM phones WHERE peopleid = ?';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $id_people, PDO::PARAM_INT);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'PhoneModel');
            return $statement->fetchAll();

        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
            return [];
        }
    }
}