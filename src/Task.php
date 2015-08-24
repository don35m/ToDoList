<?php
class Task
{
    private $description;
    private $category_id;
    private $id;
    private $task_date;

    function __construct($description, $category_id, $id = null, $task_date)
    {
        $this->description = $description;
        $this->category_id = $category_id;
        $this->id = $id;
        $this->task_date = $task_date;
    }

    function setDescription($new_description)
    {
        $this->description = (string) $new_description;
    }

    function getDescription()
    {
        return $this->description;
    }

    function getCategoryId()
    {
        return $this->category_id;
    }

    function getId()
    {
        return $this->id;
    }

    function setTaskDate($new_task_date)
    {
      $this->task_date = $new_task_date;
    }

    function getTaskDate()
    {
        return $this->task_date;
    }


    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO tasks (description, category_id, task_date) VALUES ('{$this->getDescription()}', {$this->getCategoryId()}, '{$this->getTaskDate()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function getAll()
    {
        $returned_tasks = $GLOBALS['DB']->query("SELECT * FROM tasks;");
        $tasks = array();
        foreach($returned_tasks as $task) {
            $description = $task['description'];
            $category_id = $task['category_id'];
            $id = $task['id'];
            $task_date = $task['task_date'];
            $new_task = new Task($description, $category_id, $id, $task_date);
            array_push($tasks, $new_task);

        }
        return $tasks;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM tasks;");
    }

    static function find($search_id)
    {
        $found_task = null;
        $tasks = Task::getAll();
        foreach($tasks as $task) {
          $task_id = $task->getId();
          if ($task_id == $search_id) {
              $found_task = $task;
          }
        }

        return $found_task;
    }

}


?>
