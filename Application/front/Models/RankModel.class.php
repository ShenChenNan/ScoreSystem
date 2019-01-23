<?php
class RankModel extends BaseModel
{
    function showNewestRank(&$date)
    {
        $sql = "select month from score_list";
        $sql .= " group by month";
        $sql .= " order by month desc";
        $sql .= " limit 0,1";

        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $date = $result ? $result["month"] : date("Y-m-d");

        $sql = "select name, data1+data2+data3+data4+data5+data6 as sum";
        $sql .= " from score_list";
        $sql .= " where DATE_FORMAT(month,'%Y-%m')=DATE_FORMAT('$date','%Y-%m')";
        $sql .= " order by sum desc";

        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>