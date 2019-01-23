<?php
class ScoreModel extends BaseModel
{
    function listEmployee()
    {
        $sql = "select name from employee_list";
        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        return $result;
    }

    function isScored($date)
    {
        $sql = "select DATE_FORMAT(month,'%Y-%m') as a from score_list";
        $sql .= " group by a";
        $sql .= " having a = DATE_FORMAT('$date','%Y-%m')";

        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetch();

        return $result ? true : $result;
    }

    function insertScore($arrOut)
    {

        try {
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->beginTransaction();

            $sql = "insert into score_list set";
            $sql .= " month=?,";
            $sql .= " name=?,";
            $sql .= " data1=?,";
            $sql .= " data2=?,";
            $sql .= " data3=?,";
            $sql .= " data4=?,";
            $sql .= " data5=?,";
            $sql .= " data6=?";
            $stmt = $this->pdo->prepare($sql);

            foreach ($arrOut as $key => $arrIn) {
                foreach ($arrIn as $key => $value) {
                    $stmt->bindValue($key + 1, $value);
                }
                $stmt->execute();
            }

            $this->pdo->commit();
        } catch (Exception $e) {
            $this->pdo->rollBack();
            throw new Exception("评分失败", 4);
        }
    }
}
?>