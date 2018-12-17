<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:42:"themes/admin/portal/admin_article/add.html";i:1542352843;s:82:"/Users/liufeilong/php/workspace/get2b/admin/public/themes/admin/public/header.html";i:1541948631;}*/ ?>
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
<style type="text/css">
    .pic-list li {
        margin-bottom: 5px;
    }
</style>
<script type="text/html" id="photos-item-tpl">
    <li id="saved-image{id}">
        <input id="photo-{id}" type="hidden" name="photo_urls[]" value="{filepath}">
        <input class="form-control" id="photo-{id}-name" type="text" name="photo_names[]" value="{name}"
               style="width: 200px;" title="图片名称">
        <img id="photo-{id}-preview" src="{url}" style="height:36px;width: 36px;"
             onclick="imagePreviewDialog(this.src);">
        <a href="javascript:uploadOneImage('图片上传','#photo-{id}');">替换</a>
        <a href="javascript:(function(){$('#saved-image{id}').remove();})();">移除</a>
    </li>
</script>
<script type="text/html" id="files-item-tpl">
    <li id="saved-file{id}">
        <input id="file-{id}" type="hidden" name="file_urls[]" value="{filepath}">
        <input class="form-control" id="file-{id}-name" type="text" name="file_names[]" value="{name}"
               style="width: 200px;" title="文件名称">
        <a id="file-{id}-preview" href="{preview_url}" target="_blank">下载</a>
        <a href="javascript:uploadOne('文件上传','#file-{id}','file');">替换</a>
        <a href="javascript:(function(){$('#saved-file{id}').remove();})();">移除</a>
    </li>
