<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Course.php";
    // require_once "src/Student.php";

    require_once "src/Course.php";
    // require_once "src/Student.php";
    $server = 'mysql:host=localhost;dbname=test_university_registrar';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CourseTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown() {
            Course::deleteAll();
            // Student::deleteAll();
        }

        function testGetName()
        {
            $name = "Coding 101";
            $test_course = new Course($name);

            $result = $test_course->getName();

            $this->assertEquals($name, $result);
        }

        function testSetName()
        {
            $name = "Coding 101";
            $test_course = new Course($name);

            $test_course->setName("Advanced Coding");
            $result = $test_course->getName();

            $this->assertEquals("Advanced Coding", $result);

        }

        function testGetId()
        {
            //Arrange
            $name = "Coding 101";
            $id = 1;
            $test_course = new Course($name, $id);

            //Act
            $result = $test_course->getId();

            //Assert
            $this->assertEquals(1, $result);
        }

        function testSave()
        {
            $name = "Coding 101";
            $id = 1;
            $test_course = new Course($name, $id);
            $test_course->save();

            $result = Course::getAll();

            $this->assertEquals($test_course, $result[0]);
        }

        function testGetAll()
        {
            //Arrange
            $name = "Coding 101";
            $id = 1;
            $name2 = "Advanced Coding";
            $id2 = 2;
            $test_course = new Course($name, $id);
            $test_course->save();
            $test_course2 = new Course($name2, $id2);
            $test_course2->save();

            //Act
            $result = Course::getAll();

            //Assert
            $this->assertEquals([$test_course, $test_course2], $result);
        }

        function testDeleteAll()
        {
            $name = "Coding 101";
            $id = 1;
            $test_course = new Course($name);
            $test_course->save();

            $name2= "Advanced Coding";
            $id2 = 2;
            $test_course2 = new Course($name2);
            $test_course2->save();

            Course::deleteAll();

            $result = Course::getAll();
            $this->assertEquals([], $result);
        }

        function testUpdate()
        {
            //Arrange
            $name = "Coding 101";
            $id = 1;
            $test_course = new Course($name, $id);
            $test_course->save();

            $new_name = "Advanced Coding";

            //Act
            $test_course->update($new_name);

            //Assert
            $this->assertEquals("Advanced Coding", $test_course->getName());
        }

        function testDeleteCourse()
        {
            $name = "Coding 101";
            $id = 1;
            $test_course = new Course($name);
            $test_course->save();

            $name2= "Advanced Coding";
            $id2 = 2;
            $test_course2 = new Course($name2);
            $test_course2->save();

            $test_course->delete();

            $this->assertEquals([$test_course2], Course::getAll());
        }

        function testFind()
        {
            //Arrange
            $name = "Coding 101";
            $id = 1;
            $test_course = new Course($name, $id);
            $test_course->save();

            $name2 = "Advanced Coding";
            $id2 = 2;
            $test_course2 = new Course($name2, $id2);
            $test_course2->save();

            //Act
            $result = Course::find($test_course->getId());

            //Assert
            $this->assertEquals($test_course, $result);
        }


    }

?>
