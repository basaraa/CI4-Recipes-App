<?php
namespace App\Controllers;

use App\Models\RecipeModel;
use App\Models\RecipeStepsModel;
use App\Models\RecipeIngredientsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class AjaxHandler extends BaseController{
	public function index(){
		if (! $this->validate([
            'id' => 'required'
		])) {
            // The validation fails, so returns the form.
            throw new PageNotFoundException('Zle zadaný request');;
        }
		$recipe_id = ($this->validator->getValidated())['id'];
        $model = model(RecipeModel::class);
        $model_steps = model(RecipeStepsModel::class);
        $model_ingredients = model(RecipeIngredientsModel::class);
        $recipe = $model->getRecipes($recipe_id,null);
		$data['recipe_types']=['polievkové lyžice','čajové lyžice','kusy','balenia','kilogramy','gramy','mililitre','decilitre','litre','trochu','veľa'];
		$data['id']=$recipe['id'];
        $data['recipe_name']=$recipe['recipe_name'];
        if (empty($data['recipe_name'])) {
            throw new PageNotFoundException('Nenašiel sa recept');
        }
        $data['recipe_img_path']=$recipe["recipe_img_path"];
        $data['recipe_steps']=$model_steps->getRecipeSteps($recipe_id);
        $data['recipe_ingredients']=$model_ingredients->getRecipeIngredients($recipe_id);		
        return view('ajaxHandlers/editForm',$data);
    }
	public function editRecipe(){
		helper('form');
        //|regex_match[[^\\s]+(.*?)\\.(jpg|png|pneg)$]
		
        if (! $this->validate([
			'id' => 'required',
            'recipe_name' => 'required|max_length[32]|min_length[2]',
            'recipe_img_path'  => 'required|max_length[32]|min_length[2]',
            'recipe_steps' => 'required',
			'recipe_steps_id' => 'required',
			'recipe_ingredients_id' => 'required',
            'recipe_ingredient_names' => 'required',
            'recipe_ingredient_counts'  => 'required',
            'recipe_ingredient_types' => 'required'
        ])) {
            // The validation fails, so returns the form.
			
            return 'Something is wrong with inputed datas';
        }

        $model = model(RecipeModel::class);
        $model_steps = model(RecipeStepsModel::class);
        $model_ingredients = model(RecipeIngredientsModel::class);
        // Gets the validated data.
        $post = $this->validator->getValidated();

        //if recipe ingredient info count not fit return form
        if (!(count($post['recipe_ingredient_names']) == count($post['recipe_ingredient_counts']) and
            count($post['recipe_ingredient_names']) == count($post['recipe_ingredient_types']))){
            return 'Count of ingredient infos are not same';
        }
		$recipe=$model->getRecipes($post['id']);
		if ($recipe['user_id'] != session()->get('id')){
            return 'Dont change other recipes';
		}
			
        $model->update($post['id'],[
            'recipe_name' => $post['recipe_name'],
            'recipe_img_path'  => $post['recipe_img_path'],
        ]);
        $i=1;
		$model_steps->getRecipeSteps($post['id']);
        foreach ($post['recipe_steps'] as $recipe_step){
			if ($post['recipe_steps_id'][$i-1] != null)
				$model_steps->update($post['recipe_steps_id'][$i-1],[
					'step_description' => $recipe_step
				]);
			else $model_steps->insert([
                'recipe_id'  => $post['id'],
                'step_number' => $i++,
                'step_description' => $recipe_step
            ]);
        }
        for ($i=0;$i<count($post['recipe_ingredient_names']);$i++) {
			if ($post['recipe_ingredients_id'][$i] != null)
				$model_ingredients->update($post['recipe_ingredients_id'][$i],[
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
		return json_encode(["scs" => true, "msg" => '<h2 class="green">Succesful edited recipe '.$post['recipe_name'].'</h2>']);
	}
	public function deleteRecipe(){
		if (! $this->validate([
            'id' => 'required'
		])) {
            // The validation fails, so returns the form.
            throw new PageNotFoundException('Zle zadaný request');;
        }
		$post = $this->validator->getValidated();
		$model = model(RecipeModel::class);
		$your_id=session()->get('id') !==null ? session()->get('id') : null;
		$recipe=$model->getRecipes($post['id']);
		if ($your_id && $your_id==$recipe['user_id']){
			$model->where('id', $recipe['id'])->delete();
			return json_encode(["scs" => true, "msg" => '<h2 class="green">Sucessful deleted recipe</h2>']);
		}
		else
			return json_encode(["scs" => false, "msg" => '<h2 class="red">Unsucessful attempt to delete recipe</h2>']);		
	}
}