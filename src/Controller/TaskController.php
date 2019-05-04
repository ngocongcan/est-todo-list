<?php
/**
 * Class TaskController
 *
 * @package  ${NAMESPACE}
 * @author   canngo
 *
 */

namespace Est\TodoApp\Controller;

use Est\TodoApp\Entities\Tasks;
use Est\TodoApp\ServiceProviders\DBService;

class TaskController extends EstController
{

    private $dbService;

    /**
     * TaskController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->dbService = new DBService('sqlite.db');
    }

    public function handle() {

        $action = $this->get('action');
        $success = true;
        $result = null;
        switch ($action) {
            case 'get_all' :
                $result = $this->getAll();
                break;
            case 'create' :
                $name = $this->get('name');
                $status = $this->get('status');
                $startDate = $this->get('start_date');
                $endDate = $this->get('end_date');
                $success = $this->createTask($name, $status, $startDate, $endDate);
                break;
            case 'update' :
                $id = $this->get('id');
                $name = $this->get('name');
                $status = $this->get('status');
                $startDate = $this->get('start_date');
                $endDate = $this->get('end_date');
                $success = $this->updateTask($id, $name, $status, $startDate, $endDate);
                break;
            case 'delete' :
                $id = $this->get('id');
                $success = $this->deleteTask($id);
                break;
            default:

        }

        return [
            'success' => $success,
            'result' => $result,
        ];

    }


    public function getAll() {

        $sql = "SELECT id, name, status, start_date, end_date, CASE
     WHEN status = " . Tasks::STATUS_PLANING. "  THEN 'Planing'
     WHEN status = " . Tasks::STATUS_DOING. "  THEN 'Doing'
     WHEN status = " . Tasks::STATUS_COMPLETE. "  THEN 'Complete'
     ELSE 'Undefined'
     END as text_status FROM tasks";
        $result = $this->dbService->query($sql);
        $rows = array();
        while($res = $result->fetchArray(SQLITE3_ASSOC)){
            if(!isset($res['id'])) continue;
            $rows[$res['id']] = $res;
        }
        return $rows;
    }

    public function getTask($id) {

        $sql = "SELECT * FROM tasks WHERE id = $id";
        $result = $this->dbService->query($sql);
        while($res = $result->fetchArray(SQLITE3_ASSOC)){
            if(!isset($res['id'])) continue;
            return $res;
        }
        return null;
    }


    public function createTask($name, $status, $startDate, $endDate) {

        $task = new Tasks();
        $task->setName($name);
        $task->setStatus($status);
        $task->setStartDate($startDate);
        $task->setEndDate($endDate);
        $sql = $task->getInsertQuery();
        $result = $this->dbService->exec($sql);
        return  $result ? $this->dbService->lastInsertRowID() : false;

    }

    public function deleteTask($id) {

        $task = new Tasks();
        $task->setId($id);
        $sql = $task->getDeleteQuery();
        $result = $this->dbService->exec($sql);
        return $result;
    }

    public function updateTask($id, $name, $status, $startDate, $endDate) {

        $task = new Tasks();
        $task->setId($id);
        $task->setName($name);
        $task->setStatus($status);
        $task->setStartDate($startDate);
        $task->setEndDate($endDate);
        $sql = $task->getUpdateQuery();
        $result = $this->dbService->exec($sql);

        return $result;
    }

    public function getTaskName($name) {

        $sql = "SELECT * FROM tasks WHERE name = '$name'";
        $result = $this->dbService->query($sql);
        while($res = $result->fetchArray(SQLITE3_ASSOC)){
            if(!isset($res['id'])) continue;
            return $res;
        }
        return null;
    }
}
