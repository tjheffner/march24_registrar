<?php

    require_once "src/Student.php";

    Class StudentTest extends PHPUnit_Framework_TestCase
    {
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
    }



?>
