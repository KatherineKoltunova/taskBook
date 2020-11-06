<?php include ROOT.'/views/layouts/header.php'; ?>

<h2>Вход в истему</h2>

<form action="" method="post">
    <div class="form-group<?= isset($errors['login']) ? ' has-error' : '' ?>">
        <label class="control-label" for="login">Логин:</label>
        <input type="text" class="form-control" name="login" value="<?= $login ?>">

        <?php if(isset($errors['login'])): ?>
            <span class="help-block"><?= $errors['login'] ?></span>
        <?php endif; ?>
    </div>
    <div class="form-group<?= isset($errors['pass']) ? ' has-error' : '' ?>">
        <label class="control-label"  for="pass">Пароль:</label>
        <input type="password" class="form-control" name="pass" value="<?= $password ?>">

        <?php if(isset($errors['pass'])): ?>
            <span class="help-block"><?= $errors['pass'] ?></span>
        <?php endif; ?>
    </div>

    <div class="form-group<?= isset($errors['auth']) ? ' has-error' : '' ?>">
        <?php if(isset($errors['auth'])): ?>
            <span class="help-block"><?= $errors['auth'] ?></span>
        <?php endif; ?>
    </div>

    <a href="/taskbook" class="btn btn-info" role="button">Отмена</a>
    <input type="submit" class="btn btn-primary" name="submit" value="Вход">

</form>

<?php include ROOT.'/views/layouts/footer.php'; ?>
