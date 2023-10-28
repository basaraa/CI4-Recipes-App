<h2 class="green"><?= esc($title) ?></h2>

<?php if (!empty($recipe && is_array($recipe))) {
    echo '<div class="flexdiv">';

    foreach ($recipe as $recipe_item){

        $base_url=base_url("img/food/".$recipe_item['recipe_img_path']."");
        echo '<div class="inflexdiv" onclick="location.href=\'/public/recipes/'.$recipe_item['id'].'\'">	
		<img class="img1" src="'.$base_url.'" alt="x">
		<h2>'.esc($recipe_item['recipe_name']).'</h2>
	    </div>';
    }

}
else
    echo "
    <h3>No Recipe</h3>

    <p>Unable to find any recipe for you.</p>";

?>