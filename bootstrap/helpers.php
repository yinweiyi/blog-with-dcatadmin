<?php
/**
 * Created by Idea.
 * User: wayee
 * Date: 2020/4/14
 * Time: 17:24
 */

if (!function_exists('human_filesize')) {

    /**
     * 格式化容量为易读字符串
     *
     * @param int $bytes
     * @param int $decimals
     * @return string
     */
    function human_filesize($bytes, $decimals = 2)
    {
        $sz = 'BKMGTP';
        $factor = floor((strlen($bytes) - 1) / 3);

        return sprintf("%.{$decimals}f ", $bytes / pow(1024, $factor)) . @$sz[$factor];
    }

}

if (!function_exists('obfuscate_string')) {

    /**
     * 模糊字符串
     *
     * @param string $string
     * @param int $keepTail
     * @return string
     */
    function obfuscate_string($string, $keepTail = 0)
    {
        if (empty($string) || !is_string($string)) {
            return '';
        }

        $len = mb_strlen($string);
        $olen = floor($len / 2) - 1;

        if ($len < $keepTail) {
            return $string;
        }

        $tail = mb_substr($string, $len - $keepTail, $keepTail);
        $string = mb_substr($string, 0, $len - $keepTail);
        $nlen = mb_strlen($string);
        if ($olen > $nlen) {
            return str_repeat('*', $nlen) . $tail;
        }

        return mb_substr($string, 0, $nlen - $olen) . str_repeat('*', $olen) . $tail;
    }
}

if (!function_exists('obfuscate_email')) {

    /**
     * 模糊邮箱名
     *
     * @param string $email
     * @param int $keepTail
     * @return string
     */
    function obfuscate_email($email, $keepTail = 0)
    {
        $em = explode('@', $email);
        if (count($em) < 2) {
            return '';
        }

        $name = implode('@', array_slice($em, 0, count($em) - 1));

        return obfuscate_string($name, $keepTail) . '@' . end($em);
    }
}

if (!function_exists('scheme_url')) {
    /**
     * 添加url前缀
     *
     * @param string $url
     * @param string $scheme
     * @return string
     */
    function scheme_url($url, $scheme = 'http://')
    {
        return parse_url($url, PHP_URL_SCHEME) === null ? $scheme . $url : $url;
    }
}

if (!function_exists('object_get_ex')) {
    /**
     * Get an item from an object using "dot" notation.
     *
     * @param object $object
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function object_get_ex($object, $key, $default = null)
    {
        if (is_null($key) || trim($key) == '') {
            return $object;
        }

        foreach (explode('.', $key) as $segment) {
            if (!is_object($object) || is_null($object = $object->{$segment})) {
                return value($default);
            }
        }

        return $object;
    }
}

if (!function_exists('path_active')) {
    /**
     * 根据path设置菜单激活状态
     *
     * @param string|array $path
     * @param string $class
     * @return string
     */
    function path_active($path, $class = 'active')
    {
        return call_user_func_array('\Request::is', (array)$path) ? $class : '';
    }
}

if (!function_exists('request_info')) {
    /**
     * Write some information with request to the log.
     *
     * @param string $message
     * @param mixed $context
     * @return void
     */
    function request_info($message, $context = null)
    {
        $request = app('request');
        $qs = $request->getQueryString();
        $userId = intval(auth()->id());
        $message .= " [{$request->getClientIp()}] [$userId] {$request->getMethod()} {$request->getPathInfo()}" . ($qs ? '?' . $qs : '');

        return app('log')->info($message, [
            'context' => $context,
            'input'   => $request->except(['password', 'password_confirmation']),
            'referer' => $request->server('HTTP_REFERER'),
            'ua'      => $request->server('HTTP_USER_AGENT'),
        ]);
    }
}

