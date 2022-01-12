<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Session;
use app\helpers\UtilHelper;
use app\models\RecipeModel;
use app\models\UserModel;

class RecipeController extends Controller
{
    private object $recipe;
    private object $user;

    public function __construct()
    {
        $this->recipe = new RecipeModel();
        $this->user   = new UserModel();
    }

    //Display main page with recipes
    public function index(): void
    {
        $allRecipes = $this->recipe->getAll();

        foreach($allRecipes as $key => $recipe) {
            if(empty($recipe['IMAGE']) || !file_exists(PATH_FILES.$recipe['IMAGE'])) {
                $allRecipes[$key]['IMAGE'] = '../images/no-img.jpg';
            }
        }

        $lastRecipe = $allRecipes[0];
        unset($allRecipes[0]);

        $this->view('recipe/index', [
            'lastRecipe' => $lastRecipe,
            'allRecipes' => $allRecipes
        ]);
    }

    //Show single recipe
    public function show(): void
    {
        if(empty($_GET['id'])) {
            $this->redirect('/');
        }

        $recipe = $this->recipe->getById((int) $_GET['id']);

        if(empty($recipe)) {
            $this->redirect('/');
        }

        if(!empty($recipe['IMAGE'])) {
            $recipe['IMAGE'] = '../uploads/'.$recipe['IMAGE'];
        } else {
            $recipe['IMAGE'] = '../images/no-img.jpg';
        }

        $this->view('recipe/show', [
            'recipe' => $recipe,
            'user'   => $this->user->getById($recipe['USER_ID'])
        ]);
    }

    //Display form to add new recipe
    public function create(): void
    {
        $this->view('recipe/create', [
            'model' => $this->recipe,
        ]);
    }

    //Store data with new recipe in database
    public function store(): void
    {
        $data = [
            'title'       => $_POST['title'],
            'description' => $_POST['description'],
            'ingredients' => $_POST['ingredients'],
            'time'        => $_POST['time'],
            'level'       => $_POST['level'],
        ];

        if($_FILES['photo']['error'] === 0) {
            $data['photo'] = $_FILES['photo'];
        }

        if(!$this->recipe->validate($data)) {
            $this->view('recipe/create', [
                'model' => $this->recipe,
                'data'  => $data
            ]);
            return;
        }

        if(isset($data['photo'])) {
            $fileLocation = UtilHelper::saveFile($data['photo'], PATH_FILES);
        }

        $id = $this->recipe->create(
            $data['title'],
            Session::get('user')['ID'],
            $fileLocation ?? null,
            $data['description'],
            $data['ingredients'],
            $data['time'],
            $data['level']
        );

        $this->redirect('/recipe/show?id='.$id);
    }

    //Display form to edit recipe
    public function edit(): void
    {
        if(empty($_GET['id'])) {
            $this->redirect('/');
        }

        $recipe = $this->recipe->getById($_GET['id']);
        if(empty($recipe) || $recipe['USER_ID'] !== Session::get('user')['ID']) {
            $this->redirect('/');
        }

        $this->view('recipe/edit', [
            'model'  => $this->recipe,
            'recipe' => $recipe,
        ]);
    }

    //Update recipe in database
    public function update(): void
    {
        if(empty($_GET['id'])) {
            $this->redirect('/');
        }

        $id = $_GET['id'];
        $data = [
            'title'       => $_POST['title'],
            'description' => $_POST['description'],
            'ingredients' => $_POST['ingredients'],
            'time'        => $_POST['time'],
            'level'       => $_POST['level']
        ];

        if($_FILES['photo']['error'] === 0) {
            $data['photo'] = $_FILES['photo'];
        }

        if(!$this->recipe->validate($data)) {
            $this->view('recipe/create', [
                'model' => $this->recipe,
                'data'  => $data
            ]);
            return;
        }

        if(isset($data['photo'])) {
            $fileLocation = UtilHelper::saveFile($data['photo'], PATH_FILES);
        }

        $this->recipe->update(
            $id,
            $data['title'],
            $fileLocation ?? null,
            $data['description'],
            $data['ingredients'],
            $data['time'],
            $data['level']
        );

        $this->redirect('/recipe/show?id='.$id);
    }

    //Delete recipe from db
    public function destroy(): void
    {
        if(empty($_GET['id'])) {
            $this->redirect('/');
        }

        $recipe = $this->recipe->getById($_GET['id']);
        if(empty($recipe) || $recipe['USER_ID'] !== Session::get('user')['ID']) {
            $this->redirect('/');
        }

        $this->recipe->delete($recipe['ID']);
        $this->redirect('/');
    }
}