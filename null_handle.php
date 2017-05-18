<?php

//数据null处理
/*
 * 该方法递归判断传入的数组中的每一个值是否为null,若为Null，则转换为""
 * $array:为要处理的数组或字符串
 * $replace:为null要 替换成的字符串，默认为""
 * */
function null_handle(&$array,$replace=""){
    if(is_array($array)){
        foreach($array as $first_key=>&$first_item){
            if(is_null($first_item)){
                $array[$first_key] = &$replace;               
            }
            if(is_array($first_item)){
                null_handle($first_item,$replace);
            }
        }
    }else{
        $array = $replace;
    }

    return $array;
}

?>