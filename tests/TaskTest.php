<?php

namespace Est\TodoApp\Tests;

use Est\TodoApp\Controller\TaskController;


class TaskTest extends TestCase
{
    private  $controller;

    /**
     * TaskTest constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->controller = new TaskController();
    }

    public function testInsertTask()
    {
        $result = $this->controller->createTask('Test_TASK', 0,'2019-05-01', '2019-05-02');
        $this->assertNotFalse($result, 'Insert task fail');
    }

    public function testFetchTask()
    {
        $taskController = new TaskController();
        $result = $taskController->getAll();
        $this->assertNotEmpty($result, 'Empty task');
    }

    public function testUpdateTask()
    {
        $task = $this->controller->getTaskName('Test_TASK');
        if ($task) {
            $result = $this->controller->updateTask($task['id'], 'Test_TASK_UPDATED', 1, '2019-05-02', '2019-05-04');
            if ($result) {
                $updatedTask = $this->controller->getTask($task['id']);
                $expected = [
                    'id' => $task['id'],
                    'name' => 'Test_TASK_UPDATED',
                    'status' => 1,
                    'start_date' => '2019-05-02',
                    'end_date' => '2019-05-04',
                ];
                $this->assertEquals($updatedTask, $expected, 'Update fail');
            } else {
                $this->assertEquals(1, $result);
            }
        }
    }

    public function testDeleteTask()
    {
        $task = $this->controller->getTaskName('Test_TASK_UPDATED');
        if ($task['id']) {
            $result = $this->controller->deleteTask($task['id']);
            $this->assertTrue($result, 'Delete task');
        } else {
            $this->assertTrue(false);
        }
    }
}
