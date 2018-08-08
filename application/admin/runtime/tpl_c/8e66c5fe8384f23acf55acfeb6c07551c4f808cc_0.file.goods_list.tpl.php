<?php
/* Smarty version 3.1.30, created on 2018-07-11 12:41:23
  from "G:\wm\wamp64\www\application\application\admin\view\goods_list.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b45faf3a80b65_35341798',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8e66c5fe8384f23acf55acfeb6c07551c4f808cc' => 
    array (
      0 => 'G:\\wm\\wamp64\\www\\application\\application\\admin\\view\\goods_list.tpl',
      1 => 1531312795,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b45faf3a80b65_35341798 (Smarty_Internal_Template $_smarty_tpl) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cat_list']->value, 'v');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
?>

<?php echo $_smarty_tpl->tpl_vars['v']->value['goods_name'];?>
<br>

<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
}
}
