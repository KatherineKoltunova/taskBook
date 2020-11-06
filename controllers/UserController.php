<?php

class UserController
{
    public function actionLogin()
    {
        $login = '';
        $password = '';

        if (isset($_POST['submit'])) {
            $login = $_POST['login'];
            $password = $_POST['pass'];

            $errors = false;

            if (!User::checkLogin($login)) {
                $errors['login'] = 'Логин должен содержать не менее 2-х символов';
            }
            if (!User::checkPassword($password)) {
                $errors['pass'] = 'Пароль должен содержать 3 символа';
            }

            if (!is_array($errors)) {
                $userID = User::findUser($login, $password);

                if ($userID) {
                    $_SESSION['user'] = $userID;
                    header("Location: /taskbook/");
                }
                else {
                    $errors['auth'] = 'Не верный логин или пароль';
                }
            }
        }

        require_once (ROOT.'/views/user/login.php');

        return true;
    }

    public function actionLogout()
    {
        unset($_SESSION['user']);

        header("Location: /taskbook/");
    }
}