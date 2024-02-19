<?php
set_time_limit(0);

header('Cache-Control: no-cache'); //禁用浏览器缓存
header('X-Accel-Buffering: no'); //适用于Nginx服务器环境
ob_end_flush(); //禁止PHP缓存数据
ob_implicit_flush(1); //打开/关闭绝对刷送，不需要再调用flush()
// JSON 文件路径
$jsonFilePath = 'http://nxu-tzsearch.thisish.cn/pages.json';

// 读取 JSON 文件内容
// if (file_exists($jsonFilePath)) {
    $jsonData = file_get_contents($jsonFilePath);
    $dataArray = json_decode($jsonData, true);
    if (empty($dataArray)) {
        $dataArray = array();
    }
// } else {
//     $dataArray = array();
// }

if (isset($_GET['num'])) {
    $num = $_GET['num'];
} else if (count($dataArray) != 0){
    $num = max($dataArray) + 1;
} else {
    $num = 1022;
}


$url = 'https://tuanwei.nxu.edu.cn/tzgg.htm';
$html = file_get_contents($url);
if (preg_match('/info\/1003\/(\d+).htm/', $html, $matches)) {
    $update_end = intval($matches[1]);
} else {
    die('{"code":401, "error_msg":"未找到结束节点"}');
}

// 创建一个包含 HTTP 头的流上下文以检查响应状态
$options = [
    'http' => [
        'method' => 'GET'
    ],
];

$context = stream_context_create($options);

for (; $num <= $update_end; $num++) {
    $url = 'https://tuanwei.nxu.edu.cn/info/1003/' . $num . '.htm';

    // 使用创建的流上下文调用 file_get_contents
    $html = @file_get_contents($url, false, $context);

    // 检查 file_get_contents 是否成功
    if ($html !== false) {
        $dataArray[] = $num;
        echo $num . ' OK<br>';
    } else {
        echo $num . ' FALSE<br>';
    }
    
}

// 转换关联数组为 JSON 格式
$jsonData = json_encode($dataArray, JSON_PRETTY_PRINT);

// 将 JSON 数据写入文件
file_put_contents($jsonFilePath, $jsonData);