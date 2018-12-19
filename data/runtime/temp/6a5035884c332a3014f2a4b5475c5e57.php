<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:43:"themes/admin/portal/admin_article/edit.html";i:1545128818;s:82:"/Users/liufeilong/php/workspace/get2b/admin/public/themes/admin/public/header.html";i:1541948631;}*/ ?>
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
</head>
<body>
<div class="wrap js-check-wrap">
    <ul class="nav nav-tabs">
        <li><a href="<?php echo url('AdminArticle/index'); ?>">文章管理</a></li>
        <li>
            <a href="<?php echo url('AdminArticle/add'); ?>">添加文章</a>
        </li>
        <li class="active"><a href="#">编辑文章</a></li>
    </ul>
    <form action="<?php echo url('AdminArticle/editPost'); ?>" method="post" class="form-horizontal js-ajax-form margin-top-20">
        <div class="row">
            <div class="col-md-9">
                <table class="table table-bordered">
                    <tr>
                        <th width="100">所属分类<span class="form-required">*</span></th>
                        <td>
                            <input class="form-control" type="text" style="width:400px;" required
                                   value="<?php echo implode(' ',$post_categories); ?>"
                                   placeholder="请选择分类" onclick="doSelectCategory();" id="js-categories-name-input"
                                   readonly/>
                            <input class="form-control" type="hidden" value="<?php echo $post_category_ids; ?>"
                                   name="post[categories]"
                                   id="js-categories-id-input"/>
                        </td>
                    </tr>
                    <tr>
                        <th>功能列表<span class="form-required">*</span></th>
                        <td>
                            <input class="form-control" type="text" style="width:400px;" required value="<?php echo $functionName; ?>"
                                   placeholder="请选择功能" onclick="doSelectFunction();" id="js-functions-name-input"
                                   readonly/>
                            <input class="form-control" type="hidden" value="<?php echo $post['functions']; ?>" name="post[functions]"
                                   id="js-functions-id-input"/>
                        </td>
                    </tr>
                    <tr>
                        <th>应用名称<span class="form-required">*</span></th>
                        <td>
                            <input id="post-id" type="hidden" name="post[id]" value="<?php echo $post['id']; ?>">
                            <input class="form-control" type="text" name="post[post_title]"
                                   required value="<?php echo $post['post_title']; ?>" placeholder="请输入标题"/>
                        </td>
                    </tr>
                    <tr>
                        <th>应用官网</th>
                        <td>
                            <input class="form-control" type="text" name="post[web_site]"
                                   id="webSite" value="<?php echo $post['web_site']; ?>" placeholder="请输入应用官网"/>
                        </td>
                    </tr>
                    <tr>
                        <th>开发商名称</th>
                        <td>
                            <input class="form-control" type="text" name="post[post_developer]"
                                   id="developer" required value="<?php echo $post['post_developer']; ?>" placeholder="请输入开发商名称"/>
                        </td>
                    </tr>
                    <tr>
                        <th>开发商介绍</th>
                        <td>
                            <textarea class="form-control" name="post[post_developer_introduction]" style="height: 50px;"
                                      placeholder="请填写开发商介绍"><?php echo $post['post_developer_introduction']; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>应用简介</th>
                        <td>
                            <textarea class="form-control" name="post[post_excerpt]" style="height: 50px;"
                                      placeholder="请填写应用简介"><?php echo $post['post_excerpt']; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>关键词</th>
                        <td>
                            <input class="form-control" type="text" name="post[post_keywords]"
                                   value="<?php echo $post['post_keywords']; ?>" placeholder="请输入关键字">
                            <p class="help-block">多关键词之间用英文逗号隔开</p>
                        </td>
                    </tr>
                    <tr>
                        <th>应用介绍</th>
                        <td>
                            <script type="text/plain" id="content" name="post[post_content]"><?php echo $post['post_content']; ?></script>
                        </td>
                    </tr>
                    <tr>
                        <th>定价详情</th>
                        <td>
                            <table>
                                <tr>
                                    <td>最低价格：</td>
                                    <td><input class="form-control" type="text" name="post[floor_price]"  id="floorPrice" value="<?php echo $post['floor_price']; ?>" placeholder="请输入最低价格"/></td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;收费周期：</td>
                                    <td><select class="form-control" name="post[fee_cycle]" id="feeCycle">
                                        <option value="1" <?php  echo ($post['fee_cycle'] == 1) ? 'selected': ''; ?>>一次性</option>
                                        <option value="2" <?php  echo ($post['fee_cycle'] == 2) ? 'selected': ''; ?>>每月</option>
                                        <option value="3" <?php  echo ($post['fee_cycle'] == 3) ? 'selected': ''; ?>>每年</option>
                                    </select>
                                    </td>
                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;收费标准：</td>
                                    <td><select class="form-control" name="post[fee_standard]" id="feeStandard">
                                        <option value="1" <?php  echo ($post['fee_standard'] == 1) ? 'selected': ''; ?>>用户</option>
                                        <option value="2" <?php  echo ($post['fee_standard'] == 2) ? 'selected': ''; ?>>序列号</option>
                                    </select>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th>免费试用/DEMO</th>
                        <td width="100">
                            <select class="form-control" name="post[free_trial]" id="freeTrial" style="width:200px;overflow:auto;" >
                                <option value="1" <?php  echo ($post['free_trial'] == 1) ? 'selected': ''; ?>>是</option>
                                <option value="0" <?php  echo ($post['free_trial'] == 0) ? 'selected': ''; ?>>否</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>支持平台</th>
                        <td>
                            <input type="checkbox" name="post[support_platform][]" value="1" <?php  echo in_array(1,$supportPlatform) ? 'checked': ''; ?> /> 网页版
                            <input type="checkbox" name="post[support_platform][]" value="2" <?php  echo in_array(2,$supportPlatform) ? 'checked': ''; ?> /> Windows
                            <input type="checkbox" name="post[support_platform][]" value="3" <?php  echo in_array(3,$supportPlatform)? 'checked': ''; ?> /> MacOS
                            <input type="checkbox" name="post[support_platform][]" value="4" <?php  echo in_array(4,$supportPlatform) ? 'checked': ''; ?> /> iOS
                            <input type="checkbox" name="post[support_platform][]" value="5" <?php  echo in_array(5,$supportPlatform) ? 'checked': ''; ?> /> Android
                        </td>
                    </tr>
                    <tr>
                        <th>培训方式</th>
                        <td>
                            <input type="checkbox" name="post[training_mode][]" value="1" <?php  echo in_array(1,$trainingMode) ? 'checked': ''; ?> /> 专人到场
                            <input type="checkbox" name="post[training_mode][]" value="2" <?php  echo in_array(2,$trainingMode) ? 'checked': ''; ?> /> 视频培训
                            <input type="checkbox" name="post[training_mode][]" value="3" <?php  echo in_array(3,$trainingMode) ? 'checked': ''; ?> /> 在线培训
                            <input type="checkbox" name="post[training_mode][]" value="4" <?php  echo in_array(4,$trainingMode) ? 'checked': ''; ?> /> 培训文档
                            <input type="checkbox" name="post[training_mode][]" value="99" <?php  echo in_array(99,$trainingMode) ? 'checked': ''; ?> /> 不提供
                        </td>
                    </tr>
                    <tr>
                        <th>技术支持</th>
                        <td>
                            <input type="checkbox" name="post[technical_support][]" value="1" <?php  echo in_array(1,$technicalSupport) ? 'checked': ''; ?> /> 随时
                            <input type="checkbox" name="post[technical_support][]" value="2" <?php  echo in_array(2,$technicalSupport) ? 'checked': ''; ?> /> 工作时间
                            <input type="checkbox" name="post[technical_support][]" value="3" <?php  echo in_array(3,$technicalSupport) ? 'checked': ''; ?> /> 线上技术支持
                            <input type="checkbox" name="post[technical_support][]" value="99" <?php  echo in_array(99,$technicalSupport) ? 'checked': ''; ?> /> 不提供
                        </td>
                    </tr>
                    <tr>
                        <th>应用截图</th>
                        <td>
                            <ul id="photos" class="pic-list list-unstyled form-inline">
                                <?php if(!(empty($post['more']['photos']) || (($post['more']['photos'] instanceof \think\Collection || $post['more']['photos'] instanceof \think\Paginator ) && $post['more']['photos']->isEmpty()))): if(is_array($post['more']['photos']) || $post['more']['photos'] instanceof \think\Collection || $post['more']['photos'] instanceof \think\Paginator): if( count($post['more']['photos'])==0 ) : echo "" ;else: foreach($post['more']['photos'] as $key=>$vo): $img_url=cmf_get_image_preview_url($vo['url']); ?>
                                        <li id="saved-image<?php echo $key; ?>">
                                            <input id="photo-<?php echo $key; ?>" type="hidden" name="photo_urls[]"
                                                   value="<?php echo $vo['url']; ?>">
                                            <input class="form-control" id="photo-<?php echo $key; ?>-name" type="text"
                                                   name="photo_names[]"
                                                   value="<?php echo (isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''); ?>" style="width: 200px;" title="图片名称">
                                            <img id="photo-<?php echo $key; ?>-preview"
                                                 src="<?php echo cmf_get_image_preview_url($vo['url']); ?>"
                                                 style="height:36px;width: 36px;"
                                                 onclick="parent.imagePreviewDialog(this.src);">
                                            <a href="javascript:uploadOneImage('图片上传','#photo-<?php echo $key; ?>');">替换</a>
                                            <a href="javascript:(function(){$('#saved-image<?php echo $key; ?>').remove();})();">移除</a>
                                        </li>
                                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                            </ul>
                            <a href="javascript:uploadMultiImage('图片上传','#photos','photos-item-tpl');"
                               class="btn btn-sm btn-default">选择图片</a>
                        </td>
                    </tr>
                    <tr>
                        <th>附件</th>
                        <td>
                            <ul id="files" class="pic-list list-unstyled form-inline">
                                <?php if(!(empty($post['more']['files']) || (($post['more']['files'] instanceof \think\Collection || $post['more']['files'] instanceof \think\Paginator ) && $post['more']['files']->isEmpty()))): if(is_array($post['more']['files']) || $post['more']['files'] instanceof \think\Collection || $post['more']['files'] instanceof \think\Paginator): if( count($post['more']['files'])==0 ) : echo "" ;else: foreach($post['more']['files'] as $key=>$vo): $file_url=cmf_get_file_download_url($vo['url']); ?>
                                        <li id="saved-file<?php echo $key; ?>">
                                            <input id="file-<?php echo $key; ?>" type="hidden" name="file_urls[]"
                                                   value="<?php echo $vo['url']; ?>">
                                            <input class="form-control" id="file-<?php echo $key; ?>-name" type="text"
                                                   name="file_names[]"
                                                   value="<?php echo $vo['name']; ?>" style="width: 200px;" title="图片名称">
                                            <a id="file-<?php echo $key; ?>-preview" href="<?php echo $file_url; ?>" target="_blank">下载</a>
                                            <a href="javascript:uploadOne('文件上传','#file-<?php echo $key; ?>','file');">替换</a>
                                            <a href="javascript:(function(){$('#saved-file<?php echo $key; ?>').remove();})();">移除</a>
                                        </li>
                                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
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
    \think\Hook::listen('portal_admin_article_edit_view_main',$temp5c1a184647772,null,false);
 ?>
            </div>
            <div class="col-md-3">
                <table class="table table-bordered">
                    <tr>
                        <th>ICON</th>
                    </tr>
                    <tr>
                        <td>
                            <div style="text-align: center;">
                                <input type="hidden" name="post[more][thumbnail]" id="thumbnail"
                                       value="<?php echo (isset($post['more']['thumbnail']) && ($post['more']['thumbnail'] !== '')?$post['more']['thumbnail']:''); ?>">
                                <a href="javascript:uploadOneImage('图片上传','#thumbnail');">
                                    <?php if(empty($post['more']['thumbnail'])): ?>
                                        <img src="/themes/admin/public/assets/images/default-thumbnail.png"
                                             id="thumbnail-preview"
                                             width="135" style="cursor: pointer"/>
                                        <?php else: ?>
                                        <img src="<?php echo cmf_get_image_preview_url($post['more']['thumbnail']); ?>"
                                             id="thumbnail-preview"
                                             width="135" style="cursor: pointer"/>
                                    <?php endif; ?>
                                </a>
                                <input type="button" class="btn btn-sm btn-cancel-thumbnail" value="取消图片">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>发布时间</th>
                    </tr>
                    <tr>
                        <td>
                            <input class="form-control js-bootstrap-datetime" type="text" name="post[published_time]"
                                   value="<?php echo date('Y-m-d H:i',$post['published_time']); ?>">
                        </td>
                    </tr>
                    <!--
                    <tr>
                        <th>评论</th>
                    </tr>
                    <tr>
                        <td>
                            <label style="width: 88px"><a
                                    href="javascript:openIframeDialog('<?php echo url('comment/commentadmin/index',array('post_id'=>$post['id'])); ?>','评论列表')">查看评论</a></label>
                        </td>
                    </tr>
                    -->
                    <tr>
                        <th>状态</th>
                        <?php 
                            $status_yes=$post['post_status']==1?"checked":"";
                            $is_top_yes=$post['is_top']==1?"checked":"";
                            $recommended_yes=$post['recommended']==1?"checked":"";
                         ?>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="post-status-checkbox" name="post[post_status]" value="1"
                                           <?php echo $status_yes; ?>>发布
                                    <span id="post-status-error" style="color: red;display: none"></span>
                                </label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label><input type="checkbox" id="is-top-checkbox" name="post[is_top]" value="1"
                                              <?php echo $is_top_yes; ?>>置顶</label>
                                <span id="is-top-error" style="color: red;display: none"></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" id="recommended-checkbox" name="post[recommended]" value="1"
                                           <?php echo $recommended_yes; ?>>推荐
                                    <span id="recommended-error" style="color: red;display: none"></span>
                                </label>
                            </div>
                        </td>
                    </tr>
                </table>

                <?php 
    \think\Hook::listen('portal_admin_article_edit_view_right_sidebar',$temp5c1a18464778d,null,false);
 ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary js-ajax-submit"><?php echo lang('SAVE'); ?></button>
                <a class="btn btn-default" href="javascript:history.back(-1);"><?php echo lang('BACK'); ?></a>
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

        $('#more-template-select').val("<?php echo (isset($post['more']['template']) && ($post['more']['template'] !== '')?$post['more']['template']:''); ?>");
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

