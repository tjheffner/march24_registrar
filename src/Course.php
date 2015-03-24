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









    }



?>