if (!function_exists('error_info')) {

    /**
     * 记录错误日志
     *
     * @param $channel
     * @param Exception $exception
     */
    function error_info(\Exception $exception, $channel = 'daily')
    {
        app('log')->channel($channel)->info('Error:' . $exception->getMessage(), [
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
        ]);
    }
}

if (!function_exists('in_wechat')) {
    /**
     * 判断当前访问是否在微信里面
     *
     * @return bool
     */
    function in_wechat()
    {
        return false !== strpos(app('request')->server('HTTP_USER_AGENT'), 'MicroMessenger');
    }
}

if (!function_exists('is_id_card')) {
    /**
     * 是否身份证
     *
     * @param $value
     * @return false|int
     */
    function is_id_card($value)
    {
        return preg_match('/(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/', $value);
    }
}

if (!function_exists('storage_file_path')) {

    /**
     * storage 文件绝对路径
     *
     * @param $path
     *
     * @return string
     */
    function storage_file_path($path)
    {
        $fileSystemConfig = config('filesystems');

        $disk = $fileSystemConfig['disks'][$fileSystemConfig['default']];

        return $disk['root'] . '/' . $path;

    }
}

if (!function_exists('guid')) {
    /**
     * 创建UUID字符串
     * @return string
     */
    function guid()
    {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf(
            '%04X%04X-%04X-%04X-%04X-%04X%04X%04X',
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(16384, 20479),
            mt_rand(32768, 49151),
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(0, 65535)
        );
    }
}

if (!function_exists('object_to_array')) {
    /**
     * 对象转数组
     * @param $object
     * @return mixed
     */
    function object_to_array($object)
    {
        //先编码成json字符串，再解码成数组
        return json_decode(json_encode($object), true);
    }
}

if (!function_exists('is_mobile')) {
    /**
     * 是否手机号
     *
     * @param $value
     * @return false|int
     */
    function is_mobile($value)
    {
        return preg_match('/^1[3456789][0-9]{9}$/', $value);
    }
}

if (!function_exists('array_filter_null')) {
    /**
     * 移除数组null
     *
     * @param $array
     * @return array
     */
    function array_filter_null($array = [])
    {
        return array_filter($array, function ($item) {
            return !is_null($item);
        });
    }
}

if (!function_exists('urlsafe_b64encode')) {
    /**
     * 加密码时把特殊符号替换成URL可以带的内容
     * @param $string
     * @return string|string[]
     */
    function urlsafe_b64encode($string)
    {
        $data = base64_encode($string);
        $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
        return $data;
    }
}

if (!function_exists('urlsafe_b64decode')) {
    /**
     * 解密码时把转换后的符号替换特殊符号
     * @param $string
     * @return false|string
     */
    function urlsafe_b64decode($string)
    {
        $data = str_replace(array('-', '_'), array('+', '/'), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
}

if (!function_exists('asset_min')) {

    /**
     * 获取压缩地址
     *
     * @param $url
     * @return string
     */
    function asset_min($url)
    {
        // 线上用压缩js
        if (app()->environment('product')) {
            $url = preg_replace_callback('/\.\w+/', function ($matches) {
                if (in_array($matches[0], ['.js', '.css'])) {
                    return '.min' . $matches[0];
                }
                return $matches[0];
            }, $url);
        }

        $minFullPath = public_path($url);
        if (is_file($minFullPath)) {
            $lastUpdateTime = filemtime($minFullPath);
            $url = $url . '?t=' . $lastUpdateTime;
        }

        return asset($url);
    }
}

if (!function_exists('is_weixin')) {
    /**
     * 判断是否微信
     *
     * @return bool
     */
    function is_weixin()
    {
        return isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false;
    }
}

if (!function_exists('array_sort')) {
    /**
     * 二维数组排序
     *
     * @param $array
     * @param $keys
     * @param string $sort
     * @return array
     */
    function array_sort($array, $keys, $sort = 'asc')
    {
        $newArr = $valArr = array();
        foreach ($array as $key => $value) {
            $valArr[$key] = $value[$keys];
        }
        ($sort == 'asc') ? asort($valArr) : arsort($valArr);
        reset($valArr);
        foreach ($valArr as $key => $value) {
            $newArr[$key] = $array[$key];
        }
        return array_values($newArr);
    }
}

if (!function_exists('xml_to_array')) {
    /**
     * xml_to_array
     *
     * @param $xml
     * @return mixed
     */
    function xml_to_array($xml)
    {
        //libxml_disable_entity_loader(true);

        return json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA), JSON_UNESCAPED_UNICODE), true);

    }
}

