<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2018 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------
namespace app\portal\model;

use think\Model;
use tree\FunctionTree;

class PortalFunctionModel extends Model
{


    public function addFunction($data)
    {
        return $this->insertGetId($data);
    }

    public function selectFunction($categoryId) {
        return $this->where(['category_id'=>$categoryId,'status' => 1])->select();
    }

    public function editFunction($data)
    {
        return $this->update($data);
    }

    /**
     * 功能树形结构
     * @param int $currentIds
     * @param string $tpl
     * @return string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function adminFunctionTableTree($currentCategoryIds, $currentFunctionIds = 0)
    {
        $functionList =$this->alias('f')->join('portal_category c','c.id = f.category_id')->whereIn('f.category_id', $currentCategoryIds)->where('f.status', 1)->field('f.id as fid, f.name as fname, c.id as cid, c.name as cname')->select()->toArray();
        $functionTree       = new FunctionTree();
        $functionTree->icon = ['&nbsp;&nbsp;│', '&nbsp;&nbsp;├─', '&nbsp;&nbsp;└─'];
        $functionTree->nbsp = '&nbsp;&nbsp;';

        if (!is_array($currentFunctionIds)) {
            $currentFunctionIds = [$currentFunctionIds];
        }

        $newFunctions = [];
        foreach ($functionList as $item) {
            $item['checked']        = in_array($item['fid'], $currentFunctionIds) ? "checked" : "";
            array_push($newFunctions, $item);
        }

        $functionTree->init($newFunctions);
        $treeStr = $functionTree->getTree($currentFunctionIds);


        return $treeStr;
    }

}
