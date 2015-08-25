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
            $enrollment_date = '0000-00-00';
            $id = null;
            $test_course = new Course($name, $id);
            $test_course->save();

            $student_name = "Aladdin";
            $course_id = $test_course->getId();
            $test_student = new Student ($student_name, $id, $enrollment_date, $course_id);

            $result = $test_student->getStudentName();

            $this->assertEquals($student_name, $result);
        }

        function testSetStudentName()
        {
            //Arrange
            $name = "Coding 101";
            $enrollment_date = '0000-00-00';
            $id = null;
            $test_course = new Course($name, $id);
            $test_course->save();

            $student_name = "Aladdin";
            $course_id = $test_course->getId();
            $test_course = new Student ($student_name, $id, $enrollment_date, $course_id);

            //Act
            $test_course->setStudentName("Jafar");
            $result = $test_course->getStudentName();

            //Assert
            $this->assertEquals("Jafar", $result);
        }

        function testGetId()
        {
            $name = "Coding 101";
            $enrollment_date = '0000-00-00';
            $id = 1;
            $test_course = new Course($name, $id);
            $test_course->save();

            $student_name = "Aladdin";
            $course_id = $test_course->getId();
            $test_student = new Student ($student_name, $id, $enrollment_date, $course_id);

            $result = $test_student->getId();

            $this->assertEquals(1, $result);
        }

        function test_getCategoryId() {
            $name = "Coding 101";
            $enrollment_date = '0000-00-00';
            $id = null;
            $test_course = new Course($name, $id);
            $test_course->save();

            $student_name = "Aladdin";
            $course_id = $test_course->getId();
            $test_student = new Student($student_name, $id, $enrollment_date, $course_id);
            $test_student->save();

            $result = $test_student->getCourseId();

            $this->assertEquals(true, is_numeric($result));
        }

        function testSave()
        {
            $name = "Coding 101";
            $enrollment_date = '0000-00-00';
            $id = null;
            $test_course = new Course($name, $id);
            $test_course->save();

            $student_name = "Aladdin";
            $course_id = $test_course->getId();
            $test_student = new Student ($student_name, $id, $enrollment_date, $course_id);

            $test_student->save();

            $result = Student::getAll();
            $this->assertEquals($test_student, $result[0]);
        }

        //Failing!!
        function test_GetAll()
        {
            $name = "Coding 101";
            $enrollment_date = '0000-00-00';
            $id = null;
            $test_course = new Course($name, $id);
            $test_course->save();

            $student_name = "Aladdin";
            $course_id = $test_course->getId();
            $test_student = new Student ($student_name, $id, $enrollment_date, $course_id);
            $test_student->save();

            $student_name2 = "Jasmine";
            $id2= null;
            $course_id2 = $test_course->getId();
            $test_student2 = new Student ($student_name2, $id2, $enrollment_date, $course_id2);
            $test_student->save();

            $result = Student::getAll();

            $this->assertEquals(['test_student, $test_student2'], $result);
        }

    }

?>
