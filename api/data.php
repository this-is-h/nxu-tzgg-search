<?php
function httpRequest($url, $params, $post = true)
{
    $header = [
            'Content-Type: application/json; charset=utf-8',
    ];

    $ch = curl_init();
    if ($post) {
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    } elseif (is_array($params) && 0 < count($params)) {
        curl_setopt($ch, CURLOPT_URL, $url . "?" . http_build_query($params));
    } else {
        curl_setopt($ch, CURLOPT_URL, $url);
    }
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FORBID_REUSE, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $data = curl_exec($ch);
    if (curl_error($ch)) {
        echo curl_error($ch);
        return null;
    }
    curl_close($ch);
    return $data;
}

// echo httpRequest('https://tuanwei.nxu.edu.cn/info/1003/1022.htm', array(), false);
echo file_get_contents('https://tuanwei.nxu.edu.cn/info/1003/1022.htm');