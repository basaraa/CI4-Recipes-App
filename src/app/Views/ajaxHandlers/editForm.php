


    <div class="form-group">
        <label class="green" for="recipe_name">Názov receptu</label>
        <input class="form-control" type="text" id="recipe_name" name="recipe_name" value="<?= $recipe_name ?>" maxlength="32" required>

        <label class="green" for="recipe_img">Cesta ku obrázku</label>
        <input class="form-control" type="text" id = "recipe_img_path" name="recipe_img_path" value="<?= base_url($recipe_img_path) ?>" maxlength="32" required>
		
        <div class="stepContainer">
			<label class="green" for="recipe_steps">Znenie <? esc($recipe_steps_item['step_number'])?>.kroku receptu</label>
				<input class="form-control" type="text" name="recipe_steps[]" value="<? esc($recipe_steps_item['step_description']) ?>" maxlength="128" required>
        </div>
        <button class="btn btn-secondary" id="addStep">Pridať krok ku receptu</button><br>
        <div class="ingredientContainer">
			<? $j=0;
			foreach ($recipe_ingredients as $recipe_ingredients_item){
				$j+=1?>
				<label class="red" >Ingrediencia č.<? echo $j;?> </label><br>
				<div class="ingredientLine">
					<label class="green">Názov<input class="form-control ingredientInput1" type="text" name="recipe_ingredient_names[]" value="<? esc($recipe_ingredients_item['ingredient_name']) ?>" maxlength="32" required></label>
					<label class="green">Počet<input class="form-control ingredientInput2" type="number" name="recipe_ingredient_counts[]" value="<? esc($recipe_ingredients_item['ingredient_count'])?>" min="1" max="128" required></label>
					<label class="green">Typ<select class="form-control ingredientInput1" name= "recipe_ingredient_types[]"  required>
						<?
						foreach ($recipe_types as $recipe_type){
						?>
							<option value="<? echo $recipe_type?>"<? if ($recipe_type==$recipe_ingredients_item['ingredient_name']) echo'selected';?>><? echo $recipe_type?>
							</option>
						<?}?>
					</select></label>					
			<?}?>            
            </div>
        </div>
        <button class="btn btn-secondary" id="addIngredient">Pridať ingredienciu ku receptu</button><br>
        <button type="submit" class="btn btn-primary">Uprav recept</button>
    </div>
