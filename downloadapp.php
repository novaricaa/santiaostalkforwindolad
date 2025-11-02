<?php
// 固定的目标文件链接（改成你要下载的地址）
$url = "https://santiao.oss-cn-hongkong.aliyuncs.com/santiao-x64.zip";  

// 取出文件名
$filename = basename($url);

// 获取远程文件内容
$fileContent = @file_get_contents($url);

// 判断是否成功获取
if ($fileContent === false) {
    header("HTTP/1.1 404 Not Found");
    exit("无法下载指定文件。");
}

// 设置浏览器响应头，让浏览器弹出下载框
header("Content-Description: File Transfer");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Expires: 0");
header("Cache-Control: must-revalidate");
header("Pragma: public");
header("Content-Length: " . strlen($fileContent));

// 输出文件内容
echo $fileContent;
exit;
?>
