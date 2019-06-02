<?php 


class wechatredbag {
	public $config = [
		//appid是微信公众账号或开放平台APP的唯一标识，在公众平台申请公众账号或者在开放平台申请APP账号后，微信会自动分配对应的appid，用于标识该应用。
		'appid' => 'wxa6d21544d46833ee',
		//微信支付商户号
		'mch_id' => '1272885701',
		//微信支付的key
		'mch_key' => 'OXJCodJKKpSQmmZwrXKrUvQtJhqtSyVE',
		//证书目录是crl
		'zhengshuPath' => 'D:/phpStudy/WWW/gittest/toozan666/cret/'
	];
	

	public function __construct($config =[]){
		if(is_array($config)){
			$this->config = array_merge($this->config,$config);
		}
	}

	//发送微信红包
	public function redBag($openid,$total_amount,$total_num,$order,$wishing='使用奔瑞产品扫码领红包，最高88元！',$act_name='来自奔瑞奖励'){

        $remark = '奔瑞汽车用品';
		$scene_id = 'PRODUCT_1';
		$post = [
			'nonce_str' => $this->randString(),
			'mch_billno' => $order,
			'mch_id' => $this->config['mch_id'],
			'wxappid' => $this->config['appid'],
			'send_name' => '来自奔瑞奖励',
			're_openid' => $openid,
			'total_amount' => ($total_amount)*100,
			'total_num' => $total_num,
			'wishing' => $wishing,
			'client_ip' => '139.227.189.155',  //139.227.189.155    115.159.29.184
			'act_name' => $act_name,
			'remark' => $remark,
			'scene_id' => $scene_id,
		];
		$sign = $this->sign($post);
		$post['sign'] = $sign;
		$post_xml = $this->arr2xml($post);
		$url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';
		$res_xml = $this->sendWx($url, $post_xml);
		$arr = $this->xml($res_xml);

		return $arr;
	}
	//查询红包记录
	public function selectRedBag($mch_billno){
		$post = [
			'nonce_str' => $this->randString(),
			'mch_billno' => $mch_billno,
			'mch_id' => $this->config['mch_id'],
			'appid' => $this->config['appid'],
			'bill_type' => 'MCHT'
		];

		$sign = $this->sign($post);
		$post['sign'] = $sign;
		$post_xml = $this->arr2xml($post);
		$url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/gethbinfo';
		$res_xml = $this->sendWx($url, $post_xml);
		$arr = $this->xml($res_xml);

		return $arr;
	}
	//获取微信rsa公钥
	//需要安装OpenSSL
	public function getRSAFile(){
		$mch_id = $this->config['mch_id'];
		$nonce_str = $this->randString();
		$post = [
			'mch_id' => $mch_id,
			'nonce_str' => $nonce_str,
		];
		$sign = $this->sign($post);
		$post['sign'] = $sign;
		$post_xml = $this->arr2xml($post);
		$url = "https://fraud.mch.weixin.qq.com/risk/getpublickey";
		$res = $this->sendWx($url,$post_xml);
		$res = $this->xml($res);
		if($res['RETURN_CODE'] == 'SUCCESS' && $res['RESULT_CODE'] == 'SUCCESS'){

			if(file_put_contents($this->config['zhengshuPath'].'public.pem', $res['PUB_KEY'])){
				//PKCS#1 转 PKCS#8: 需要安装OpenSSL
				exec("openssl rsa -RSAPublicKey_in -in ".$this->config['zhengshuPath'].'public.pem'." -pubout",$arr);

				$str = '';
				foreach ($arr as $key => $value) {
					$str .= $value ."\n";
				}
				// var_dump($a);
				file_put_contents($this->config['zhengshuPath'].'public.pem', $str);
				return $this->config['zhengshuPath'].'public.pem';
			}else{
				die('生成微信rsa公钥失败！无法提现');
			}
		}else{
			die('获取微信rsa公钥失败！无法提现');
		}


	}
	//使用rsa公钥加密
	public function getpublickey($str){
		
		$file_path = $this->config['zhengshuPath'].'public.pem';
		//没有这个文件就获取文件
		if(!is_file($file_path)){
			$this->getRSAFile();
		}
		if(is_file($file_path)){
			$f= file_get_contents($file_path);
			$pu_key = openssl_pkey_get_public($f);//读取公钥内容
			if(!$pu_key ){
				die('读取公钥内容失败');
			}
			$encryptedBlock = '';
        	$encrypted = '';
			// 用标准的RSA加密库对敏感信息进行加密，选择RSA_PKCS1_OAEP_PADDING填充模式
	        openssl_public_encrypt($str,$encryptedBlock,$pu_key,OPENSSL_PKCS1_OAEP_PADDING);
	        // 得到进行rsa加密并转base64之后的密文
	        $str_base64  = base64_encode($encrypted.$encryptedBlock);
	        return $str_base64;
		}else{
			die('微信rsa公钥不存在');
		}
		
	}
	//请求微信接口
	public function sendWx($url,$data,$headers = []){
		//证书目录
		$zspath = $this->config['zhengshuPath'];
		$ch = curl_init();
		//是否有头信息
		if(!empty($headers)){
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		}

		curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_TIMEOUT,60); //超时时间
        curl_setopt($ch,CURLOPT_SSLCERT,$zspath.'apiclient_cert.pem');
        curl_setopt($ch,CURLOPT_SSLKEY,$zspath.'apiclient_key.pem');

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $data = curl_exec($ch);

        if (!empty($data)){
            curl_close($ch);
            return $data;
        }
        else{
            $error = curl_errno($ch);
            echo "curl出错，错误码:$error"."<br>";
            echo "call faild, errorCode:$error\n";
            curl_close($ch);
            return false;
        }
	}

	//生成32位随机字符串
	static public function randString(){
		$str = "123456789qwertyuiopasdfghjklmnbvcxzQWERTYUIOPLKJHGFDSAZXCVBNM";
		$randString = '';
		for($i=0;$i<32;$i++){
			$k = rand(0,strlen($str)-1);
			$randString .= $str[$k];
		}
		return strtoupper($randString);
	}

	//生成微信规则的签名
	public function sign($data){
		ksort($data);
		$stringA = '';
		foreach ($data as $key => $value) {
			if(!empty($value)){
				if(empty($stringA)){
					$stringA .= $key.'='.$value;
				}else{
					$stringA .= '&'.$key.'='.$value;
				}
			}
		}
		$stringA = $stringA.'&key='.$this->config['mch_key'];

		return strtoupper(md5($stringA));
	}

	//数组转xml
	static public function arr2xml($data, $root = true){
		$str="";
		if($root)
			$str .= "<xml>"."\n";
		foreach($data as $key => $val){
			if(is_array($val)){
			  $child = self::arr2xml($val, false);
			  $str .= "<$key>$child</$key>"."\n";
			}else{
			  $str.= "<$key><![CDATA[$val]]></$key>"."\n";
			}
		}
		if($root)
			$str .= "</xml>";
		return $str;
	}

	//xml转换数组
	public function xml($xml){
        libxml_disable_entity_loader(true);
        $data= json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        $data=array_change_key_case($data,CASE_UPPER);
        return $data;
    }
}