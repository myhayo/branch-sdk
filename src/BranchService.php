<?php


namespace Myhayo\Branch;


use GuzzleHttp\Client;
use Myhayo\Branch\Exceptions\EmptyUuidException;
use Myhayo\Branch\Exceptions\InvalidAccessException;
use Myhayo\Branch\Exceptions\InvalidDeviceActionException;

class BranchService
{
    // 设备系统 - 安卓
    const DEVICE_OS_ANDROID = 1;
    // 设备系统 - iOS
    const DEVICE_OS_IOS = 2;

    const DEVICES_OS = [
        self::DEVICE_OS_ANDROID => '安卓',
        self::DEVICE_OS_IOS     => 'iOS',
    ];

    // 设备行为 - 激活
    const DEVICE_ACTION_ACTIVATE_APP = 0;
    // 设备行为 - 注册
    const DEVICE_ACTION_PURCHASE = 1;
    // 设备行为 - 次日留存
    const DEVICE_ACTION_START_APP = 2;

    const DEVICE_ACTIONS = [
        self::DEVICE_ACTION_ACTIVATE_APP => '激活',
        self::DEVICE_ACTION_PURCHASE     => '注册',
        self::DEVICE_ACTION_START_APP    => '次日留存',
    ];

    protected $config;

    public function __construct()
    {
    }

    /**
     * 获取配置信息
     *
     * @param $key
     *
     * @return mixed|null
     */
    protected function getConfig($key)
    {
        if (empty($this->config)) {
            $this->config = config('myhayo_branch');
        }

        return $this->config[$key] ?? null;
    }

    /**
     * 获取请求url
     *
     * @param $q
     *
     * @return string
     */
    protected function getUrl($q): string
    {
        $service = $this->getConfig('service');
        $access_id = $this->getConfig('access_id');

        return "{$service}api/v1/open/{$access_id}/{$q}";
    }

    /**
     * 获取参数
     *
     * @param $params
     *
     * @return array
     */
    protected function getParams($params): array
    {
        $access_key = $this->getConfig('access_key');

        return array_merge($params, [
            'access_key' => $access_key,
        ]);
    }

    /**
     * 初始
     *
     * @param array $device
     *
     * @return mixed|null
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function init(array $device = [])
    {
        $url = $this->getUrl('init');

        $result = $this->postRequest($url, $device);

        if (empty($result) || $result['code'] != 0) {
            return null;
        }

        return $result['data'];
    }

    /**
     * 上报行为
     *
     * @param $uuid
     * @param $action_type
     * @param $action_param
     * @param $device
     *
     * @return mixed|null
     * @throws EmptyUuidException
     * @throws InvalidDeviceActionException
     */
    public function report($uuid, $action_type, $action_param, $device)
    {
        if (!isset(self::DEVICE_ACTIONS[$action_type])) {
            throw new InvalidDeviceActionException();
        }

        if (empty($uuid)) {
            throw new EmptyUuidException();
        }

        $url = $this->getUrl('report');

        $device['uuid'] = $uuid;
        $device['action_type'] = $action_type;
        $device['action_param'] = $action_param;

        $result = $this->postRequest($url, $device);

        if (empty($result) || $result['code'] != 0) {
            return null;
        }

        return $result['data'];
    }

    /**
     * 回调处理
     *
     * @throws EmptyUuidException
     * @throws InvalidAccessException
     */
    public function callback(\Illuminate\Http\Request $request, \Closure $closure)
    {
        $access_key = $request->get('access_key', '');

        // 校验
        if (!$this->verify($access_key)) {
            throw new InvalidAccessException();
        }

        $uuid = $request->get('uuid');
        if (empty($uuid)) {
            throw new EmptyUuidException();
        }

        return $closure($uuid, $request['action'], $request['channel']);
    }

    /**
     * 校验
     *
     * @param $access_key
     *
     * @return bool
     */
    protected function verify($access_key): bool
    {
        return $access_key == $this->getConfig('access_key');
    }

    /**
     * post 请求
     *
     * @param string     $url
     * @param array|null $params
     *
     * @return array|mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function postRequest(string $url, array $params = null)
    {
        $client = new Client();

        $params = $this->getParams($params);

        try {
            $res = $client->post($url, [
                'json' => $params,
            ]);

            return json_decode($res->getBody()->getContents(), true);
        } catch (\Exception $ex) {
        }

        return [];
    }
}