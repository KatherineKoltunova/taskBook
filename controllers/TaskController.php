<?php

class TaskController
{
    public function actionIndex()
    {
        if (isset($_GET["add"]) && $_GET["add"]) {
            echo '
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    Задача добавлена в список
                </div>';
        }

        if (isset($_SESSION['user'])) $isGuest = false;
        else $isGuest = true;

        if (isset($_GET["field"])) {
            $field = $_GET["field"];
            $path = $_SERVER['REQUEST_URI'].'&';

        }
        else {
            $field = 'id';
            $path = '?';
        }

        if (isset($_GET["sort"])) $sort = $_GET["sort"];
        else $sort = 'ASC';

        if (isset($_GET["page"])) {
            $page = $_GET["page"];
            $path = str_replace('&page='.$page, '', $path);
        }
        else $page = 1;

        $tasksList = Tasks::getTasksList($field, $sort, $page, $path);

        $totalTasks = intval(Tasks::getTotalTasks());
        $pageCount = ceil($totalTasks/Tasks::COUNT_TASKS);

        if (isset($_POST['submit'])) {
            if (!$isGuest) {
                $id = $_POST['id'];

                if (isset($_POST['text'])) $text = $_POST['text'];
                else $text = '';

                $params = '?field=' . $field . '&sort=' . $sort . '&page=' . $page;

                $errors = false;
                if (!Tasks::checkText($text)) {
                    $errors['text'] = 'Текст задачи должен содержать не менее 6-ти символов';
                    $errors['id'] = $id;
                }

                if (!is_array($errors) && Tasks::changeText($id, $text)) {
                    $result = Tasks::editText($id, $text);
                    if ($result) {
                        header("Location: /taskbook/" . $params);
                    } else {
                        $errors['edit'] = 'Задача не была добавлена';
                        $errors['id'] = $id;
                    }
                }
            }
            else {
                header("Location: /taskbook/user/login");
            }
        }

        require_once(ROOT . '/views/task/index.php');

        return true;
    }

    public function actionAdd()
    {
        $user = '';
        $email = '';
        $text = '';

        if (isset($_POST['submit'])) {
            $user = $_POST['user'];
            $email = $_POST['email'];
            $text = $_POST['text'];

            $errors = false;
            $result = false;

            if (!Tasks::checkUserName($user)) {
                $errors['user'] = 'Имя пользователя должно содержать более 2-х символов';
            }
            if (!Tasks::checkEmail($email)) {
                $errors['email'] = 'E-mail введён не верно';
            }
            if (!Tasks::checkText($text)) {
                $errors['text'] = 'Текст задачи должен содержать не менее 6-ти символов';
            }

            if (!is_array($errors)) {
                $result = Tasks::addTask($user, $email, $text);
                if ($result) {
                    header("Location: /taskbook/?add=true");
                }
                else {
                    $errors['add'] = 'Задача не была добавлена';
                }
            }
        }

        require_once(ROOT . '/views/task/add.php');

        return true;
    }

    public function actionEditStatus()
    {
        if (isset($_SESSION['user'])) {

            if (isset($_GET["task"])) $id = $_GET["task"];
            else $id = false;

            if (isset($_GET["field"])) $field = $_GET["field"];
            else $field = 'id';

            if (isset($_GET["sort"])) $sort = $_GET["sort"];
            else $sort = 'ASC';

            if (isset($_GET["page"])) $page = $_GET["page"];
            else $page = 1;

            $params = '?field='.$field.'&sort='.$sort.'&page='.$page;
            if($id){
                $result = Tasks::editStatus($id);
                if ($result) {
                    header("Location: /taskbook/".$params);
                }
            }
        }
        else {
            header("Location: /taskbook/user/login");
        }

        return true;
    }
}