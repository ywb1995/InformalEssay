<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 0) ? (include $this->template('common/header', TEMPLATE_INCLUDEPATH)) : (include template('common/header', TEMPLATE_INCLUDEPATH));?>
<div class="panel-body">
    <form action="./index.php?c=mc&a=hongbao&do=savedata" method="post">
        <table class="table we7-table table-hover fans-info vertical-middle">
            <tr>
                <td colspan="2" align="left">
                    编辑红包信息
                </td>
            </tr>
            <tr>
                <td style="width: 200px;">名称:</td>
                <td> <input  type="text" class="form-control" value="<?php  echo $hongbao['name'];?>" name="name"/></td>
            </tr>
            <tr>
                <td style="width: 200px;">红包金额:</td>
                <td> <input  type="number" class="form-control" value="<?php  echo $hongbao['money'];?>" name="money"/></td>
            </tr>
            <tr>
                <td style="width: 200px;">红包数量:</td>
                <td> <input  type="text" class="form-control"  value="<?php  echo $hongbao['number'];?>" name="number" readonly/></td>
            </tr>
            <tr>
                <td style="width: 200px;">产品名称:</td>
                <td> <input  type="text" class="form-control" value="<?php  echo $hongbao['product_name'];?>" name="product_name"/></td>
            </tr>
            <tr>
                <td style="width: 200px;">产品规格:</td>
                <td> <input  type="text" class="form-control" value="<?php  echo $hongbao['product_site'];?>" name="product_site"/></td>
            </tr>
            <tr>
                <td style="width: 200px;">产品价格:</td>
                <td> <input  type="text" class="form-control"  value="<?php  echo $hongbao['product_money'];?>" name="product_money"/></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="hidden" value="<?php  echo $hongbao['id'];?>" name="id">
                    <button type="submit" class="btn btn-primary">提交</button>
                </td>
            </tr>
        </table>
    </form>
</div>