<?php
class IndexController extends BaseController
{
    function indexAction()
    {
        if (!empty($_COOKIE["username"])) {
            $cookie_user = $_COOKIE["username"];
        } else {
            $cookie_user = "";
        }
        include VIEW_PATH . "login.html";
    }

    function checkLoginAction()
    {
        $arr = array();
        $arr['username'] = addslashes($_POST["username"]);
        $arr['password'] = addslashes($_POST["password"]);

        $model = ModelFactory::M("AdminModel");
        $result = $model->checkAdmin($arr);
        if ($result) {
            $_SESSION["AdminIsLogin"] = "OK";
            header("location:?p=back&a=loginOK");
        } else {
            $this->gotoUrl("管理员登录失败！", "?p=back");
        }
    }

    function loginOKAction()
    {
        if (!empty($_SESSION["AdminIsLogin"]) && $_SESSION["AdminIsLogin"] == "OK") { 
            header("location:?p=back&c=Score");
        } else {
            $this->gotoUrl("登录超时，请重新登录！", "?p=back");
        }
    }

    function logoutAction()
    {
        session_destroy();
        header("location:?p=back");
    }
}
?>