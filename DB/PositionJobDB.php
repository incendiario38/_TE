<?php

require_once 'Model/PositionJobModel.php';

class PositionJobDB extends DB
{
    public function getALL() {
        try {
            $sql = 'SELECT * FROM positionjob';

            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'PositionJobModel');
            return $statement->fetchAll();
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
            return [];
        }
    }

    public function get($id) {
        try {
            $sql = 'SELECT * FROM positionjob WHERE positionjob.id_positionjob = ?';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'PositionJobModel');
            return $statement->fetch();
        } catch (PDOException $error) {
            echo $sql ."<br>". $error->getMessage();
            return null;
        }
    }

    public function add(PositionJobModel $positionjob) {
        try{
            $sql = 'INSERT INTO positionjob (id_positionjob, name_positionjob) values (nextval(\'positionjob_id_positionjob_seq\'), ?)';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $positionjob->name_positionjob, PDO::PARAM_STR);
            $statement->execute();
        }catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
            return false;
        }

        return true;
    }

    public function update(PositionJobModel $positionjob) {
        try {
            $sql = 'UPDATE positionjob SET name_positionjob = :name_positionjob WHERE id_positionjob = :id_positionjob';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $positionjob->name_positionjob, PDO::PARAM_STR);
            $statement->bindParam(2, $positionjob->id_positionjob, PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException $error) {
            echo $sql . $error->getMessage();
            return false;
        }

        return true;
    }

    public function delete($id) {
        try {
            $sql = 'DELETE FROM positionjob WHERE id_positionjob = ?';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
            return false;
        }

        return true;
    }
}