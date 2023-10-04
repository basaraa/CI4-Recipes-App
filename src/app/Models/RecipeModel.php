<?php
namespace App\Models;

use CodeIgniter\Model;

class RecipeModel extends Model
{
    protected $table = 'recipes';
    protected $allowedFields = ['recipe_name', 'recipe_img_path'];
    public function getRecipes($recipe_id=null){
        if ($recipe_id)
            return $this->where (['id' => $recipe_id])->first();
        else
            return $this->findAll();
    }
}