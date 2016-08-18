<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 8/11/2016
 * Time: 1:56 AM
 */
class submit_model extends base_model
{
    private $table = 'posts';
    
    
    public function getSubmitUserByName($user_name)
    {
        $sql = "SELECT * FROM users WHERE user_name = ?";

        try{
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->bindParam(1,$user_name);
            $this->stmt->execute();
        }catch(PDOException $e){
            echo "<pre>"; var_dump(die($e->getMessage())); echo "</pre>";exit();
        }
        return $this->stmt->fetch();
    }

    public function getDataById($id)
    {
        $sql = "SELECT posts.*,users.user_name, categories.category_name 
                FROM posts
                INNER JOIN users ON posts.user_ID = users.id
                INNER JOIN categories ON categories.id = posts.category_ID 
                WHERE posts.id = ?";
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

    public function getAllCategories()
    {
        return parent::getAll('categories');
    }

    public function insertPOST($sTitle, $sContent, $sUser_ID, $sCategory_ID)
    {
        $sql = 'INSERT INTO ' . $this->table . ' (title, content,created_time,last_edit,views,user_ID,category_ID) VALUES (:title, :content,:created_time,:last_edit,:views,:user_ID,:category_ID)';
        $getDate = date('y-m-d');
        $views = 0;
        try {
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->bindParam(':title', $sTitle);
            $this->stmt->bindParam(':content', $sContent);
            $this->stmt->bindParam(':created_time', $getDate);
            $this->stmt->bindParam(':last_edit', $getDate);
            $this->stmt->bindParam(':views', $views);
            $this->stmt->bindParam(':user_ID', $sUser_ID);
            $this->stmt->bindParam(':category_ID', $sCategory_ID,PDO::PARAM_INT);
            $this->stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        $id = $this->conn->lastInsertId();
        return $this->getDataById($id);
    }
    
}