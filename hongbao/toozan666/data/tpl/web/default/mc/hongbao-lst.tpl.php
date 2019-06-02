<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<style type="text/css">
        .myul{
        width: 100%;
        height:100px; overflow:auto
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
    .clear{
        clear:both;
    }
</style>
<?php  echo $pagename;?>
<p style="color: red;">
    <ul class="myul">

<?php 
$sum = 0;
    foreach($list1 as $l1){
            echo "<li><p>".$l1['money']."元红包总数：</p>".$l1['num']."</li> ";
            $sum = $sum + ($l1['money'] * $l1['num'] );
            
    }
?>
<li><p>所有红包总数：</p><?php  echo $total;?></li>

<li><p>红包总金额：</p><?php  echo $sum;?></li>
<div class="clear"></div>
</ul>
</p>

<a href="./index.php?c=mc&a=hongbao&do=add" class="btn btn-primary test we7-margin-left-sm batch-group" data-toggle='popover' >添加</a>
<a href="javascript:void(0)" class="btn btn-primary test we7-margin-left-sm batch-group" data-toggle='popover' id='alldelete' >删除</a>
<a href="javascript:void(0)" class="btn btn-primary test we7-margin-left-sm batch-group" data-toggle='popover' id='alldowload' >下载二维码</a>
<input type="text" name="dowloadid1" id='dowloadid1' style="width: 100px;border: 1px solid gary;border-radius: 5px 5px;"  />到
<input type="text" name="dowloadid2" id='dowloadid2' style="width: 100px;border: 1px solid gary;border-radius: 5px 5px;"   />
<div class="panel-body">
    <table class="table we7-table table-hover fans-info vertical-middle">
        <tr>
            <th><input type="checkbox"  name="" id='all'></th>
            <th width="70" align="center">ID</th>
            <!-- <th  align="center">编码</th> -->
            <th  align="center">名称</th>
            <th width="70" align="center">红包金额</th>
            <th width="50" align="center">总计数量</th>
            <th align="center">产品名称</th>
            <th width="100" align="center">是否发送</th>
            <th width="100" align="center">扫码时间</th>
            <th width="100" align="center">用户昵称</th>
            <th>操作</th>
        </tr>
        <?php  if(is_array($list)) { foreach($list as $ll) { ?>
        <tr>
            <td><input type="checkbox"  name="multi" class="othermulti" value="<?php  echo $ll['id'];?>" ></td>
            <td align="center"><?php  echo $ll['id'];?></td>
            <!-- <td align="center"><?php  echo $ll['coding'];?></td> -->
            <td align="center"><?php  echo $ll['name'];?></td>
            <td align="center"><?php  echo $ll['money'];?></td>
            <td align="center"><?php  echo $ll['number'];?></td>
            <td align="center"><?php  echo $ll['product_name'];?></td>
            <td align="center"><?php  if(($ll['isenvelope'] == 1)) { ?> 已发送<?php  } else if(($ll['isenvelope'] == 2)) { ?>已扫码未发送<?php  } else { ?> 未发送<?php  } ?></td>

            <td align="center">
                <?php 
                if(!empty($ll['gettime'] && $ll['gettime'] != '0')){
                    echo date('Y-m-d H:i:s', $ll['gettime']);
                }

                ?>
            </td>
            <td align="center"><?php  echo $ll['openid'];?></td>
            <td>
                <a target="_blank" href="./index.php?c=mc&a=hongbao&do=dowload&id=<?php  echo $ll['id'];?>"  style="width: 50px;height: 50px;">二维码</a> &nbsp;|
                <a href="./index.php?c=mc&a=hongbao&do=edit&id=<?php  echo $ll['id'];?>"  style="width: 50px;height: 50px;">编辑</a>&nbsp;|
                <a href="./index.php?c=mc&a=hongbao&do=del&id=<?php  echo $ll['id'];?>"  style="width: 50px;height: 50px;">删除</a>
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
        $('#all').change(function(){
            var flage = $(this).is(":checked");
            $('.othermulti').prop("checked",flage);
        });
        ///index.php?c=mc&a=hongbao&do=alldelete
         var page = getPar('page');
        $('#alldelete').click(function(){
            var x = '';
            $('.othermulti').each(function(){
                if($(this).is(":checked")){
                    x = x + $(this).val()+',';
                }  
            })
            if(x == ''){
                return ;
            }
           
            window.location.href = 'index.php?c=mc&a=hongbao&do=alldelete&ids='+x+'&page='+(page-1);
        })

        $("#alldowload").click(function(){
            var x = '';
            var type = 1; //1是勾选下载 0 是输入范围下载
            $('.othermulti').each(function(){
                if($(this).is(":checked")){
                    x = x + $(this).val()+',';
                }  
            })

            if(x == ''){
                //则是填写输入框输入
                var dowloadid1 = $("#dowloadid1").val();
                var dowloadid2 = $("#dowloadid2").val();
                if(dowloadid1 =='' || dowloadid2==''){
                    alert('请填写参数。或勾选下载项目');
                    return;
                }

                x = dowloadid1+','+dowloadid2+',';
                
                if(x == ''){
                    return;
                }
                type = 0;
            }
            
            
            window.location.href = 'index.php?c=mc&a=hongbao&do=alldowload&ids='+x+'&type='+type;
        })

    })
</script>