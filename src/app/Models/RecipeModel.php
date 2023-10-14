<?php
namespace App\Models;

use CodeIgniter\Model;

class RecipeModel extends Model
{
    protected $table = 'recipes';
    protected $allowedFields = ['user_id','recipe_name', 'recipe_img_path'];
    public function getRecipes($recipe_id=null,$user_id=null){
        if ($recipe_id)
            return $this->where (['id' => $recipe_id])->first();
        else if ($user_id)
            return $this->where (['user_id' => $user_id])->findAll();
        else
            return $this->findAll();
    }
}