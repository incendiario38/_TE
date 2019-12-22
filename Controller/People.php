<?php

require_once 'DB/PeopleDB.php';
require_once 'DB/PeopleInGroupDB.php';
require_once 'DB/GroupDB.php';
require_once 'DB/PhoneDB.php';
require_once 'DB/PositionJobDB.php';
require_once 'Model/PeopleModel.php';
require_once 'Model/PeopleInGroupModel.php';
require_once 'Model/GroupModel.php';
require_once 'Model/PhoneModel.php';
require_once 'Model/PositionJobModel.php';

class People extends Controller
{
    public function index(...$params)
    {
        $data = [];

        $db = new PeopleDB();
        $data['peoples'] = $db->getALL();

        foreach ($data['peoples'] as $people) {
            $db_groups = new GroupDB();
            $people->groups = $db_groups->getAllByPeopleId($people->id_people);
            $db_phones = new PhoneDB();
            $people->phones = $db_phones->getAllByPeopleId($people->id_people);
            $db_pos = new PositionJobDB();
            $people->positionjob = $db_pos->get($people->positionjobid);
        }

        if (count($params) > 0) {
            if ('ok' == array_shift($params)) {
                $data['status'] = 'Успех';
            } else {
                $data['status'] = 'Ошибка';
            }
        }

        $this->view('People/mainPeople', $data);
    }

    public function add(...$params)
    {
        $data = [];

        $db_groups = new GroupDB();
        $data['groups'] = $db_groups->getAll();
        $db_positionjob = new PositionJobDB();
        $data['positionjob'] = $db_positionjob->getALL();


        if (isset($_POST['submit'])) {
            $peoples = new PeopleModel();
            $peoples->fio = $_POST['fio'];
            $peoples->address = $_POST['address'] ?? null;
            $peoples->email = $_POST['email'] ?? null;
            $peoples->positionjobid = $_POST['positionjobid'] ?? null;
            $db = new PeopleDB();


            if (false !== $id = $db->add($peoples)) {
                $error = false;

                $db_peopleingroup = new PeopleInGroupDB();
                if (isset($_POST['groups'])) {
                    foreach ($_POST['groups'] as $id_group) {
                        if (false !== $error) break;
                        $peopleingroup = new PeopleInGroupModel();
                        $peopleingroup->peopleid = $id;
                        $peopleingroup->groupid = $id_group;
                        $error = !$db_peopleingroup->add($peopleingroup);
                    }
                }

                $error1 = false;
                $db_phones = new PhoneDB();
                if (isset($_POST['phones'])) {
                    foreach ($_POST['phones'] as $_phone) {
                        if ($error1) break;

                        if (empty($_phone)) continue;
                        
                        $phone = new PhoneModel();
                        $phone->peopleid = $id;
                        $phone->phone = $_phone;
                        $error1 = !$db_phones->add($phone);
                    }
                }

                if (!$error && !$error1) {
                    header('HTTP/1.1  200 OK');
                    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/index.php?url=people/index');
                } else {
                    $data['status'] = 'Ошибка добавления групп и/или телефонов';
                }
            }

            $data['status'] = $data['status'] ?? 'Ошибка добавления контакта';
        }

        $this->view('People/createPeople', $data);
    }

    public function update(...$params)
    {
        $data = [];

        $db_groups = new GroupDB();
        $data['groups'] = $db_groups->getAll();

        $db_positionjob = new PositionJobDB();
        $data['positionjob'] = $db_positionjob->getALL();

        $db_people = new PeopleDB();
        $people = $db_people->get(array_shift($params));

        if (!$people) {
            die('Not Found');
        }

        $db_phone = new PhoneDB();
        $people->phones = $db_phone->getAllByPeopleId($people->id_people);
        $people->groups = $db_groups->getAllByPeopleId($people->id_people);

        $data['people'] = $people;

        if (isset($_POST['submit'])) {
            $people->fio = $_POST['fio'];
            $people->address = $_POST['address'];
            $people->email = $_POST['email'];
            $people->positionjobid = $_POST['positionjob'];
            $db = new PeopleDB();

            if (false !== $id = $db->update($people)) {
                $db_peopleingroup = new PeopleInGroupDB();
                $error = !$db_peopleingroup->deleteByPeopleId($id);

                if (isset($_POST['groups'])) {
                    foreach ($_POST['groups'] as $id_group) {
                        if (false !== $error) break;
                        $peopleingroup = new PeopleInGroupModel();
                        $peopleingroup->peopleid = $id;
                        $peopleingroup->groupid = $id_group;
                        $error = !$db_peopleingroup->add($peopleingroup);
                    }
                }

                $error1 = !$db_phone->deleteByPeopleId($id);

                if (isset($_POST['phones'])) {
                    foreach ($_POST['phones'] as $_phone) {
                        if ($error1) break;

                        if (empty($_phone)) continue;

                        $phone = new PhoneModel();
                        $phone->peopleid = $id;
                        $phone->phone = $_phone;
                        $error1 = !$db_phone->add($phone);
                    }
                }

                if (!$error && !$error1) {
                    header('HTTP/1.1 200 OK');
                    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/index.php?url=people/index/ok');
                } else {
                    $data['status'] = 'Ошибка обновления групп и/или телефонов';
                }
            }

            $data['status'] = $data['status'] ?? 'Ошибка обновления контакта';
        }
        $this->view('People/updatePeople', $data);
    }

    public function delete(...$params)
    {
        $db = new PeopleDB();

        $id = array_shift($params);
        if (is_numeric($id) && $db->get($id) instanceof PeopleModel) {
            if ($db->delete($id)) {
                $db_phone = new PhoneDB();
                $db_phone->deleteByPeopleId($id);

                $db_peopleingroup = new PeopleInGroupDB();
                $db_peopleingroup->deleteByPeopleId($id);

                header('HTTP/1.1 200 OK');
                header('Location: http://' . $_SERVER['HTTP_HOST'] . '/index.php?url=people/index/ok');
            } else {
                header('HTTP/1.1 200 OK');
                header('Location: http://' . $_SERVER['HTTP_HOST'] . '/index.php?url=people/index/error');
            }
        }

        die('Not Found');
    }

    public function search()
    {
        $data = [];

        if (isset($_POST['submit'])) {
            $db = new PeopleDB();
            $peoples = $db->search($_POST['search']);

            foreach ($peoples as $people) {
                $db_groups = new GroupDB();
                $people->groups = $db_groups->getAllByPeopleId($people->id_people);

                $db_phones = new PhoneDB();
                $people->phones = $db_phones->getAllByPeopleId($people->id_people);

                $db_pos = new PositionJobDB();
                $people->positionjob = $db_pos->get($people->positionjobid);

            }

            //die('<pre>' . print_r($peoples, true) . '</pre>');

            $data['peoples'] = $peoples;
        }

        $this->view('People/searchPeople', $data);
    }
}