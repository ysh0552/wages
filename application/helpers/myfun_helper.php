<?php

/**
 * 片区经理接口
 */
function getAreaInterface($url,$params=array(),$method='POST'){
	$interfaceUrl = 'http://10.22.1.67:8023/api/'; //'http://10.21.1.42:8003/api/'; //
	$info = request($interfaceUrl.$url,$params,$method);
	return $info;
}



/**
 * 接口请求POST
 */
function getInterface($url,$params=array(),$code,$method = 'POST'){
	$header = 'Authorization: Bearer ';
	$interfaceUrl = 'http://10.22.1.198:8004/api/';
	$headerArr = array(
			$header.$code,
	);
	$info = request($interfaceUrl.$url,$params,$method,false,$headerArr);
	
	return $info;
}

/**
 * 获取接口请求头
 */
function getInterfaceHeader(){
	$url = "http://202.105.107.30:8002/authtoken";
	$params = array(
			'grant_type'=>'password',
			'username'=>'WeChatMall',
			'password'=>'kfrWrJQNWrq5q2Tw33WOdX2CgilAPzvJ8AJFbPHzUYy19BC50FcbZYWn2RZcouPmXwxMZgUvnMIoj0ZwFuP3SMtdPLSn7r4KgqYVFjdipiUoGwwJ9uuahGAYSxsL8lCL'
	);
	$getHeaderStr = request($url,$params,'POST');
	return $getHeaderStr;
}


/**
 * 发起一个HTTP/HTTPS的请求
 * @param $url 接口的URL
 * @param $params 接口参数   array('content'=>'test', 'format'=>'json');
 * @param $method 请求类型    GET|POST
 * @param $multi 图片信息
 * @param $extheaders 扩展的包头信息 ('Content-Type:application/x-www-form-urlencoded')
 * @return string
 */
function request($url , $params = array(), $method = 'GET' , $multi = false, $extheaders = array('Content-Type:application/x-www-form-urlencoded'))
{
	if(!function_exists('curl_init')) exit('Need to open the curl extension');
	$method = strtoupper($method);
	$ci = curl_init();
	curl_setopt($ci, CURLOPT_USERAGENT, 'PHP-SDK OAuth2.0');
	curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 3);
	curl_setopt($ci, CURLOPT_TIMEOUT, 3);
	curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ci, CURLOPT_HEADER, false);
	$headers = (array)$extheaders;
	switch ($method)
	{
		case 'POST':
			curl_setopt($ci, CURLOPT_POST, TRUE);
			if (!empty($params))
			{
				if($multi)
				{
					foreach($multi as $key => $file)
					{
						$params[$key] = '@' . $file;
					}
					curl_setopt($ci, CURLOPT_POSTFIELDS, $params);
					$headers[] = 'Expect: ';
				}
				else
				{
					curl_setopt($ci, CURLOPT_POSTFIELDS, http_build_query($params));
				}
			}
			break;
		case 'DELETE':
		case 'GET':
			$method == 'DELETE' && curl_setopt($ci, CURLOPT_CUSTOMREQUEST, 'DELETE');
			if (!empty($params))
			{
				$url = $url . (strpos($url, '?') ? '&' : '?')
				. (is_array($params) ? http_build_query($params) : $params);
			}
			break;
	}
	curl_setopt($ci, CURLINFO_HEADER_OUT, TRUE );
	curl_setopt($ci, CURLOPT_URL, $url);
	if($headers)
	{
		curl_setopt($ci, CURLOPT_HTTPHEADER, $headers );
	}
	

	if (curl_errno($ci)) {
    	echo 'Curl error: ' . curl_error($ci);
	}
	$response = curl_exec($ci);
	curl_close ($ci);
	return json_decode($response);
}




/**
 * 案例图片显示
 **/
function caseImg($title,$imgurl,$content,$link){
	
	if(empty($title)){
		$str = '没有数据';
		$title = $str;
		$imgurl =  base_url('index/noimages.jpg');
		$contents = $str;
		$links = '';
	}else{
		$links = $link?site_url('cases/casecon').'/'.$link:'#';
		$contents = str_replace('|','<br/>',strip_tags($content));
		if($imgurl){
			$imgurl = base_url('upload').'/'.$imgurl;
		}else{
			$imgurl = base_url('index/noimages.jpg');	
		}
	}
	
	$html = '';
	$html .= '<a href="'.$links.'">';
	$html .= '<img src="'.$imgurl.'" class="img">';
	$html .= '<div class="cover_case"><p><span class="tittle">'.$title.'</span><span class="des">'.$contents.'</span></p></div>';
	$html .= '</a> ';
	
	
	return $html;
	
}






/* -----------------------------------------------------------
 * 处理缩略图（源文件路径，保存缩略图路径，图片类型，最大宽度，最大高度）
 * ---------------------------------------------------------- */
