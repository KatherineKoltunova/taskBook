<?php include ROOT.'/views/layouts/header.php'; ?>

<h2>Добавление новой задачи</h2>

<form class="form-horizontal" action="" method="post">
    <div class="form-group<?= isset($errors['user']) ? ' has-error' : '' ?>">
        <label class="control-label col-sm-2" for="user">Имя пользователя*:</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="user" value="<?= $user ?>">
            <?php if(isset($errors['user'])): ?>
                <span class="help-block"><?= $errors['user'] ?></span>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group<?= isset($errors['email']) ? ' has-error' : '' ?>">
        <label class="control-label col-sm-2" for="email">E-mail*:</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" name="email" value="<?= $email ?>">
            <?php if(isset($errors['email'])): ?>
                <span class="help-block"><?= $errors['email'] ?></span>
            <?php endif; ?>
        </div>
    </div>

    <div class="form-group<?= isset($errors['text']) ? ' has-error' : '' ?>">
        <label class="control-label col-sm-2" for="text">Текст задачи*:</label>
        <div class="col-sm-10">
            <textarea class="form-control" rows="5" name="text" value="<?= $text ?>"><?= $text ?></textarea>
            <?php if(isset($errors['text'])): ?>
                <span class="help-block"><?= $errors['text'] ?></span>
            <?php endif; ?>
        </div>
    </div>

    <?php if(isset($errors['add'])): ?>
        <div class="form-group has-error">
            <label class="control-label col-sm-2" for="text"></label>
            <div class="col-sm-10">
                    <span class="help-block"><?= $errors['add'] ?></span>
            </div>
        </div>
    <?php endif; ?>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <a href="/taskbook" class="btn btn-info" role="button">Отмена</a>
            <input type="submit" class="btn btn-primary" name="submit" value="Добавить">
        </div>
    </div>

</form>

<?php include ROOT.'/views/layouts/footer.php'; ?>
