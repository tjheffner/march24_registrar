<?php

    /**
    *  @backupGlobals disabled
    *  @backupStaticAttributes disabled
    */

    require_once "src/Student.php";

    $DB = new PDO ('pgsql:host=localhost;dbname=college_test');

    Class StudentTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Student::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Tim";
            $id = 1;
            $date = 1;
            $test_student = new Student($name, $id, $date);

            //Act
            $result = $test_student->getName();

            //Assert
            $this->assertEquals($name, $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Lizabeth";
            $id = 1;
            $date = 1;
            $test_student = new Student($name, $id, $date);

            //Act
            $result = $test_student->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function test_setId()
        {
            //Arrange
            $name = "Frederick";
            $id = null;
            $date = 1;
            $test_student = new Student($name, $id, $date);

            //Act
            $test_student->setId(2);

            //Assert
            $result = $test_student->getId();
            $this->assertEquals(2, $result);
        }

        function test_getDate()
        {
            //Arrange
            $name = "Frederick";
            $id = 1;
            $date = 1;
            $test_student = new Student($name, $id, $date);

            //Act
            $result = $test_student->getDate();

            //Assert
            $this->assertEquals(1, $result);
        }

// test chunk for save / getall / deleteall
        function test_save()
        {
            //Arrange
            $name = "Bartholomew";
            $id = 1;
            $date = 1;
            $test_student = new Student($name, $id, $date);

            //Act
            $test_student->save();

            //Assert
            $result = Student::getAll();
            $this->assertEquals([$test_student], $result);
        }

        function test_getAll()
        {
            //Arrange
            $name1 = "Nathanael";
            $name2 = "Nathaniel";
            $id = 1;
            $id2 = 2;
            $date = 1;

            $test_student1 = new Student($name1, $id, $date);
            $test_student2 = new Student($name2, $id2, $date);
            $test_student1->save();
            $test_student2->save();

            //Act
            $result = Student::getAll();

            //Assert
            $this->assertEquals([$test_student1, $test_student2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name1 = "Nathanael";
            $name2 = "Nathaniel";
            $id = 1;
            $id2 = 2;
            $date = 1;

            $test_student1 = new Student($name1, $id, $date);
            $test_student2 = new Student($name2, $id2, $date);
            $test_student1->save();
            $test_student2->save();

            //Act
            Student::deleteAll();

            //Assert
            $result = Student::getAll();
            $this->assertEquals([], $result);
        }

        function test_updateStudent()
        {
            //Arrange
            $name = "Bobby Knight";
            $id = 1;
            $date = 1;

            $test_student = new Student($name, $id, $date);
            $test_student->save();

            $new_name = "Robert Knight";

            //Act
            $test_student->updateStudent($new_name);

            //Assert
            $result = $test_student->getName();
            $this->assertEquals($new_name, $result);
        }

        function test_deleteStudent()
        {
            //Arrange
            $name = "Pope Francis";
            $id = 1;
            $date = 1;
            $test_student = new Student($name, $id, $date);
            $test_student->save();

            $name2 = "Tsar Nikolas";
            $id2 = 2;
            $test_student2 = new Student($name2, $id2, $date);
            $test_student2->save();

            //Act
            $test_student->deleteStudent();

            //Assert
            $result = Student::getAll();
            $this->assertEquals([$test_student2], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "Long John Silver";
            $id = 1;
            $date = 1;
            $test_student = new Student($name, $id, $date);
            $test_student->save();

            $name2 = "Tiny Tim";
            $id2 = 2;
            $test_student2 = new Student($name2, $id2, $date);
            $test_student2->save();

            //Act
            $result = Student::find($test_student->getId());

            //Assert
            $this->assertEquals($test_student, $result);
        }
    }

?>
