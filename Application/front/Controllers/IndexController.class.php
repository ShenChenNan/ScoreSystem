<?php
class IndexController extends BaseController
{
    function indexAction()
    {
        $rankTime = "";
        $model = ModelFactory::M("RankModel");
        $data = $model->showNewestRank($rankTime);
        $month = date("Y年m月", strtotime($rankTime));
        include VIEW_PATH . "rank.html";
    }
}
?>