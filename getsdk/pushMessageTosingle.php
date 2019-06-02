<?php
//消息推送Demo
header("Content-Type: text/html; charset=utf-8");
require_once(dirname(__FILE__) . '/' . 'IGt.Push.php');

//采用"PHP SDK 快速入门"， "第二步 获取访问凭证 "中获得的应用配置
define('APPKEY','6QzJ4uIF5rADSAzvgaX3V8');
define('APPID','B5OWKII10h6Vm52B6czPMA');
define('MASTERSECRET','4PtsoKd793AeZfz0xT3TO1');
define('HOST','http://sdk.open.api.igexin.com/apiex.htm');
define('CID','c8430515535da770e7bdb12194c2ff83');
//别名推送方式
// define('Alias','yyy');

pushMessageToSingle();

//单推接口案例
function pushMessageToSingle(){
    $igt = new IGeTui(HOST,APPKEY,MASTERSECRET);

    //消息模版：
    // 4.NotyPopLoadTemplate：通知弹框下载功能模板
    $template = IGtNotyPopLoadTemplateDemo();


    //定义"SingleMessage"
    $message = new IGtSingleMessage();

    $message->set_isOffline(true);//是否离线
    $message->set_offlineExpireTime(3600*12*1000);//离线时间
    $message->set_data($template);//设置推送消息类型
    //$message->set_PushNetWorkType(0);//设置是否根据WIFI推送消息，2为4G/3G/2G，1为wifi推送，0为不限制推送
    //接收方
    $target = new IGtTarget();
    $target->set_appId(APPID);
    $target->set_clientId(CID);
//    $target->set_alias(Alias);

    try {
        $rep = $igt->pushMessageToSingle($message, $target);
        var_dump($rep);
        echo ("<br><br>");

    }catch(RequestException $e){
        $requstId =$e.getRequestId();
        var_dump($requstId);
        //失败时重发
        $rep = $igt->pushMessageToSingle($message, $target,$requstId);
        var_dump($rep);
        echo ("<br><br>");
    }
}

function IGtNotyPopLoadTemplateDemo(){
        $template =  new IGtNotyPopLoadTemplate();
        $template ->set_appId(APPID);                      //应用appid
        $template ->set_appkey(APPKEY);                    //应用appkey
        //通知栏
        $template ->set_notyTitle("22");                 //通知栏标题
        $template ->set_notyContent("33"); //通知栏内容
        $template ->set_notyIcon("");                      //通知栏logo
        $template ->set_isBelled(true);                    //是否响铃
        $template ->set_isVibrationed(true);               //是否震动
        $template ->set_isCleared(true);                   //通知栏是否可清除
        //弹框
        $template ->set_popTitle("11");              //弹框标题
        $template ->set_popContent("22");            //弹框内容
        $template ->set_popImage("");                      //弹框图片
        $template ->set_popButton1("33");                //左键
        $template ->set_popButton2("11");                //右键
        //下载
        $template ->set_loadIcon("");                      //弹框图片
        $template ->set_loadTitle("23");
        $template ->set_loadUrl("323");
        $template ->set_isAutoInstall(false);
        $template ->set_isActived(true);

        //设置通知定时展示时间，结束时间与开始时间相差需大于6分钟，消息推送后，客户端将在指定时间差内展示消息（误差6分钟）
        $begin = date('Y-m-d H:i:s',strtotime('- 1 day'));
        $end = date('Y-m-d H:i:s',strtotime('+ 1 day'));
        var_dump($begin);
        var_dump($end);
        // $template->set_duration($begin,$end);
        return $template;
}
?>