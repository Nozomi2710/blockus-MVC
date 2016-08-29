<?php

class Controller
{
    public function model($model)
    {
        $modelName = $model . "Model";
        require_once "models/$modelName.php";//注意資料夾相對位置

        return new $modelName();
    }

    public function view($view, $data = array())
    {
        require_once "views/$view.php";
    }

}
