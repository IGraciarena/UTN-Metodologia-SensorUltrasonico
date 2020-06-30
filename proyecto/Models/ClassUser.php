<?php 
namespace Models;
 
class ClassUser{
	
	private $userName;
	private $password;
	private $firstName;
	private $lastName;
	private $email;

	function __construct($userName, $password, $firstName, $lastName, $email){
		$this->userName = $userName;
		$this->password = $password;
		$this->firstName = $firstName;
		$this->lastName = $lastName;
		$this->email = $email;
		
	}
	public function getUserName(){
		return $this->userName;
	}
	public function getPassword(){
		return $this->password;
	}
	public function getFirstName(){
		return $this->firstName;
	}
	public function getLastName(){
		return $this->lastName;
	}
	public function getEmail(){
		return $this->email;
	}
	public function setUserName($userName){
		$this->userName = $userName;
	}
	public function setPassword($password){
		$this->password = $password;
	}

	public function setFirstName($firstName){
		$this->firstName = $firstName;
	}
	public function setLastName($lastName){
		$this->lastName = $lastName;

	}
	public function setEmail($email){
		$this->email = $email;
	}
}
 ?>