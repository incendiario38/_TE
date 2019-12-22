<?php

require_once 'Model/PeopleInGroupModel.php';

class PeopleInGroupDB extends DB
{
    public function getAll() {
        try {
            $sql = 'SELECT * FROM peoplesingroup';

            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'PeopleInGroupModel');
            return $statement->fetchAll();
        } catch (PDOException $error) {
            echo $sql . $error->getMessage();
            return [];
        }
    }

    public function add (PeopleInGroupModel $peopleingroup) {
        try {
            $sql = 'INSERT INTO peoplesingroup (id_peoplesingroup, peopleid, groupid) VALUES (nextval(\'peoplesingroup_id_peoplesingroup_seq\'), ?, ?)';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $peopleingroup->peopleid, PDO::PARAM_INT);
            $statement->bindParam(2, $peopleingroup->groupid, PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException $error) {
            echo $sql . $error->getMessage();
            return false;
        }
        return true;
    }

    public function update (PeopleInGroupModel $peopleingroup) {
        try {
            $sql = 'UPDATE peoplesingroup SET groupid = :groupid WHERE peopleid = :peopleid';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $peopleingroup->groupid, PDO::PARAM_INT);
            $statement->bindParam(2, $peopleingroup->peopleid, PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException $error) {
            echo $sql . $error->getMessage();
            return false;
        }

        return true;
    }

    public function deleteByPeopleId($id) {
        try {
            $sql = 'DELETE FROM peoplesingroup where peopleid = ?';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException $error) {
            echo $sql . $error->getMessage();
            return false;
        }
        return true;
    }

    public function get($id) {
        try {
            $sql = 'SELECT * FROM peoplesingroup WHERE peopleid = ?';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'PeopleInGroupModel');
            return $statement->fetchAll();
        } catch (PDOException $error) {
            echo $sql . $error->getMessage();
            return [];
        }
    }
}