<?php
return array(
	'URL_ROUTER_ON' => true,								//开启路由功能
	'URL_CASE_INSENSITIVE' =>true,
	// 'TMPL_L_DELIM' => '{',									//修改左右定界符
	// 'TMPL_R_DELIM' => '}',									//修改左右定界符
	'DEFAULT_CHARSET'=> 'utf-8',							//编码设置
	'SESSION_AUTO_START' => true,							//开启SESSION
	'URL_HTML_SUFFIX' => 'html|shmtl|xml', 					// 多个用 | 分割伪静态配置
	'VAR_PAGE'=>'page',										//分页变量
	
	
	
	'TMPL_PARSE_STRING' => array(
		'__APP__' => __ROOT__.'/?s=Home',					// 更改默认的__APP__ 替换规则
		'__JS__' => __ROOT__.'/Public/home/js',
		'__CSS__' => __ROOT__.'/Public/home/css',
		'__IMAGE__' => __ROOT__.'/Public/home/images',
		
	),
);