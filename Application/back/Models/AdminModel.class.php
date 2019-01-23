<?php
class AdminModel extends BaseModel
{
    function checkAdmin($arr)
    {
        $sql = "select * from admin_list where ";
        $sql .= "name='{$arr['username']}' and ";
        $sql .= "password=md5('{$arr['password']}')";
        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result && count($result) == 1) {
            return true;
        } else {
            return false;
        }
    }
}
?>