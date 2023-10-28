<?php
namespace App\Controllers;

use App\Models\RecipeModel;
use App\Models\RecipeStepsModel;
use App\Models\RecipeIngredientsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Recipes extends BaseController{
    public function index($user_id=null){
        $model = model(RecipeModel::class);
        $recipe=$model->getRecipes(null,$user_id);
        $data=[
            'recipe' => $recipe,
            'title' => "Recepty"
        ];

        return view('partials/header', $data)
            . view('recipes/recipesList')
            . view('partials/footer');
    }

    public function showRecipeInfo($recipe_id=null){
        $model = model(RecipeModel::class);
        $model_steps = model(RecipeStepsModel::class);
        $model_ingredients = model(RecipeIngredientsModel::class);
        $recipe = $model->getRecipes($recipe_id,null);
        $data['recipe_name']=$recipe['recipe_name'];
        if (empty($data['recipe_name'])) {
            throw new PageNotFoundException('Nenašiel sa recept');
        }
        $data['recipe_img_path']=$recipe["recipe_img_path"];
        $data['recipe_steps']=$model_steps->getRecipeSteps($recipe_id);
        $data['recipe_ingredients']=$model_ingredients->getRecipeIngredients($recipe_id);

        return view('partials/header', $data)
            . view('recipes/recipeInfo')
            . view('partials/footer');
    }
    public function newRecipe(){
        helper('form');
        $data=[
            'title' => 'Vytvor nový recept',
            'recipe_types' => ['polievkové lyžice','čajové lyžice','kusy','balenia','kilogramy','gramy','mililitre','decilitre','litre','trochu','veľa']
        ];
        return view('partials/header', $data)
            . view('recipes/create')
            . view('partials/footer');
    }
    public function createRecipe(){
        helper('form');
        //helper('file');
        //|regex_match[[^\\s]+(.*?)\\.(jpg|png|pneg)$]
        // Checks whether the submitted data passed the validation rules.
        if (! $this->validate([
            'recipe_name' => 'required|max_length[32]|min_length[2]',
            'recipe_img_path'  => 'required|max_length[32]|min_length[2]',
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

        //if recipe ingredient info count not fit return form
        if (!(count($post['recipe_ingredient_names']) == count($post['recipe_ingredient_counts']) and
            count($post['recipe_ingredient_names']) == count($post['recipe_ingredient_types']))){
            return $this->createRecipe();
        }
        //$img = $this->request->getFile('file');
        //$img->move('img/food/');
        $insertedRow=$model->insert([
            'user_id' => session()->get('id'),
            'recipe_name' => $post['recipe_name'],
            'recipe_img_path'  => $post['recipe_img_path'],
        ]);
        $i=1;
        foreach ($post['recipe_steps'] as $recipe_step){
            $model_steps->insert([
                'recipe_id'  => $insertedRow,
                'step_number' => $i++,
                'step_description' => $recipe_step
            ]);
        }
        for ($i=0;$i<count($post['recipe_ingredient_names']);$i++) {
            $model_ingredients->insert([
                'recipe_id' => $insertedRow,
                'ingredient_name' => $post['recipe_ingredient_names'][$i],
                'ingredient_count' => $post['recipe_ingredient_counts'][$i],
                'ingredient_count_type' => $post['recipe_ingredient_types'][$i],
            ]);
        }

        return view('partials/header', ['title' => 'Nový recept vytvorený'])
            . view('recipes/successCreate')
            . view('partials/footer');
    }
    function loggedUserRecipes(){
        $model = model(RecipeModel::class);
        $recipe=$model->getRecipes(null,session()->get('id'));
        $data=[
            'recipe' => $recipe,
            'title' => "Recepty"
        ];

        return view('partials/header', $data)
            . view('users/myRecipes')
            . view('partials/footer');
    }
}