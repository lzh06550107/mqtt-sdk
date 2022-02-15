<?php
/**
 * 文件描述
 * Created on 2022/2/15 11:36
 * Create by LZH
 */

namespace JuLongDeviceMqtt\ParamSetting\Models;

use JuLongDeviceMqtt\Common\AbstractRequest;
use JuLongDeviceMqtt\ParamSetting\ParamSettingAction;

/**
 * 用户名密码设置
 * Created on 2022/2/15 11:36
 * Create by LZH
 */
class SetAccountRequest extends AbstractRequest
{
    /**
     * @var string 旧账号密码的MD5加密(小写)，拼接格式: username:password。例: admin:admin
     */
    public $LastAccount;

    /**
     * @var string 新用户名
     */
    public $Username;

    /**
     * @var string 新密码
     */
    public $Password;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->Action = ParamSettingAction::SET_ACCOUNT; // 初始化动作名称
    }

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param["LastAccount"])) {
            $this->LastAccount = $param["LastAccount"];
        }

        if (isset($param["Username"])) {
            $this->Username = $param["Username"];
        }

        if (isset($param["Password"])) {
            $this->Password = $param["Password"];
        }
    }
}