function imgThumb($sourceFile,$thumbUrl,$types,$maxwidth=120,$maxheight=120)
{
	if($types !='')
	{
		$imgs=getimagesize($sourceFile);
		$im='';
		switch($types){
			case 'jpg':
				$im=imagecreatefromjpeg($sourceFile);
				break;
			case 'png':
				$im=imagecreatefrompng($sourceFile);
				break;
			case 'gif':
				$im=imagecreatefromgif($sourceFile);
				break;
			case 'bmp':
				$im=imagecreatefromwbmp($sourceFile);
				break;
			default:
				echo '文件类型错误！';
				return;
		}
	}
	
	$width = imagesx($im);
	$height = imagesy($im);
	$RESIZEWIDTH=false;
	$RESIZEHEIGHT=false;
	if(($maxwidth && $width > $maxwidth) || ($maxheight && $height > $maxheight)){
		if($maxwidth && $width > $maxwidth){
			$widthratio = $maxwidth/$width;
			$RESIZEWIDTH=true;
		}
		if($maxheight && $height > $maxheight){
			$heightratio = $maxheight/$height;
			$RESIZEHEIGHT=true;
		}
		if($RESIZEWIDTH && $RESIZEHEIGHT){
			if($widthratio < $heightratio){
				$ratio = $widthratio;
			}else{
				$ratio = $heightratio;
			}
		}elseif($RESIZEWIDTH){ 
			$ratio = $widthratio;
		}elseif($RESIZEHEIGHT){ 
			$ratio = $heightratio;
		}
			$newwidth = $width * $ratio; 
			$newheight = $height * $ratio; 						
	}else{
		$newwidth = $width; 
		$newheight = $height; 						
	}
			
	/* 图像失真解决 */
	if(function_exists("imagecopyresampled"))
	{
		$thumb=imagecreatetruecolor($newwidth,$newheight);
		imagecopyresampled($thumb,$im,0,0,0,0,$newwidth,$newheight,$imgs[0],$imgs[1]);
	}else{
		$thumb=imagecreate($newwidth,$newheight);
		imagecopyresized($thumb,$im,0,0,0,0,$newwidth,$newheight,$imgs[0],$imgs[1]);
	}
	
	imagejpeg($thumb,$thumbUrl);
	imagedestroy($thumb);
				
}

function delDirAndFile( $dirName )
{
if($handle = opendir("$dirName")){
	while(false !== ( $item = readdir( $handle ) ) ){
		if($item != "." && $item != ".." ){
		if(is_dir( "$dirName/$item" ) ) {
			delDirAndFile( "$dirName/$item" );
		}else{
		if(unlink( "$dirName/$item"))echo "";

				}
			}
		}
		closedir($handle);
		if(rmdir($dirName))echo "";
	}
}


/* ----------------------------------------
 * 该函数用于删除文件和文件夹
 * ---------------------------------------- */
function dirDelete($dir){

	$dir = dirPath($dir);
	if (!is_dir($dir)){
		return false;
	}
	$list = glob($dir.'*');
	foreach ($list as $v){
		is_dir($v)?dirDelete($v):@unlink(iconv('utf-8','gb2312',$v),0777,true);
	}
	return @rmdir($dir);
}


/* ----------------------------------------
 * 该函数用于将路径标准化
 * ---------------------------------------- */
function dirPath($path){
	$path = str_replace('\\', '/', $path);
	if (substr($path, -1) != '/')
	$path = $path . '/';
	return $path;
}


/* ----------------------------------------
 * 判断是手机访问还是电脑访问
 * ---------------------------------------- */
function isMobile(){ 
	$useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : ''; 
	$useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';    
	function CheckSubstrs($substrs,$text)
	{ 
		foreach($substrs as $substr) 
			if(false!==strpos($text,$substr)){ 
				return true; 
			}
		return false; 
	}
	$mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
	$mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod'); 
	$found_mobile=CheckSubstrs($mobile_os_list,$useragent_commentsblock) || 
	CheckSubstrs($mobile_token_list,$useragent); 
	if ($found_mobile){ 
		return true; 
	}else{ 
		return false; 
	} 
}



/* ----------------------------------------
 * 获取客户端IP
 * ---------------------------------------- */
function getIP()
{
	global $ip;
	if (getenv("HTTP_CLIENT_IP"))
	$ip = getenv("HTTP_CLIENT_IP");
	else if(getenv("HTTP_X_FORWARDED_FOR"))
	$ip = getenv("HTTP_X_FORWARDED_FOR");
	else if(getenv("REMOTE_ADDR"))
	$ip = getenv("REMOTE_ADDR");
	else $ip = "Unknow";
	return $ip;
}

//操作提示,跳转链接
function admin_msg($url='back',$msg='')
{
	header("Content-type:text/html;charset=utf-8");
	echo '<script type="text/javascript">';

	if($msg !='')
	{
		echo 'alert("'.$msg.'");';
	}
	if($url == 'back')
	{
		echo 'history.go(-1)';
	}else{
		echo 'location.href="'.site_url($url).'"';
	}
	echo '</script>';
	
}


/* ----------------------------------------
 * 获取字符串字节数
 * ---------------------------------------- */
function hmStrlen($str){
	if($str == "") return 0;
	$length = strlen($str);
	$i = 0;
	$bytes = 0;
	while($i<$length){
		$asc2 = ord(substr($str, $i, 1));
		if($asc2 >= 224){
			$bytes += 2;
			$i += 3;
		}elseif($asc2 >= 192){
			$bytes += 2;
			$i += 2;
		}else{
			$i++;
			$bytes++;
		}
	}
	return $bytes;
}

/* ----------------------------------------
 * 以字节数截取字符串
 * ---------------------------------------- */
function hmSubstr($str, $byte){
	if(is_null($str)) return "";
	if($str == "") return  "";
	if($byte < 1) return $str;
	$len = strlen($str);
	if($len < $byte) return $str;
	$num = 0;
	$result = "";
	$i = 0;
	while($i < $len){
		$asc2 = ord(substr($str, $i, 1));
		if($asc2 >= 224){
			$space = 3;
		}elseif($asc2 >= 192){
			$space = 2;
		}else{
			$space = 1;
		}
		$num += ($space > 1) ? 2 : 1;
		if($num > $byte){
			return $result;
		}elseif($num == $byte){
			return ($i + $space == $len) ? $str : ($result."..") ;
		}else{
			$result .= substr($str, $i, $space);
			if(($num + 1 > $byte) && ($i + $space < $len)){
				return $result."..";
			}
			
		}
		$i += $space;
	}
	return $result;
}









?>