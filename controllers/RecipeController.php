<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Session;
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
//        var_dump(Session::get('user')['NICKNAME']);
//        die;
        $this->view('recipe/index', [
            'recipes' => $this->recipes->getAll()
        ]);
    }

    //Show single recipe
    public function show(int $id): void
    {
        $this->view('recipe/show', [
            'recipe' => $this->recipes->getById($id)
        ]);
    }

    //Display form to add new recipe
    public function create()
    {
        $this->view('recipe/create');
    }

    //Store data with new recipe in database
    public function store()
    {

    }

    //Display form to edit recipe
    public function edit(int $id)
    {
        $this->view('recipe/create', [
            'recipe' => $this->recipes->getById($id)
        ]);
    }

    //Update recipe in database
    public function update()
    {

    }

    //Delete recipe from db
    public function destroy()
    {

    }
}