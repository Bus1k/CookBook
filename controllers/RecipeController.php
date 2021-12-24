<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Session;
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
        $lastRecipe = $allRecipes[count($allRecipes) - 1];

        unset($allRecipes[count($allRecipes) - 1]);

        $this->view('recipe/index', [
            'lastRecipe' => $lastRecipe,
            'allRecipes' => $allRecipes
        ]);
    }

    //Show single recipe
    public function show(): void
    {
        if(!isset($_GET['id'])) {
            $this->redirect('/');
        }

        $recipe = $this->recipe->getById((int) $_GET['id']);

        if(empty($recipe)) {
            $this->redirect('/');
        }

        $this->view('recipe/show', [
            'recipe' => $recipe,
            'user'   => $this->user->getById($recipe['USER_ID'])
        ]);
    }

    //Display form to add new recipe
    public function create(): void
    {
        $this->view('recipe/create');
    }

    //Store data with new recipe in database
    public function store(): void
    {

    }

    //Display form to edit recipe
    public function edit(): void
    {
        if(!isset($_GET['id'])) {
            $this->redirect('/');
        }

        $this->view('recipe/create', [
            'recipe' => $this->recipe->getById($_GET['id'])
        ]);
    }

    //Update recipe in database
    public function update(): void
    {

    }

    //Delete recipe from db
    public function destroy(): void
    {
        if(!isset($_GET['id'])) {
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