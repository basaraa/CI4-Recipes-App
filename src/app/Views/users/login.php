<h2 class="purple"><?= esc($title) ?></h2>

<?= session()->getFlashdata('error') ?>


<form action="/public/users/login" class="form addForm" method="post">
    <?= csrf_field()?>
    <div class="form-group">
        <label class="green" for="email">Email:</label>
        <input class="form-control" type="text" id="email" name="email" value="<?= set_value('email') ?>" maxlength="64" required>
        <label class="green" for="password">Heslo:</label>
        <input class="form-control" type="password" id = "password" name="password" value="<?= set_value('password') ?>" maxlength="64" required>
        <button type="submit" class="btn btn-primary">Prihlásiť sa</button>
        <p>Nemáte ešte účet? <a href="/public/users/register">Registrujte sa na tomto odkaze</a><p>
    </div>
</form>
<?= validation_list_errors() ?>
<h3 class="red"><?= esc($error) ?></h3>