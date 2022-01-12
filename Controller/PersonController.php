<?php

namespace CRUD\Controller;

use CRUD\Helper\DBConnector;
use CRUD\Helper\PersonHelper;
use CRUD\Model\Actions;
use PDO;

class PersonController
{
    public function switcher($method,$request)
    {
        switch ($method)
        {
            case Actions::CREATE:
                $this->createAction($request);
                break;
            case Actions::UPDATE:
                $this->updateAction($request);
                break;
            case Actions::READ:
                $this->readAction($request);
                $this->readAllAction($request);
                break;
            case Actions::DELETE:
                $this->deleteAction($request);
                break;
            default:
                break;
        }
    }

    public function createAction($request)
    {
        $helper = new PersonHelper();
        $helper->insert($request);
    }

    public function updateAction($request)
    {
        $helper = new PersonHelper();
        $helper->update($request);
    }

    public function readAction($request)
    {
        if(str_contains($_SERVER['REQUEST_URI'], '/person')) {
            $helper = new PersonHelper();
            $data = $helper->fetch((int) $_GET['id']);
            echo json_encode($data);
        }
    }

    public function readAllAction($request)
    {
        $helper = new PersonHelper();
        if(str_contains($_SERVER['REQUEST_URI'], '/people')) {
            $data = $helper->fetchAll();
            echo json_encode($data);
        }
    }

    public function deleteAction($request)
    {
        $helper = new PersonHelper();
        $helper->delete($request);
    }

}