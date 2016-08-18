<?php

/**
 * Created by PhpStorm.
 * User: nguyenduytien
 * Date: 8/9/16
 * Time: 3:14 PM
 */
class post_model extends base_model
{
    private $table = 'posts';
    public function getDataById($id)
    {
        $sql = "SELECT posts.*,users.user_name, categories.category_name 
                FROM posts
                INNER JOIN users ON posts.user_ID = users.id
                INNER JOIN categories ON categories.id = posts.category_ID 
                WHERE posts.id= ?";
        try {
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->bindParam(1, $id, PDO::PARAM_INT);
            $this->stmt->execute();
        } catch (PDOException $e) {
            echo "<pre>";
            var_dump(die($e->getMessage()));
            echo "</pre>";
            exit();
        }
        return $this->stmt->fetch();
    }

    public function getAllData()
    {
        $sql = "SELECT posts.*,users.user_name, categories.category_name 
                FROM posts 
                INNER JOIN users ON posts.user_ID = users.id
                INNER JOIN categories ON categories.id = posts.category_ID ";
        try {
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->execute();
        } catch (PDOException $e) {
            echo "<pre>";
            var_dump(die($e->getMessage()));
            echo "</pre>";
            exit();
        }
        return $this->stmt->fetchAll();
    }

    public function getTotalPost()
    {
        $sql = "SELECT count(*) as total FROM posts";
        try {
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->execute();
        } catch (PDOException $e) {
            echo "<pre>";
            var_dump(die($e->getMessage()));
            echo "</pre>";
            exit();
        }
        return $this->stmt->fetch();
    }

    public function getDataByPage($page = 1)
    {
        $limit = 7;

        $sql = "SELECT posts.*,users.user_name,categories.category_name
              FROM posts
              INNER JOIN users ON users.id = posts.user_ID
              INNER JOIN categories ON categories.id = posts.category_ID
              ORDER BY posts.created_time DESC
              LIMIT " . ($page - 1) * $limit . "," . $limit;
        try {
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->execute();
        } catch (PDOException $e) {
            echo "<pre>";
            var_dump(die($e->getMessage()));
            echo "</pre>";
            exit();
        }
        return $this->stmt->fetchAll();
    }
}

?>