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
$html = file_get_contents('https://tuanwei.nxu.edu.cn/info/1003/1022.htm');

// 创建 DOMDocument 对象
$dom = new DOMDocument();

// 忽略 HTML 错误
libxml_use_internal_errors(true);

// 加载 HTML 内容到 DOMDocument
$dom->loadHTML($html);

// 恢复错误处理
libxml_clear_errors();

// 使用 XPath 查询获取 class 为 "abd" 的 div 内容
$xpath = new DOMXPath($dom);
$divs = $xpath->query('//div[contains(@class, "abd")]');

// 遍历匹配的 div 元素并输出其内容
foreach ($divs as $div) {
    echo $dom->saveHTML($div);
}