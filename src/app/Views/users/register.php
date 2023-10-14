<h2 class="purple"><?= esc($title) ?></h2>

<?= session()->getFlashdata('error') ?>
<?= validation_list_errors() ?>

<form action="/public/users/register" class="form addForm" method="post">
    <?= csrf_field()?>
    <div class="form-group">
        <label class="red" for="user_name">Meno:</label>
        <input class="form-control" type="text" id = "user_name" name="user_name" value="<?= set_value('user_name') ?>" maxlength="64" required>
        <label class="red" for="email">Email:</label>
        <input class="form-control" type="text" id="email" name="email" value="<?= set_value('email') ?>" maxlength="64" required>
        <label class="red" for="password">Heslo:</label>
        <input class="form-control" type="password" id = "password" name="password" value="<?= set_value('password') ?>" maxlength="64" required>
        <label class="red" for="confirm_password">Heslo znova:</label>
        <input class="form-control" type="password" id = "confirm_password" name="confirm_password" value="<?= set_value('confirm_password') ?>" maxlength="64" required>
        <button type="submit" class="btn btn-primary">Registrovať sa</button>
    </div>
</form>