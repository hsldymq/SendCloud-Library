<?php

namespace SendCloud\Request;

use SendCloud\Config as Config;
use SendCloud\ReturnValue as RV;

class WebAPIRequest extends AbstractRequest
{
    /**
     * @var array 请求数据
     */
    private $data = array();

    public function __construct()
    {
        $this->baseUrl = "http://sendcloud.sohu.com/webapi/";
    }

    /**
     * 发送API请求
     *
     * 允许重复发送请求
     *
     * @return null|array 请求参数错误将返回null
     */
    public function send()
    {
        $ch = curl_init($this->requestUrl);

        $cOptions = array(
            CURLOPT_HTTPAUTH => CURLAUTH_BASIC,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_URL => $this->requestUrl,
            CURLOPT_POSTFIELDS => $this->data
        );
        curl_setopt_array($ch, $cOptions);

        return $this->parseReturnData(curl_exec($ch));

    }

    /**
     * 准备请求数据.
     *
     * 在发送数据前,允许对用户自定义的请求数据进行替换
     * 当用户数据中缺乏必要字段时,方法将会从配置中取出预先设置的值进行覆盖.
     *
     * @param array $data POST data
     *
     * @return void
     */
    public function prepareData(array $data)
    {
        $data['api_key'] = Config::get('API_KEY');
        $data['api_user'] = isset($data['api_user']) ? $data['api_user'] : Config::get('API_KEY');
        $this->data = $data;
    }

    /**
     * 设置请求地址.
     *
     * 每当用户设置请求的API模块与行为时,请求地址将发生变化
     *
     * @return void
     */
    protected function prepareUrl()
    {
        $interface = implode(".", array($this->module, $this->action, Config::get('FORMAT')));
        $this->requestUrl = $this->baseUrl . $interface;
    }

    /**
     * 根据格式将返回数据转为关联数组
     *
     * @param mixed $data
     *
     * @return array|null
     */
    private function parseReturnData($data)
    {
        $format = strtolower(Config::get("FORMAT"));
        switch ($format) {
            case "json":
                return RV\Json::parse($data);
                break;
            case "xml":
                return RV\Xml::parse($data);
                break;
        }
    }
}