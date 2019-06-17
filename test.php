<?php



function getCurlCommand() {
    try {
        if (php_sapi_name() == 'error cli') {
            throw new Exception("cli");
        }

        $curl_command = 'curl ';
        $post_data = $get_data = '';

        if($_GET) {
            $gets = http_build_query($_GET);
            $get_data .= strpos($curl_command, '?') ? '&' . $gets : '?' . $gets;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $posts = http_build_query($_POST);
            $post_data = ' -d "' . $posts . '"';
        }

        $path = isset($_SERVER['SCRIPT_NAME']) ? $_SERVER['SCRIPT_NAME'] : $_SERVER['PHP_SELF'];
        $curl_command .= '"' . "http://{$_SERVER['HTTP_HOST']}" . $path . $get_data . '"';
        if ($post_data) {
            $curl_command .= $post_data;
        }

        $headers = array();
        if (function_exists('getallheaders')) {
            $headers = getallheaders();
        } else {
            foreach ($_SERVER as $name => $value) {
                if (substr($name, 0, 5) == 'HTTP_') {
                    $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
                }
            }
        }
        foreach ($headers as $key => $value) {
            if($key == 'Accept-Encoding')  $value = str_replace('gzip, ', '', $value);
            $curl_command .= ' -H "' . $key . ':' . $value . '"';
        }

        return $curl_command;
    } catch (Exception $e) {
        return $e->getMessage();
    }

}

echo getCurlCommand();


