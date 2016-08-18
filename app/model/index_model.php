<?php

/**
 * Created by PhpStorm.
 * User: Nimo
 * Date: 08/08/2016
 * Time: 10:05 CH
 */
class index_model extends base_model
{
    public $table = "posts";

    /**
     * @param $limit
     * @param int $page
     * @return array
     */
    public function getDataByPage($limit, $page = 1)
    {
//        $limit = 3;
        $sql = "SELECT p.*, u.user_name FROM posts p INNER JOIN users u ON p.user_ID = u.id";
        if ($limit !== 'all') {
            $sql .= " LIMIT " . (($page - 1) * $limit) . "," . $limit;
        }
        $this->stmt = $this->conn->prepare($sql);
        $this->stmt->execute();
        return $this->stmt->fetchAll();
    }

    public function totalPost()
    {
        $sql = "SELECT count(*) as total FROM " . $this->table;
        try {
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->execute();
            return $this->stmt->fetch();
        } catch (PDOException $e) {
            echo "<pre>";
            var_dump(die($e->getMessage()));
            echo "</pre>";
            exit();
        }
    }


}