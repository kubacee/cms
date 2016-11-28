<?php

/**
 * Created by PhpStorm.
 * User: kuba
 * Date: 06.02.16
 * Time: 17:28
 */
class UserEntity
{
    private $id;
    private $role;
    private $login;
    private $email;
    private $password;
    private $lastName;
    private $firstName;

    // ~

    public function getId() {
        return $this->id;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function getLogin() {
        return $this->login;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function getRole() {
        return $this->role;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    // ~

    /**
     * Create user object
     * @param array $fields
     */
    public function dump($fields = array()) {
        $this->id = $fields['id'];
        $this->role = $fields['role'];
        $this->login = $fields['login'];
        $this->email = $fields['email'];
        $this->password = $fields['password'];
        $this->lastName = $fields['last_name'];
        $this->firstName = $fields['first_name'];
    }
}