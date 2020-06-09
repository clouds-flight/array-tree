<?php

/*
 * @Author: 吴云祥
 * @Date: 2020-06-09 11:57:21
 * @LastEditTime: 2020-06-09 18:38:22
 * @FilePath: /array-tree/src/ArrayTree.php
 */

namespace ArrayTree;


class ArrayTree
{

    public static function getTree(array $array, $id)
    {


        $items = [];

        if ($array) {
            foreach ($array as $k => $v) {
                $items[$v['parent_id']][] = &$array[$k];
            }
        }

        $next = &$items[$id];

        while (true) {
            $next_temp = array();

            foreach ($next as $key => $value) {

                $next[$key]["children"] = array();

                if (!isset($items[$value["id"]]) || empty($items[$value["id"]])) {
                    continue;
                }

                $next[$key]["children"] = $items[$value["id"]];

                $next_temp = array_merge($next_temp, $items[$value["id"]]);

            }

            $next = &$next_temp;

            unset($next_temp);

            if (count($next) == 0) {
                break;
            }
        }

        return $items[$id];
    }



    public static function getTreePath($array, $id,$separator)
    {
        $items = [];

        if ($array) {
            foreach ($array as $k => $v) {
                $items[$v['parent_id']][] = &$array[$k];
            }
        }

        $next = &$items[$id];

        while (true) {
            $next_temp = array();

            foreach ($next as $key => $value) {

                if(isset($value['path']))
                {
                    $next[$key]['path']=$next[$key]['path'].$separator.$value['name'];
                }else{
                    $next[$key]['path']=$value['name'];
                }

                $next[$key]["children"] = array();

                if (!isset($items[$value["id"]]) || empty($items[$value["id"]])) {
                    continue;
                }

                $next[$key]["children"] = $items[$value["id"]];

                foreach($items[$value["id"]] as $k=>$v)
                {
                    $items[$value["id"]][$k]['path']=$next[$key]['path'];
                    $next_temp[]=&$items[$value["id"]][$k];
                }

            }

            $next = &$next_temp;

            unset($next_temp);

            if (count($next) == 0) {
                break;
            }
        }

        return $items[$id];
    }



    public static function getChildrenIdArray($array, $id)
    {
        $items = [];

        if ($array) {
            foreach ($array as $k => $v) {
                $items[$v['parent_id']][] = &$array[$k];
            }
        }

        $next = &$items[$id];

        $children=array();

        while (true) {
            $next_temp = array();

            $children  = array_merge($children, array_column($next, 'id'));

            foreach ($next as $key => $value) {

                $next[$key]["children"] = array();

                if (!isset($items[$value["id"]]) || empty($items[$value["id"]])) {
                    continue;
                }

                $next[$key]["children"] = $items[$value["id"]];

                $next_temp = array_merge($next_temp, $items[$value["id"]]);
                
            }

            $next = &$next_temp;

            unset($next_temp);

            if (count($next) == 0) {
                break;
            }
        }

        return $children;
    }

}
