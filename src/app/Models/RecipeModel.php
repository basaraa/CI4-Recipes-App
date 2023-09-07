<?php
namespace App\Models;

use CodeIgniter\Model;

class RecipeModel extends Model
{
    protected $table = 'recipes';
    public function getRecipes($recipe_name=null)
    {
        if ($recipe_name)
            return $this->where (['recipe_name' => $recipe_name])->first();
        else
            return $this->findAll();
    }
}