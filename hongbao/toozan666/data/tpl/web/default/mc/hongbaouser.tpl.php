<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
    
    .seach{
        width: 100%;
    }
    .seach tr td{
        margin: 8px 8px;
        padding:7px 7px;
    }
    .myul{
        width: 100%;
        height:100px;
        overflow:auto
    }
    .myul li{
        width: 250px;
        float: left;
        list-style: none;
        color: red;
    }
    .myul li p{
        display: inline-block;
        font-weight: bold;
        color: black;
    }
</style>

<?php  echo $pagename;?>
<p style="color: red;">
    <ul class="myul">
<?php  if(is_array($list1)) { foreach($list1 as $l1) { ?>
     <li><p><?php  echo $l1['money'];?>元红包总数：</p><?php  echo $l1['num'];?></li>
<?php  } } ?>
<li><p>所有红包总数：</p><?php  echo $total;?></li>
<li><p>所有用户总数：</p><?php  echo $usertotals;?></li>
</ul>
</p>
<form action="index.php?c=mc&a=hongbao&do=hongbaouser" method="post">
<table class="seach">
    <tr>
        <td>领取总金额：</td>
        <td>
            <input type="text" id='totalmoney1' name="totalmoney1" value="<?php  echo $totalmoney1;?>" style="width: 100px;border: 1px solid gary;border-radius: 5px 5px;"  />到
            <input type="text" id='totalmoney2' name="totalmoney2" value="<?php  echo $totalmoney2;?>" style="width: 100px;border: 1px solid gary;border-radius: 5px 5px;"   />
        </td>
        <td>&nbsp;&nbsp;</td>
        <td>单个红包金额：</td>
        <td>
            <input type="text" id='money1' name="money1" value="<?php  echo $money1;?>"  style="width: 100px;border: 1px solid gary;border-radius: 5px 5px;"  />到
            <input type="text" id='money2' name="money2" value="<?php  echo $money2;?>" style="width: 100px;border: 1px solid gary;border-radius: 5px 5px;"   />
        </td>
        
        
    </tr>
    <tr>
        <td>领取次数：</td>
        <td>
            <input type="text" id='num1' name="num1" value="<?php  echo $num1;?>" style="width: 100px;border: 1px solid gary;border-radius: 5px 5px;"  />到
            <input type="text" id='num2' name="num2" value="<?php  echo $num2;?>" style="width: 100px;border: 1px solid gary;border-radius: 5px 5px;"   />
        </td>
        <td>&nbsp;&nbsp;</td>
        <td>城市：</td>
        <td >
            <select id='residecity1' name="residecity1" style="width: 218px;border: 1px solid gary;border-radius: 5px 5px;" >
                <option <?php  if($residecity1 == '') { ?> selected="selected" <?php  } ?> value="">全部</option>
                <?php  if(is_array($city)) { foreach($city as $c) { ?>
                <option <?php  if($residecity1 == $c) { ?> selected="selected" <?php  } ?> value="<?php  echo $c;?>"><?php  echo $c;?></option>
                <?php  } } ?>
                <option <?php  if($residecity1 == '未知') { ?> selected="selected" <?php  } ?> value="未知">未知</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>用户昵称：</td>
        <td>
            <input type="text" id='nickname' name="nickname" value="<?php  echo $nickname;?>" style="width: 100px;border: 1px solid gary;border-radius: 5px 5px;"  />
            
        </td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>
            <button href="javascript:void(0)" class="btn btn-primary test we7-margin-left-sm batch-group" data-toggle='popover' type="submit" >查找</button>
        </td>
    </tr>
</table>
</form>
<div class="panel-body">
    <table class="table we7-table table-hover fans-info vertical-middle">
        <tr>
            <th  align="center">用户ID</th>            
            <th  align="center">用户昵称</th>
            <th  align="left">发送时间</th>
            <th  align="center">领取红包总数</th>
            <th  align="center">红包金额</th>
            <th  align="center">领取总金额</th>
            <th  align="center">所在城市</th>
        </tr>
        <?php  if(is_array($data)) { foreach($data as $ll) { ?>
        <tr>
            <td align="center"><?php  echo $ll['uid'];?></td>
            <td align="center"><?php  echo $ll['nickname'];?></td>
            <td align="left">
                <?php 
                if(!empty($ll['gettime'] && $ll['gettime'] != '0')){
                    echo date('Y-m-d H:i:s', $ll['gettime']);
                }

                ?>
            </td>
            <td align="center"><?php  echo $ll['num'];?></td>
            <td align="center"><?php  echo $ll['money'];?></td>
            <td align="center"><?php  echo $ll['totalmoney'];?></td>
            <td align="center">
                <?php  
                    if($ll['residecity'] == '市' || empty($ll['residecity'])){
                        echo '未知';
                    }else{
                        echo $ll['residecity'];
                    }
                ?>
            </td>
            
        </tr>
        <?php  } } ?>
    </table>
    <div class="popover-group-list" > 

    </div>
    <div class="text-right we7-margin-top">
        
            <?php  echo $pager;?>
    </div>
</div>
<script type="text/javascript">
    function getPar(par){
    //获取当前URL
    var local_url = document.location.href; 
    //获取要取得的get参数位置
    var get = local_url.indexOf(par +"=");
    if(get == -1){
        return false;   
    }   
    //截取字符串
    var get_par = local_url.slice(par.length + get + 1);    
    //判断截取后的字符串是否还有其他get参数
    var nextPar = get_par.indexOf("&");
    if(nextPar != -1){
        get_par = get_par.slice(0, nextPar);
    }
    return get_par;
}
    $(function(){
        //取得并组装查询条件$money1 $num1 residecity1
        //总金额
        totalmoney1 = $('#totalmoney1').val();
        totalmoney2 = $('#totalmoney2').val();
        //单个金额
        money1 = $('#money1').val();
        money2 = $('#money2').val();
        //红包数量
        num1 = $('#num1').val();
        num2 = $('#num2').val();
        //城市
        residecity1 =  $("#residecity1 option:selected").val();
        //昵称nickname
        nickname = $('#nickname').val();
        var sql = '&totalmoney1='+totalmoney1+'&totalmoney2='+totalmoney2+'&money1='+money1+'&money2='+money2+'&num1='+num1+'&num2='+num2+'&residecity1='+residecity1+'&nickname='+nickname;
        $(".pagination li a").each(function(){
            this.href = this.href + sql;
        })
    })
</script>