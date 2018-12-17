<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:45:"themes/admin/portal/admin_category/index.html";i:1542036081;s:82:"/Users/liufeilong/php/workspace/get2b/admin/public/themes/admin/public/header.html";i:1541948631;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim for IE8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->


    <link href="/themes/admin/public/assets/themes/<?php echo cmf_get_admin_style(); ?>/bootstrap.min.css" rel="stylesheet">
    <link href="/themes/admin/public/assets/simpleboot3/css/simplebootadmin.css" rel="stylesheet">
    <link rel="stylesheet" href="jquery.tag-editor.css">

    <link href="/static/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        form .input-order {
            margin-bottom: 0px;
            padding: 0 2px;
            width: 42px;
            font-size: 12px;
        }

        form .input-order:focus {
            outline: none;
        }

        .table-actions {
            margin-top: 5px;
            margin-bottom: 5px;
            padding: 0px;
        }

        .table-list {
            margin-bottom: 0px;
        }

        .form-required {
            color: red;
        }
    </style>
    <script type="text/javascript">
        //全局变量
        var GV = {
            ROOT: "/",
            WEB_ROOT: "/",
            JS_ROOT: "static/js/",
            APP: '<?php echo \think\Request::instance()->module(); ?>'/*当前应用名*/
        };
    </script>
    <script src="/themes/admin/public/assets/js/jquery-1.10.2.min.js"></script>
    <script src="/static/js/wind.js"></script>
    <script src="/themes/admin/public/assets/js/bootstrap.min.js"></script>
    <script>
        Wind.css('artDialog');
        Wind.css('layer');
        $(function () {
            $("[data-toggle='tooltip']").tooltip({
                container:'body',
                html:true,
            });
            $("li.dropdown").hover(function () {
                $(this).addClass("open");
            }, function () {
                $(this).removeClass("open");
            });
        });
    </script>
    <?php if(APP_DEBUG): ?>
        <style>
            #think_page_trace_open {
                z-index: 9999;
            }
        </style>
    <?php endif; ?>
</head>
<body>
<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li class="active"><a href="<?php echo url('AdminCategory/index'); ?>">分类管理</a></li>
        <li><a href="<?php echo url('AdminCategory/add'); ?>">添加分类</a></li>
    </ul>
    <form class="well form-inline margin-top-20" method="post" action="<?php echo url('AdminCategory/index'); ?>">
        分类名称:
        <input type="text" class="form-control" name="keyword" style="width: 200px;"
               value="<?php echo (isset($keyword) && ($keyword !== '')?$keyword:''); ?>" placeholder="请输入分类名称">
        <input type="submit" class="btn btn-primary" value="搜索"/>
        <a class="btn btn-danger" href="<?php echo url('AdminCategory/index'); ?>">清空</a>
    </form>

    <form method="post" class="js-ajax-form" action="<?php echo url('AdminCategory/listOrder'); ?>">
        <div class="table-actions">
            <button type="submit" class="btn btn-primary btn-sm js-ajax-submit"><?php echo lang('SORT'); ?></button>
        </div>
        <?php if(empty($keyword) || (($keyword instanceof \think\Collection || $keyword instanceof \think\Paginator ) && $keyword->isEmpty())): ?>
            <table class="table table-hover table-bordered table-list" id="menus-table">
                <thead>
                <tr>
                    <th width="16" style="padding-left:20px;"><label><input type="checkbox" class="js-check-all"
                                                                            data-direction="x"
                                                                            data-checklist="js-check-x"></label></th>
                    <th width="50">排序</th>
                    <th width="50">ID</th>
                    <th>分类名称</th>
                    <th>描述</th>
                    <th>状态</th>
                    <th width="200">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php echo $category_tree; ?>
                </tbody>
                <tfoot>
                <tr>
                    <th width="16" style="padding-left:20px;"><label><input type="checkbox" class="js-check-all"
                                                                            data-direction="x"
                                                                            data-checklist="js-check-x"></label></th>
                    <th width="50">排序</th>
                    <th width="50">ID</th>
                    <th>分类名称</th>
                    <th>描述</th>
                    <th>状态</th>
                    <th width="200">操作</th>
                </tr>
                </tfoot>
            </table>
            <?php else: ?>
            <table class="table table-hover table-bordered table-list">
                <thead>
                <tr>
                    <th width="16"><label><input type="checkbox" class="js-check-all"
                                                 data-direction="x"
                                                 data-checklist="js-check-x"></label></th>
                    <th width="50">排序</th>
                    <th width="50">ID</th>
                    <th>分类名称</th>
                    <th>描述</th>
                    <th>状态</th>
                    <th width="200">操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if(is_array($categories) || $categories instanceof \think\Collection || $categories instanceof \think\Paginator): if( count($categories)==0 ) : echo "" ;else: foreach($categories as $key=>$vo): ?>
                    <tr>
                        <td><input
                                type="checkbox" class="js-check" data-yid="js-check-y" data-xid="js-check-x"
                                name="ids[]" value="<?php echo $vo['id']; ?>"></td>
                        <td><input name="list_orders[<?php echo $vo['id']; ?>]" type="text" size="3" value="<?php echo $vo['list_order']; ?>"
                                   class="input-order"></td>
                        <td><?php echo $vo['id']; ?></td>
                        <td><a href="{cmf_url('portal/List/index', ['id' => $vo['id']])}" target="_blank"><?php echo $vo['name']; ?></a>
                        </td>
                        <td><?php echo $vo['description']; ?></td>
                        <td><?php echo !empty($vo['status'])?'显示':'隐藏'; ?></td>
                        <td>
                            <a href="<?php echo url('AdminCategory/add', ['parent' => $vo['id']]); ?>">添加子分类</a>
                            <a href="<?php echo url('AdminCategory/edit',['id'=>$vo['id']]); ?>">编辑</a>
                            <a class="js-ajax-delete" href="<?php echo url('AdminCategory/delete',['id'=>$vo['id']]); ?>">删除</a>
                        </td>
                    </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
                <tfoot>
                <tr>
                    <th width="16"><label><input type="checkbox" class="js-check-all"
                                                 data-direction="x"
                                                 data-checklist="js-check-x"></label></th>
                    <th width="50">排序</th>
                    <th width="50">ID</th>
                    <th>分类名称</th>
                    <th>描述</th>
                    <th>状态</th>
                    <th width="200">操作</th>
                </tr>
                </tfoot>
            </table>
        <?php endif; ?>
    </form>
