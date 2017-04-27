<?php

/**
 * Created by PhpStorm.
 * User: PengZong
 * Date: 17/4/25
 * Time: 00:47
 */

namespace app\admin\model;


use think\Model;

class Article extends Model {
    protected $name = 'article';

    /**
     * [getDataList 获取列表]
     * @PengZong
     * @DateTime  2017-04-25T21:07:18+0800
     * @param     [string]                   $keywords [关键字]
     * @param     [number]                   $page     [当前页数]
     * @param     [number]                   $limit    [每页数量]
     * @return    [array]                              [description]
     */
    public function getDataList($keywords, $page, $limit) {
        $map = [];
        if ($keywords) {
            $map['title|name'] = ['like', '%'.$keywords.'%'];
        }

        $list = $this
            ->where($map)
            ->alias('article')
            ->join('__CATEGORY__ category', 'category.id=article.cate_id', 'LEFT');

        // 若有分页
        if ($page && $limit) {
            $list = $list->page($page, $limit);
        }

        $list = $list->field('article.*,category.pid,category.name')->select();

        $dataCount = sizeof($list);

        $data['list'] = $list;
        $data['dataCount'] = $dataCount;

        return $data;
    }

    /**
     * [saveData 添加文章]
     * PengZong
     * DateTime: 2017-04-26T17:07:18+0800
     *
     * @param  $param        [添加数组]
     * @return bool
     */
    public function saveData($param) {
        try{
            $this->data($param)->allowField(true)->save();
            return true;
        }catch (\Exception $e){

            $this->error = '添加失败';
            return false;
        }

    }

    /**
     * [updateDataById 编辑文章]
     * PengZong
     * DateTime: 2017-04-26T17:32:18+0800
     *
     * @param  $param        [编辑数组]
     * @param  $id           [主键]
     * @return bool
     */
    public function updateDataById($param, $id){
        if (empty($id)) {
            $this->error = '编辑失败';
            return false;
        }
        try{
            $this->allowField(true)->save($param, ['id' => $id]);
            return true;
        }catch (\Exception $e){
            $this->error = '编辑失败';
            return false;
        }
    }


    /**
     * [delDataById 删除文章]
     * PengZong
     * DateTime: 2017-04-26T18:45:12+0800
     *
     * @param  string $id       [主键]
     * @return bool
     */
    public function delDataById($id = '') {
        if (empty($id)) {
            $this->error = '删除失败';
            return false;
        }
        try {
            $this->where($this->getPk(), $id)->delete();
            return true;
        } catch(\Exception $e) {
            $this->error = '删除失败';
            return false;
        }
    }


    /**
     * [enableData]
     * PengZong
     * DateTime: ${DATE} ${TIME}
     *
     * @param  string    $id          [主键]
     * @param  int       $status      [状态1启用0禁用]
     * @return bool
     */
    public function enableData($id = '', $status = 1){
        if (empty($id)) {
            $this->error = '操作失败';
            return false;
        }
        //更改状态
        if($status == 0){$status = 1;}else{$status = 0;}

        try{
            $this->where($this->getPk(),$id)->setField('status', $status);
            return true;
        }catch (\Exception $e){
            $this->error = '操作失败';
            return false;
        }
    }

}