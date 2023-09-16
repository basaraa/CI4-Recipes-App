<?php
namespace App\Models;

use CodeIgniter\Model;

class RecipeIngredientsModel extends Model
{
    protected $table = 'recipe_ingredients';
    protected $allowedFields = ['recipe_id', 'ingredient_name','ingredient_count','ingredient_count_type'];
    public function getRecipeIngredients($recipe_id=null){
        if ($recipe_id)
            return $this->where(['recipe_id' => $recipe_id])->findAll();
        else
            return null;
    }
}