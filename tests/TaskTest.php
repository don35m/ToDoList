<?php

    /**
    *@backupGlobals disabled
    *@backupStaticAttributes disabled
    */

    require_once "src/Task.php";
    require_once "src/Category.php";

    $server = 'mysql:host=localhost:8889;dbname=to_do_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class TaskTest extends PHPUnit_Framework_TestCase
    {

          protected function tearDown()

          {
              Task::deleteAll();
              Category::deleteAll();
          }

          function test_save()
          {
              //Arrange
              $name = "Home stuff";
              $id = null;
              $test_category = new Category($name, $id);
              $test_category->save();


              $description = "Wash the dog";
              $category_id = $test_category->getId();
              $task_date = "2015-03-18";
              $test_task = new Task($description, $category_id, $id, $task_date);

              //Act
              $test_task->save();

              //Assert
              $result = Task::getAll();
              $this->assertEquals($test_task, $result[0]);

          }

          function test_getAll()
          {
              //Arrange
              $name = "Home stuff";
              $id = null;
              $test_category = new Category($name, $id);
              $test_category->save();

              $description = "Wash the dog";
              $category_id = $test_category->getId();
              $task_date = "2015-03-18";
              $test_Task = new Task ($description, $category_id, $id, $task_date);
              $test_Task->save();

              $description2 = "Water the lawn";
              $test_Task2 = new Task($description2, $category_id, $id, $task_date);
              $test_Task2->save();

              //Act
              $result = Task::getAll();

              //Assert
              $this->assertEquals([$test_Task, $test_Task2], $result);

          }

        function test_deleteAll()
        {

          //Arrange
          $name = "Home stuff";
          $id = null;
          $test_category = new Category($name, $id);
          $test_category->save();

          $description = "Wash the dog";
          $category_id = $test_category->getId();
          $task_date = "2015-03-18";
          $test_Task = new Task($description, $category_id, $task_date, $id);
          $test_Task->save();

          $description2 = "Water the lawn";
          $test_Task2 = new Task($description2, $category_id, $task_date, $id);
          $test_Task2->save();

          //Act
          Task::deleteAll();

          //Assert
          $result = Task::getAll();
          $this->assertEquals([], $result);

        }

        function test_getId()
        {
            //Arrange
            $name ="Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $task_date = "2015-03-18";
            $test_task = new Task($description, $category_id, $task_date, $id);
            $test_task->save();

            //Act
            $result = $test_task->getId();

            //Assert
            $this->assertEquals(true, is_numeric($result));
        }

        function test_getCategoryId()
        {
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $task_date = "2015-03-18";
            $test_task = new Task($description, $category_id, $task_date, $id);
            $test_task->save();

            $result = $test_task->getCategoryId();

            $this->assertEquals(true, is_numeric($result));
        }

        function test_find()
        {
            //Arrange
            $name = "Home stuff";
            $id = null;
            $test_category = new Category($name, $id);
            $test_category->save();

            $description = "Wash the dog";
            $category_id = $test_category->getId();
            $task_date = "2015-03-18";
            $test_task = new Task($description, $category_id, $id, $task_date);
            $test_task->save();

            $description2 = "Water the lawn";
            $test_Task2 = new Task($description2, $category_id, $id, $task_date);
            $test_Task2->save();

            //Act
            $result = Task::find($test_task->getId());

            //Assert
            $this->assertEquals($test_task, $result);
        }
    }
?>
