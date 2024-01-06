<?php
namespace App\Controllers;

use App\Models\RecipeModel;
use App\Models\RecipeStepsModel;
use App\Models\RecipeIngredientsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class AjaxHandler extends BaseController{
	public function index($recipe_id=null){
        $model = model(RecipeModel::class);
        $model_steps = model(RecipeStepsModel::class);
        $model_ingredients = model(RecipeIngredientsModel::class);
        $recipe = $model->getRecipes($recipe_id,null);
		$data['id']=$recipe['id'];
        $data['recipe_name']=$recipe['recipe_name'];
        if (empty($data['recipe_name'])) {
            throw new PageNotFoundException('Nenašiel sa recept');
        }
        $data['recipe_img_path']=$recipe["recipe_img_path"];
        $data['recipe_steps']=$model_steps->getRecipeSteps($recipe_id);
        $data['recipe_ingredients']=$model_ingredients->getRecipeIngredients($recipe_id);
		
        return view('ajaxHandlers/editForm');
    }
	public function editRecipe(){
		helper('form');
        //|regex_match[[^\\s]+(.*?)\\.(jpg|png|pneg)$]
        if (! $this->validate([
            'recipe_name' => 'required|max_length[32]|min_length[2]',
            'recipe_img_path'  => 'required|max_length[32]|min_length[2]',
            'recipe_steps' => 'required',
            'recipe_ingredient_names' => 'required',
            'recipe_ingredient_counts'  => 'required',
            'recipe_ingredient_types' => 'required'
        ])) {
            // The validation fails, so returns the form.
			echo 'Something is wrong with input datas'
            return ;
        }

        $model = model(RecipeModel::class);
        $model_steps = model(RecipeStepsModel::class);
        $model_ingredients = model(RecipeIngredientsModel::class);
        // Gets the validated data.
        $post = $this->validator->getValidated();

        //if recipe ingredient info count not fit return form
        if (!(count($post['recipe_ingredient_names']) == count($post['recipe_ingredient_counts']) and
            count($post['recipe_ingredient_names']) == count($post['recipe_ingredient_types']))){
            echo 'Count of ingredient infos are not same';
            return ;
        }
		$recipe=$model->getRecipes($post['id']);
		if ($recipe['user_id'] != session()->get('id')){
			echo 'Dont change other recipes';
            return ;
		}
			
        $model->update($post['id'],[
            'recipe_name' => $post['recipe_name'],
            'recipe_img_path'  => $post['recipe_img_path'],
        ]);
        $i=1;
		$model_steps->getRecipeSteps($post['id']);
        foreach ($post['recipe_steps'] as $recipe_step){
			if ($recipe_step['step_id'] != null)
				$model_steps->update($recipe_step['step_id'],[
					'step_description' => $recipe_step
				]);
			else $model_steps->insert([
                'recipe_id'  => $post['id'],
                'step_number' => $i++,
                'step_description' => $recipe_step
            ]);
        }
        for ($i=0;$i<count($post['recipe_ingredient_names']);$i++) {
			if ($recipe_step['ingredient_id'] != null)
				$model_ingredients->update($post['ingredient_id'][$i],[
					'ingredient_name' => $post['recipe_ingredient_names'][$i],
					'ingredient_count' => $post['recipe_ingredient_counts'][$i],
					'ingredient_count_type' => $post['recipe_ingredient_types'][$i],
				]);
			else
				$model_ingredients->update($post['ingredient_id'][$i],[
					'recipe_id' => $post['id'],
					'ingredient_name' => $post['recipe_ingredient_names'][$i],
					'ingredient_count' => $post['recipe_ingredient_counts'][$i],
					'ingredient_count_type' => $post['recipe_ingredient_types'][$i],
				]);
        }
		echo 'Succesful edited recipe '.$post['recipe_name'].'';
	}
	public function deleteRecipe(){
		$model = model(RecipeModel::class);
		$your_id=isset(session()->get('id')) ? session()->get('id') : null;
		$recipe=$model->getRecipes($post['id']);
		if ($your_id && $your_id==$recipe['user_id']){
			$model->where('id', $recipe['id'])->delete();
			echo json_encode(["scs" => true, "msg" => '<h2 class="blue">Sucessful deleted recipe</h2>']);
		}
		else
			echo json_encode(["scs" => false, "msg" => '<h2 class="red">Unsucessful attempt to delete recipe</h2>']);		
	}
	
}