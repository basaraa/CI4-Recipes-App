<?php
namespace App\Models;

use CodeIgniter\Model;

class RecipeStepsModel extends Model
{
    protected $table = 'recipe_steps';
    public function getRecipeSteps($recipe_id=null)
    {
        if ($recipe_id)
            return $this->where(['recipe_id' => $recipe_id])->findAll();
        else
            return null;
    }
}