if (!function_exists('array_to_xml')) {
    /**
     * xml_to_array
     *
     * @param $data
     * @param $rootKey
     * @return mixed
     */
    function array_to_xml($data, $rootKey = 'xml')
    {
        $xml = '<' . $rootKey . '>';
        foreach ($data as $key => $val) {
            if (is_numeric($val)) {
                $xml .= '<' . $key . '>' . $val . '</' . $key . '>';
            } else if (is_string($val)) {
                $xml .= '<' . $key . '><![CDATA[' . $val . ']]></' . $key . '>';
            } else if (is_array($val)) {
                $xml .= array_to_xml($val, $key);
            }
        }
        $xml .= '</' . $rootKey . '>';

        return $xml;
    }
}

if (!function_exists('write_file')) {
    /**
     * 文件写稿
     *
     * @param $file
     * @param $data
     * @param $mode
     */
    function write_file($file, $data, $mode = 'w+')
    {
        $fp = fopen($file, $mode);
        if (flock($fp, LOCK_EX)) {
            fwrite($fp, $data);
            flock($fp, LOCK_UN);
        }
        fclose($fp);
    }
}

if (!function_exists('array_insert')) {
    /**
     * 在数组某个位置插入一个值
     *
     * @param $array
     * @param $value
     * @param int $position
     * @return array
     */
    function array_insert($array, $value, $position = 0)
    {
        $fore = ($position == 0) ? array() : array_splice($array, 0, $position);
        $fore[] = $value;
        return array_merge($fore, $array);
    }
}
if (!function_exists('random_color')) {
    /**
     * 随机颜色
     *
     * @return string
     */
    function random_color()
    {
        $colors = array();
        for ($i = 0; $i < 6; $i++) {
            $colors[] = dechex(rand(0, 15));
        }
        return '#' . implode('', $colors);
    }
}

if (!function_exists('unlimited_for_layer')) {
    /**
     * @param $array
     * @param $id
     * @param $level
     * @param $parentId
     * @return array
     */
    function unlimited_for_layer($array, $id = 0, $level = 0, $parentId = 'parent_id')
    {
        $list = array();
        foreach ($array as $k => $v) {
            if ($v[$parentId] == $id) {
                $v['level'] = $level;
                $v['children'] = unlimited_for_layer($array, $v['id'], $level + 1);
                $list[] = $v;
            }
        }
        return $list;
    }
}

if (!function_exists('app_url')) {
    /**
     * APP
     *
     * @param $url
     * @return string
     */
    function app_url($url = '/')
    {
        return $url == '/' ? config('app.url') : config('app.url') . '/' . $url;
    }
}
if (!function_exists('mini_html')) {
    /**
     * mini_html
     *
     * @param $value
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    function mini_html($value)
    {
        $replace = array(
            '/<!--[^\[](.*?)[^\]]-->/s' => '',
            "/\n([\S])/"                => ' $1',
            "/\r/"                      => '',
            "/\n/"                      => '',
            "/\t/"                      => ' ',
            "/ +/"                      => ' ',
        );
        return preg_replace(array_keys($replace), array_values($replace), $value);
    }
}


if (!function_exists('i_view')) {
    /**
     * @param null $view
     * @param array $data
     * @param array $mergeData
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    function i_view($view = null, $data = [], $mergeData = [])
    {
        $view = view($view, $data, $mergeData);
        return mini_html($view);
    }
}
