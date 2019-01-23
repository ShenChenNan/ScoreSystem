<?php
class Upload
{
    function uploadAll()
    {
        foreach ($_FILES as $key => $file) {
            if (is_array($file["name"])) {
                $file_arr = array();
                for ($i = 0; $i < count($file["name"]); $i++) {
                    $file_arr["name"] = $file["name"][$i];
                    $file_arr["type"] = $file["type"][$i];
                    $file_arr["tmp_name"] = $file["tmp_name"][$i];
                    $file_arr["error"] = $file["error"][$i];
                    $file_arr["size"] = $file["size"][$i];

                    $this->uploadOneFile($file_arr);
                }
            }
            else {
                $this->uploadOneFile($file);
            }
        }
    }

    function uploadOneFile($file)
    {
        if ($file["error"] == 0) {
            $fname = $file["name"];
            $name1 = date("YmdHis") . '-' . rand(10000, 99999);
            $suffix = strrchr($fname, '.');
            $target_file = "./Web/back/upfiles/" . $name1 . $suffix;

            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                // echo "上传成功";
            } else {
                echo "<br>移动文件时发生错误";
            }
        } else {
            echo "<br>上传的文件发生错误";
        }
    }
}
?>