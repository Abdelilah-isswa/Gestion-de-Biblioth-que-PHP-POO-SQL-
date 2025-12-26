<?php 
abstract class AbstractUser
{
    protected int $id;
    protected string $firstName;
    protected string $lastName;
    protected string $email;
    public function __constract(array $data){
        $this -> id = $data['id'];
        $this->firstName = $data['firstName'];
        $this ->lastName = $data['lastName'];
        $this -> email = $data['email'];

    }
    public function login(): bool
    {
        $_SESSION['user'] = [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'role' => static::class
        ];
        return true;
    }
    public function logout():void{
        session_destroy();

    }
    public function getId():int{
        return $this ->id;
    }

}