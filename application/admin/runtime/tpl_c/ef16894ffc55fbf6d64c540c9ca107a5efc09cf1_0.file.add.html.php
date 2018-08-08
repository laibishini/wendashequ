<?php
/* Smarty version 3.1.30, created on 2018-07-17 13:13:04
  from "G:\wm\wamp64\www\application\admin\view\category\add.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b4deb60eca2e8_45919357',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ef16894ffc55fbf6d64c540c9ca107a5efc09cf1' => 
    array (
      0 => 'G:\\wm\\wamp64\\www\\application\\admin\\view\\category\\add.html',
      1 => 1531833183,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./common/layout.html' => 1,
  ),
),false)) {
function content_5b4deb60eca2e8_45919357 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_216095b4deb60ec3aa1_27747912', "content");
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:./common/layout.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block "content"} */
class Block_216095b4deb60ec3aa1_27747912 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <div class="aw-content-wrap">
        <form method="post" id="category_form" enctype="multipart/form-data"
        action="?m=admin&c=category&a=addHandleAction">
        <div class="mod">
            <div class="mod-head">
                <h3>
                    <span class="pull-left">添加分类</span>
                </h3>
            </div>
            <div class="tab-content mod-content">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <td>
                            <div class="form-group">
                                <span class="col-sm-4 col-xs-3 control-label">分类标题:</span>
                                <div class="col-sm-5 col-xs-8">
                                    <input type="text" name="cat_name" class="form-control">
                                </div>
                            </div>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <div class="form-group">
                                <span class="col-sm-4 col-xs-3 control-label">分类描述:</span>
                                <div class="col-sm-5 col-xs-8">
                                    <input type="text" name="cat_desc" class="form-control">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <span class="col-sm-4 col-xs-3 control-label">分类图标:</span>
                                <div class="col-sm-5 col-xs-8">
                                    <input type="file" value="默认分类" name="cat_logo" class="form-control">
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <span class="col-sm-4 col-xs-3 control-label">父级分类:</span>
                                <div class="col-sm-5 col-xs-8">
                                    <select class="form-control" name="parent_id">
                                        <option value="0">无</option>

                                        <!--循环所有的数据遍历出来-->
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cat_list']->value, 'cat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['cat']->value['cat_id'];?>
"> <?php echo $_smarty_tpl->tpl_vars['cat']->value['cat_name'];?>
</option>
                                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                     </select>
                                </div>
                            </div>
                        </td>
                    </tr>
                    </tbody><tfoot>
                    <tr>
                        <td>
                            <input type="submit" class="btn btn-primary center-block" value="添加">
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
