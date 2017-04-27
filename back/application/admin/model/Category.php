<?php
/**
 * Created by PhpStorm.
 * User: PengZong
 * Date: 17/4/26
 * Time: 04:15
 */

namespace app\admin\model;


use think\Model;

class Category extends Model {
    protected $name = 'category';

    public function getDataList() {
        $cat = new \com\Category('category', array('id', 'pid', 'name', 'title'));
        $data = $cat->getList('', 0, 'id');

        return $data;
    }
}