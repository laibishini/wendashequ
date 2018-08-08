<?php
/* Smarty version 3.1.30, created on 2018-07-30 11:38:57
  from "G:\wm\wamp64\www\application\admin\view\Question\add.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b5ef8d17b2fc7_85846476',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '979c17b379c8f90cf5a50378d02665b662602207' => 
    array (
      0 => 'G:\\wm\\wamp64\\www\\application\\admin\\view\\Question\\add.html',
      1 => 1501498489,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/layout.html' => 1,
  ),
),false)) {
function content_5b5ef8d17b2fc7_85846476 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_238345b5ef8d17ae976_92893030', "content");
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:common/layout.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block "content"} */
class Block_238345b5ef8d17ae976_92893030 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="aw-content-wrap">
        <form method="post" id="category_form" 
        action="?m=admin&c=question&a=collectAction">
        <div class="mod">
            <div class="mod-head">
                <h3>
                    <span class="pull-left">添加分类</span>
                </h3>
            </div>
            <div class="tab-content mod-content">
                <table class="table table-striped">
                    <tbody><tr>
                        <td>
                            <div class="form-group">
                                <span class="col-sm-4 col-xs-4 control-label" 
                                style="text-align:center;margin-top:10px">
                                		网页地址:
                                </span>
                                <div class="col-sm-8 col-xs-8">
                                    <input type="text" placeholder="网页地址" name="url" class="form-control">
                                </div>
                            </div>
                        </td>
                    </tr>

                    </tbody><tfoot>
                    <tr>
                        <td>
                            <input type="submit" class="btn btn-primary center-block" value="开始采集">
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
