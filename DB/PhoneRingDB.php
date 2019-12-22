<?php


class PhoneRingDB extends DB
{
    public function getALL() {
        try {
            $sql = 'SELECT * FROM phonering';

            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'PhoneRingModel');
            return $statement->fetchAll();
        } catch (PDOException $error) {
            echo $sql . $error->getMessage();
            return [];
        }
    }

    public function add(PhoneRingModel $phonering) {
        try {
            $sql = 'INSERT INTO phonering (id_phonering, callerphone, datetime) VALUES (nextval(\'phonering_id_phonering_seq\'), ?, ?)';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $phonering->callerphone, PDO::PARAM_STR);
            $statement->bindParam(2, $phonering->datetime, PDO::PARAM_STR);
            $statement->execute();
            return $this->connection->lastInsertId();
        } catch (PDOException $error) {
            echo $sql . $error->getMessage();
            return false;
        }
    }

    public function delete($id) {
        try {
            $sql = 'DELETE FROM phonering WHERE id_phonering = ?';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException $error) {
            echo $sql . $error->getMessage();
            return false;
        }

        return true;
    }
}