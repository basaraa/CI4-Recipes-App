<?$base_url=base_url($recipe_img_path);?>
<div class="midd">
    <h1 class="red"><?= esc($recipe_name) ?></h1>
    <img class="img2" src="<?=$base_url?>" alt="x">
</div>
<div class="flexdiv">
    <div class="inflexdiv2">
        <h2>Suroviny:</h2>
        <hr>
        <? foreach ($recipe_ingredients as $recipe_ingredients_item)
            echo '<p>'.esc($recipe_ingredients_item['ingredient_count']).' '.esc($recipe_ingredients_item['ingredient_count_type']).' '.esc($recipe_ingredients_item['ingredient_name']).'</p>        
            ';?>
    </div>
    <div class="inflexdiv2">
        <h2>Postup:</h2>
        <hr>
        <? foreach ($recipe_steps as $recipe_steps_item)
            echo '<p>'.esc($recipe_steps_item['step_number']).'. '.esc($recipe_steps_item['step_description']).' </p>        
            ';?>
    </div>
</div>