<?php
    Class Student {
        private $student_name;
        private $id;
        private $course_id;


        function __construct($student_name, $id = null, $course_id)
        {
            $this->student_name = $student_name;
            $this->id = $id;
            $this->course_id = $course_id;
        }

        function setStudentName($new_student_name) {
            $this->student_name = (string) $new_student_name;
        }
        
        function getStudentName() {
            return $this->student_name;
        }

        function getId() {
            return $this->id;
        }

        static function deleteAll() {
            $GLOBALS['DB']->exec("DELETE FROM students;");
        }
    }

?>
