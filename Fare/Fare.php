<?php

class Fare {
    private $age;
    private $distance;

    public function setAge($age){
        $this->age = $age;
        
    }
    public function getAge(){
        return $this->age;
        
    }
    
    
    public function setDistance($distance){
        $this->distance = $distance;
    }

    public function getDistance(){
        return $this->distance;
    }

    public function calculateFare(){
        $baseFare = 8;
        $addFare = 0;

        if($this->distance >= 4) {
            $addFare = $this->distance - 4;
        }

        $total = $baseFare + $addFare;
    
        if($this->age >= 60){
            $total *= 0.8;
        }
       

        return $total;
        }
    }
 ?>