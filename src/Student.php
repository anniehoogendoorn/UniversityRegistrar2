<?php
    Class Student {
        private $student_name;
        private $id;
        private $enrollment_date;
        private $course_id;


        function __construct($student_name, $id = null, $enrollment_date, $course_id)
        {
            $this->student_name = $student_name;
            $this->id = $id;
            $this->enrollment_date = $enrollment_date;
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

        function setEnrollmentDate($enrollment_date) {
            $this->enrollment_Date = $new_enrollment_date;
        }

        function getEnrollmentDate() {
            return $this->enrollment_date;
        }


        function getCourseId(){
            return $this->course_id;
        }

        function save() {
        $GLOBALS['DB']->exec("INSERT INTO students (student_name, enrollment_date, course_id) VALUES ('{$this->getStudentName()}', '{$this->getEnrollmentDate()}', {$this->getCourseId()});");
        $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function deleteAll() {
            $GLOBALS['DB']->exec("DELETE FROM students;");
        }

        static function getAll() {
            $returned_students = $GLOBALS['DB']->query("SELECT * FROM students;");
            $students = array();
            foreach($returned_students as $student) {
                $student_name = $student['student_name'];
                $id = $student['id'];
                $enrollment_date = $student['enrollment_date'];
                $course_id = $student['course_id'];
                $new_student = new Student($student_name, $id, $enrollment_date, $course_id);
                array_push($students, $new_student);
            }
            return $students;
        }
    }

?>
