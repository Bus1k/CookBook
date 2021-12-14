<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Session;
use app\models\LoginModel;
use app\models\UserModel;

/**
 * Class LoginController
 *
 * @package app\controllers
 */
class LoginController extends Controller
{
    private object $login;
    private object $user;

    public function __construct()
    {
        $this->login = new LoginModel();
        $this->user  = new UserModel();
    }

    //Display form to login
    public function create()
    {
        $this->view('user/login', [
            'model' => $this->login
        ]);
    }

    //Login user in session
    public function login()
    {
        $data = [
            'email'    => $_POST['email'],
            'password' => $_POST['password']
        ];

        if(!$this->login->validate($data)) {
            $this->view('user/login', [
                'model' => $this->login,
                'data'  => $data,
            ]);
            return;
        }

        $dbUser = $this->user->getByEmail($data['email']);

        if(!$dbUser || !password_verify($data['password'], $dbUser['PASSWORD'])) {
            $this->login->addCustomError('email', 'Wrong login details');
            $this->login->addCustomError('password', '');
            $this->view('user/login', [
                'model' => $this->login,
                'data'  => $data,
            ]);
            return;
        }

        Session::set('user', $dbUser);
        $this->redirect('/');
    }

    //Destroy user session
    public function logout()
    {
        Session::remove('user');
        Session::destroy();
        $this->redirect('/');
    }
}