<?php
class Contact {
    function __construct(private int $id,private string $name,private string $email,private string $phone_number)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->phone_number = $phone_number;
    }

    public function getId(): int{
        return $this->id;
    }
    public function getName():string{
        return $this->name;
    }
    public function getEmail():string{
        return $this->email;
    }
    public function getPhoneNumber():string{
        return $this->phone_number;
    }

    public function setId($id):void{
        $this->id = $id;
    }
    public function setName($name):void{
        $this->name = $name;
    }
    public function setEmail($email):void{
        $this->email = $email;
    }
    public function setPhoneNumber($phone_number):void{
        $this->phone_number = $phone_number;
    }




}