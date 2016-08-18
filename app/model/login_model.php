<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 8/12/2016
 * Time: 8:55 PM
 */
class login_model extends base_model
{
    public function getDataByName($name)
    {
        $sql = "SELECT * FROM users WHERE user_name = ?";
        try {
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->bindParam(1, $name);
            $this->stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $this->stmt->fetch();
    }

    public function getDataByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE user_email = ?";
        try {
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->bindParam(1, $email);
            $this->stmt->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        return $this->stmt->fetch();
    }
    
    public function insertRegister($name,$pass,$email)
    {
        $getDate = date('y-m-d');
        $sql = "INSERT INTO users (user_name,user_pass,user_email,created_time) VALUES (?,?,?,?) ";
        
        try{
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->bindParam(1,$name,PDO::PARAM_INT);
            $this->stmt->bindParam(2,$pass);
            $this->stmt->bindParam(3,$email);
            $this->stmt->bindParam(4,$getDate);
            $this->stmt->execute();
        }catch(PDOException $e){
            die($e->getMessage());
        }
        return $this->getDataByName($name);
    }
}















