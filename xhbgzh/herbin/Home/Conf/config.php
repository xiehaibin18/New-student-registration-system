<?php
return array(
    /* 数据库设置 */
    'DB_TYPE'=>'mysql', 
    'DB_HOST'=>SAE_MYSQL_HOST_M, 
    'DB_USER'=>SAE_MYSQL_USER, 
    'DB_PWD'=>SAE_MYSQL_PASS,  
    'DB_NAME'=>SAE_MYSQL_DB, 
    'DB_PREFIX'=>'gzh_', 
    'RBAC_ADMIN_TABLE'=>'gzh_admin', 
    'RBAC_INFO_TABLE'=>'gzh_info', 
    'RBAC_LOGIN_TABLE'=>'gzh_login', 
    'RBAC_SELFHELP_TABLE'=>'gzh_selfhelp', 

    /* 显示页面Trace信息 */
    'SHOW_PAGE_TRACE'       =>  true,

    /* 修改定界符 */
    'TMPL_L_DELIM'          =>  '<{', //修改左定界符
    'TMPL_R_DELIM'          =>  '}>', //修改右定界符

    //默认错误跳转对应的模板文件
    'TMPL_ACTION_ERROR' => 'Public:error',
    //默认成功跳转对应的模板文件
    'TMPL_ACTION_SUCCESS' => 'Public:success',


);