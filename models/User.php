<?php

class User
{
    public static function findUser($login, $password)
    {
        $db = DataBase::getConnect();

        $query = "SELECT * FROM users WHERE login = :login AND password = :password";

        $result = $db->prepare($query);

        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();
        if ($user){
            return $user['id'];
        }

        return false;
    }

    public static function checkLogin($login)
    {
        if (strlen($login) >= 2) {
            return true;
        }
        else return false;
    }

    public static function checkPassword($password)
    {
        if (strlen($password) == 3) {
            return true;
        }
        else return false;
    }

}