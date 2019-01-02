<?php
namespace swiftphp\common\util;

/**
 * URL辅助类
 * @author Tomix
 *
 */
class UrlUtil
{

    /**
     * 把键值对数组拼装成url参数字符串
     * @param array $params     键值对数组
     * @param string|array $removeKey 移除的键
     */
    public static function joinUrlParams($params=[],$removeKeys=[])
    {
        if(!is_array($removeKeys)){
            $removeKeys=[$removeKeys];
        }
        $url="";
        foreach ($params as $k=>$v){
            if(!in_array($k, $removeKeys)){
                $url.="&".$k."=".urlencode($v);
            }
        }
        if(!empty($url)){
            $url=substr($url, 1);
        }
        return $url;
    }

    /**
     * 附加参数到URL
     * @param string $url
     * @param array $appendParams
     * @return string
     */
    public static function appendUrlParams($url,$appendParams=[])
    {
        if(empty($appendParams)){
            return $url;
        }
        $paramString="";
        foreach ($appendParams as $key => $value){
            $paramString.="&".$key."=".urlencode($value);
        }
        $paramString=substr($paramString, 1);

        $pos=strpos($url, "?");
        if($pos>0 || $pos===0){
            $url.="&".$paramString;
        }else{
            $url.="?".$paramString;
        }
        return $url;
    }

    /**
     * 从URL移除参数
     * @param string $url
     * @param array $removeKeys
     */
    public static function removeUrlParams($url,$removeKeys)
    {
        if(empty($removeKeys)){
            return $url;
        }
        $pos=strpos($url, "?");
        if($pos>0 || $pos===0){
            $baseUrl=substr($url, 0,$pos);
            $paramStr=substr($url, $pos+1);
            if(empty($paramStr)){
                return $url;
            }
            $params=explode("&", $paramStr);
            $paramStr="";
            foreach ($params as $param){
                $kv=explode("=", $param);
                if(!in_array($kv[0], $removeKeys)){
                    $paramStr.="&".$kv[0]."=".(count($kv)>1?$kv[1]:"");
                }
            }
            if(!empty($paramStr)){
                $paramStr=substr($paramStr, 1);
            }
            if(!empty($paramStr)){
                $baseUrl=$baseUrl."?".$paramStr;
            }
            return $baseUrl;
        }else{
            return $url;
        }
    }
}

