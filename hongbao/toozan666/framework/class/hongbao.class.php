<?php
/**
 * Created by PhpStorm.
 * User: YWB
 * Date: 2018/4/26
 * Time: 14:16
 */

/**
 *生成微信公众号的二维码
 */
class Hongbao
{
    //扫码关注
    protected $appid = 'wxa6d21544d46833ee';
    protected $secret = '1baf2b73bb769c33b33ffef39ff07382';
    protected $url = "";
    protected $access_tokens = "";


    public function __construct()
    {
        //获取$access_token
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=" . $this->appid . "&secret=" . $this->secret . "";
        $result = $this->curl_post($url);
        $access_tokens = json_decode($result, true);
        $this->access_tokens = $access_tokens['access_token'];

    }

    public function Follow($str)
    {
        //非必传项
        $rs = $this->getTemporaryQrcode($this->access_tokens, $str);
        $ticket = $rs['ticket'];
        $qrcode = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=" . $ticket . "";
        ///打印二维码显示
        return $qrcode;
    }

//生成二维码
    public function getTemporaryQrcode($access_tokens, $orderId)
    {
        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=" . $access_tokens . "";
//生成二维码需要的参数
        $qrcode = '{"action_name": "QR_LIMIT_STR_SCENE", "action_info": {"scene": {"scene_str": "' . $orderId . '"}}}';
        $momo = json_decode($qrcode, true);
        $result = $this->curl_post($url, $momo);
        $rs = json_decode($result, true);
        return $rs;
    }

    /*
    *得到一个字符串到另一个字符串之间的字符串
     *@parameter startStr string 开始字符串
     *@parameter stopStr string 结束字符串
     *@parameter str string 被截取字符串
     */
    public static function mysubstr($startStr, $stopStr,$str){
        if(empty($startStr)){
            $start = 0;
        }else{
            $start = strpos($str, $startStr)+strlen($startStr);
        }
        if(empty($stopStr)){
            return mb_substr($str, $start);
        }
        $stop = (strlen($str)-strpos($str, $stopStr))*(-1);

        return mb_substr($str, $start,$stop);
    }

    public function curl_post($url, array $params = array())
    {
        $data_string = json_encode($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json'
            )
        );
        $data = curl_exec($ch);
        curl_close($ch);
        return ($data);
    }

    /**xml转数组并且键值全部大写
     * @param $xml xml字符串
     * @return array
     */
    public function xmlToarray($xml){
        //xml转数组
        libxml_disable_entity_loader(true);
        $data= json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        $data=array_change_key_case($data,CASE_UPPER);
        return $data;
    }
    //返回一个微秒时间戳
    function Mymicrotime()
    {
        list($msec, $sec) = explode(' ', microtime());
        $msectime =  (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
        return $msectime;
    }

    // 发红包方法
    public function  sendRedBag($code, $id, $openid){
        include __DIR__.'/wechatredbag.classs.php';

      /*  //找出这条记录用两个参数筛选防止伪造红包
        $hongbao = pdo_get('hongbao',['id'=>$id,'coding'=>$code]);
        if(empty($hongbao)){
            return ;
        }
        //已经领取过了
        if($hongbao['isenvelope'] == 1){
            return ;
        }
        //如果用户openid不为空
        if(!empty($hongbao['openid'])){

            //说明扫码了但是没有发出去红包
            if($openid != $hongbao['openid']){

                //如果再次扫码的用户不是之前的用户。不给发红包直接退出
                return ;
            }
        }*/
        //给用户发钱
        $config = [
            'zhengshuPath' => 'D:\www\Apache24\htdocs\hongbao\toozan666\cert/',
        ];
        $zhifu = new wechatredbag($config);
        $res = $zhifu->redBag('oF_mkjuTLXuwaXEuJq167hLTB1ac',1,1,'TZHB15264357765216439');
        var_dump($res);die;
       // var_dump($res) ;
        if($res['RETURN_CODE'] == 'SUCCESS' && $res['RESULT_CODE'] == 'SUCCESS'){
            //领取完成更新信息
            $update = [
                'isenvelope'=>1,
                'openid' => $openid,
                'gettime' => time(),
            ];
            pdo_update('hongbao',$update, ['id'=>$id]);
        }else{
            //领取完成更新信息
            $update = [
                'isenvelope'=>2,
                'openid' => $openid,
                'gettime' => time(),
            ];
            pdo_update('hongbao',$update, ['id'=>$id]);
        }
    }
}