<?php

namespace app\controllers;

use app\core\Controller;
use app\models\RecipeModel;

class RecipeController extends Controller
{
    private object $recipes;

    public function __construct()
    {
        $this->recipes = new RecipeModel();
    }

    //Display main page with recipes
    public function index(): void
    {
        $allRecipes = $this->recipes->getAll();
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

        $this->view('recipe/show', [
            'recipe' => $this->recipes->getById((int) $_GET['id'])
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
            'recipe' => $this->recipes->getById($_GET['id'])
        ]);
    }

    //Update recipe in database
    public function update(): void
    {

    }

    //Delete recipe from db
    public function destroy(): void
    {

    }
}