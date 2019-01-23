<?php
class RadarModel extends BaseModel
{
    function getOneScore($month, $name)
    {
        $sql = "select * from score_list";
        $sql .= " where DATE_FORMAT(month,'%Y年%m月')='$month'";
        $sql .= " and name='$name'";

        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    function getAvgScore($month)
    {
        $sql = "select avg(data1), avg(data2), avg(data2), avg(data4), avg(data5), avg(data6)";
        $sql.= " from score_list";
        $sql .= " where DATE_FORMAT(month,'%Y年%m月')='$month'";
        
        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_NUM);
        return $result;
    }
}
?>