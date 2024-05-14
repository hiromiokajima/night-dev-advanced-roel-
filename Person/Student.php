<!-- Child Class-->
<?php
    include "Person.php";

    class Student extends Person {
        private $student_id;

        public function __construct($new_name,$new_gender,$new_country,$new_studentID){
            $this->name = $new_name;
            $this->gender = $new_gender;
            $this->country = $new_country;
            $this->student_id = $new_studentID;
        }

        public function getStudentID(){
            return $this->student_id;
        }
    }
?>