<?php keke_tpl_class::checkrefresh('admin/tpl/admin_config_pay', '1449998982' );?><!DOCTYPE HTML>
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
    	<h1><?php echo $_lang['pay_manage'];?></h1>
        <div class="tool">
            <a href="index.php?do=config&view=pay&op=config" <?php if($op=='config' || !isset($op)) { ?>class="here"<?php } ?>><?php echo $_lang['pay_config'];?></a>
            <a href="index.php?do=config&view=pay&op=online" <?php if($op=='online') { ?>class="here"<?php } ?>><?php echo $_lang['online_pay_interface'];?></a>
<a href="index.php?do=config&view=pay&op=offline" <?php if($op=='offline') { ?>class="here"<?php } ?>><?php echo $_lang['line_pay_interface'];?></a>
<!--
<a href="index.php?do=config&view=pay&op=trust" <?php if($op=='trust') { ?>class="here"<?php } ?>><?php echo $_lang['trust_pay_interface'];?></a>
    		-->
</div>
    </div>
<?php if($op == 'online'||$op=='trust') { ?>
<div class="box tip clearfix p_relative">
    	<div class="control"><a href="javascript:void(0);" onclick="$(this).parent().parent().fadeOut();" title=<?php echo $_lang['close'];?>><b>&times;</b></a></div>
        <div class="title"><h2><?php echo $_lang['tips'];?></h2></div>
        <div class="detail pad10">
            <ul>
            	<?php if($op=='online') { ?>
                	<li><?php echo $_lang['open_pay_info'];?></li>
 
              	  
<?php } ?>
            </ul>
        </div>
</div>
<div class="box list">
 <div class="title"><h2><?php echo $_lang['pay_interface'];?>&nbsp&nbsp<a href="http://bbs.kppw.cn/bbs_redirect.php?c=2" target="_blank" style="color:red;font-size:small;">查看相关教程</a></h2></div>
  <div class="detail">
     <form action="" method="post">
     	<input type="hidden" value="<?php echo $do?>" name="do">
<input type="hidden" value="<?php echo $view?>" name="view">
      <table cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <th width="120"><?php echo $_lang['pay_interface_name'];?></th>
            <th ><?php echo $_lang['correspond_dir'];?></th>
            <th><?php echo $_lang['author'];?></th>
            <th width="260"><?php echo $_lang['explain'];?></th>
            <th><?php echo $_lang['application_status'];?></th>
            <th><?php echo $_lang['operate'];?></th>
          </tr>
  <?php if(is_array($payment_list)) { foreach($payment_list as $v) { ?>
              <tr class="item">
                <td><a href="index.php?do=config&view=editpay&payname=<?php echo $v['pay_dir'];?>"><?php echo $v['pay_name']?></a></td>
                <td><?php echo $v['pay_dir']?></td>
                <td><?php echo $v['pay_dev']?> </td>
                <td><a href="#"><?php echo $v['pay_desc']?></a></td>
                <td class="td25"><?php $pay_config=unserialize(stripslashes($v['config'])) ?><?php if($pay_config['pay_status']) { ?><?php echo $_lang['open'];?><?php } else { ?><?php echo $_lang['close'];?><?php } ?></td>
                <td>
            	<?php if($pay_config['pay_status']) { ?>
<a href="index.php?do=config&view=pay&op=disable&payname=<?php echo $v['pay_dir'];?>&ac=<?php echo $op;?>"  class="button"><span class="cross icon"></span><?php echo $_lang['disable'];?></a>
<?php } else { ?> 
<a href="index.php?do=config&view=pay&op=allow&payname=<?php echo $v['pay_dir'];?>&ac=<?php echo $op;?>" class="button" ><span class="check icon"></span><?php echo $_lang['use'];?></a>
<?php } ?> 
<a href="index.php?do=config&view=editpay&payname=<?php echo $v['pay_dir'];?>&type=<?php echo $op;?>" class="button"><span class="cog icon"></span><?php echo $_lang['config'];?></a>
<?php if($v['pay_dir']=='alipayjs') { ?>
<a href="http://act.life.alipay.com/systembiz/keke/" class="button"><span class="user icon"></span><?php echo $_lang['application_interface'];?></a>
<?php } elseif($v['pay_dir']=='alipaydual') { ?>
<a href="http://act.life.alipay.com/systembiz/keke/" class="button"><span class="user icon"></span><?php echo $_lang['application_interface'];?></a>
<?php } elseif($v['pay_dir']=='chinabank') { ?>
<a href="http://www.chinabank.com.cn/" class="button"><span class="user icon"></span><?php echo $_lang['application_interface'];?></a>	
<?php } elseif($v['pay_dir']=='paypal') { ?>
<a href="https://www.paypal.com/c2?&locale.x=zh_XC&kw=PPC-BD-KWd002423&mpch=ads&mplx=3484-39238-9395-106" class="button"><span class="user icon"></span><?php echo $_lang['application_interface'];?></a>	
<?php } elseif($v['pay_dir']=='tenpay') { ?>
<a href="http://union.tenpay.com/mch/mch_register.shtml?sp_suggestuser=1212087301" class="button"><span class="user icon"></span><?php echo $_lang['application_interface'];?></a>	
<?php } elseif($v['pay_dir']=='wxpay') { ?>
<a href="https://pay.weixin.qq.com" class="button"><span class="user icon"></span><?php echo $_lang['application_interface'];?></a>	
<?php } elseif($v['pay_dir']=='alipay_trust') { ?>
<a href="https://b.alipay.com/support/helperApply.htm?action=supportHome" class="button"><span class="user icon"></span><?php echo $_lang['application_interface'];?></a>		
<?php } ?>
</td>
               </tr>
          <?php } } ?>
                </tbody>
              </table>
        	</form>
        </div>
        
</div>
<?php } elseif($op == 'offline') { ?>
<div class="box tip clearfix p_relative">
    	<div class="control"><a href="javascript:void(0);" onclick="$(this).parent().parent().fadeOut();" title=<?php echo $_lang['close'];?>><b>&times;</b></a></div>
        <div class="title"><h2><?php echo $_lang['tips'];?></h2></div>
        <div class="detail pad10">
            <ul>
                <li><?php echo $_lang['open_pay_info'];?></li>
            </ul>
        </div>
</div>
<div class="box list">
 <div class="title"><h2><?php echo $_lang['line_pay_interface'];?>&nbsp&nbsp<a href="http://bbs.kppw.cn/bbs_redirect.php?c=3" target="_blank" style="color:red;font-size:small;">查看相关教程</a></h2></div>
  <div class="detail">
     <form action="" method="post">
     	<input type="hidden" value="<?php echo $do?>" name="do">
<input type="hidden" value="<?php echo $view?>" name="view">
      <table cellpadding="0" cellspacing="0">
        <tbody>
          <tr>
            <th width="150"><?php echo $_lang['bank_name'];?></th>
            <th width="170"><?php echo $_lang['account'];?></th>
<th width="170"><?php echo $_lang['username'];?></th>
            <th><?php echo $_lang['contact_tel'];?></th>
            <th><?php echo $_lang['application_status'];?></th>
            <th><?php echo $_lang['operate'];?></th>
          </tr>
  <?php if(is_array($payment_list)) { foreach($payment_list as $v) { ?>
<?php if($v['type']=='offline') { ?>
<?php $pay_config=unserialize(stripslashes($v['config'])) ?>
              <tr class="item">
                <td><?php echo $bank_arr[$v['payment']];?></td>
                <td><?php echo $pay_config['pay_account']?></td>
                <td><?php echo $pay_config['pay_user']?></td>
<td><?php echo $pay_config['pay_phone']?></td>
                <td class="td25"><?php if($pay_config['pay_status']) { ?><?php echo $_lang['open'];?><?php } else { ?><?php echo $_lang['close'];?><?php } ?></td>
                <td> 
                <?php if($pay_config['pay_status']) { ?>
<a href="index.php?do=config&view=pay&op=disable&payname=<?php echo $v['payment'];?>&ac=offline"  class="button"><span class="cross icon"></span><?php echo $_lang['disable'];?></a>
<?php } else { ?> 
<a href="index.php?do=config&view=pay&op=allow&payname=<?php echo $v['payment'];?>&ac=offline" class="button" ><span class="check icon"></span><?php echo $_lang['use'];?></a>
<?php } ?> 
<a href="index.php?do=config&view=pay&op=<?php echo $op?>&ac=edit&payment=<?php echo $v['payment'];?>" class="button"><span class="cog icon"></span><?php echo $_lang['config'];?></a>
<a href="index.php?do=config&view=pay&op=<?php echo $op?>&ac=del&payment=<?php echo $v['payment'];?>" onclick="return cdel(this);"  class="button"><span class="negative icon"></span><?php echo $_lang['delete'];?></a>
</td>
               </tr>
<?php } ?>
          <?php } } ?>
          </tbody>
  <tfoot>
  	 <tr class="item">
                <td colspan="6" align="left">
                	 <button class="positive primary pill button t_r" type="button" value=<?php echo $_lang['add'];?> onclick="location.href='index.php?do=config&view=pay&op=<?php echo $op?>&ac=add'"><span class="check icon"></span><?php echo $_lang['add'];?></button>
</td>
 </tr>
  </tfoot>
         </table>
       </form>
     </div>   
</div>
<?php } elseif($op=='config' || !isset($op)) { ?>
<div class="box post">
<div class="tabcon">
        	<div class="title"><h2><?php echo $_lang['recharge_Ment_config'];?></h2></div>
            <div class="detail">
                <form name="frm_config_pay" id="frm_config_pay" action="#" method="post">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <th scope="row" width="160"><?php echo $_lang['recharge_mini_money'];?><?php echo $_lang['zh_mh'];?></th>
                        <td><input type="text"  name="fds[recharge_min]" id="txt_recharge_min" value="<?php echo $pay_config['recharge_min']['v'];?>" limit='type:float' title='<?php echo $_lang['recharge_mini_money'];?><?php echo $pay_config['recharge_min']['v'];?><?php echo $_lang['yuan'];?>' msg="<?php echo $_lang['recharge_big_money'];?><?php echo $pay_config['recharge_min']['v'];?><?php echo $_lang['yuan'];?>" msgArea="recharge_min_msg" class="txt" style=" width:260px;"/><span id="recharge_min_msg"></span><?php echo $_lang['umit'];?></td>
                      </tr>
                      <tr>
                        <th scope="row"><?php echo $_lang['ment_mini_value'];?><?php echo $_lang['zh_mh'];?></th>
                        <td><input type="text" name="fds[withdraw_min]" id="txt_withdraw_min" value="<?php echo $pay_config['withdraw_min']['v'];?>" limit="type:float" title="<?php echo $_lang['a_ment_mini_value'];?><?php echo $pay_config['withdraw_min']['v'];?><?php echo $_lang['yuan'];?>" msg="<?php echo $_lang['ment_big_money'];?><?php echo $pay_config['withdraw_min']['v'];?><?php echo $_lang['yuan'];?>" msgArea="withdraw_min_msg"  class="txt" style=" width:260px;"/><span id="withdraw_min_msg"></span><?php echo $_lang['umit'];?></td>
                      </tr>
                      <tr>
                        <th scope="row"><?php echo $_lang['date_ment_hight'];?><?php echo $_lang['zh_mh'];?></th>
                        <td><input type="text" name="fds[withdraw_max]" id="txt_withdraw_max"  value="<?php echo $pay_config['withdraw_max']['v'];?>" limit="type:int" title="<?php echo $_lang['day_ment_hight'];?><?php echo $pay_config['withdraw_max']['v'];?><?php echo $_lang['yuan'];?>，<?php echo $_lang['excess_not_ment'];?>" msg=<?php echo $_lang['date_ment_big_zero'];?> msgArea="withdraw_max_msg" maxlength="10" class="txt" style=" width:260px;"/><span id="withdraw_max_msg"></span><?php echo $_lang['umit'];?></td>
                      </tr>
  <tr>
                   <th scope="row"><?php echo $_lang['single_tariff'];?><?php echo $_lang['zh_mh'];?></th>
               <td>
                    <input type="text" name="fds[per_charge]" value="<?php echo $pay_config['per_charge']['v'];?>" class="txt" style=" width:260px;"/>
<div class="padt10 direct"><p>(<?php echo $_lang['user_a_single_charge_ratio'];?> )</p></div>
   </td>
   </tr>
<tr>
                   <th scope="row"><?php echo $_lang['single_minimum_charge'];?><?php echo $_lang['zh_mh'];?></th>
               <td>
                    <input type="text" name="fds[per_low]" value="<?php echo $pay_config['per_low']['v'];?>" class="txt" style=" width:260px;"/>
<div class="padt10 direct"><p>(<?php echo $_lang['user_single_charge_minimum_amount'];?>)</p></div>
  </td>
   </tr>
<tr>
                   <th scope="row"><?php echo $_lang['single_highest_fees'];?><?php echo $_lang['zh_mh'];?></th>
               <td>
                    <input type="text" name="fds[per_high]" value="<?php echo $pay_config['per_high']['v'];?>" class="txt" style=" width:260px;"/>
<!--<div class="padt10 direct"><p>(<?php echo $_lang['user_single_charge_highest_amount'];?>)</p></div>-->
  </td>
   </tr>
   <tr>
                      <tr>
                        <th scope="row">&nbsp;</th>
                        <td>
                            <div class="clearfix padt10">
                                <button class="positive pill primary button" type="submit" onclick="return checkForm(document.getElementById('frm_config_pay'),false)"  name="sbt_edit" value="<?php echo $_lang['edit'];?>"><span class="check icon"></span><?php echo $_lang['submit'];?></button>
                               
                            </div>
                        </td>
                      </tr>
                    </table>
                    
                </form>
            </div>
        </div>
</div>
<?php } ?>

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
<?php keke_tpl_class::ob_out();?>