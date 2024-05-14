<!--Parent Class -->
<?php
    class Person {
        # Properties
        protected $name;

        protected $gender;

        protected $country;

        # Methods
        public function __construct($new_name,$new_gender,$new_country){
            $this->name = $new_name;
            $this->gender = $new_gender;
            $this->country = $new_country;
        }

        public function getName(){
            return $this->name;
        }
        public function getGender(){
            return $this->gender;
        }
        public function getCountry(){
            return $this->country;
        }

    }
?>