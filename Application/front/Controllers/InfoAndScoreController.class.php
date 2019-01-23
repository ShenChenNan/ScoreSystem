<?php
class InfoAndScoreController extends BaseController
{
    function indexAction()
    {
        $month = addslashes($_GET["month"]);
        $name = addslashes($_GET["name"]);

        include VIEW_PATH . "info_score.html";
    }

    function jsonRadarAction()
    {
        $month = addslashes($_GET["month"]);
        $name = addslashes($_GET["name"]);
        $callback = addslashes($_GET["callback"]);

        $model = ModelFactory::M("RadarModel");

        $score = $model->getOneScore($month, $name);
        $scoreJson = json_encode($score);

        $avg = $model->getAvgScore($month);
        $avgJson = json_encode($avg);

        echo $callback . "($scoreJson, $avgJson)";
    }

    function jsonBarAction()
    {
        $name = addslashes($_GET["name"]);
        $callback = addslashes($_GET["callback"]);

        $model = ModelFactory::M("BarModel");
        $scores = $model->getScoresByName($name);
        $scoresJson = json_encode($scores);

        echo $callback . "($scoresJson)";
    }
}
?>