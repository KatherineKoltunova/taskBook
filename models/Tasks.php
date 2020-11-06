<?php

class Tasks
{
    const COUNT_TASKS = 3;

    public static function getTasksList($field, $sort, $page, $path)
    {
        $page = intval($page);
        $field = strval($field);
        $offset = ($page-1) * self::COUNT_TASKS;

        $db = DataBase::getConnect();
        $tasksList = array();
        $result = $db->query("SELECT * FROM tasks"
            . " ORDER BY ".$field." ".$sort
            . " LIMIT ".self::COUNT_TASKS
            . " OFFSET ".$offset);

        $i = 0;
        while ($row = $result->fetch()) {
            $tasksList[$i]['id'] = $row['id'];
            $tasksList[$i]['user'] = $row['user'];
            $tasksList[$i]['email'] = $row['email'];
            $tasksList[$i]['text'] = htmlentities($row['text']);
            $tasksList[$i]['status'] = $row['status'];
            $tasksList[$i]['edit'] = $row['edit'];
            $i++;
        }

        return $tasksList;
    }

    public static function getTotalTasks()
    {
        $db = DataBase::getConnect();

        $result = $db->query("SELECT COUNT(*) FROM tasks");
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $row = $result->fetch();

        return $row["COUNT(*)"];
    }

    public static function addTask($userName, $email, $text)
    {
        $db = DataBase::getConnect();

        $query = "INSERT INTO tasks (user, email, text) "
            . "VALUES (:user, :email, :text)";

        $result = $db->prepare($query);

        $result->bindParam(':user', $userName, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':text', $text, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function editStatus($id)
    {
        $id = intval($id);

        if ($id) {
            $db = DataBase::getConnect();

            $query = "UPDATE tasks SET status = 1 WHERE id = :id";

            $result = $db->prepare($query);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            return $result->execute();
        }
    }

    public static function editText($id, $text)
    {
        $id = intval($id);

        if ($id) {
            $db = DataBase::getConnect();

            $query = "UPDATE tasks SET text = :text, edit = 1 WHERE id = :id";

            $result = $db->prepare($query);
            $result->bindParam(':text', $text, PDO::PARAM_STR);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            return $result->execute();
        }
    }

    public static function checkUserName($name)
    {
        if (strlen($name) >= 2) {
            return true;
        }
        else return false;
    }

    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        else return false;
    }

    public static function checkText($text)
    {
        if (strlen($text) >= 6) {
            return true;
        }
        else return false;
    }

    public static function changeText($id, $text)
    {
        $id = intval($id);

        if ($id) {
            $db = DataBase::getConnect();

            $result = $db->query('SELECT text FROM tasks WHERE id='.$id);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $task = $result->fetch();

            if ($text == $task['text'])return false;
            else return true;
        }
    }
}
