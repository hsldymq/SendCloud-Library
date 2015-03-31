<?php

namespace SendCloud\Request;

abstract class AbstractRequest
{
    /**
     * @var string SendCloud接口基础地址
     */
    protected $baseUrl;

    /**
     * @var string 实际请求地址
     */
    protected $requestUrl;

    /**
     * @var string 模块
     */
    protected $module = "";

    /**
     * @var string 动作
     */
    protected $action = "";

    public function setModule($module)
    {
        $this->$module = is_string($module) ? $module : $this->$module;
        $this->prepareUrl();
    }

    public function setAction($action)
    {
        $this->$action = is_string($action) ? $action : $this->$action;
        $this->prepareUrl();
    }

    abstract protected function prepareUrl();
}