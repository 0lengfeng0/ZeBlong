<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件

/**
 * ajax返回封装
 * @param bool $status
 * @param string $msg
 * @param array $data
 * @return \think\response\Json
 */
function show($status=false,$msg='',$data=[])
{
    $response = [
        'status'    =>  $status,
        'msg'       =>  $msg,
        'date'      =>  $data
    ];
    return json($response);
}

/**
 * 密码MD5
 */
function md5Str($str,$salt="")
{
    $res = md5($salt.'_'.$str);
    return $res;
}

/**
 * [后台]判断菜单是否被选中的样式调整
 * @param $str controller/action名
 * @param $type 判断类型(1-controller,2-action)
 * @param $choose_name 选中状态css名
 */
function isActive($str = '',$type=1,$choose_name='active')
{
    switch ($type)
    {
        case 1:
            $c = \think\Request::instance()->controller();
            if(is_array($str)){
                if(in_array($c,$str)){
                    return $choose_name;
                }
            }else{
                if((String)$c == (String)$str){
                    return $choose_name;
                }
            }
            break;
        case 2:
            $a = \think\Request::instance()->action();
            if(is_array($str)){
                if(in_array($a,$str)){
                    return $choose_name;
                }
            }else{
                if((String)$a == (String)$str){
                    return $choose_name;
                }
            }
            break;
        default:
            return '';
            break;
    }
    return '';
}