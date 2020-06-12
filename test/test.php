<?php
/*
 * @Author: 吴云祥
 * @Date: 2020-06-06 11:05:58
 * @LastEditTime: 2020-06-12 23:11:40
 * @FilePath: /array-tree/test/test.php
 */

namespace Test;

require __DIR__ . '/bootstrap.php';

use ArrayTree\ArrayTree;


\Co\run(function () {
    $swoole_mysql = new \Swoole\Coroutine\MySQL();
    $swoole_mysql->connect([
        'host'     => '127.0.0.1',
        'port'     => 3306,
        'user'     => '****',
        'password' => '*****',
        'database' => '***',
    ]);


    $sql = "SELECT id,parent_id,name FROM `pf_admin_menu` order by id asc";

    $res= $swoole_mysql->query($sql);

    echo count($res);

    $tree=ArrayTree::getTree($res,0);
    echo json_encode($tree,JSON_UNESCAPED_UNICODE);

    $children=ArrayTree::getChildrenIdArray($res,0);
    echo json_encode($children,JSON_UNESCAPED_UNICODE);

    $tree_path=ArrayTree::getTreePath($res,0,"/");
    echo json_encode($tree_path,JSON_UNESCAPED_UNICODE);
    
});

