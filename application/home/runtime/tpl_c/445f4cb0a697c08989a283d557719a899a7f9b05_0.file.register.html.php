<?php
/* Smarty version 3.1.30, created on 2018-07-26 03:22:05
  from "D:\wamp\www\application\home\view\user\register.html" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5b593e5d3a8fb1_89649987',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '445f4cb0a697c08989a283d557719a899a7f9b05' => 
    array (
      0 => 'D:\\wamp\\www\\application\\home\\view\\user\\register.html',
      1 => 1532575312,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5b593e5d3a8fb1_89649987 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta content="IE=edge,Chrome=1" http-equiv="X-UA-Compatible">
	<meta content="webkit" name="renderer">
	<title>注册 - 有问必答</title>
	<meta content="有问必答,知识社区,社交社区,问答社区" name="keywords">
	<meta content="有问必答 社交化知识社区" name="description">
<link type="image/x-icon" rel="shortcut icon" href="<?php echo PUBLIC_PATH;?>
home/css/default/img/favicon.ico?v=20151125">

<link href="<?php echo PUBLIC_PATH;?>
home/css/bootstrap.css" type="text/css" rel="stylesheet">
<link href="<?php echo PUBLIC_PATH;?>
home/css/icon.css" type="text/css" rel="stylesheet">

<link type="text/css" rel="stylesheet" href="<?php echo PUBLIC_PATH;?>
home/css/default/common.css?v=20151125">
<link type="text/css" rel="stylesheet" href="<?php echo PUBLIC_PATH;?>
home/css/default/link.css?v=20151125">
<link type="text/css" rel="stylesheet" href="<?php echo PUBLIC_PATH;?>
home/js/plug_module/style.css?v=20151125">
<link type="text/css" rel="stylesheet" href="<?php echo PUBLIC_PATH;?>
home/css/default/register.css?v=20151125">

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo PUBLIC_PATH;?>
home/js/jquery.2.js?v=20151125"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo PUBLIC_PATH;?>
home/js/jquery.form.js?v=20151125"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo PUBLIC_PATH;?>
home/js/plug_module/plug-in_module.js?v=20151125"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo PUBLIC_PATH;?>
home/js/aws.js?v=20151125"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo PUBLIC_PATH;?>
home/js/aw_template.js?v=20151125"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo PUBLIC_PATH;?>
home/js/compatibility.js" type="text/javascript"><?php echo '</script'; ?>
>
<!--[if lte IE 8]>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo PUBLIC_PATH;?>
home/js/respond.js"><?php echo '</script'; ?>
>
<![endif]-->
<style type="text/css">.fancybox-margin{margin-right:17px;}</style>
</head>

<body>
<noscript id="noscript" unselectable="on">
	<div class="aw-404 aw-404-wrap container">
		<img src="<?php echo PUBLIC_PATH;?>
home/common/no-js.jpg">
		<p>你的浏览器禁用了JavaScript, 请开启后刷新浏览器获得更好的体验!</p>
	</div>
</noscript>

<div class="aw-register-box">
	<div class="mod-head">
		<a href="">
			<img alt="" src="<?php echo PUBLIC_PATH;?>
home/css/default/img/login_logo.png"></a>
		<h1>注册新用户</h1>
	</div>
	<div class="mod-body">
		<form id="register_form"  action="?m=home&c=user&a=doRegisterAction" method="post" class="aw-register-form">

			<ul>
				<li class="alert alert-danger hide error_message text-left"> <i class="icon icon-delete"></i> <em></em>
				</li>
				<li>
					<input type="text" value="" errortips="用户名长度不符合" tips="请输入一个 2-14 位的用户名" placeholder="用户名" name="user_name" class="aw-register-name form-control">
					<span id="user_msg" style="width: 260px;position: absolute;right: -263px;"></span>
				</li>
				<li>
					<input type="text" errortips="邮箱格式不正确" value="" tips="请输入你常用的电子邮箱作为你的账号" name="email" placeholder="邮箱" class="aw-register-email form-control">
					<span id="email_msg"></span>
					<a href="?c=user&a=msmAction" style="float:right">短信验证</a>
				</li>
					
				<li>
					<input type="password" errortips="密码不符合规则" tips="请输入 6-16 个字符,区分大小写" placeholder="密码" name="password" class="aw-register-pwd form-control">
					<span id="pass_msg" style="margin-top: 10px;"></span>
				</li>
				<li class="more-information hide">
					<ul>
						<li>
							性别:
							<label>
								<input type="radio" value="1" id="sex" name="sex">男</label>
							&nbsp;
							<label>
								<input type="radio" value="2" id="sex" name="sex">女</label>
							&nbsp;
							<label>
								<input type="radio" checked="checked" value="3" id="sex" name="sex">保密</label>
						</li>
						<li>
							职业:
							<select name="job_id">
								<option value="">--</option>
								<option value="1">销售</option>
								<option value="2">市场/市场拓展/公关</option>
								<option value="3">商务/采购/贸易</option>
								<option value="4">计算机软、硬件/互联网/IT</option>
								<option value="5">电子/半导体/仪表仪器</option>
								<option value="6">通信技术</option>
								<option value="7">客户服务/技术支持</option>
								<option value="8">行政/后勤</option>
								<option value="9">人力资源</option>
								<option value="10">高级管理</option>
								<option value="11">生产/加工/制造</option>
								<option value="12">质控/安检</option>
								<option value="13">工程机械</option>
								<option value="14">技工</option>
								<option value="15">财会/审计/统计</option>
								<option value="16">金融/银行/保险/证券/投资</option>
								<option value="17">建筑/房地产/装修/物业</option>
								<option value="18">交通/仓储/物流</option>
								<option value="19">普通劳动力/家政服务</option>
								<option value="20">零售业</option>
								<option value="21">教育/培训</option>
								<option value="22">咨询/顾问</option>
								<option value="23">学术/科研</option>
								<option value="24">法律</option>
								<option value="25">美术/设计/创意</option>
								<option value="26">编辑/文案/传媒/影视/新闻</option>
								<option value="27">酒店/餐饮/旅游/娱乐</option>
								<option value="28">化工</option>
								<option value="29">能源/矿产/地质勘查</option>
								<option value="30">医疗/护理/保健/美容</option>
								<option value="31">生物/制药/医疗器械</option>
								<option value="32">翻译（口译与笔译）</option>
								<option value="33">公务员</option>
								<option value="34">环境科学/环保</option>
								<option value="35">农/林/牧/渔业</option>
								<option value="36">兼职/临时/培训生/储备干部</option>
								<option value="37">在校学生</option>
								<option value="38">其他</option>
							</select>
						</li>
						<li>
							所在城市:
							<select style="display:inline-block" class="select_area" name="province">
								<option value="">请选择省份或直辖市</option>
								<option value="安徽省">安徽省</option>
								<option value="北京市">北京市</option>
								<option value="福建省">福建省</option>
								<option value="甘肃省">甘肃省</option>
								<option value="广东省">广东省</option>
								<option value="广西壮族自治区">广西壮族自治区</option>
								<option value="贵州省">贵州省</option>
								<option value="海南省">海南省</option>
								<option value="河北省">河北省</option>
								<option value="河南省">河南省</option>
								<option value="黑龙江省">黑龙江省</option>
								<option value="湖北省">湖北省</option>
								<option value="湖南省">湖南省</option>
								<option value="吉林省">吉林省</option>
								<option value="江苏省">江苏省</option>
								<option value="江西省">江西省</option>
								<option value="辽宁省">辽宁省</option>
								<option value="内蒙古自治区">内蒙古自治区</option>
								<option value="宁夏回族自治区">宁夏回族自治区</option>
								<option value="青海省">青海省</option>
								<option value="山东省">山东省</option>
								<option value="山西省">山西省</option>
								<option value="陕西省">陕西省</option>
								<option value="上海市">上海市</option>
								<option value="四川省">四川省</option>
								<option value="天津市">天津市</option>
								<option value="西藏自治区">西藏自治区</option>
								<option value="新疆维吾尔自治区">新疆维吾尔自治区</option>
								<option value="云南省">云南省</option>
								<option value="浙江省">浙江省</option>
								<option value="重庆市">重庆市</option>
								<option value="香港">香港</option>
								<option value="澳门">澳门</option>
								<option value="台湾">台湾</option>
							</select>

							<select class="select_area" name="city"></select>
						</li>
						<li>
							<input type="text" name="signature" value="" id="welcome_signature" placeholder="一句话介绍" class="form-control"></li>
					</ul>
				</li>
				<li>
					<hr>
					<a class="more-information-btn">更多资料</a>
				</li>
				<li class="aw-register-verify">
					<img src="?m=home&c=user&a=makeCaptchaAction" onclick="" id="captcha" class="pull-right">

					<input type="text" placeholder="验证码" name="seccode_verify" class="form-control"></li>
				<li class="last">
					<label>
						<input type="checkbox" name="agreement_chk" value="1" checked="checked">我同意</label>
					<a class="aw-agreement-btn" href="javascript:;">用户协议</a>
					<a class="pull-right" href="?/account/login/">已有账号?</a>
					<div class="aw-register-agreement hide">
						<div id="register_agreement" class="aw-register-agreement-txt">
							当您申请用户时，表示您已经同意遵守本规章。
							<br>
							欢迎您加入本站点参与交流和讨论，本站点为社区，为维护网上公共秩序和社会稳定，请您自觉遵守以下条款：
							<br>
							<br>
							一、不得利用本站危害国家安全、泄露国家秘密，不得侵犯国家社会集体的和公民的合法权益，不得利用本站制作、复制和传播下列信息：
							<br>
							&#12288;（一）煽动抗拒、破坏宪法和法律、行政法规实施的；
							<br>
							&#12288;（二）煽动颠覆国家政权，推翻社会主义制度的；
							<br>
							&#12288;（三）煽动分裂国家、破坏国家统一的；
							<br>
							&#12288;（四）煽动民族仇恨、民族歧视，破坏民族团结的；
							<br>
							&#12288;（五）捏造或者歪曲事实，散布谣言，扰乱社会秩序的；
							<br>
							&#12288;（六）宣扬封建迷信、淫秽、色情、赌博、暴力、凶杀、恐怖、教唆犯罪的；
							<br>
							&#12288;（七）公然侮辱他人或者捏造事实诽谤他人的，或者进行其他恶意攻击的；
							<br>
							&#12288;（八）损害国家机关信誉的；
							<br>
							&#12288;（九）其他违反宪法和法律行政法规的；
							<br>
							&#12288;（十）进行商业广告行为的。
							<br>
							<br>
							二、互相尊重，对自己的言论和行为负责。
							<br>
							三、禁止在申请用户时使用相关本站的词汇，或是带有侮辱、毁谤、造谣类的或是有其含义的各种语言进行注册用户，否则我们会将其删除。
							<br>
							四、禁止以任何方式对本站进行各种破坏行为。
							<br>
							五、如果您有违反国家相关法律法规的行为，本站概不负责，您的登录信息均被记录无疑，必要时，我们会向相关的国家管理部门提供此类信息。
						</div>
					</div>

				</li>
				<li class="clearfix">
					<input type="submit" value="注册" class="btn btn-large btn-blue btn-block">
				</li>
			</ul>
		</form>
	</div>
	<div class="mod-footer"></div>
</div>

<div class="aw-footer-wrap">
	<div class="aw-footer">
		Copyright &copy; 2016-2099, All Rights Reserved
		<span class="hidden-xs">
			Powered By
			<a target="blank" href="http://helloitbull.net/">有问必答 1.0</a>
		</span>

	</div>
</div>
<?php echo '<script'; ?>
 type="text/javascript">
	//先找到用户名、密码、邮箱DOM对象
	var oUser = document.getElementsByName('user_name')[0];
	var oPass = document.getElementsByName('password')[0];
	var oEmail = document.getElementsByName('email')[0];

	//点击注册时进行用户名、密码、邮箱的验证
	function validate(){
		//1. 验证用户名
		var res1 = checkUser();
		//2. 验证密码
		var res2 = checkPass();
		//3. 验证邮箱
		var res3 = checkEmail();
		
		if(res1 && res2 && res3){
			return true;
		}else{
			return false;
		}
	}
	//键盘抬起分别验证用户名、密码、邮箱是否符合规则
	oUser.onkeyup = checkUser;
	oPass.onkeyup = checkPass;
	oEmail.onkeyup = checkEmail;

	//验证用户名是否符合规则
    //参数1：$username待验证的用户名
    //参数2：$min 最少多少位
    //参数3：$max 最多多少位
    function checkUser()
    {
        //1. 用户名的验证规则：6-30位，字母、数字、下划线组合，字母开头
        var reg = /^[a-zA-Z]\w{5,29}$/;
       
        var result = reg.test(oUser.value);
        
        if(result){            
            //显示验证的结果
            document.getElementById('user_msg').innerHTML = '<font color="green">用户名可以使用</font>';
            return true;
        }else{            
            //显示验证失败的结果
            document.getElementById('user_msg').innerHTML = '<font color="red">6-30位，字母、数字、下划线组合，字母开头</font>';
            return false;
        }
    }
	//验证密码
	function checkPass(){
		//1. 先定义一个纯字母、纯数字的规则
        var reg1 = /^[a-zA-Z]{6,20}$/; 		//纯字母
        var reg2 = /^\d{6,20}$/;       		//纯数字
        var reg3 = /^[a-zA-Z0-9]{6,20}$/;   //字母、数字的组合
        var reg4 = /^[a-zA-Z0-9~`!@#\$%\^&\*\(\)\-_\+=\{\}\[\]\|\\;:\'\"<>,\.\?\/]{6,20}$/;
        
        //获得用户输入的密码  
        var password = oPass.value;   
        var result1 = reg1.test(password);        
        var result2 = reg2.test(password);        
        var result3 = reg3.test(password);        
        var result4 = reg4.test(password); 
        
        if(result1 || result2){
            //说明是纯字母或纯数字的
            document.getElementById('pass_msg').innerHTML = '<font color="green">纯字母或数字的简单爆了</font>';
            return true;
        }else if (result3){
            //说明是字母、数字的组合
            document.getElementById('pass_msg').innerHTML = '<font color="green">密码安全性一般</font>';
            return true;
        }else if(result4){
            //说明是特殊符号、字母、数字的组合
            document.getElementById('pass_msg').innerHTML = '<font color="green">密码杠杠滴</font>';
            return true;
        }else{
            document.getElementById('pass_msg').innerHTML = '<font color="red">密码不符合规则</font>';
            return false;
        }
	}
	//验证邮箱
	function checkEmail(){
		//@后面可能有vip.  也可能没有
        var reg = /^[\w\-\.]+@([a-zA-Z\d]+\.)?[a-zA-Z\d]+\.[A-Za-z]{2,4}$/;
                
        //3. 使用我们规则检验一下用户的输入是否符合规则
        var result = reg.test(oEmail.value);

        if(result){
            //验证通过
            document.getElementById('email_msg').innerHTML = '<font color="green">邮箱可用</font>';
            return true;
        }else{
            //邮箱不合法
            document.getElementById('email_msg').innerHTML = '<font color="red">邮箱不合法</font>';
            return false;
        }
	}

	//点击验证码切换

	// 先找到验证码图片
	var oCaptcha = document.getElementById('captcha');
	oCaptcha.onclick = function(){
		var random = Math.random();
		
		//如果src的值不变说明请求的就是同一张图片资源，如果每次请求时src的值变化了，说明请求的图片地址就不一样了
		this.src = "<?php echo framework\core\Factory::U('home/user/makeCaptcha',array('random'=>"+random+"));?>
";
	}
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
