<?php

    namespace app\controllers;

    use app\framework\database\Connection;

    class LoginController
    {
        public function index()
        {
            var_dump('index do login');
        }

        public function store()
        {
            $login    = strip_tags($_POST['login']);
            $password = strip_tags($_POST['password']);

            if(empty($login) || empty($password))
            {
                var_dump("Usuário ou senha invalidos");
                die();
            }

            $connect = Connection::getConnection();
            $prepare = $connect->prepare("select id, login, senha from usuarios where login = :login");
            $prepare->execute([
                'login' => $login
            ]);

            $userFound = $prepare->fetchObject();

            if(!$userFound)
            {
                var_dump("Usuário ou senha inválidos");
                die();
            }

            if(!($password === $userFound->senha))
            {
                var_dump("Usuário ou senha inválidos, senha");
                die();
            }

            $_SESSION['logged'] = true;
            unset($userFound->password);
            $_SESSION['user'] = $userFound;

            redirect('/dashboard');
        }
    }