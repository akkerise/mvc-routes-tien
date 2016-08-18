<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 8/11/2016
 * Time: 11:40 AM
 */
class search_model extends base_model
{
    private $table = 'posts';

    public function searchProName($key, $limit, $page = 1)
    {
        $name = "%" . $key . "%";
        $sql = "SELECT posts.*,users.user_name FROM posts JOIN users ON users.id = posts.id WHERE title OR content LIKE ?";
        $sql .= " LIMIT " . (($page - 1) * $limit) . "," . $limit;
        $this->stmt = $this->conn->prepare($sql);
        $this->stmt->bindParam(1, $name);
        $this->stmt->execute();
        return $this->stmt->fetchAll();
    }


}

