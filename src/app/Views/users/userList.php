<h2 class="green"><?= esc($title) ?></h2>

<?php if (!empty($user && is_array($user))) {
    echo '<div class="flexdiv">';

    foreach ($user as $user_item){
        echo '<div class="inflexdiv" onclick="location.href=\'/public/users/recipes/'.$user_item['id'].'\'">	
		<h2>'.esc($user_item['user_name']).'</h2>
	    </div>';
    }

}
else
    echo "
    <h3>No users</h3>
    <p>Unable to find any users.</p>";

?>