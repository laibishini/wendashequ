<?php
/* Smarty version 3.1.30, created on 2018-07-21 06:45:44
  from "D:\wamp\www\application\admin\view\topic\edit.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b52d698551d62_13108722',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c171bddb0d6bf1e9caed1114ca7e85515a86c358' => 
    array (
      0 => 'D:\\wamp\\www\\application\\admin\\view\\topic\\edit.html',
      1 => 1532099070,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/layout.html' => 1,
  ),
),false)) {
function content_5b52d698551d62_13108722 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_58845b52d69854dee4_69469446', "content");
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:common/layout.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block "content"} */
class Block_58845b52d69854dee4_69469446 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="aw-content-wrap">
        <form method="post" id="settings_form" 
        action="?m=admin&c=topic&a=updateAction"
        enctype="multipart/form-data">
        
        <div class="mod">
            <div class="mod-head">
                <h3>
                    <span class="pull-left">话题编辑</span>
                </h3>
            </div>

            <div class="tab-content mod-content">
                <table class="table table-striped">
                    <tbody><tr>
                        <td>
                            <div class="form-group">
                                <span class="col-sm-4 col-xs-3 control-label">缩略图:</span>
                                <div class="col-sm-5 col-xs-8">
                                	<!--<?php if (isset($_smarty_tpl->tpl_vars['topic']->value['topic_pic'])) {?>-->
                                		<img src="<?php echo THUMB_PATH;
echo $_smarty_tpl->tpl_vars['topic']->value['topic_pic'];?>
" 
                                		style="max-width:50px;max-height:50px">
                                		<font color="red">您已上传，再次上传会覆盖</font>
                                		<input type="file" name="topic_pic">
                                	<!--<?php } else { ?>-->
                                		<input type="file" name="topic_pic">
                                	<!--<?php }?>-->
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-group">
                                <span class="col-sm-4 col-xs-3 control-label">话题标题:</span>
                                <div class="col-sm-5 col-xs-8">
                                    <input type="text" value="<?php echo $_smarty_tpl->tpl_vars['topic']->value['topic_title'];?>
" class="form-control" name="topic_title">
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="form-group">
                                <span class="col-sm-4 col-xs-3 control-label">话题描述:</span>
                                <div class="col-sm-5 col-xs-8">
                                    <textarea name="topic_desc" class="form-control"><?php echo $_smarty_tpl->tpl_vars['topic']->value['topic_desc'];?>
</textarea>
                                </div>
                            </div>
                        </td>
                    </tr>

                    </tbody><tfoot>
                    <tr>
                        <td>
                        	<input type="hidden" name="topic_id" value="<?php echo $_smarty_tpl->tpl_vars['topic']->value['topic_id'];?>
">
                        	<input type="hidden" name="old_topic_pic" value="<?php echo $_smarty_tpl->tpl_vars['topic']->value['topic_pic'];?>
">
                            <input type="submit" class="btn btn-primary center-block" value="保存设置">
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        </form>
    </div>

<?php
}
}
/* {/block "content"} */
}
