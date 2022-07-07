<?php

$config = require(ROOT_PATH . "/include/config.php");
$params = array_merge($config['params'], array('administrator' => array('admin'),));
$st="";

    $params['roleItem'] = array(
    array(
     '测试',
        array(
            'award_index989' => array('测试', 'Article/DownloadTemplateWord'),
            ),
       ),

    array(
     '服務機構',
        array(
            'award_index301' => array('栏目设置', 'NewsColumn/index'),
            'award_index302' => array('报刊机构设置', 'Institutions/index'),
            'award_index303' => array('学生排名', 'rank/index'),
            'award_index304' => array('学校信息', 'schoolList/index'),
            'award_index305' => array('用户信息', 'user/index'),
            'award_index306' => array('得分明细', 'scoredetail/index'),
            'award_index314' => array('各学校稿件数明细', 'articleNum/index'),
            ),
       ),
    array(
     '稿件审核',
        array(
             
             'award_index307' => array('稿件浏览', 'Article/index'),
             'award_index308' => array('稿件一审', 'Article/firstcountnumber'),
             'award_index309' => array('稿件二审', 'Article/secondcountnumber'),
             'award_index310' => array('稿件总审', 'Article/finalcountnumber'), 
             'award_index311' => array('录用稿件', 'Article/published'), 
             'award_index315' => array('发表稿件', 'Article/publishOn'), 
             'award_index312' => array('拒收稿件', 'Article/refused'), 
             'award_index313' => array('退稿重改稿件', 'Article/remodefied'), 

            ),
       ),
    array(
     '随笔审核',
        array(
             
             'award_index324' => array('稿件浏览', 'Essay/index'),
             'award_index325' => array('稿件审核', 'Essay/examine  '),
             'award_index326' => array('发表稿件', 'Essay/publishOn'),
             'award_index327' => array('拒收稿件', 'Essay/refused'), 

            ),
       ),
    array(
     '题库相关',
        array(
            'award_index316' => array('题库', 'question/index'),
        )
    ),
    array(
     '阅读相关',
        array(
            'award_index317' => array('阅读', 'readselect/index'),
        )
    ),
    array(
     '活动申请',
        array(
            'award_index318' => array('活动申请', 'activitydetail/index'),
          //  'award_index319' => array('申请状态查看', 'activity/index'),
            'award_index320' => array('申请通过活动', 'activitydetail/index&status=4'),
        )
    ),
      array(
     '活动审核',
        array(
            'award_index321' => array('活动一审', 'activity/index'),
             'award_index322' => array('活动二审', 'activity/index'),
             'award_index323' => array('活动总审', 'activity/index'),
        )
    ),
      array(
     '人大代表信息管理',
        array(
            'award_index324' => array('人大代表个人信息', 'representative/index'),
            'award_index325' => array('人大代表个人信息审核', 'representative/check'),
            'award_index327' => array('人大代表个人信息管理', 'representative/manage'),
            'award_index326' => array('政府职能部门信息', 'government/index'),
            'award_index328' => array('提交信息', 'representative/update1'),
        )
    )
  );




$main = array(
    'basePath' => ROOT_PATH . '/admin',
    'runtimePath' => ROOT_PATH . '/runtime/admin',
    'name' => '',
    'defaultController' => 'index',
    'components' => array(
        'db' => $config['components']['db'],
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'info,error, warning'
                ),
                array(
                    'class' => 'CWebLogRoute',
                    'levels' => 'trace'
                ),
            ),
        ),
    ),
    'params' => $params,
);

return array_merge($config, $main);
?>

<ul class="sidebar-menu">            
<li class="treeview">               
    <a href="#">                    
        <i class="fa fa-gears"></i> <span>權限控制</span>                    
        <i class="fa fa-angle-left pull-right"></i>               
    </a>               
    <ul class="treeview-menu">                   
        <li class="treeview">                        
            <a href="/admin">管理員</a>                        
            <ul class="treeview-menu">                            
                <li><a href="/user"><i class="fa fa-circle-o"></i> 後臺用戶</a></li>                            
                <li class="treeview">                                
                    <a href="/admin/role"> <i class="fa fa-circle-o"></i> 權限 <i class="fa fa-angle-left pull-right"></i>
                    </a>                                
                    <ul class="treeview-menu">                                    
                        <li><a href="/admin/route"><i class="fa fa-circle-o"></i> 路由</a></li>
                        <li><a href="/admin/permission"><i class="fa fa-circle-o"></i> 權限</a></li>
                        <li><a href="/admin/role"><i class="fa fa-circle-o"></i> 角色</a></li>
                        <li><a href="/admin/assignment"><i class="fa fa-circle-o"></i> 分配</a></li>
                        <li><a href="/admin/menu"><i class="fa fa-circle-o"></i> 菜單</a></li>
                    </ul>                           
                </li>                        
            </ul>                    
        </li>                
    </ul>            
    </li>        
</ul>
