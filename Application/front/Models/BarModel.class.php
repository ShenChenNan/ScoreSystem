<?php
class BarModel extends BaseModel
{
    function getScoresByName($name)
    {
        $sql = "select DATE_FORMAT(month,'%c') as time,";
        $sql .= " data1+data2+data3+data4+data5+data6 as sum";
        $sql .= " from score_list";
        $sql .= " where name='$name' and YEAR(month)=YEAR(now())";
        $sql .= " order by month";

        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>