</script>
<link rel="stylesheet" href="/themes/admin/public/assets/css/jquery.tag-editor.css">
</head>
<body>
<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li><a href="<?php echo url('AdminArticle/index'); ?>">所用应用</a></li>
        <li class="active"><a href="<?php echo url('AdminArticle/add'); ?>">添加应用</a></li>
    </ul>
    <form action="<?php echo url('AdminArticle/addPost'); ?>" method="post" class="form-horizontal js-ajax-form margin-top-20">
        <div class="row">
            <div class="col-md-9">
                <table class="table table-bordered">
                    <tr>
                        <th width="100">应用分类<span class="form-required">*</span></th>
                        <td>
                            <input class="form-control" type="text" style="width:400px;" required value=""
                                   placeholder="请选择分类" onclick="doSelectCategory();" id="js-categories-name-input"
                                   readonly/>
                            <input class="form-control" type="hidden" value="" name="post[categories]"
                                   id="js-categories-id-input"/>
                        </td>
                    </tr>
                    <tr>
                        <th>功能列表<span class="form-required">*</span></th>
                        <td>
                            <input class="form-control" type="text" style="width:400px;" required value=""
                                   placeholder="请选择功能" onclick="doSelectFunction();" id="js-functions-name-input"
                                   readonly/>
                            <input class="form-control" type="hidden" value="" name="post[functions]"
                                   id="js-functions-id-input"/>
                        </td>
                    </tr>
                    <tr>
                        <th>应用名称<span class="form-required">*</span></th>
                        <td>
                            <input class="form-control" type="text" name="post[post_title]"
                                   id="title" required value="" placeholder="请输入应用名称"/>
                        </td>
                    </tr>
                    <tr>
                        <th>应用官网</th>
                        <td>
                            <input class="form-control" type="text" name="post[web_site]"
                                   id="webSite" required value="" placeholder="请输入应用官网"/>
                        </td>
                    </tr>
                    <tr>
                        <th>开发商介绍</th>
                        <td>
                            <textarea class="form-control" name="post[post_excerpt]" style="height: 50px;"
                                      placeholder="请填写开发商介绍"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>关键词</th>
                        <td>
                            <input class="form-control" type="text" name="post[post_keywords]" id="keywords" value=""
                                   placeholder="请输入关键字">
                            <p class="help-block">多关键词之间用英文逗号隔开</p>
                        </td>
                    </tr>
                    <tr>
                        <th>应用介绍</th>
                        <td>
                            <script type="text/plain" id="content" name="post[post_content]"></script>
                        </td>
                    </tr>
                    <tr>
                        <th>定价详情</th>
                        <td>
                            <table>
                                <tr>
                                    <td>最低价格：</td>
                                    <td><input class="form-control" type="text" name="post[floor_price]"  id="floorPrice" required value="" placeholder="请输入最低价格"/></td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;收费周期：</td>
                                    <td><select class="form-control" name="post[fee_cycle]" id="feeCycle">
                                        <option value="1">一次性</option>
                                        <option value="2">每月</option>
                                        <option value="3">每年</option>
                                    </select>
                                    </td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;收费标准：</td>
                                    <td><select class="form-control" name="post[fee_standard]" id="feeStandard">
                                        <option value="1">用户</option>
                                        <option value="2">序列号</option>
                                    </select>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th>免费试用/DEMO</th>
                        <td>
                            <select class="form-control" name="post[free_trial]" id="freeTrial" style="width:200px;overflow:auto;">
                                <option value="1">是</option>
                                <option value="0">否</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>支持平台</th>
                        <td>
                            <input type="checkbox" name="post[support_platform][]" value="1"  /> 网页版
                            <input type="checkbox" name="post[support_platform][]" value="2"  /> Windows
                            <input type="checkbox" name="post[support_platform][]" value="3"  /> MacOS
                            <input type="checkbox" name="post[support_platform][]" value="4"  /> iOS
                            <input type="checkbox" name="post[support_platform][]" value="5"  /> Android
                        </td>
                    </tr>
                    <tr>
                        <th>培训方式</th>
                        <td>
                            <input type="checkbox" name="post[training_mode][]" value="1"  /> 专人到场
                            <input type="checkbox" name="post[training_mode][]" value="2"  /> 视频培训
                            <input type="checkbox" name="post[training_mode][]" value="3"  /> 在线培训
                            <input type="checkbox" name="post[training_mode][]" value="4"  /> 培训文档
                            <input type="checkbox" name="post[training_mode][]" value="99"  /> 不提供
                        </td>
                    </tr>
                    <tr>
                        <th>技术支持</th>
                        <td>
                            <input type="checkbox" name="post[technical_support][]" value="1"  /> 随时
                            <input type="checkbox" name="post[technical_support][]" value="2"  /> 工作时间
                            <input type="checkbox" name="post[technical_support][]" value="3"  /> 线上技术支持
                            <input type="checkbox" name="post[technical_support][]" value="99"  /> 不提供
                        </td>
                    </tr>
                    <tr>
                        <th>应用截图</th>
                        <td>
                            <ul id="photos" class="pic-list list-unstyled form-inline"></ul>
                            <a href="javascript:uploadMultiImage('图片上传','#photos','photos-item-tpl');"
                               class="btn btn-default btn-sm">选择图片</a>
                        </td>
                    </tr>
                    <tr>
                        <th>附件</th>
                        <td>
                            <ul id="files" class="pic-list list-unstyled form-inline">
                            </ul>
                            <a href="javascript:uploadMultiFile('附件上传','#files','files-item-tpl','file');"
                               class="btn btn-sm btn-default">选择文件</a>
                        </td>
                    </tr>
                    <tr>
                        <th>教学视频</th>
                        <td class="form-inline">
                            <input id="file-video" class="form-control" type="text" name="post[more][video]"
                                   value="<?php echo (isset($post['more']['video']) && ($post['more']['video'] !== '')?$post['more']['video']:''); ?>" placeholder="请上传视频文件" style="width: 200px;">
                            <?php if(!(empty($post['more']['video']) || (($post['more']['video'] instanceof \think\Collection || $post['more']['video'] instanceof \think\Paginator ) && $post['more']['video']->isEmpty()))): ?>
                                <a id="file-video-preview" href="<?php echo cmf_get_file_download_url($post['more']['video']); ?>"
                                   target="_blank">下载</a>
                            <?php endif; ?>
                            <a href="javascript:uploadOne('文件上传','#file-video','video');">上传</a>
                        </td>
                    </tr>
                </table>
                <?php 
    \think\Hook::listen('portal_admin_article_edit_view_main',$temp5c171d35abc99,null,false);
 ?>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('ADD'); ?></button>
                        <a class="btn btn-default" href="<?php echo url('AdminArticle/index'); ?>"><?php echo lang('BACK'); ?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <table class="table table-bordered">
                    <tr>
                        <th><b>ICON</b></th>
                    </tr>
                    <tr>
                        <td>
                            <div style="text-align: center;">
                                <input type="hidden" name="post[more][thumbnail]" id="thumbnail" value="">
                                <a href="javascript:uploadOneImage('图片上传','#thumbnail');">
                                    <img src="/themes/admin/public/assets/images/default-thumbnail.png"
                                         id="thumbnail-preview"
                                         width="135" style="cursor: pointer"/>
                                </a>
                                <input type="button" class="btn btn-sm btn-cancel-thumbnail" value="取消图片">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th><b>发布时间</b></th>
                    </tr>
                    <tr>
                        <td>
                            <input class="form-control js-bootstrap-datetime" type="text" name="post[published_time]"
                                   value="<?php echo date('Y-m-d H:i:s',time()); ?>">
                        </td>
                    </tr>
                </table>

                <?php 
    \think\Hook::listen('portal_admin_article_edit_view_right_sidebar',$temp5c171d35abcb9,null,false);
 ?>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript" src="/static/js/admin.js"></script>
