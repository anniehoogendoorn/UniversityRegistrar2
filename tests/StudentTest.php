<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Student.php";
    require_once "src/Course.php";
    $server = "mysql:host=localhost;dbname=test_university_registrar";
    $username = "root";
    $password = "root";
    $DB = new PDO($server, $username, $password);

    class StudentTest extends PHPUnit_Framework_TestCase {

        protected function tearDown()
        {
            Student::deleteAll();
            Course::deleteAll();
        }

        function testGetStudentName()
        {
            $name = "Coding 101";
            $id = null;
            $test_course = new Course($name, $id);
            $test_course->save();

            $student_name = "Aladdin";
            $course_id = $test_course->getId();
            $test_student = new Student ($student_name, $id, $course_id);

            $result = $test_student->getStudentName();

            $this->assertEquals($student_name, $result);
        }

        function testSetStudentName()
        {
            //Arrange
            $name = "Coding 101";
            $id = null;
            $test_course = new Course($name, $id);
            $test_course->save();

            $student_name = "Aladdin";
            $course_id = $test_course->getId();
            $test_course = new Student ($student_name, $id, $course_id);

            //Act
            $test_course->setStudentName("Jafar");
            $result = $test_course->getStudentName();

            //Assert
            $this->assertEquals("Jafar", $result);
        }





    }



?>
