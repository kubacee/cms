<?php

/**
 * Created by PhpStorm.
 * User: kuba
 * Date: 06.02.16
 * Time: 21:30
 */
class UserModel
{
    public function findById($userId) {
        $user = new UserEntity();
        $connect = Database::connect();

        $query = $connect->prepare('SELECT * FROM user WHERE id = :id');
        $query->bindParam(':id', $userId, PDO::PARAM_INT);
        $query->execute();

        $user->dump($query->fetch(PDO::FETCH_ASSOC));

        return $user;
    }

    public function findByEmailAndPassword($email, $password)
    {
        $user = new UserEntity();
        $connect = Database::connect();

        $query = $connect->prepare('SELECT * FROM user WHERE email = :email AND password = :password');
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);
        $user->dump($result);

        return $user;
    }

    public function findByLoginAndPassword($login, $password)
    {
        $user = new UserEntity();
        $connect = Database::connect();

        $query = $connect->prepare('SELECT * FROM user WHERE login = :login AND password = :password');
        $query->bindParam(':login', $login, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();

        $result = $query->fetch(PDO::FETCH_ASSOC);
        $user->dump($result);

        return $user;
    }

    public function insert(UserEntity $user)
    {
        $connect = Database::connect();

        $query = $connect->prepare('
            INSERT INTO `user` VALUES (:login, :email, :password, :role, :first_name, :last_name)
        ');
        $query->bindParam(':role', $user->getRole(), PDO::PARAM_STR);
        $query->bindParam(':login', $user->getLogin(), PDO::PARAM_STR);
        $query->bindParam(':email', $user->getEmail(), PDO::PARAM_STR);
        $query->bindParam(':password', $user->getPassword(), PDO::PARAM_STR);
        $query->bindParam(':last_name', $user->getLastName(), PDO::PARAM_STR);
        $query->bindParam(':first_name', $user->getFirstName(), PDO::PARAM_STR);

        $query->execute();
    }

    public function update(UserEntity $user)
    {
        $connect = Database::connect();

        $query = $connect->prepare('
            update user set
              role = :role,
              `login` = :login,
              email = :email,
              password = :password,
              last_name = :last_name,
              first_name = :first_name
              where id = :id        ');

        $query->bindParam(':id', $user->getId(), PDO::PARAM_INT);
        $query->bindParam(':role', $user->getRole(), PDO::PARAM_STR);
        $query->bindParam(':login', $user->getLogin(), PDO::PARAM_STR);
        $query->bindParam(':email', $user->getEmail(), PDO::PARAM_STR);
        $query->bindParam(':password', $user->getPassword(), PDO::PARAM_STR);
        $query->bindParam(':last_name', $user->getLastName(), PDO::PARAM_STR);
        $query->bindParam(':first_name', $user->getFirstName(), PDO::PARAM_STR);

        $query->execute();
    }
}