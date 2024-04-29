<?php

    namespace app\controllers;

    class HomeController
    {
        public function index()
        {
            view('home', ['name' => 'Fabio Ceola', 'age' => 34]);
        }
    }