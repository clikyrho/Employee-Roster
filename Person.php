<?php
// Person.php
class Person
{
    private string $name;
    private string $address;
    private int $age;

    public function __construct(string $name, string $address, int $age)
    {
        $this->name = $name;
        $this->address = $address;
        $this->age = $age;
    }

    // Getters and Setters
    public function getName(): string
    {
        return $this->name;
    }
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAddress(): string
    {
        return $this->address;
    }
    public function setAddress(string $address): void
    {
        $this->address = $address;
    }

    public function getAge(): int
    {
        return $this->age;
    }
    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    // toString method
    public function __toString(): string
    {
        return "Name: $this->name, Address: $this->address, Age: $this->age";
    }
}