<script>

    var publishYesUrl   = "<?php echo url('AdminArticle/publish',array('yes'=>1)); ?>";
    var publishNoUrl    = "<?php echo url('AdminArticle/publish',array('no'=>1)); ?>";
    var topYesUrl       = "<?php echo url('AdminArticle/top',array('yes'=>1)); ?>";
    var topNoUrl        = "<?php echo url('AdminArticle/top',array('no'=>1)); ?>";
    var recommendYesUrl = "<?php echo url('AdminArticle/recommend',array('yes'=>1)); ?>";
    var recommendNoUrl  = "<?php echo url('AdminArticle/recommend',array('no'=>1)); ?>";

    var postId = $('#post-id').val();

    //发布操作
    $("#post-status-checkbox").change(function () {
        if ($('#post-status-checkbox').is(':checked')) {
            //发布
            $.ajax({
                url: publishYesUrl, type: "post", dataType: "json", data: {ids: postId}, success: function (data) {
                    if (data.code != 1) {
                        $('#post-status-checkbox').removeAttr("checked");
                        $('#post-status-error').html(data.msg).show();

                    } else {
                        $('#post-status-error').hide();
                    }
                }
            });
        } else {
            //取消发布
            $.ajax({
                url: publishNoUrl, type: "post", dataType: "json", data: {ids: postId}, success: function (data) {
                    if (data.code != 1) {
                        $('#post-status-checkbox').prop("checked", 'true');
                        $('#post-status-error').html(data.msg).show();
                    } else {
                        $('#post-status-error').hide();
                    }
                }
            });
        }
    });

    //置顶操作
    $("#is-top-checkbox").change(function () {
        if ($('#is-top-checkbox').is(':checked')) {
            //置顶
            $.ajax({
                url: topYesUrl, type: "post", dataType: "json", data: {ids: postId}, success: function (data) {
                    if (data.code != 1) {
                        $('#is-top-checkbox').removeAttr("checked");
                        $('#is-top-error').html(data.msg).show();

                    } else {
                        $('#is-top-error').hide();
                    }
                }
            });
        } else {
            //取消置顶
            $.ajax({
                url: topNoUrl, type: "post", dataType: "json", data: {ids: postId}, success: function (data) {
                    if (data.code != 1) {
                        $('#is-top-checkbox').prop("checked", 'true');
                        $('#is-top-error').html(data.msg).show();
                    } else {
                        $('#is-top-error').hide();
                    }
                }
            });
        }
    });
    //推荐操作
    $("#recommended-checkbox").change(function () {
        if ($('#recommended-checkbox').is(':checked')) {
            //推荐
            $.ajax({
                url: recommendYesUrl, type: "post", dataType: "json", data: {ids: postId}, success: function (data) {
                    if (data.code != 1) {
                        $('#recommended-checkbox').removeAttr("checked");
                        $('#recommended-error').html(data.msg).show();

                    } else {
                        $('#recommended-error').hide();
                    }
                }
            });
        } else {
            //取消推荐
            $.ajax({
                url: recommendNoUrl, type: "post", dataType: "json", data: {ids: postId}, success: function (data) {
                    if (data.code != 1) {
                        $('#recommended-checkbox').prop("checked", 'true');
                        $('#recommended-error').html(data.msg).show();
                    } else {
                        $('#recommended-error').hide();
                    }
                }
            });
        }
    });


</script>


</body>
</html>
