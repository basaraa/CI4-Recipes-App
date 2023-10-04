<h2 class="purple"><?= esc($title) ?></h2>

<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="/public/recipes" class="form addForm" method="post">
    <?= csrf_field()?>
    <div class="form-group">
        <label class="red" for="recipe_name">Názov receptu</label>
        <input class="form-control" type="text" id="recipe_name" name="recipe_name" value="<?= set_value('recipe_name') ?>" maxlength="32" required>

        <label class="red" for="recipe_img_path">Cesta k obrázku receptu</label>
        <input class="form-control" type="text" id = "recipe_img_path" name="recipe_img_path" value="<?= set_value('recipe_img_path') ?>" maxlength="32" required>

        <div class="stepContainer">
            <label class="red" for="recipe_steps">Znenie 1.kroku receptu</label>
            <input class="form-control" type="text" name="recipe_steps[]" value="<?= set_value('recipe_steps') ?>" maxlength="128" required>
        </div>
        <button class="btn btn-secondary" id="addStep">Pridať krok ku receptu</button><br>
        <div class="ingredientContainer">
            <label class="red" >Ingrediencia č.1 </label><br>
            <div class="ingredientLine">
                <label class="green">Názov<input class="form-control ingredientInput1" type="text" name="recipe_ingredient_names[]" value="<?= set_value('recipe_ingredient_names') ?>" maxlength="32" required></label>
                <label class="green">Počet<input class="form-control ingredientInput2" type="number" name="recipe_ingredient_counts[]" value="<?= set_value('recipe_ingredient_counts') ?>" min="1" max="128" required></label>
                <label class="green">Typ<select class="form-control ingredientInput1" name= "recipe_ingredient_types[]"  required>
                    <?
                    foreach ($recipe_types as $recipe_type){
                    ?>
                        <option value="<?echo $recipe_type?>"><?echo $recipe_type?></option>
                    <?}?>
                </select></label>
            </div>
        </div>
        <button class="btn btn-secondary" id="addIngredient">Pridať ingredienciu ku receptu</button><br>
        <button type="submit" class="btn btn-primary">Vytvor nový recept</button>
    </div>
</form>