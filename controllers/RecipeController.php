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

    public function index()
    {
        $this->view('recipe/index', [
            'recipes' => $this->recipes->getAll()
        ]);
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