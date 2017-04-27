<?php
/**
 * Created by PhpStorm.
 * User: PengZong
 * Date: 17/4/26
 * Time: 21:08
 */

namespace app\admin\controller;


use think\Controller;

class Category extends Controller {
    public function index(){
        $categoryModel = model('Category');
//        $param = Request::instance()->get();

        $data = $categoryModel->getDataList();

        // var_dump($data);
        return resultArray(['data' => $data]);
    }
}