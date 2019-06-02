<?php
/**
 * Created by PhpStorm.
 * User: YWB
 * Date: 2018/4/26
 * Time: 11:47
 * 后台红包管理
 */
defined('IN_IA') or exit('Access Denied');
load()->model('mc'); 
//设置脚本超时时间
set_time_limit(0) ;

$dos = ['display','add','del','dowload','edit','savedata','alldelete','alldowload','classtype','hongbaouser'];
$do = in_array($do, $dos) ? $do : 'display';
if($do == 'display'){
    $_W['page']['title'] = '红包管理';
    $groups = mc_groups();
    $pindex = max(1, intval($_GPC['page']));
    $psize = 10;

    $sql = "SELECT *  FROM ".tablename('hongbao')."  ORDER BY id ASC LIMIT  " . ($pindex - 1) * $psize . ',' . $psize;

    $total_sql = "SELECT count(*)  FROM ".tablename('hongbao')."  ORDER BY id ASC ";
    $list = pdo_fetchall($sql); 
    $total = pdo_fetchcolumn($total_sql);
    $pager = pagination($total, $pindex, $psize);

    $sql1 = "SELECT COUNT(*) num, money FROM ims_hongbao GROUP BY money";
    $list1 = pdo_fetchall($sql1); 
    $pagename = '红包管理';
    template('mc/hongbao-lst');
}

if($do == 'classtype'){
    $type = $_GET['type']; //0未领取、1已领取
    $_W['page']['title'] = '红包管理';
    $groups = mc_groups();
    $pindex = max(1, intval($_GPC['page']));
    $psize = 10;

    $sql = "SELECT *  FROM ".tablename('hongbao')." where `isenvelope` = '".$type."'  ORDER BY id ASC LIMIT  " . ($pindex - 1) * $psize . ',' . $psize;

    $total_sql = "SELECT count(*)  FROM ".tablename('hongbao')." where `isenvelope` = '".$type."'  ORDER BY id ASC ";

    $list = pdo_fetchall($sql); 
    $total = pdo_fetchcolumn($total_sql);
    $pager = pagination($total, $pindex, $psize);

    //统计红包
    $sql1 = "SELECT COUNT(*) num,money   FROM ims_hongbao WHERE isenvelope='".$type."' GROUP BY money";
    $list1 = pdo_fetchall($sql1); 
    if($type == 0){
        $pagename = '未领取红包';
    }elseif ($type == 1) {
        $pagename = '已领取红包';
    }else{
        $pagename = '发送失败红包';
    }
//var_dump($total);die;
    template('mc/hongbao-lst');
}

if($do == 'dowload'){
    load()->classs('hongbao');
    //IA_ROOT
    $id = $_GET['id'];
    $hongbao = pdo_get('hongbao',['id'=>$id]);
    $str = $hongbao['coding'].'--'.$id;
    $path = IA_ROOT.'/uploads/'.$hongbao['coding'].'.png';
    $imgsrc = '/uploads/'.$hongbao['coding'].'.png';
    //没有这个文件就下载
    if(!is_file($path)){

        $myHongbao = new Hongbao();
        $qrcode = $myHongbao->Follow($str);
        $img = file_get_contents($qrcode);

        file_put_contents($path, $img);
    }

    echo '<img src='.$imgsrc.' />';
    echo '<a href='.$imgsrc.' download="'.$hongbao['name'].'-'.$hongbao['id'].'" >下载图片 </a>';
}

if($do == 'edit'){
//IA_ROOT
    $id = $_GET['id'];
    $hongbao = pdo_get('hongbao',['id'=>$id]);
    template('mc/hongbao-edit');
}

if($do == 'savedata'){
    load()->classs('hongbao');
    $data = [
        'name' => $_POST['name'],
        'money' => $_POST['money'],
        'number' => $_POST['number'],
        'product_name' => $_POST['product_name'],
        'product_site' => $_POST['product_site'],
        'product_money' => $_POST['product_money'],
    ];

    if(isset($_POST['id'])){

        $data['id'] = $_POST['id'];
        pdo_update('hongbao',$data,['id'=>$data['id']]);
    }else{
        $myHongbao = new Hongbao();
        $start = $myHongbao->Mymicrotime();
        $i=0;
        //新增保存
        while (true) {

            $end = $myHongbao->Mymicrotime();
            //设置每次for循环都要延迟200毫秒执行。防止图片无法下载
            if($end-$start >= 200){
                $coding = 'TZHB'.$end.rand(1000,9999);
                $data['coding'] = $coding;

                pdo_insert('hongbao',$data);
                $id = pdo_insertid();
                $str = $data['coding'].'--'.$id;
               //下载图片
                $path = IA_ROOT.'/uploads/'.$data['coding'].'.png';

                $qrcode = $myHongbao->Follow($str);
                $img = file_get_contents($qrcode);
                file_put_contents($path, $img);

                // 上一次的结束时间是下一次的开始时间
                 $start = $end;
                 $i++;
                 if($i >= $data['number']){
                     break;
                 }
            }

        }
    }
    itoast('保存成功', url('mc/hongbao/display'), '');
}

