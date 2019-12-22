<?php

require_once 'Model/GroupModel.php';

class GroupDB extends DB
{

    public function getAll()
    {
        try {
            $sql = 'SELECT * FROM groups';

            $statement = $this->connection->prepare($sql);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'GroupModel');
            return $statement->fetchAll();

        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
            return [];
        }
    }


    public function get($id)
    {
        try {
            $sql = 'SELECT * FROM groups WHERE id_group = :id_group';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'GroupModel');
            return $statement->fetch();
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
            return null;
        }
    }

    public function add(GroupModel $group)
    {
        try {
            $sql = 'INSERT INTO groups (id_group, name_group) values (nextval(\'groups_id_group_seq\'), ?)';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $group->name_group, PDO::PARAM_STR);
            $statement->execute();
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
            return false;
        }

        return true;
    }

    public function update(GroupModel $group)
    {
        try {
            $sql = 'UPDATE groups SET name_group = :name_group WHERE id_group = :id_group';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $group->name_group, PDO::PARAM_STR);
            $statement->bindParam(2, $group->id_group, PDO::PARAM_INT);
            $statement->execute();
        } catch (PDOException $error) {
            echo $sql . $error->getMessage();
            return false;
        }

        return true;
    }

    public function delete($id)
    {
        try {
            $sql = 'DELETE FROM groups where id_group = ?';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $id, PDO::PARAM_INT);
            $statement->execute();

        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
            return false;
        }

        return true;
    }

    public function search($name_group) {
        try {
            $sql = 'SELECT * FROM groups WHERE upper(name_group) like \'%\' || upper(?) || \'%\'';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $name_group, PDO::PARAM_STR);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'GroupModel');
            return $statement->fetchAll();
        } catch (PDOException $error) {
            echo $sql . '<br>' . $error->getMessage();
            return null;
        }
    }

    public function getAllByPeopleId($id_people)
    {
        try {
            $sql = 'SELECT groups.* FROM groups JOIN peoplesingroup ON groupid = id_group WHERE peopleid = ?';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(1, $id_people, PDO::PARAM_INT);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_CLASS, 'GroupModel');
            return $statement->fetchAll();

        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
            return [];
        }
    }
}