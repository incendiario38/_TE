<?php

require_once 'DB/PhoneRingDB.php';
require_once 'DB/PeopleDB.php';
require_once 'Model/PhoneRingModel.php';
require_once 'Model/PeopleModel.php';

class PhoneRing extends Controller {
    public function index(...$params) {
        $data = [];

        $db = new PhoneRingDB();
        $data['phonering'] = $db->getALL();

        foreach ($data['phonering'] as $ring) {
            $db_people = new PeopleDB();
            $ring->people = $db_people->findByPhone($ring->callerphone);
        }

        if(count($params) > 0) {
            if ('ok' == array_shift($params)) {
                $data['status'] = 'Успех';
            } else {
                $data['status'] = 'Ошибка';
            }
        }

        $this->view('CallerPhones/mainCallerPhones', $data);
    }

    public function add() {
        $data = [];

        if (isset($_POST['submit'])) {
            $phonering = new PhoneRingModel();
            $phonering->callerphone = $_POST['callerphone'];
            $phonering->datetime = $_POST['datetime'];

            $db = new PhoneRingDB();
            if ($db->add($phonering)) {
                header('HTTP/1.1 200 OK');
                header('Location: http://'.$_SERVER['HTTP_HOST']. '/index.php?url=phonering/index/ok');
            } else {
                $data['status'] = 'Ошибка';
            }
        }
        $this->view('CallerPhones/createCallerPhones', $data);
    }

    public function delete(...$params) {
        $db = new PhoneRingDB();
        if ($db->delete(array_shift($params))) {
            header('HTTP/1.1 200 OK');
            header('Location: http://'.$_SERVER['HTTP_HOST']. '/index.php?url=phonering/index/ok');
        } else {
            header('HTTP/1.1 200 OK');
            header('Location: http://'.$_SERVER['HTTP_HOST']. '/index.php?url=phonering/index/error');
        }
    }
}
