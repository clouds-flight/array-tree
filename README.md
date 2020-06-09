# array-tree
带有树结构的数组（含parent_id）非递归转为包含层级的树结构数组

只是遍历了一遍所有数据，和指定父元素及其下所有子元素，未使用递归，理论上可以支持无限层级

原始结构

    json编码后结构如下：
       [{
	       "id": "1",
	       "parent_id": "0",
	       "name": "插件中心"
       }, {
	       "id": "2",
	       "parent_id": "1",
	       "name": "钩子管理"
       }, {
	       "id": "3",
	       "parent_id": "2",
	       "name": "钩子插件管理"
       }, {
	       "id": "4",
	       "parent_id": "2",
	       "name": "钩子插件排序"
       }, {
	       "id": "5",
	       "parent_id": "2",
	       "name": "同步钩子"
       }, {
	       "id": "6",
	       "parent_id": "0",
	       "name": "设置"
       }, {
	       "id": "7",
	       "parent_id": "6",
	       "name": "友情链接"
       }, {
	       "id": "8",
	       "parent_id": "7",
	       "name": "添加友情链接"
       }, {
	       "id": "9",
	       "parent_id": "7",
	       "name": "添加友情链接提交保存"
       }]
       
获取包含层级结构的数组
    
    ArrayTree::getTree($array,id);  //$array 包含树结构关系的数组（需包含 id  parent_id name），$id 父id ，会返回该父id下的所有子级元素（层级结构）
    结果如下：
    [{
	    "id": "1",
	    "parent_id": "0",
	    "name": "插件中心",
	    "children": [{
		    "id": "2",
		    "parent_id": "1",
		    "name": "钩子管理",
		    "children": [{
			    "id": "3",
			    "parent_id": "2",
			    "name": "钩子插件管理",
			    "children": []
		    }, {
			    "id": "4",
			    "parent_id": "2",
			    "name": "钩子插件排序",
			    "children": []
		    }, {
			    "id": "5",
			    "parent_id": "2",
			    "name": "同步钩子",
			    "children": []
		    }]
	    }]
    }, {
	    "id": "6",
	    "parent_id": "0",
	    "name": "设置",
	    "children": [{
		    "id": "7",
		    "parent_id": "6",
		    "name": "友情链接",
		    "children": [{
		    	"id": "8",
		    	"parent_id": "7",
		    	"name": "添加友情链接",
	    		"children": []
	    	}, {
		    	"id": "9",
		    	"parent_id": "7",
		    	"name": "添加友情链接提交保存",
		    	"children": []
		    }]
	    }]
    }]

    
获取包含层级结构的数组，并添加名称路径

    ArrayTree::getTreePath($res,$id,$separator);  //$array 包含树结构关系的数组（需包含 id  parent_id name），$id 父id ，会返回该父id下的所有子级元素（层级结构），$separator 路径分隔符
    结果如下（分隔符是/，因转为json字符串添加了转义符，解码后是没有\的）：
    [{
	    "id": "1",
	    "parent_id": "0",
	    "name": "插件中心",
	    "path": "插件中心",
	    "children": [{
		    "id": "2",
		    "parent_id": "1",
		    "name": "钩子管理",
		    "path": "插件中心\/钩子管理",
		    "children": [{
			    "id": "3",
			    "parent_id": "2",
		            "name": "钩子插件管理",
		            "path": "插件中心\/钩子管理\/钩子插件管理",
		    	    "children": []
	    	}, {
			"id": "4",
		    	"parent_id": "2",
		    	"name": "钩子插件排序",
		    	"path": "插件中心\/钩子管理\/钩子插件排序",
		    	"children": []
	    	}, {
		    	"id": "5",
		    	"parent_id": "2",
		    	"name": "同步钩子",
	    		"path": "插件中心\/钩子管理\/同步钩子",
		    	"children": []
	    	}]
	    }]
    }, {
	    "id": "6",
	    "parent_id": "0",
	    "name": "设置",
	    "path": "设置",
	    "children": [{
		    "id": "7",
	    	"parent_id": "6",
	    	"name": "友情链接",
	    	"path": "设置\/友情链接",
	    	"children": [{
		    	"id": "8",
		    	"parent_id": "7",
		    	"name": "添加友情链接",
		    	"path": "设置\/友情链接\/添加友情链接",
		    	"children": []
	    	}, {
		    	"id": "9",
		    	"parent_id": "7",
		    	"name": "添加友情链接提交保存",
			 path": "设置\/友情链接\/添加友情链接提交保存",
		    	"children": []
	    	}]
	    }]
    }]



    
获取父元素所有子元素id的集合

    ArrayTree::getChildrenIdArray($array,$id);  //$array 包含树结构关系的数组（需包含 id  parent_id name），$id 父id ，会返回该父id下的所有子级元素id的集合
    结果如下：
    ["1","6","2","7","3","4","5","8","9"]
    
    

    
    
    