if($do == 'add'){
    template('mc/hongbao-add');
}

if($do == 'del'){
    $id = $_GET['id'];
    if(empty($id)){
        itoast('参数为空', url('mc/hongbao/display'), '');

    }
    //先删除二维码图片
    $hongbao = pdo_get('hongbao',['id'=>$id]);
    $path = IA_ROOT.'/uploads/'.$hongbao['coding'].'.png';
    if(is_file($path)){
        unlink($path);
    }
    pdo_delete('hongbao',['id'=>$id]);
    itoast('删除成功', url('mc/hongbao/display'), '');

}

///alldelete 批量删除
if($do == 'alldelete'){
    $ids = $_GET['ids'];
    $ids = rtrim($ids, ',');
    $page=$_GET['page'];
    if(strpos($ids, ',')){
        $idarray = explode(',', $ids);
    }elseif(empty($ids)){
        return ;
    }else{
        $idarray[] = $ids;
    }
    foreach ($idarray as $id) {
            //先删除二维码图片
        $hongbao = pdo_get('hongbao',['id'=>$id]);
        $path = IA_ROOT.'/uploads/'.$hongbao['coding'].'.png';
        // var_dump($path);die;
        if(is_file($path)){
            unlink($path);
        }
        pdo_delete('hongbao',['id'=>$id]);
    }
    itoast('删除成功', url('mc/hongbao/display'), '');
}


//批量下载
if($do == 'alldowload'){
    //文件压缩类
    load()->classs('zipfile');
    //生成二维码图片类
    load()->classs('hongbao');
    $ids = $_GET['ids']; //下载的数据id
    $type = $_GET['type'] ; //下载类型 1 勾选下载 0 范围下载
    $ids = rtrim($ids, ',');

    if($type != 0 && $type != 1){
        return ;
    }


    if(strpos($ids, ',')){
        $idarray = explode(',', $ids);
    }elseif(empty($ids)){
        return ;
    }else{
        $idarray[] = $ids;
    }
    

    if($type == 1){
        //勾选下载
        //遍历所有ids找出都有图片地址，下载
        foreach ($idarray as $key => $id) {
            $hongbao = pdo_get('hongbao',['id'=>$id]);
            //生成二维码图片的参数
            $str = $hongbao['coding'].'--'.$id;
            //二维码的存储地址
            $path = IA_ROOT.'/uploads/'.$hongbao['coding'].'.png';

            //没有这个文件就下载
            if(!is_file($path)){

                $myHongbao = new Hongbao();
                $qrcode = $myHongbao->Follow($str);
                $img = file_get_contents($qrcode);

                file_put_contents($path, $img);
            }
            //图片的地址
            $image[$key]['image_src'] = IA_ROOT.'/uploads/'.$hongbao['coding'].'.png';
            //生成的二维码图片名
            $image[$key]['image_name'] = $hongbao['name'].'-'.$hongbao['id'].'.png';
        }
        

    }elseif($type == 0){
        //范围下载，遍历id再找个范围内的所有数据
        for ($i=$idarray[0]; $i <= $idarray[1]; $i++) { 
            $hongbao = pdo_get('hongbao',['id'=>$i ]);
            //如果没有这条记录 结束本次循环
            if(empty($hongbao)){
                continue;
            }
            //生成二维码的参数
            $str = $hongbao['coding'].'--'.$id;
            //二维码的保存路径
            $path = IA_ROOT.'/uploads/'.$hongbao['coding'].'.png';
            //没有这个文件就下载
            if(!is_file($path)){

                $myHongbao = new Hongbao();
                $qrcode = $myHongbao->Follow($str);
                $img = file_get_contents($qrcode);

                file_put_contents($path, $img);
            }
            //图片的地址
            $image[$i]['image_src'] = IA_ROOT.'/uploads/'.$hongbao['coding'].'.png';
            //生成的二维码图片名
            $image[$i]['image_name'] = $hongbao['name'].'-'.$hongbao['id'].'.png';
        }
    }
    if(empty($image)){
        itoast('所选范围没有内容', url('mc/hongbao/display'), '');
    }
    $dfile = tempnam('/tmp', 'tmp');//产生一个临时文件，用于缓存下载文件

    $zip = new zipfile(); //new一个压缩类

    $filename = date('Y-m-d H:i:s').'.zip'; //下载压缩文件的默认文件名

    foreach($image as $v){
        $zip->add_file(file_get_contents($v['image_src']), iconv("utf-8","gb2312",$v['image_name']));
        // 添加打包的图片，第一个参数是图片内容，第二个参数是压缩包里面的显示的名称, 可包含路径
        // 或是想打包整个目录 用 $zip->add_path($image_path);
    }
    //----------------------
    $zip->output($dfile);

    // 下载文件
    ob_clean();
    header('Pragma: public');
    header('Last-Modified:'.gmdate('D, d M Y H:i:s') . 'GMT');
    header('Cache-Control:no-store, no-cache, must-revalidate');
    header('Cache-Control:pre-check=0, post-check=0, max-age=0');
    header('Content-Transfer-Encoding:binary');
    header('Content-Encoding:utf-8');
    header('Content-type:multipart/form-data');
    header('Content-Disposition:attachment; filename="'.$filename.'"'); //设置下载的默认文件名
    header('Content-length:'. filesize($dfile));
    $fp = fopen($dfile, 'r');
    while(connection_status() == 0 && $buf = @fread($fp, 8192)){
        echo $buf;
    }
    fclose($fp);
    @unlink($dfile);
    @flush();
    @ob_flush();
    exit();

}

