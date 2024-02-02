<div class="form-group">
		<input class="form-control" type="hidden" id="id" name="id" value="<?echo $id ?>">
        <label class="green" for="recipe_name">Názov receptu</label>
        <input class="form-control" type="text" id="recipe_name" name="recipe_name" value="<?= $recipe_name ?>" maxlength="32" required>

        <label class="green" for="recipe_img_path">Cesta ku obrázku</label>
        <input class="form-control" type="text" id = "recipe_img_path" name="recipe_img_path" value="<?= $recipe_img_path ?>" maxlength="32" required>
		<?foreach ($recipe_steps as $recipe_steps_item){?>
        <div class="stepContainer">
			<input class="form-control" type="hidden" name="recipe_steps_id[]" value="<?echo $recipe_steps_item['id'] ?>">
			<label class="green" for="recipe_steps">Znenie <? echo esc($recipe_steps_item['step_number'])?>.kroku receptu</label>
				<input class="form-control" type="text" name="recipe_steps[]" value="<? echo esc($recipe_steps_item['step_description']) ?>" maxlength="128" required>
        </div>
		<?}?>
        <button class="btn btn-secondary" id="addStep">Pridať krok ku receptu</button><br>
        <div class="ingredientContainer">
			<? $j=0;
			foreach ($recipe_ingredients as $recipe_ingredients_item){
				$j+=1?>
				<input class="form-control" type="hidden" name="recipe_ingredients_id[]" value="<?echo $recipe_ingredients_item['id'] ?>">
				<label class="red" >Ingrediencia č.<? echo $j;?> </label><br>
				<div class="ingredientLine">
					<label class="green">Názov<input class="form-control ingredientInput1" type="text" name="recipe_ingredient_names[]" value="<? echo esc($recipe_ingredients_item['ingredient_name']) ?>" maxlength="32" required></label>
					<label class="green">Počet<input class="form-control ingredientInput2" type="number" name="recipe_ingredient_counts[]" value="<? echo esc($recipe_ingredients_item['ingredient_count'])?>" max="128"></label>
					<label class="green">Typ<select class="form-control ingredientInput1" name= "recipe_ingredient_types[]"  required>
						<?
						foreach ($recipe_types as $recipe_type){
						?>
							<option value="<? echo esc ($recipe_type)?>"<? if ($recipe_type==$recipe_ingredients_item['ingredient_count_type']) echo 'selected';?>><? echo esc($recipe_type)?>
							</option>
						<?}?>
					</select></label><br>					
			<?}?>            
            </div>
        </div>
        <button class="btn btn-secondary" id="addIngredient">Pridať ingredienciu ku receptu</button><br>
        <button type="submit" class="btn btn-primary">Uprav recept</button>
    </div>