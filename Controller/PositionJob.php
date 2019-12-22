<?php

require_once 'DB/PositionJobDB.php';
require_once 'Model/PositionJobModel.php';

class PositionJob extends Controller
{
    public function index(...$params)
    {
        $data = [];

        $db = new PositionJobDB();
        $data['positionjob'] = $db->getALL();

        if (count($params) > 0) {
            if ('ok' === array_shift($params)) {
                $data['status'] = 'Успех';
            } else {
                $data['status'] = 'Ошибка';
            }
        }

        $this->view('PositionJob/mainPositionJob', $data);
    }

    public function add(...$parama)
    {
        $data = [];

        if (isset($_POST['submit'])) {
            $model = new PositionJobModel();
            $model->name_positionjob = $_POST['name_positionjob'];

            $db = new PositionJobDB();
            if ($db->add($model)) {
                header('HTTP/1.1 200 OK');
                header('Location: http://' . $_SERVER['HTTP_HOST'] . '/index.php?url=positionJob/index');
            } else {
                $data['status'] = 'Ошибка';
            }
        }

        $this->view('PositionJob/createPositionJob', $data);
    }

    public function update(...$params)
    {
        $db = new PositionJobDB();
        $positionjob = $db->get(array_shift($params));

        $data = [];
        $data['positionjob'] = $positionjob;

        if (isset($_POST['submit'])) {
            $positionjob->name_positionjob = $_POST['name_positionjob'];

            if ($db->update($positionjob)) {
                header('HTTP/1.1 200 OK');
                header('Location: http://' . $_SERVER['HTTP_HOST'] . '/index.php?url=positionJob/index');
            } else {
                $data['status'] = 'Ошибка';
            }
        }

        $this->view('PositionJob/updatePositionJob', $data);
    }

    public function delete(...$params)
    {
        $db = new PositionJobDB();
        if ($db->delete(array_shift($params))) {
            header('HTTP/1.1 200 OK');
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/index.php?url=positionJob/index/ok');
        } else {
            header('HTTP/1.1 200 OK');
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/index.php?url=positionJob/index/error');
        }
    }
}