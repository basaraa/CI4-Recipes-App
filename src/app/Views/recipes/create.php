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

        <label class="red" for="recipe_step_numbers">Číslo kroku receptu</label>
        <input class="form-control" type="number" id = "recipe_step_numbers" name="recipe_step_numbers" value="<?= set_value('recipe_step_numbers') ?>" min="1" max="128" required>
        <label class="red" for="recipe_steps">Znenie kroku receptu</label>
        <input class="form-control" type="text" id = "recipe_steps" name="recipe_steps" value="<?= set_value('recipe_steps') ?>" maxlength="128" required>

        <label class="red" for="recipe_ingredient_names">Názov ingrediencie</label>
        <input class="form-control" type="text" id = "recipe_ingredient_names" name="recipe_ingredient_names" value="<?= set_value('recipe_ingredient_names') ?>" maxlength="32" required>
        <label class="red" for="recipe_ingredient_counts">Počet danej ingrediencie</label>
        <input class="form-control" type="number" id = "recipe_ingredient_counts" name="recipe_ingredient_counts" value="<?= set_value('recipe_ingredient_counts') ?>" min="1" max="128" required>
        <label class="red" for="recipe_ingredient_types">Typ počtu ingrediencie</label>
        <select class="form-control" name= "recipe_ingredient_types" id="recipe_ingredient_types" required>
            <?
            foreach ($recipe_types as $recipe_type){
            ?>
                <option value="<?echo $recipe_type?>"><?echo $recipe_type?></option>
            <?}?>
        </select>

        <button type="submit" class="btn btn-primary">Vytvor nový recept</button>
    </div>
</form>