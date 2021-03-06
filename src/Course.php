<?php

    class Course
    {
        private $title;
        private $id;
        private $number;

        function __construct($title, $id = null, $number)
        {
            $this->title = $title;
            $this->id = $id;
            $this->number = $number;
        }

        function setTitle($new_title)
        {
            $this->title = (string) $new_title;
        }

        function getTitle()
        {
            return $this->title;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function getId()
        {
            return $this->id;
        }

        function setNumber($new_number)
        {
            $this->number = (string) $new_number;
        }

        function getNumber()
        {
            return $this->number;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO courses (title, number) VALUES ('{$this->getTitle()}', '{$this->getNumber()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses *;");
        }

        static function getAll()
        {
            $returned_courses = $GLOBALS['DB']->query("SELECT * FROM courses;");
            $courses = array();
            foreach($returned_courses as $course) {
                $title = $course['title'];
                $id = $course['id'];
                $number = $course['number'];
                $new_course = new Course($title, $id, $number);
                array_push($courses, $new_course);
            }
            return $courses;
        }

        function updateCourse($new_title)
        {
            $GLOBALS['DB']->exec("UPDATE courses SET title = '{$new_title}' WHERE id = {$this->getId()};");
            $this->setTitle($new_title);
        }

        function deleteCourse()
        {
            $GLOBALS['DB']->exec("DELETE FROM courses WHERE id = {$this->getId()};");
        }

        static function find($search_id)
        {
            $found_course = null;
            $courses = Course::getAll();
            foreach($courses as $course) {
                $course_id = $course->getId();
                if ($course_id == $search_id) {
                    $found_course = $course;
                }
            }
            return $found_course;
        }

        function addStudent($student)
        {
            $GLOBALS['DB']->exec("INSERT INTO courses_students (course_id, student_id) VALUES ({$this->getId()}, {$student->getId()});");
        }

        function getStudents()
        {
            $query = $GLOBALS['DB']->query("SELECT students.* FROM
                courses JOIN courses_students ON (courses.id = courses_students.course_id)
                        JOIN students ON (courses_students.student_id = students.id)
                        WHERE courses.id = {$this->getId()};");
            $student_ids = $query->fetchAll(PDO::FETCH_ASSOC);

            $students = array();
            foreach ($student_ids as $student) {

                $name = $student['name'];
                $id = $student['id'];
                $date = $student['date'];
                $new_student = new Student($name, $id, $date);
                array_push($students, $new_student);
            }
            return $students;
        }

    }

?>
