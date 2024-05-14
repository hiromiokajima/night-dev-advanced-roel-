<!--Display Value of the class -->

<?php
  include "Student.php";

$first_student = new Student("William","Male","Canada","01-11A1");
echo "Name: ".$first_student->getName()."<br>";
echo "Gender: ".$first_student->getGender()."<br>";
echo "Country: ".$first_student->getCountry()."<br>";
echo "Student ID: ".$first_student->getStudentID()."<br>";


?>