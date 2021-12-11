<?php

namespace app\controllers;

use app\core\Controller;
use app\models\RecipesModel;

class RecipeController extends Controller
{
    private object $recipes;

    public function __construct()
    {
        $this->recipes = new RecipesModel();
    }

    public function index()
    {
        $this->view('products/index');
    }

    public function show()
    {

    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}