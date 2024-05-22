<?php
class Contact
{
    function __construct(private int $id, private string $name, private string $email, private string $phone_number)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone_number = $phone_number;
    }
    function __toString(): string
    {
        return $this->id . ' | ' . $this->name . ' | ' . $this->email . ' | ' . $this->phone_number . PHP_EOL;
    }
/* ----- Setters ------*/
    function setId(int $value): void
    {
        $this->id = $value;
    }
    function setName(string $value): void
    {
        $this->name = $value;
    }
    function setEmail(string $value): void
    {
        $this->email = $value;
    }
    function setPhoneNumber(string $value): void
    {
        $this->phone_number = $value;
    }
    /* ----- Getters ------*/
    function getId():int{
        return $this->id;
    }
    function getName():string{
        return $this->name;
    }
    function getEmail():string{
        return $this->email;
    }
    function getPhone():string{
        return $this->phone_number;
    }
}