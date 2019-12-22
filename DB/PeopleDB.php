<?php

require_once 'Model/PeopleModel.php';

class PeopleDB extends DB
{
    public function getALL()
    {
        try {
            $sql = 'SELECT * FROM peoples';

            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'PeopleModel');
            return $statement->fetchAll();
        } catch (PDOException $error) {
            echo $sql . '<br>' . $error->getMessage();
            return [];
        }
    }

    public function get($id) {
        try {
            $sql = 'SELECT * FROM peoples WHERE peoples.id_people = ?';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'PeopleModel');
            return $statement->fetch();
        } catch (PDOException $error) {
            echo $sql . '<br>' . $error->getMessage();
            return null;
        }
    }

    public function add(PeopleModel $people) {
        try {
            $sql = 'INSERT INTO peoples (id_people, fio, address, email, positionjobid) VALUES (nextval(\'peoples_id_people_seq\'), ?, ?, ?, ?)';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $people->fio, PDO::PARAM_STR);
            $statement->bindParam(2, $people->address, PDO::PARAM_STR);
            $statement->bindParam(3, $people->email, PDO::PARAM_STR);
            $statement->bindParam(4, $people->positionjobid, PDO::PARAM_INT);
            $statement->execute();
            return $this->connection->lastInsertId();
        } catch (PDOException $error) {
            echo $sql . '<br>' . $error->getMessage();
            return false;
        }
    }

    public function update(PeopleModel $people) {
        try {
            $sql = 'UPDATE peoples SET fio = :fio, address = :address, email = :email, positionjobid = :positionjobid WHERE id_people = :id_people' ;

            $statement = $this->connection->prepare($sql);
            $statement->bindParam('id_people', $people->id_people, PDO::PARAM_INT);
            $statement->bindParam(1,$people->fio, PDO::PARAM_STR);
            $statement->bindParam(2, $people->address, PDO::PARAM_STR);
            $statement->bindParam(3, $people->email, PDO::PARAM_STR);
            $statement->bindParam(4, $people->positionjobid, PDO::PARAM_INT);
            $statement->execute();
            return $people->id_people;
        } catch (PDOException $error) {
            echo $sql . $error->getMessage();
            return false;
        }
    }

    public function delete($id) {
        try {
            $sql = 'DELETE FROM peoples WHERE id_people = ?';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException $error) {
            echo $sql . $error->getMessage();
            return false;
        }

        return true;
    }

    public function search($search) {
        try {
            $sql = 'SELECT p.* FROM peoples p
LEFT JOIN peoplesingroup pg ON pg.peopleid = p.id_people
LEFT JOIN groups g ON g.id_group = pg.groupid
LEFT JOIN phones ph ON ph.peopleid = p.id_people
LEFT JOIN positionjob pj ON pj.id_positionjob = p.positionjobid
WHERE UPPER(p.fio) LIKE UPPER(:search)
OR UPPER(p.email) LIKE UPPER(:search)
OR UPPER(p.address) LIKE UPPER(:search)
OR UPPER(g.name_group) LIKE UPPER(:search)
OR UPPER(ph.phone) LIKE UPPER(:search)
OR UPPER(pj.name_positionjob) LIKE UPPER(:search)
GROUP BY p.id_people';

            $search = '%' . $search . '%';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam('search', $search, PDO::PARAM_STR);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'PeopleModel');
            return $statement->fetchAll();
        } catch (PDOException $error) {
            echo $sql . '<br>' . $error->getMessage();
            return [];
        }
    }

    public function findByPhone($phonenumber) {
        try {
            $sql = 'SELECT p.* FROM phones ph
LEFT JOIN peoples p ON p.id_people = ph.peopleid
WHERE ph.phone LIKE :phonenumber
GROUP BY p.id_people';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam('phonenumber', $phonenumber, PDO::PARAM_STR);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'PeopleModel');
            return $statement->fetch();
        } catch (PDOException $error) {
            echo $sql . '<br>' . $error->getMessage();
            return null;
        }
    }
}