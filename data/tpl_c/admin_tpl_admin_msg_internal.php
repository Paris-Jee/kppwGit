<?php keke_tpl_class::checkrefresh('admin/tpl/admin_msg_internal', '1449998985' );?><!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $_K['charset'];?>">
<title>keke admin</title>


<link href="tpl/css/admin_management.css" rel="stylesheet" type="text/css" />
<link href="tpl/css/button/stylesheets/css3buttons.css" rel="stylesheet" type="text/css" />
<link title="style1" href="tpl/skin/default/style.css" rel="stylesheet" type="text/css" />
<!--<link title="style2" href="tpl/skin/light/style.css" rel="stylesheet" type="text/css" />-->
<!-- <link href="tpl/js/jquery.qtip.min.css" rel="stylesheet" type="text/css" /> -->
<script type="text/javascript" src="tpl/js/jquery.js"></script>
<script type="text/javascript" src="tpl/js/keke.js"></script>
</head>
<body class="frame_body">
<div class="frame_content">
<div id="append_parent"></div>
<div class="page_title">
<h1>短信模板</h1>
<div class="tool">
<a href="index.php?do=msg&view=internal" <?php if($view== 'internal') { ?>class="here"<?php } ?> > <?php echo $_lang['sms_config'];?></a> <a href="index.php?do=msg&view=intertpl" <?php if($view== 'intertpl') { ?>class="here"<?php } ?> > <?php echo $_lang['sms_tpl_config_edit'];?></a>
</div>
</div>
<div class="box post">

<div class="tab">
<a href="index.php?do=msg&view=internal" <?php if(!$obj) { ?> class="select"<?php } ?>><?php echo $_lang['all'];?></a> <?php if(is_array($message_send_obj)) { foreach($message_send_obj as $k => $v) { ?> <a href="index.php?do=msg&view=internal&obj=<?php echo $k;?>" <?php if($obj==$k) { ?> class="select"<?php } ?>><?php echo $v;?></a> <?php } } ?>
</div>
<div class="tabcon">
<div class="title">
<h2>
<?php echo $_lang['sms_send_config_manage'];?>
</h2>
</div>
<div style="clear: both;"></div>
<div class="detail">
<form name="frm_config_msg" action="#" method="post">
<input type="hidden" name="hdn_msg_config_id" value="<?php echo $msg_cofig_id;?>">
<table border="0" cellspacing="0" cellpadding="0">
<tr>
<th scope="row"><?php echo $_lang['config_num'];?></th>
<th scope="row"><?php echo $_lang['config_name'];?><img id="question" src="tpl/img/system_question_alt_02.png" data-title="鼠标移动到具体的配置名称时，出现对应的配置名称的详细说明！"></th>
<th scope="row"><?php echo $_lang['basic_config'];?></th>
<th scope="row"><?php echo $_lang['operate'];?></th>
</tr>
<?php if(is_array($msg_config)) { foreach($msg_config as $k => $v) { ?>
<tr>
<?php $config=unserialize($v['v']); ?>
<td scope="row"><?php echo $v['config_id'];?></td>
<td><div class="titlebutton" id="tit_<?php echo $v['config_id'];?>" data-title="<?php echo $v['prompt'];?>"><?php echo $v['desc']?></div></td>
<td>
<?php $send_type=unserialize($v['v']);$is_open=array_sum($send_type); ?> <label for="send_close_<?php echo $v['config_id'];?>"> <input type="radio" name="fds[<?php echo $v['config_id'];?>][send_open]" value="0" id="send_close_<?php echo $v['config_id'];?>" onclick="hide_me(<?php echo $v['config_id']?>);" <?php if($is_open==0) { ?>checked="checked"<?php } ?>><?php echo $_lang['close'];?>
</label> <label for="send_open_<?php echo $v['config_id'];?>"> <input type="radio" name="fds[<?php echo $v['config_id'];?>][send_open]" value="1" id="send_open_<?php echo $v['config_id'];?>" onclick="show_me(<?php echo $v['config_id']?>);" <?php if($is_open!=0) { ?>checked="checked"<?php } ?>><?php echo $_lang['open'];?>
</label> <span style="display: {if<?php echo $is_open?>==0" id="show_send_type_<?php echo $v['config_id'];?>"> 
<?php $smsInterface = db_factory::get_one('select v from '.TABLEPRE.'witkey_basic_config where k="sms_interface"'); ?>
<?php if(is_array($message_send_type['0'])) { foreach($message_send_type['0'] as $k2 => $v2) { ?>
<?php if($k2==3) { ?>
<?php if($smsInterface['v']=='open') { ?>
<label for="cbk_<?php echo $k;?>_<?php echo $k2;?>"> 
<input type="checkbox" id="cbk_<?php echo $k;?>_<?php echo $k2;?>" name="ckb[<?php echo $v['config_id'];?>][<?php echo $v2?>]" value="1" <?php if($send_type[$v2]!=0) { ?> checked="checked" <?php } ?>>
<?php echo $message_send_type['1'][$v2]?>&nbsp;&nbsp;&nbsp;&nbsp;
</label>
<?php } ?>
<?php } else { ?>
<label for="cbk_<?php echo $k;?>_<?php echo $k2;?>"> 
<input type="checkbox" id="cbk_<?php echo $k;?>_<?php echo $k2;?>" name="ckb[<?php echo $v['config_id'];?>][<?php echo $v2?>]" value="1" <?php if($send_type[$v2]!=0) { ?> checked="checked" <?php } ?>>
<?php echo $message_send_type['1'][$v2]?>&nbsp;&nbsp;&nbsp;&nbsp;
</label>
<?php } ?>
<?php } } ?>
</span>
</td>
<td>
<button type="button" class="button" value="<?php echo $_lang['edit_tpl'];?>" onclick="window.location.href='index.php?do=msg&view=intertpl&slt_tpl_code=<?php echo $v['k']?>'" /> <span class="pen icon"></span><?php echo $_lang['edit_tpl'];?>
</button>
</td>
</tr>
<?php } } ?>
<tr>
<td colspan="4">

