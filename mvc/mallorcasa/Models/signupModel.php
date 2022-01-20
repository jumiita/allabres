<?php

include_once "../DB/dbo.php";
include_once "../Entities/user.php";

class signupModel
{
    private dbo $db;

    public function __construct()
    {
        $this->db = new dbo();
    }

    public function checkUserExists($mail)
    {
        $sql = "SELECT * FROM users WHERE mail = '" . $mail."';";
        $this->db->default();
        $query = $this->db->query($sql);
        $this->db->close();
        if ($query->num_rows == 0) {
            return false;
        }
        return true;
    }

    public function saveUser($mail, $password)
    {
        $sql = "INSERT INTO users (mail, password) VALUES ('" . $mail."', '".$password."');";
        $this->db->default();
        $this->db->query($sql);
        if ($this->db->insert_id > 0) {
            $this->db->close();
            return true;
        }
        $this->db->close();
        return false;
    }

}