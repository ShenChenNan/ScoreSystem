<?php
$p = !empty($_GET["p"]) ? $_GET["p"] : "front";

define("PLAT", $p);
define("DS", DIRECTORY_SEPARATOR);
define("ROOT", __DIR__ . DS);
define("APP", ROOT . "Application" . DS);
define("FRAMEWORK", ROOT . "Framework" . DS);
define("PLAT_PATH", APP . PLAT . DS);
define("CTRL_PATH", PLAT_PATH . "Controllers" . DS);
define("MODEL_PATH", PLAT_PATH . "Models" . DS);
define("VIEW_PATH", PLAT_PATH . "Views" . DS);

$c = !empty($_GET["c"]) ? $_GET["c"] : "Index";
$a = !empty($_GET["a"]) ? $_GET["a"] : "index";

spl_autoload_register("autoload");
function autoload($class)
{
    $base_class = array("BaseModel", "ModelFactory", "BaseController", "Session", "Upload");
    if (in_array($class, $base_class)) {
        require_once FRAMEWORK . $class . ".class.php";
    } elseif (substr($class, -5) == "Model") {
        require_once MODEL_PATH . $class . ".class.php";
    } elseif (substr($class, -10) == "Controller") {
        require_once CTRL_PATH . $class . ".class.php";
    }
}

$controller_name = $c . "Controller";
$action = $a . "Action";

$ctrl = new $controller_name();
$ctrl->$action();
?>
