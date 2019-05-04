<?php
/**
 * Class Tasks
 *
 * @package  ${NAMESPACE}
 * @author   canngo
 *
 */
namespace Est\TodoApp\Entities;

class Tasks
{

    private $id;

    private $name;

    private $status;

    private $startDate;

    private $endDate;


    const STATUS_PLANING = 0;
    const STATUS_DOING = 1;
    const STATUS_COMPLETE = 2;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;
    }


    public function getInsertQuery() {
        return "INSERT INTO tasks (name, status, start_date, end_date)
         VALUES( '$this->name', $this->status, '$this->startDate', '$this->endDate')";
    }

    public function getUpdateQuery() {
        return "UPDATE tasks SET name = '$this->name', status = $this->status,
         start_date = '$this->startDate', end_date = '$this->endDate' WHERE id = $this->id";
    }

    public function getDeleteQuery() {
        return "DELETE from tasks WHERE id = $this->id";
    }
}
