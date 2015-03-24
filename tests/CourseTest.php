<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

    require_once "src/Course.php";
    require_once "src/Student.php";

    $DB = new PDO ('pgsql:host=localhost;dbname=college_test');

    Class CourseTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Course::deleteAll();
            Student::deleteAll();
        }

        function test_getTitle()
        {
            //Arrange
            $title = "Intro to T-Shirt Studies";
            $id = 1;
            $number = "PHYS305";
            $test_course = new Course($title, $id, $number);

            //Act
            $result = $test_course->getTitle();

            //Assert
            $this->assertEquals($title, $result);
        }

        function test_getId()
        {
            //Arrange
            $title = "Avocado Growth Patterns in the Western Himalayas";
            $id = 1;
            $number = "SOC101";
            $test_course = new Course($title, $id, $number);

            //Act
            $result = $test_course->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_setId()
        {
            //Arrange
            $title = "Monkeys: Friend or Foe?";
            $id = null;
            $number = "MATH339";
            $test_course = new Course($title, $id, $number);

            //Act
            $test_course->setId(2);

            //Assert
            $result = $test_course->getId();
            $this->assertEquals(2, $result);
        }

        function test_getNumber()
        {
            //Arrange
            $title = "Advanced Textile Studies: Fibers of the Pampas";
            $id = 7;
            $number = "AGR404";
            $test_course = new Course($title, $id, $number);

            //Act
            $result = $test_course->getNumber();

            //Assert
            $this->assertEquals($number, $result);
        }

        function test_save()
        {
            //Arrange
            $title = "Sucrose Looks Like An Orgy: Poems Through Time";
            $id = 12;
            $number = "CHEM336";
            $test_course = new Course($title, $id, $number);

            //Act
            $test_course->save();

            //Assert
            $result = Course::getAll();
            $this->assertEquals([$test_course], $result);
        }

        function test_getAll()
        {
            //Arrange
            $title = "Reddenbacher";
            $id = 4;
            $number = "ENG204";

            $title2 = "Beowulf: A Feminist Reading";
            $id2 = 5;
            $number2 = "CHEM337";

            $test_course = new Course($title, $id, $number);
            $test_course->save();
            $test_course2 = new Course($title2, $id2, $number2);
            $test_course2->save();

            //Act
            $result = Course::getAll();

            //Assert
            $this->assertEquals([$test_course, $test_course2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $title = "Intro To Beards";
            $id = 3;
            $number = "PDX101";
            $test_course = new Course($title, $id, $number);
            $test_course->save();

            //Act
            Course::deleteAll();

            //Assert
            $result = Course::getAll();
            $this->assertEquals([], $result);
        }

        function test_updateCourse()
        {
            //Arrange
            $title = "The Red Panda: Humanity''s Last Hope... ?";
            $id = 4;
            $number = "GEO406";
            $test_course = new Course($title, $id, $number);
            $test_course->save();
            $new_title = "Han Shot First: Alcohol, Violence, and Outlaws in Interplanetary Gender Relations.";

            //Act
            $test_course->updateCourse($new_title);

            //Assert
            $this->assertEquals($test_course->getTitle(), $new_title);
        }

        function test_deleteCourse()
        {
            //Arrange
            $title = "Domiciles of Education: Alternative Learning Options in The Twenty-First Century And Beyond";
            $id = 5;
            $number = "PE116";
            $test_course = new Course($title, $id, $number);
            $test_course->save();

            $title2 = "Bell Peppers are Fruits";
            $id2 = 2;
            $number2 = "WSTU551";
            $test_course2 = new Course($title2, $id2, $number2);
            $test_course2->save();

            //Act
            $test_course->deleteCourse();
            $result = Course::getAll();

            //Assert
            $this->assertEquals([$test_course2], $result);
        }

        function test_find()
        {
            //Assert
            $title = "It Goes To 11: A Study of Third Wave British Metal";
            $id = 1;
            $number = "MATH203";
            $title2 = "Stonehenge: A Study of Rocks";
            $id2 = 2;
            $number2 = "PSY307";
            $test_course = new Course($title, $id, $number);
            $test_course->save();
            $test_course2 = new Course($title2, $id2, $number2);
            $test_course2->save();

            //Act
            $result = Course::find($test_course->getId());

            //Assert
            $this->assertEquals($test_course, $result);
        }
    }

 ?>
