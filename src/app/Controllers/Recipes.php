<?php
namespace App\Controllers;

use App\Models\RecipeModel;
use App\Models\RecipeStepsModel;
use App\Models\RecipeIngredientsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Recipes extends BaseController
{
    public function index()
    {
        $model = model(RecipeModel::class);
        $recipe=$model->getRecipes();
        $data=[
            'recipe' => $recipe,
            'title' => "Recepty"
        ];

        return view('partials/header', $data)
            . view('recipes/recipesList')
            . view('partials/footer');
    }

    public function showRecipeInfo($recipe_name=null)
    {
        $model = model(RecipeModel::class);
        $model_steps = model(RecipeStepsModel::class);
        $model_ingredients = model(RecipeIngredientsModel::class);
        $recipe = $model->getRecipes($recipe_name);
        $data['recipe_name']=$recipe['recipe_name'];
        if (empty($data['recipe_name'])) {
            throw new PageNotFoundException('Nenašiel sa recept na: ' . $recipe_name);
        }
        $id=$recipe['id'];
        $data['recipe_img_path']=$recipe["recipe_img_path"];
        $data['recipe_steps']=$model_steps->getRecipeSteps($id);
        $data['recipe_ingredients']=$model_ingredients->getRecipeIngredients($id);

        return view('partials/header', $data)
            . view('recipes/recipeInfo')
            . view('partials/footer');
    }
}