<?php
class BaseController
{
    function __construct()
    {
        header("content-type:text/html; charset=utf-8");
        new Session();//设定了session的处理机制是我们自己的数据库
        session_start();//启动session
    }

    // 显示一定的简短提示文字，然后，自动跳转(可以设定停留的时间秒数)
    function gotoUrl($msg, $url, $time = 3)
    {
        echo "<font color=red>$msg</font>";
        echo "<a href='$url'>返回</a>";
        echo "<br>页面将在{$time}秒之后自动跳转";
        // 自动定时跳转功能
        header("refresh:$time; url=$url");
    }
}
?>