if($do == 'hongbaouser'){
    //用户统计页返回所有的领取红包用户列表
    $pindex = max(1, intval($_GPC['page']));
    $psize = 10;

    $sql = "SELECT * FROM (SELECT h.openid openid, m.residecity,b.money,b.gettime,h.uid,m.nickname FROM ims_mc_members m LEFT JOIN ims_mc_mapping_fans h ON m.uid=h.uid LEFT JOIN ims_hongbao b ON b.openid = h.openid WHERE b.id IS NOT NULL AND b.isenvelope=1) a "."  ORDER BY gettime DESC ";


    $list = pdo_fetchall($sql); 
    
    $city = []; //所有的城市
    $list1 = []; //红包统计信息
    //遍历所有的数据，计算每个用户领取红包的总数和总金额
    foreach ($list as $key => $value) {
        //领取红包总数
        $list[$key]['num'] = 0;
        //领取红包总金额
        $list[$key]['totalmoney'] = 0;

        for($i=0;$i<count($list);$i++){

            if($list[$i]['uid'] == $value['uid']){
                $list[$key]['num']++;
                $list[$key]['totalmoney'] += $list[$i]['money'];
            }
        }
        //得到所有的城市
        if(!in_array($value['residecity'], $city)){
            if($value['residecity'] != '市' && !empty($value['residecity'])){
                $city[] = $value['residecity'];
            }  
        }
        
    }
    //取得并组装查询条件$money1 $num1 residecity1
    //总金额
    $totalmoney1 = !empty($_REQUEST['totalmoney1']) ? $_REQUEST['totalmoney1'] : 0;
    $totalmoney2 = !empty($_REQUEST['totalmoney2']) ? $_REQUEST['totalmoney2'] : 1000000;
    //单个金额
    $money1 = !empty($_REQUEST['money1']) ? $_REQUEST['money1'] : 0;
    $money2 = !empty($_REQUEST['money2']) ? $_REQUEST['money2'] : 1000000;
    //红包数量
    $num1 = !empty($_REQUEST['num1']) ? $_REQUEST['num1'] : 0;
    $num2 = !empty($_REQUEST['num2']) ? $_REQUEST['num2'] : 1000000;
    //城市
    $residecity1 = !empty($_REQUEST['residecity1']) ? $_REQUEST['residecity1'] : '';
    //昵称nickname
    $nickname = !empty($_REQUEST['nickname']) ? $_REQUEST['nickname'] : '';
    //使用筛选条件
    foreach ($list as $key => $value) {
        //总金额筛选bccomp用来比较浮点数大小直接用大小号不正确,相等返回0 左边大返回1
        if(bccomp($totalmoney1, $value['totalmoney'],5) == 1   || bccomp($value['totalmoney'], $totalmoney2,5) == 1){

            unset($list[$key]);
        }

        //单个金额筛选
        if(bccomp($money1, $value['money'],5) == 1   || bccomp($value['money'], $money2,5) == 1){

            unset($list[$key]);
        }

        //红包数量筛选
        if(bccomp($num1, $value['num'],5) == 1   || bccomp($value['num'], $num2,5) == 1){

            unset($list[$key]);
        }
        //城市筛选
        if(!empty($residecity1)){
            if($residecity1 == '未知'){
                if( !empty($value['residecity'])  && $value['residecity'] != '市' ){
                    unset($list[$key]);
                }
            }else{
                if($value['residecity'] != $residecity1){
                    unset($list[$key]);
                }
            }
            
        }

        //昵称赛选
        if(!empty($nickname)){
            if(mb_strpos($value['nickname'], $nickname) === false){
                unset($list[$key]);
            }
        }
    }
    //分页
    $start = ($pindex - 1) * $psize;
    $end = $start+$psize;
    $data = [];
    $usertotal = [];
    $i = 0;
    foreach ($list as $key => $value) {
        //统计用户总数量
        if(!in_array($value['uid'], $usertotal)){
            $usertotal[] = $value['uid'];
        }
        
        //分页数据
        if($i >= $start && $i < $end){
            $data[] = $value;    
        }
        $i++;

         //红包统计
        $falg = 0;
        foreach ($list1 as $key1 => $value1) {
            if($value1['money'] == $value['money']){
                $falg = 1;
            }
        }
        if($falg == 0){
            $list1[$key]['num'] = 0;
            $list1[$key]['money'] = $value['money'];
        }
        
        foreach ($list as $key2 => $value2) {
            if($list1[$key]['money'] == $value2['money']){
                $list1[$key]['num']++;
            }
        }
        
    }


    $usertotals = count($usertotal);
    $total = count($list);
    $pager = pagination($total, $pindex, $psize);

    $pagename ='用户领取信息';
    template('mc/hongbaouser');

}