<div class="clearfix">
<button class="positive primary pill button" type="submit" name='sbt_edit' value="<?php echo $_lang['submit'];?>">
<span class="check icon"></span><?php echo $_lang['submit'];?>
</button>
</div>
</td>
</tr>

</table>
<div class="page"><?php echo $pages['page'];?></div>
</form>
</div>
</div>
</div>
<script type="text/javascript">
function hide_me(i) {
$("#show_send_type_" + i).hide();
}
function show_me(i) {
$("#show_send_type_" + i).css("display", "inline");
}
</script>
</div>
<script type="text/javascript" src="../lang/<?php echo $language?>/script/lang.js"></script>
<script type="text/javascript" src="tpl/js/form_and_validation.js"></script>
<!-- <script type="text/javascript" src="tpl/js/jquery.qtip.min.js"></script> -->
<script type="text/javascript" src="tpl/js/script_calendar.js"></script>
<script type="text/javascript" src="tpl/js/artdialog/artDialog.js"></script>
<script type="text/javascript" src="tpl/js/artdialog/jquery.artDialog.js?skin=default"></script>
<script type="text/javascript" src="tpl/js/artdialog/artDialog.iframeTools.source.js"></script>
<script type="text/javascript" src="tpl/js/jquery.mousewheel.min.js"></script>
<script type="text/javascript" src="tpl/js/styleswitch.js"></script>
<script type="text/javascript" src="tpl/js/table.js"></script>
<script type="text/javascript">
var sessionId = "<?php echo $xyq = session_id(); ?>";
function cdel(o, s) {
d = art.dialog;
var c = "<?php echo $_lang['you_comfirm_delete_operate'];?>";
if (s) {
c = s;
}
d.confirm(c, function() {
window.location.href = o.href;
});
return false;
}
function cpass(o, s, type,pay=1) {
d = art.dialog;
if (type == 1) {
if(pay){
var c = "确认审核通过？";
}else{
var c = "<font color='red'>该任务尚未付款</font>,确认审核通过？";
}
} else {
var c = "确认审核失败？";
}
if (s) {
c = s;
}
d.confirm(c, function() {
window.location.href = o.href;
});
return false;
}
function cfreeze(o, s, type) {
d = art.dialog;
if (type == 1) {
var c = "确认冻结？";
}
if (s) {
c = s;
}
d.confirm(c, function() {
window.location.href = o.href;
});
return false;
}
function crecomm(o, s, type) {
d = art.dialog;
if (type == 1) {
var c = "确认推荐？";
} else {
var c = "确认取消推荐？";
}
if (s) {
c = s;
}
d.confirm(c, function() {
window.location.href = o.href;
});
return false;
}
function pdel(frm) {
d = art.dialog;
var frm = frm;
var c = "<?php echo $_lang['you_comfirm_delete_operate'];?>";
d.confirm(c, function() {
$("#" + frm).submit();
});
return false;
}
function fdel(frm) {
d = art.dialog;
var frm = frm;
var c = "<?php echo $_lang['you_comfirm_delete_operate'];?>";
d.confirm(c, function() {
$("#" + frm).submit();
});
return false;
}
function batch_act(obj, frm) {
d = art.dialog;
var frm = frm;
var c = $(obj).val();
var conf = $(":checkbox[name='ckb[]']:checked").length;
if (conf > 0) {
d.confirm("<?php echo $_lang['confirm'];?>" + c + '?', function() {
$(".sbt_action").val(c);
$("#" + frm).submit();
});
} else {
d.alert("<?php echo $_lang['has_none_being_choose'];?>");
}
return false;
}
</script>
<!-- <?php if(KEKE_DEBUG) { ?>
<div
style="background-color: red; color: #fff; width: 400px; text-align: center;">
querys:
{eval echo db_factory::create()->get_query_num()}
&nbsp; times:
{eval echo kekezu::execute_time()}
</div>

<?php } ?> -->
</body>
</html>
<link rel="stylesheet" href="tpl/css/tip-yellow/tip-yellow.css" type="text/css" />
<link rel="stylesheet" href="tpl/css/tip-violet/tip-violet.css" type="text/css" />
<link rel="stylesheet" href="tpl/css/tip-darkgray/tip-darkgray.css" type="text/css" />
<link rel="stylesheet" href="tpl/css/tip-skyblue/tip-skyblue.css" type="text/css" />
<link rel="stylesheet" href="tpl/css/tip-yellowsimple/tip-yellowsimple.css" type="text/css" />
<link rel="stylesheet" href="tpl/css/tip-twitter/tip-twitter.css" type="text/css" />
<link rel="stylesheet" href="tpl/css/tip-green/tip-green.css" type="text/css" />
<script type="text/javascript" src="tpl/js/jquery.poshytip.min.js"></script>
<script type="text/javascript">
$(function() {
$("#question").poshytip({
content: function() {
var title=$(this).data('title');
return title;
}
});
var objTit = $('.titlebutton');
$(objTit).each(function() {
$(this).poshytip({
content: function() {
var title=$(this).data('title');
return title;
}
});
});
});
</script><?php keke_tpl_class::ob_out();?>