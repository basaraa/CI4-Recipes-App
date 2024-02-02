<h2 class="green"><?= esc($title) ?></h2>
<script>
    let baseUrl = "<?= base_url();?>";
</script>
<?php if (!empty($recipe && is_array($recipe))) {
    echo '<div class="flexdiv">';
    foreach ($recipe as $recipe_item){
		$id=$recipe_item['id'];
        $functionEditForm="$id,0";
        $base_url=base_url($recipe_item['recipe_img_path']);
        echo '<div class="inflexdiv">
		<span onclick="location.href=\'/public/recipes/'.$id.'\'">
		<img class="img1" src="'.$base_url.'" alt="x">
		<h2>'.esc($recipe_item['recipe_name']).'</h2>
		</span>
		<a class="nodec editRecipeButton" id="'.$id.'_edit">
			<i class = "bi bi-pencil-square"></i></a>
        <a class="nodec deleteX word" id = "' . $id . '">
            <i class = "bi bi-trash"></i></a>
	    </div>';
    }
}
else
    echo "
    <h3>No Recipe</h3>

    <p>Unable to find any recipe for you.</p>";

?>
<div id="modal_background"></div>
    <div class="modal_div">
        <div id="modal_vrstva">
            <form class="form editForm">
			<!--<input type="hidden" class="txt_csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />-->
                <div id="modal_text">
                </div>
            </form>
            <button class="btn btn-primary" onclick="go_back();">Vrátiť sa späť</button>
        </div>
</div>
    <div id="modal_background2"></div>
    <div class="modal_div2">
        <div id="modal_vrstva2">
            <h1 id="result"></h1>
            <button class="btn btn-primary" onclick="window.location.reload()">Vrátiť sa späť</button>
        </div>
    </div>
    <div id="modal_background3"></div>
    <div class="modal_div3">
        <div id="modal_vrstva3">
            <div id="modal_text3">
            </div>
            <button class="btn btn-primary" onclick="go_back2();">Vrátiť sa späť</button>
        </div>
    </div>