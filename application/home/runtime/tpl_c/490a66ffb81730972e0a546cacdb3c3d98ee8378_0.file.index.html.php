<?php
/* Smarty version 3.1.30, created on 2018-08-01 18:46:55
  from "G:\wm\wamp64\www\application\home\view\index.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b618f9fda34c4_85812667',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '490a66ffb81730972e0a546cacdb3c3d98ee8378' => 
    array (
      0 => 'G:\\wm\\wamp64\\www\\application\\home\\view\\index.html',
      1 => 1533120414,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:layout.html' => 1,
  ),
),false)) {
function content_5b618f9fda34c4_85812667 (Smarty_Internal_Template $_smarty_tpl) {
if (!is_callable('smarty_modifier_date_format')) require_once 'G:\\wm\\wamp64\\www\\framework\\vendor\\smarty\\plugins\\modifier.date_format.php';
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_127075b618f9fd996d3_83482935', "content");
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:layout.html", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block "content"} */
class Block_127075b618f9fd996d3_83482935 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<div class="aw-container-wrap">
	<div class="container category">
		<div class="row">
			<div class="col-sm-12">
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['cat_list']->value, 'cat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
?>

				<dl>
					<dt>
						<img alt="默认分类" 
						src="/application/public/thumb/category/<?php echo $_smarty_tpl->tpl_vars['cat']->value['cat_logo'];?>
"></dt>
					<dd>
						<p class="title">
							<a href="category.html"><?php echo $_smarty_tpl->tpl_vars['cat']->value['cat_name'];?>
</a>
						</p>

					</dd>
				</dl>
				<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="aw-content-wrap clearfix">
				<div class="col-sm-12 col-md-9 aw-main-content">
					<!-- end 新消息通知 -->
					<!-- tab切换 -->
					<ul class="nav nav-tabs aw-nav-tabs active hidden-xs">
						<li>
							<a href="">等待回复</a>
						</li>
						<li>
							<a id="sort_control_hot" href="">热门</a>
						</li>
						<li>
							<a href="">推荐</a>
						</li>
						<li class="active">
							<a href="">最新</a>
						</li>

						<h2 class="hidden-xs">
							<i class="icon icon-list"></i>
							发现
						</h2>
					</ul>
					<!-- end tab切换 -->

					<div class="aw-mod aw-explore-list">
						<div class="mod-body">
							<div class="aw-common-list">
								<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['questions']->value, 'v');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
?>
								<div data-topic-id="2," class="aw-item active">
									<a rel="nofollow" href="people.html" data-id="1" class="aw-user-name hidden-xs">
										<img alt="" src="<?php echo PUBLIC_PATH;?>
common/avatar-max-img.png"></a>
									<div class="aw-question-content">
										<h4>
											<!--<?php echo framework\core\Factory::U('home/question/add',array('id'=>1,'page'=>5));?>
-->
											<a href="/application/public/html/<?php echo $_smarty_tpl->tpl_vars['v']->value['static_url'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['question_title'];?>
</a>
										</h4>
										<a class="pull-right text-color-999" href="answer.html">回复</a>

										<p>
											<a href="category.html" class="aw-question-tags"><?php echo $_smarty_tpl->tpl_vars['v']->value['cat_name'];?>
</a>
											•
											<a class="aw-user-name" href="people.html"><?php echo $_smarty_tpl->tpl_vars['v']->value['username'];?>
</a>
											<span class="text-color-999">发起了问题 •
												<?php echo (($tmp = @$_smarty_tpl->tpl_vars['v']->value['focus_num'])===null||$tmp==='' ? 100 : $tmp);?>
人关注 •
												<?php echo (($tmp = @$_smarty_tpl->tpl_vars['v']->value['reply_num'])===null||$tmp==='' ? 100 : $tmp);?>
个回复 •
												<?php echo (($tmp = @$_smarty_tpl->tpl_vars['v']->value['view_num'])===null||$tmp==='' ? 100 : $tmp);?>
次浏览 •
												<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['v']->value['pub_time'],'%Y-%m-%d %H:%M:%S');?>
天前</span>
											<span class="text-color-999 related-topic hide">• 来自相关话题</span>
										</p>

									</div>
								</div>
								<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

							</div>
						</div>
						<div class="mod-footer">
							<div class="page-control">

								<?php echo $_smarty_tpl->tpl_vars['pagebar']->value;?>


							</div>
						</div>
					</div>
				</div>

				<!-- 侧边栏 -->
				<div class="col-sm-12 col-md-3 aw-side-bar hidden-xs hidden-sm">
					<div class="aw-mod aw-text-align-justify">
						<div class="mod-head">
							<a class="pull-right" href="topic_index.html">更多 &gt;</a>
							<h3>热门话题</h3>
						</div>
						<div class="mod-body">

							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hot_topics']->value, 'hot');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['hot']->value) {
?>
							<dl>
								<dt class="pull-left aw-border-radius-5">
									<a href="topic.html">
										<img src="<?php echo THUMB_PATH;
echo $_smarty_tpl->tpl_vars['hot']->value['topic_pic'];?>
" alt=""></a>
								</dt>
								<dd class="pull-left">
									<p class="clearfix">
										<span class="topic-tag">
											<a data-id="2" class="text" href="topic.html"><?php echo $_smarty_tpl->tpl_vars['hot']->value['topic_title'];?>
</a>
										</span>
									</p>
									<p> <b><?php echo $_smarty_tpl->tpl_vars['hot']->value['q_nums'];?>
</b>
										个问题, <b><?php echo $_smarty_tpl->tpl_vars['hot']->value['user_nums'];?>
</b>
										人关注
									</p>
								</dd>
							</dl>

							<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>


						</div>
					</div>
					<div class="aw-mod aw-text-align-justify">
						<div class="mod-head">
							<a class="pull-right" href="?/people/">更多 &gt;</a>
							<h3>热门用户</h3>
						</div>
						<div class="mod-body">
							<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['hot_users']->value, 'hu');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['hu']->value) {
?>
							<dl>
								<dt class="pull-left aw-border-radius-5">
									<a href="people.html">
										<img src="<?php echo THUMB_PATH;
echo $_smarty_tpl->tpl_vars['hu']->value['topic_pic'];?>
" alt=""></a>
								</dt>
								<dd class="pull-left">
									<a class="aw-user-name" data-id="2" href="people.html"><?php echo $_smarty_tpl->tpl_vars['hu']->value['username'];?>
</a>
									<p class="signature"></p>
									<p>
										<b><?php echo $_smarty_tpl->tpl_vars['hu']->value['q_nums'];?>
</b>
										个问题,
										<b>0</b>
										次赞同
									</p>
								</dd>
							</dl>
							<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

						</div>
					</div>
				</div>
				<!-- end 侧边栏 -->
			</div>
		</div>
	</div>
</div>

<div class="aw-ajax-box" id="aw-ajax-box"></div>

<?php
}
}
/* {/block "content"} */
}
