<?php
if (isset($_GET['num'])) {
    $num = $_GET['num'];
} else {
    $num = 1000;
}

$url = 'https://tuanwei.nxu.edu.cn/info/1003/' . $num . '.htm';

// 创建一个包含 HTTP 头的流上下文以检查响应状态
$options = [
    'http' => [
        'method' => 'GET'
    ],
];

$context = stream_context_create($options);

// 使用创建的流上下文调用 file_get_contents
$html = @file_get_contents($url, false, $context);

// 检查 file_get_contents 是否成功
if ($html === false) {
    // 检查 HTTP 响应代码
    $http_response_header = $http_response_header ?? [];

    if (strpos($http_response_header[0], '404') !== false) {
        http_response_code(404);
        return;
    } else {
        http_response_code(502);
        return;
    }
}

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
$divs = $xpath->query('//div[contains(@class, "ar_article_box")]');

$result = '';
// 遍历匹配的 div 元素并输出其内容
foreach ($divs as $div) {
    $result =  $dom->saveHTML($div);
}

if (empty($result)) {
return;
}

$result = preg_replace('/([cf]=")\//', '$1https://tuanwei.nxu.edu.cn/', $result);
echo $result;