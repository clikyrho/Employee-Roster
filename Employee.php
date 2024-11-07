<?php

abstract class Employee extends Person {
    private $companyName;

    public function __construct($companyName) {
        $this->companyName = $companyName;
    }

    public function getCompanyName(){
        return $this->companyName;
    }

    public function setCompanyName($companyName){
        $this->companyName = $companyName;
    }

    abstract public function earnings();

    public function __toString(){
        return $this->companyName;
    }
}