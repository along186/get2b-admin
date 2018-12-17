<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:43:"themes/admin/portal/admin_category/add.html";i:1542301488;s:76:"/Users/liufeilong/php/workspace/Get2b/public/themes/admin/public/header.html";i:1541948631;}*/ ?>
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
<link rel="stylesheet" href="/themes/admin/public/assets/css/jquery.tag-editor.css">
<body>
<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li><a href="<?php echo url('AdminCategory/index'); ?>">分类管理</a></li>
        <li class="active"><a href="<?php echo url('AdminCategory/add'); ?>">添加分类</a></li>
    </ul>
    <div class="row margin-top-20">
        <div class="col-md-2">
            <div class="list-group">
                <a class="list-group-item" href="#A" data-toggle="tab">基本属性</a>
                <a class="list-group-item" href="#C" data-toggle="tab">功能设置</a>
            </div>
        </div>
        <div class="col-md-6">
            <form class="js-ajax-form" action="<?php echo url('AdminCategory/addPost'); ?>" method="post">
                <div class="tab-content">
                    <div class="tab-pane active" id="A">
                        <div class="form-group">
                            <label for="input-parent"><span class="form-required">*</span>上级</label>
                            <div>
                                <select class="form-control" name="parent_id" id="input-parent">
                                    <option value="0">作为一级分类</option>
                                    <?php echo $categories_tree; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-name"><span class="form-required">*</span>分类名称</label>
                            <div>
                                <input type="text" class="form-control" id="input-name" name="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-description">描述</label>
                            <div>
                                <textarea class="form-control" name="description" id="input-description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-name"><span class="form-required">*</span>关键字(英文逗号分隔)</label>
                            <div>
                                <input type="text" class="form-control" id="input-name" name="keywords">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="input-description">缩略图</label>
                            <div>
                                <input type="hidden" name="more[thumbnail]" class="form-control"
                                       id="js-thumbnail-input">
                                <div>
                                    <a href="javascript:uploadOneImage('图片上传','#js-thumbnail-input');">
                                        <img src="/themes/admin/public/assets/images/default-thumbnail.png"
                                             id="js-thumbnail-input-preview"
                                             width="135" style="cursor: pointer"/>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="C">
                        <div class="form-group">
                            <!--<label for="input-list_tpl"><span class="form-required">*</span>功能列表</label>-->
                            <!--<textarea name="functions" id="hero-demo"></textarea>-->
                            <table id="table" border="1" class="table table-bordered" >
                                <tr>
                                    <th>功能名称</th>
                                    <th>功能描述</th>
                                    <th>操作</th>
                                </tr>
                                <tr>
                                    <td><input type="Text" id="txt"  class="form-control" name="function_name[]" /></td>
                                    <td><input type="Text" id="pwd" class="form-control" name="function_desc[]" /></td>
                                    <td></td>
                                </tr>
                            </table>
                            <input type="button" value="添加行" onclick="addRow();" />
                        </div>

                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('ADD'); ?></button>
                    <a class="btn btn-default" href="<?php echo url('AdminCategory/index'); ?>"><?php echo lang('BACK'); ?></a>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" src="/static/js/admin.js"></script>
<!--<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>-->
<!--<script src="http://www.jq22.com/jquery/jquery-ui-1.10.2.js"></script>-->
<!--<script src="/static/js/jquery.tag-editor.js"></script>-->
<script>
    (function($){var proto=$.ui.autocomplete.prototype,initSource=proto._initSource;function filter(array,term){var matcher=new RegExp($.ui.autocomplete.escapeRegex(term),"i");return $.grep(array,function(value){return matcher.test($("<div>").html(value.label||value.value||value).text());});}$.extend(proto,{_initSource:function(){if(this.options.html&&$.isArray(this.options.source)){this.source=function(request,response){response(filter(this.options.source,request.term));};}else{initSource.call(this);}},_renderItem:function(ul,item){return $("<li></li>").data("item.autocomplete",item).append($("<a></a>")[this.options.html?"html":"text"](item.label)).appendTo(ul);}});})(jQuery);
    var cache = {};
    function googleSuggest(request, response) {

    }
    $(function() {

        $('#hero-demo').tagEditor({

            placeholder: 'Enter function ...',

            autocomplete: { source: googleSuggest, minLength: 3, delay: 250, html: true, position: { collision: 'flip' } }

        });

        function tag_classes(field, editor, tags) {

            $('li', editor).each(function(){

                var li = $(this);

                if (li.find('.tag-editor-tag').html() == 'red') li.addClass('red-tag');

                else if (li.find('.tag-editor-tag').html() == 'green') li.addClass('green-tag')

                else li.removeClass('red-tag green-tag');

            });
        }

    });
</script>

<script type="text/javascript">

    $(document).ready(function () {
        $("#table").DataTable()
    });
    var i = 0;
    //添加行
    function addRow() {
        i++;
        var rowTem = '<tr class="tr_' + i + '">'
            + '<td><input type="Text" id="txt' + i + '"  class="form-control" name="function_name[]" /></td>'
            + '<td><input type="Text" id="pwd' + i + '" class="form-control" name="function_desc[]" /></td>'
            + '<td><a href="#" onclick=delRow('+i+') >删除</a></td>'
            + '</tr>';
        //var tableHtml = $("#table tbody").html();
        // tableHtml += rowTem;
        $("#table tbody:last").append(rowTem);
        //  $("#table tbody").html(tableHtml);

    }
    //删除行
    function delRow(_id) {
        $("#table .tr_"+_id).hide();
        i--;
    }
    //进行测试
    function ceshi() {
        var str1 = '';
        for( var j=1;j<=i;j++){
            var str = $("#" + "txt" + j).val();
            str1 += str;
        }
        alert(str1);
    }
</script>
</body>
</html>