<?php
/* Smarty version 3.1.30, created on 2018-07-30 06:44:23
  from "D:\wamp\www\application\admin\view\Question\add.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b5eb3c7e75154_05931826',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '35a1dcdb8197372cb05dbd127b4b61827615c91a' => 
    array (
      0 => 'D:\\wamp\\www\\application\\admin\\view\\Question\\add.html',
      1 => 1501498489,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common/layout.html' => 1,
  ),
),false)) {
function content_5b5eb3c7e75154_05931826 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_96975b5eb3c7e712d2_03248188', "content");
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:common/layout.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block "content"} */
class Block_96975b5eb3c7e712d2_03248188 extends Smarty_Internal_Block
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
