<?php

require_once 'DB/GroupDB.php';
require_once 'Model/GroupModel.php';

class Group extends Controller
{
    public function index(...$params)
    {
        $data = [];

        $db = new GroupDB();
        $data['groups'] = $db->getAll();

        if (count($params) > 0) {
            if ('ok' == array_shift($params)) {
                $data['status'] = 'Успех';
            } else {
                $data['status'] = 'Ошибка';
            }
        }

        $this->view('Group/mainGroup', $data);
    }

    public function add()
    {
        $data = [];

        if (isset($_POST['submit'])) {
            $model = new GroupModel();
            $model->name_group = $_POST['name_group'];

            $db = new GroupDB();
            if ($db->add($model)) {
                header('HTTP/1.1 200 OK');
                header('Location: http://'.$_SERVER['HTTP_HOST']. '/index.php?url=group/index/ok');
            } else {
                $data['status'] = 'Ошибка';
            }
        }

        $this->view('Group/createGroup', $data);
    }

    public function update(...$params) {
        $db = new GroupDB();
        $group = $db->get(array_shift($params));

        $data = [];
        $data['group'] = $group;

        if (isset($_POST['submit'])) {
            $group->name_group = $_POST['name_group'];

            if ($db->update($group)) {
                header('HTTP/1.1 200 OK');
                header('Location: http://'.$_SERVER['HTTP_HOST']. '/index.php?url=group/index/ok');
            } else {
                $data['status'] = 'Ошибка';
            }
        }

        $this->view('Group/updateGroup', $data);
    }

    public function delete(...$params) {
        $db = new GroupDB();
        if ($db->delete(array_shift($params)))
        {
            header('HTTP/1.1 200 OK');
            header('Location: http://'.$_SERVER['HTTP_HOST']. '/index.php?url=group/index/ok');
        } else {
            header('HTTP/1.1 200 OK');
            header('Location: http://'.$_SERVER['HTTP_HOST']. '/index.php?url=group/index/error');
        }
    }

    public function search() {
        $data = [];

        if (isset($_POST['submit'])) {
            $db = new GroupDB();
            $groups = $db->search($_POST['name_group']);

            $data['groups'] = $groups;
        }

        $this->view('Group/searchGroup', $data);
    }
}