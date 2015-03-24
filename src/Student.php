<?php

    class Student
    {
        private $name;
        private $id;
        private $date; //this is the enrollment date

        function __construct($name, $id = null, $date)
        {
            $this->name = $name;
            $this->id = $id;
            $this->date = $date;
        }

        function setName($new_name)
        {
            $this->name = (string) $new_name;
        }

        function getName()
        {
            return $this->name;
        }

        function setId($new_id)
        {
            $this->id = (int) $new_id;
        }

        function getId()
        {
            return $this->id;
        }

        function setDate($new_date)
        {
            $this->date = $date;
        }

        function getDate()
        {
            return $this->date;
        }

        function save()
        {
            $statement = $GLOBALS['DB']->query("INSERT INTO students (name, date) VALUES ('{$this->getName()}', '{$this->getDate()}') RETURNING id;");
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $this->setId($result['id']);
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM students *;");
        }

        static function getAll()
        {
            $returned_students = $GLOBALS['DB']->query("SELECT * FROM students;");
            $students = array();
            foreach($returned_students as $student) {
                $name = $student['name'];
                $id = $student['id'];
                $date = $student['date'];
                $new_student = new Student($name, $id, $date);
                array_push($students, $new_student);
            }
            return $students;
        }

        function updateStudent($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE students SET name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setName($new_name);
        }

        function deleteStudent()
        {
            $GLOBALS['DB']->exec("DELETE FROM students WHERE id = {$this->getId()};");
        }

        static function find($search_id)
        {
            $found_student = null;
            $students = Student::getAll();
            foreach($students as $student) {
                $student_id = $student->getId();
                if ($student_id == $search_id) {
                    $found_student = $student;
                }
            }
            return $found_student;
        }

        function addCourse($course)
        {
            $GLOBALS['DB']->exec("INSERT INTO courses_students (course_id, student_id) VALUES ({$course->getId()}, {$this->getId()});");

        }

        function getCourses()
        {
            $query = $GLOBALS['DB']->query("SELECT course.* FROM
                students JOIN courses_students ON (students.id = course_students.student_id)
                        JOIN courses ON (courses_students.course_id = courses.id)
                        WHERE students.id = {$this->getId()};");
            $course_ids = $query->fetchAll(PDO::FETCH_ASSOC);

            $courses = array();
            foreach ($course_ids as $course) {
                
                $title = $course['title'];
                $id = $course['id'];
                $number = $course['number'];
                $new_course = new Course($title, $id, $number);
                array_push($courses, $new_course);
            }
            return $courses;
        }

    }

?>
