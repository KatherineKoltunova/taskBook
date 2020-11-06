<?php include ROOT.'/views/layouts/header.php'; ?>

<h2>Задачник</h2>

<div class="buttons">
    <a href="task/add" class="btn btn-primary" role="button" >Добавить задачу</a>

    <?php if ($isGuest): ?>
        <a class="btn btn-primary" href="user/login" role="button">Войти</a>
    <?php else: ?>
        <a class="btn btn-primary" href="user/logout" role="button">Выйти</a>
    <?php endif; ?>

</div>

<table class="table table-bordered table-hover ">
    <thead>
        <tr>
            <th class="text-center">
                Имя пользователя
                <a href="?field=user&sort=ASC">&uArr;</a>
                <a href="?field=user&sort=DESC">&dArr;</a>
            </th>
            <th class="text-center">
                E-mail
                <a href="?field=email&sort=ASC">&uArr;</a>
                <a href="?field=email&sort=DESC">&dArr;</a>
            </th>
            <th class="text-center">
                Текст задачи
            </th>
            <th class="text-center">
                Статус
                <a href="?field=status&sort=DESC">&uArr;</a>
                <a href="?field=status&sort=ASC">&dArr;</a>
            </th>
        </tr>
    </thead>

    <tbody>
    <?php foreach ($tasksList as $task):?>
        <tr>
            <td><?= $task['user'] ?></td>
            <td><?= $task['email'] ?></td>

            <?php if ($isGuest): ?>
                <td><?= $task['text'] ?></td>
            <?php else: ?>

                <td>
                    <form action="" method="post">

                        <div class="form-group<?= (isset($errors['text']) && $task['id'] == $errors['id']) ? ' has-error' : '' ?>">
                            <div class="col-sm-10">
                                <textarea class="form-control buttons" name="text" value="<?= $task['text'] ?>"><?= $task['text'] ?></textarea>
                                <?php if(isset($errors['text']) && $task['id'] == $errors['id']): ?>
                                    <span class="help-block"><?= $errors['text'] ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if(isset($errors['edit']) && $task['id'] == $errors['id']): ?>
                            <div class="form-group has-error">
                                <label class="control-label col-sm-2" for="text"></label>
                                <div class="col-sm-10">
                                    <span class="help-block"><?= $errors['edit'] ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <input type="hidden" name="id" value="<?= $task['id'] ?>">
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" class="btn btn-primary" name="submit" value="Сохранить">
                            </div>
                        </div>

                    </form>
                </td>

            <?php endif; ?>

            <?php if($task['status']): ?>
                <td class="table-success text-center">
                    Выполнено
                    <?= $task['edit'] ? '<br>Отредактировано администратором' : ''; ?>
                </td>
            <?php elseif($task['edit']): ?>
                <td class="text-center">
                    Отредактировано администратором
                    <?= !$isGuest ? '<br><input type="checkbox" id="checkbox" name="status" value="'. $task['id'] .'">' : ''; ?>
                </td>
            <?php else: ?>
                <td class="text-center"><?= !$isGuest ? '<br><input type="checkbox" id="checkbox" name="status" value="'. $task['id'] .'">' : ''; ?></td>
            <?php endif; ?>
        </tr>
    <?php endforeach;?>
    </tbody>
</table>

<ul class="pagination justify-content-center">
    <?php if ($page>1):?>
        <li class="page-item"><a  class="page-link" href="<?= $path ?>page=<?= $page-1 ?>">&lArr;</a></li>
    <?php endif;?>

    <?php for($i=1; $i<=$pageCount;$i++):?>
        <li class="page-item">
            <a class="page-link<?php if($i==$page): ?> active<?php endif; ?>" href="<?= $path ?>page=<?= $i ?>"><?= $i ?></a>
        </li>
    <?php endfor;?>

    <?php if($page<$pageCount):?>
        <li class="page-item"><a class="page-link" href="<?= $path ?>page=<?= $page+1 ?>">&rArr;</a></li>
    <?php endif;?>
</ul>

<?php include ROOT.'/views/layouts/footer.php'; ?>