<?php


namespace App\Services;


use App\Vendors\Http;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use App\Vendors\Redis\Wechat;

class OfficialAccountService
{
    protected $config;

    /**
     * @var Wechat
     */
    protected $cache;

    public function __construct()
    {
        $this->cache = new Wechat();
        $this->config = Config::get('wechat.official_account');
    }

    const Template = [
        'deliver'     => 'Uf7LtSHrqwIqPnMEI2xX7JQvlI60fOKJOaV_HV9oZT0',
        'declare'     => 'WjikmBl2sFV-Z18LAQLH0c22yoXxAC8yEJaR-Y-zbyE',
        'pay_success' => 'GYv2-C6aHAYYwtWA_ziuOd1B9HSWlMz5MtSlNBFGCsY',
        'open_vip'    => 'izPtgf2amhBdmnQ_BUSZ-wCCxqt6YuaMr3VKSbhGXbg',
    ];

    /**
     * @param $xml
     * @return string
     */
    public function receipt($xml)
    {
        Log::channel('official_account')->info($xml);
        $data = xml_to_array($xml);
        if ($data['MsgType'] == 'text') {
            return $this->handleTextReceipt($data);
        } else if ($data['MsgType'] == 'event') {
            return $this->handleEventReceipt($data);
        }
    }

    /**
     * 处理事件
     *
     * @param $data
     * @return string
     */
    public function handleEventReceipt($data)
    {
        if ($data['Event'] == 'subscribe') {
            // 被关注回复
            return $this->response($data['FromUserName'], $data['ToUserName'], 'こんにちは，这里有颜值也有气质，终于也有你。');
        } elseif ($data['Event'] == 'CLICK') {
            // 联系我们
            if (Arr::get($data, 'EventKey') == 'contact_us_image') {
                $mediaId = 'w0N5rbqSwlc_lodGiVWV-TRoGzH-TT_aNYV1feElDDw';
                return $this->response($data['FromUserName'], $data['ToUserName'], $mediaId, 'image');
            }
        }
    }

    /**
     * 处理文字
     *
     * @param $data
     * @return string
     */
    public function handleTextReceipt($data)
    {
        return $this->response($data['FromUserName'], $data['ToUserName'], '亲亲，请稍等，客服正从前线赶来回复哟~');
    }

    /**
     * 回复
     *
     * @param $to
     * @param $from
     * @param $content
     * @param string $type
     * @return string
     */
    public function response($to, $from, $content, $type = 'text')
    {
        $data = [
            'ToUserName'   => $to,
            'FromUserName' => $from,
            'CreateTime'   => $from,
            'MsgType'      => $type,
        ];

        if ($type == 'text') {
            $data['Content'] = $content;
        } elseif ($type == 'image') {
            $data['Image']['MediaId'] = $content;
        }

        return array_to_xml($data);
    }


    /**
     * 验证
     *
     * @param $signature
     * @param $timestamp
     * @param $nonce
     * @return bool
     */
    public function checkSignature($signature, $timestamp, $nonce)
    {
        $token = $this->config['token'];
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);

        return $tmpStr == $signature;
    }

    /**
     * 获取token
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getToken()
    {
        if ($token = $this->cache->get('official_account_token')) {
            return $token;
        }
        $url = 'https://api.weixin.qq.com/cgi-bin/token';

        $result = Http::get($url, ['grant_type' => 'client_credential', 'appid' => $this->config['app_id'], 'secret' => $this->config['app_secret']]);
        $token = $result['access_token'];
        $this->cache->set('official_account_token', $token, 7000);
        return $token;
    }

    /**
     * @param $menus
     * @return array|array[]
     */
    public function updateMenu($menus)
    {
        $menuConf = $this->_formatMenu($menus);
        $token = $this->getToken();
        $url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=' . $token;
        return Http::postBody($url, $menuConf);
    }


    /**
     * @param $menus
     * @return array
     */
    private function _formatMenu($menus)
    {
        $results = [];

        foreach ($menus as $menu) {
            if (!empty($menu['children'])) {
                $item = ['name' => $menu['name']];
                foreach ($menu['children'] as $child) {
                    $item['sub_button'][] = $this->_getMenuAttr($child);
                }
                $results[] = $item;
            } else {
                $results[] = $this->_getMenuAttr($menu);
            }

        }
        return ['button' => $results];
    }

    /**
     * 获取menu
     *
     * @param $menu
     * @return array
     */
    private function _getMenuAttr($menu)
    {
        $result = [];
        switch ($menu['type']) {
            case 'click':
                $result = [
                    "type" => "click",
                    "name" => $menu['name'],
                    "key"  => $menu['key'],
                ];
                break;
            case 'view':
                $result = [
                    "type" => "view",
                    "name" => $menu['name'],
                    "url"  => $menu['url'],
                ];
                break;
            case 'media_id' :
                $result = [
                    "type"     => "media_id",
                    "name"     => $menu['name'],
                    "media_id" => $menu['media_id'],
                ];
                break;
        }
        return $result;
    }

}
