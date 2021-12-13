<?php

namespace app\controllers;

use app\core\Controller;
use app\models\UserModel;

/**
 * Class RegisterController
 *
 * @package app\controllers
 */
class RegisterController extends Controller
{
    private object $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }

    //Display form to create user
    public function create()
    {
        $this->view('register/create', [
            'model' => $this->user,
        ]);
    }

    //Store user in database
    public function store()
    {
        $data = [
            'nickname'         => $_POST['nickname'],
            'email'            => $_POST['email'],
            'password'         => $_POST['password'],
            'password_confirm' => $_POST['password_confirm'],
        ];

        if(!$this->user->validate($data)) {
            $this->view('register/create', [
                'model' => $this->user,
                'data'  => $data,
            ]);
            return;
        }

        $this->user->create(
            $data['nickname'],
            $data['email'],
            $data['password']
        );

        $this->redirect('/login');
    }

    public function login()
    {
        $this->view('register/login');
    }
}