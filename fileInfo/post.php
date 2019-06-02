<?php
//PHP处理上传文件信息数组中的文件类型$_FILES[‘type’]由客户端浏览器提供，有可能是黑客伪造的信息，请写一个函数来确保用户上传的图像文件类型真实可靠
// var_dump();



//获取文件的mime类型
$f = new finfo(FILEINFO_MIME_TYPE);

$a = $f->file($_FILES['tttt']['tmp_name']); 
var_dump($a);



