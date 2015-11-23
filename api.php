<?php

require(__DIR__ . '/config/error.php');
require(__DIR__ . '/classes/weixin.class.php');
require(__DIR__ . '/classes/request.class.php');
require(__DIR__ . '/classes/response.class.php');

require(__DIR__ . '/config/app_config.php');

$app_file = __DIR__ . '/app/' . SPWX_APP_NAME . '.php';
if (!is_file($app_file)) {
    throw new SPException('微信应用文件不存在', 1001);
}

require($app_file);

foreach ($GLOBALS['REQUEST_HANDLERS'] as $request_type=>$handler_class) {
    if (!class_exists($handler_class) || !is_subclass_of($handler_class, 'spWxRequest')) {
        throw new SPException('微信请求处理类'.$handler_class.'定义错误', 1002);
    }

    spWxMessage::RegisterHandler($request_type, $handler_class);
}

spWxMessage::MessageAPI();
exit;