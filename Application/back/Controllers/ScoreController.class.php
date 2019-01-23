<?php
class ScoreController extends BaseController
{
    function indexAction()
    {
        if (!empty($_SESSION["AdminIsLogin"]) && $_SESSION["AdminIsLogin"] == "OK") {
            $model = ModelFactory::M("ScoreModel");
            $result = $model->listEmployee();
            include VIEW_PATH . "score.html";
        } else {
            $this->gotoUrl("登录超时，请重新登录！", "?p=back");
        }
    }

    function scoreAction()
    {
        try {
            if (empty($_POST["name"])) {
                throw new Exception("这个月没有人参与评分", 1);
            } elseif (empty($_POST["date"])) {
                throw new Exception("未选定评分月份", 2);
            } elseif ($this->isScored($_POST["date"])) {
                throw new Exception("本月已经评分完毕", 3);
            }

            $arrOut = array();
            foreach ($_POST["name"] as $key => $value) {
                $arrIn = array();
                $arrIn[] = $_POST["date"];
                $arrIn[] = $value;

                for ($i = 1; $i < 7; $i++) {
                    $data = $value . $i;
                    $arrIn[] = !empty($_POST["$data"]) ? $_POST["$data"] : "0";
                }
                $arrOut[] = $arrIn;
            }

            $model = ModelFactory::M("ScoreModel");
            $model->insertScore($arrOut);
            $this->gotoUrl("评分成功", "?p=back&c=Score");
        } catch (Exception $e) {
            $this->gotoUrl($e->getMessage(), "?p=back&c=Score");
        }
    }

    private function isScored($date)
    {
        $model = ModelFactory::M("ScoreModel");
        return $model->isScored($date);
    }
}
?>