<script type="text/javascript">
    //编辑器路径定义
    var editorURL = GV.WEB_ROOT;
</script>
<script type="text/javascript" src="/static/js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/static/js/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript">
    $(function () {

        editorcontent = new baidu.editor.ui.Editor();
        editorcontent.render('content');
        try {
            editorcontent.sync();
        } catch (err) {
        }

        $('.btn-cancel-thumbnail').click(function () {
            $('#thumbnail-preview').attr('src', '/themes/admin/public/assets/images/default-thumbnail.png');
            $('#thumbnail').val('');
        });

    });

    function doSelectCategory() {
        var selectedCategoriesId = $('#js-categories-id-input').val();
        openIframeLayer("<?php echo url('AdminCategory/select'); ?>?ids=" + selectedCategoriesId, '请选择分类', {
            area: ['700px', '400px'],
            btn: ['确定', '取消'],
            yes: function (index, layero) {
                //do something

                var iframeWin          = window[layero.find('iframe')[0]['name']];
                var selectedCategories = iframeWin.confirm();
                if (selectedCategories.selectedCategoriesId.length == 0) {
                    layer.msg('请选择分类');
                    return;
                }
                $('#js-categories-id-input').val(selectedCategories.selectedCategoriesId.join(','));
                $('#js-categories-name-input').val(selectedCategories.selectedCategoriesName.join(' '));
                //console.log(layer.getFrameIndex(index));
                layer.close(index); //如果设定了yes回调，需进行手工关闭
            }
        });
    }
    function doSelectFunction() {
        var selectedCategoriesId = $('#js-categories-id-input').val();
        var selectedFunctionId = $('#js-functions-id-input').val();
        openIframeLayer("<?php echo url('AdminCategory/selectFunction'); ?>?ids=" + selectedCategoriesId + "&functions=" + selectedFunctionId, '请选择功能', {
            area: ['700px', '400px'],
            btn: ['确定', '取消'],
            yes: function (index, layero) {
                //do something

                var iframeWin          = window[layero.find('iframe')[0]['name']];
                var selectedCategories = iframeWin.confirm();
                if (selectedCategories.selectedCategoriesId.length == 0) {
                    layer.msg('请选择功能');
                    return;
                }
                $('#js-functions-id-input').val(selectedCategories.selectedCategoriesId.join(','));
                $('#js-functions-name-input').val(selectedCategories.selectedCategoriesName.join(' '));
                //console.log(layer.getFrameIndex(index));
                layer.close(index); //如果设定了yes回调，需进行手工关闭
            }
        });
    }
</script>
</body>
</html>
