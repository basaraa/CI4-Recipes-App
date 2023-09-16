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
    public function newRecipe()
    {
        helper('form');
        $model_ingredients = model(RecipeIngredientsModel::class);
        $data=[
            'title' => 'Vytvor nový recept',
            'recipe_types' => ['polievkové lyžice','čajové lyžice','kusy','balenia','kilogramy','gramy','mililitre','decilitre','litre','trochu','veľa']
        ];
        return view('partials/header', $data)
            . view('recipes/create')
            . view('partials/footer');
    }
    public function createRecipe()
    {
        helper('form');
        //|regex_match[[^\\s]+(.*?)\\.(jpg|png|pneg)$]
        // Checks whether the submitted data passed the validation rules.
        if (! $this->validate([
            'recipe_name' => 'required|max_length[32]|min_length[2]',
            'recipe_img_path'  => 'required|max_length[32]|min_length[2]',
            'recipe_step_numbers' => 'required',
            'recipe_steps' => 'required',
            'recipe_ingredient_names' => 'required',
            'recipe_ingredient_counts'  => 'required',
            'recipe_ingredient_types' => 'required'
        ])) {
            // The validation fails, so returns the form.
            return $this->createRecipe();
        }
        $model = model(RecipeModel::class);
        $model_steps = model(RecipeStepsModel::class);
        $model_ingredients = model(RecipeIngredientsModel::class);

        // Gets the validated data.
        $post = $this->validator->getValidated();

        // Check for uniqueness of recipe
        if ($model->getRecipes($post['recipe_name'])!=NULL)
            return $this->createRecipe();

        $insertedRow=$model->insert([
            'recipe_name' => $post['recipe_name'],
            'recipe_img_path'  => $post['recipe_img_path'],
        ]);

        $model_steps->insert([
            'recipe_id'  => $insertedRow,
            'step_number' => $post['recipe_step_numbers'],
            'step_description' => $post['recipe_steps']

        ]);
        $model_ingredients->insert([
            'recipe_id'  => $insertedRow,
            'ingredient_name' => $post['recipe_ingredient_names'],
            'ringredient_count' => $post['recipe_ingredient_counts'],
            'ingredient_count_type' => $post['recipe_ingredient_types'],
        ]);

        return view('partials/header', ['title' => 'Nový recept vytvorený'])
            . view('recipes/successCreate')
            . view('partials/footer');
    }
}