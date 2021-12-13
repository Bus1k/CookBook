<?php

namespace app\controllers;

use app\core\Controller;
use app\models\LoginModel;
use app\models\UserModel;

/**
 * Class LoginController
 *
 * @package app\controllers
 */
class LoginController extends Controller
{
    private object $user;
    private object $login;

    public function __construct()
    {
        $this->user  = new UserModel();
        $this->login = new LoginModel();
    }

    //Display form to login
    public function create()
    {
        $this->view('user/login');
    }

    //Login user in session
    public function login()
    {
//        $this->redirect('/');
    }
}