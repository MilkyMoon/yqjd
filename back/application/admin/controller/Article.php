<?php
/**
 * Created by PhpStorm.
 * User: PengZong
 * Date: 17/4/25
 * Time: 00:44
 */

namespace app\admin\controller;

use think\Controller;
use think\Request;

class Article extends Controller {
    /**
     * [index 文章列表]
     * PengZong
     * DateTime: 2017-04-25T21:09:02+0800
     *
     * @return array
     */
    public function index(){

        $articleModel = model('Article');
        $param = Request::instance()->get();
        $keywords = !empty($param['keywords']) ? $param['keywords']: '';
        $page = !empty($param['page']) ? $param['page']: '';
        $limit = !empty($param['limit']) ? $param['limit']: '';

        $data = $articleModel->getDataList($keywords, $page, $limit);

        return resultArray(['data' => $data]);
    }


    /**
     * [save 添加文章]
     * PengZong
     * DateTime: 2017-04-26T00:38:18+0800
     *
     * @return array
     */
    public function save() {
        $articleModel = model('Article');
        $param = Request::instance()->post();
        $data = $articleModel->saveData($param);
        if (!$data) {
            return resultArray(['error' => $articleModel->getError()]);
        }
        return resultArray(['data' => '添加成功']);
    }

    /**
     * [update 编辑文章]
     * PengZong
     * DateTime: 2017-04-26T17:38:18+0800
     *
     * @return array
     */
    public function update() {
        $articleModel = model('Article');
        $param = Request::instance()->post();
        $data = $articleModel->updateDataById($param, $param['id']);
        if (!$data) {
            return resultArray(['error' => $articleModel->getError()]);
        }
        return resultArray(['data' => '编辑成功']);
    }


    /**
     * [delete 删除文章]
     * PengZong
     * DateTime: 2017-04-26T18:08:24+0800
     *
     * @return array
     */
    public function delete() {
        $articleModel = model('Article');
        $param = Request::instance()->post();
        $data = $articleModel->delDataById($param['id']);
        if (!$data) {
            return resultArray(['error' => $articleModel->getError()]);
        }
        return resultArray(['data' => '删除成功']);
    }

    /**
     * [enable 启用/禁用]
     * PengZong
     * DateTime: 2017-04-26T20:24:15+0800
     *
     * @return array
     */
    public function enable() {
        $articleModel = model('Article');
        $param = $this->param;
        $data = $articleModel->enableData($param['id'], $param['status']);
        if (!$data) {
            return resultArray(['error' => $articleModel->getError()]);
        }
        return resultArray(['data' => '操作成功']);
    }

}