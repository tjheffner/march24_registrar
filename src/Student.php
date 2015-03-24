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

        




    }


?>
