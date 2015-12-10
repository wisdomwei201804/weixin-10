<?php
/**
 * 微信错误管理
 *
 * @author sskaje http://sskaje.me/
 */

/**
 * 微信错误类
 */
class spWxError
{

    /**
     * Default Exception Handler
     *
     * @param $exception
     */
    static public function ExceptionHandler($exception)
    {
        try {
            throw $exception;
        } catch (Exception $e) {
            if (php_sapi_name() == 'cli') {
                echo $e->getMessage() . '#' . $e->getCode() . "\n";
                exit;
            } else {
                spWxLogger::Log(
                    'Exception',
                    [
                        'Message' => $e->getMessage(),
                        'Code'    => $e->getCode(),
                    ]
                );

                echo json_encode([
                    'code'   =>  $e->getCode(),
                    'msg'    =>  $e->getMessage(),
                ], JSON_UNESCAPED_UNICODE);
                exit;
            }
        }
    }

    /**
     * 启用Exception Handler
     *
     * @param callback $handler
     */
    static public function SetExceptionHandler($handler=null)
    {
        if (is_callable($handler)) {
            set_exception_handler($handler);
        } else {
            set_exception_handler([__CLASS__, 'ExceptionHandler']);
        }
    }

    static public $ERROR_CODE = [
        -1	    => '系统繁忙',
        0	    => '请求成功',
        40001	=> '验证失败',
        40002	=> '不合法的凭证类型',
        40003	=> '不合法的OpenID',
        40004	=>	'不合法的媒体文件类型',
        40005	=>	'不合法的文件类型',
        40006	=>	'不合法的文件大小',
        40007	=>	'不合法的媒体文件id',
        40008	=>	'不合法的消息类型',
        40009	=>	'不合法的图片文件大小',
        40010	=>	'不合法的语音文件大小',
        40011	=>	'不合法的视频文件大小',
        40012	=>	'不合法的缩略图文件大小',
        40013	=>	'不合法的APPID',
        40014	=>	'不合法的access_token',
        40014	=>	'不合法的access_token',
        40015	=>	'不合法的菜单类型',
        40016	=>	'不合法的按钮个数',
        40017	=>	'不合法的按钮个数',
        40018	=>	'不合法的按钮名字长度',
        40019	=>	'不合法的按钮KEY长度',
        40020	=>	'不合法的按钮URL长度',
        40021	=>	'不合法的菜单版本号',
        40022	=>	'不合法的子菜单级数',
        40023	=>	'不合法的子菜单按钮个数',
        40024	=>	'不合法的子菜单按钮类型',
        40025	=>	'不合法的子菜单按钮名字长度',
        40026	=>	'不合法的子菜单按钮KEY长度',
        40027	=>	'不合法的子菜单按钮URL长度',
        40028	=>	'不合法的自定义菜单使用用户',
        41001	=>	'缺少access_token参数',
        41002	=>	'缺少appid参数',
        41003	=>	'缺少refresh_token参数',
        41004	=>	'缺少secret参数',
        41005	=>	'缺少多媒体文件数据',
        41006	=>	'缺少media_id参数',
        41007	=>	'缺少子菜单数据',
        42001	=>	'access_token超时',
        43001	=>	'需要GET请求',
        43002	=>	'需要POST请求',
        43003	=>	'需要HTTPS请求',
        44001	=>	'多媒体文件为空',
        44002	=>	'POST的数据包为空',
        44003	=>	'图文消息内容为空',
        45001	=>	'多媒体文件大小超过限制',
        45002	=>	'消息内容超过限制',
        45003	=>	'标题字段超过限制',
        45004	=>	'描述字段超过限制',
        45005	=>	'链接字段超过限制',
        45006	=>	'图片链接字段超过限制',
        45007	=>	'语音播放时间超过限制',
        45008	=>	'图文消息超过限制',
        45009	=>	'接口调用超过限制',
        45010	=>	'创建菜单个数超过限制',
        46001	=>	'不存在媒体数据',
        46002	=>	'不存在的菜单版本',
        46003	=>	'不存在的菜单数据',
        47001	=>	'解析JSON/XML内容错误',
    ];
}

/**
 * 异常 spWxException
 */
class spWxException extends Exception {}



# EOF