</div>
<script src="/static/js/admin.js"></script>
<script>
    $(document).ready(function () {
        Wind.css('treeTable');
        Wind.use('treeTable', function () {
            $("#menus-table").treeTable({
                indent: 20,
                initialState: 'expanded'
            });
        });
    });

    // $(' #menus-table .js-check').change(function () {
    //     console.log('change');
    //     checkNode(this);
    // });
    //
    // function checkNode(obj) {
    //     var $obj   = $(obj);
    //     var $table = $obj.parents('table');
    //
    //     var id       = $obj.data('id');
    //     var parentId = $obj.data('parent_id');
    //
    //     function checkParent(id, parentId, checked) {
    //         console.log('checkParent:' + id);
    //         var $parent = $("tr [data-id='" + parentId + "']", $table);
    //         if ($parent.length > 0) {
    //             $parent.prop("checked", checked);
    //             checkParent($parent.data('id'), $parent.data('parent_id'), checked);
    //         }
    //     }
    //
    //     function checkChild(id, parentId, checked) {
    //         console.log('checkChild:' + id);
    //         var $child = $("tr [data-parent_id='" + id + "']", $table);
    //
    //         if ($child.length > 0) {
    //             $child.prop("checked", checked);
    //             checkChild($child.data('id'), $child.data('parent_id'), checked);
    //         }
    //     }
    //
    //     if ($obj.is(':checked')) {
    //         checkParent(id, parentId, true);
    //         checkChild(id, parentId, true);
    //     } else {
    //         checkParent(id, parentId, false);
    //         checkChild(id, parentId, false);
    //     }
    //     return;
    //     var chk   = $("input[type='checkbox']");
    //     var count = chk.length;
    //
    //     var num       = chk.index(obj);
    //     var level_top = level_bottom = chk.eq(num).attr('level');
    //     for (var i = num; i >= 0; i--) {
    //         var le = chk.eq(i).attr('level');
    //         if (le < level_top) {
    //             chk.eq(i).prop("checked", true);
    //             var level_top = level_top - 1;
    //         }
    //     }
    //     for (var j = num + 1; j < count; j++) {
    //         var le = chk.eq(j).attr('level');
    //         if (chk.eq(num).prop("checked")) {
    //
    //             if (le > level_bottom) {
    //                 chk.eq(j).prop("checked", true);
    //             }
    //             else if (le == level_bottom) {
    //                 break;
    //             }
    //         } else {
    //             if (le > level_bottom) {
    //                 chk.eq(j).prop("checked", false);
    //             } else if (le == level_bottom) {
    //                 break;
    //             }
    //         }
    //     }
    // }
</script>
</body>
</html>