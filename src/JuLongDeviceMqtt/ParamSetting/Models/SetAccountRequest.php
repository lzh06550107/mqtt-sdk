<?php
/**
 * 文件描述
 * Created on 2022/2/15 11:36
 * Create by LZH
 */

declare(strict_types=1);

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
    private $LastAccount;

    /**
     * @var string 新用户名
     */
    private $Username;

    /**
     * @var string 新密码
     */
    private $Password;

    /**
     * 构造函数
     */
    public function __construct()
    {
        $this->setAction(ParamSettingAction::SET_ACCOUNT); // 初始化动作名称
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

    /**
     * @return string
     */
    public function getLastAccount(): string
    {
        return $this->LastAccount;
    }

    /**
     * @param string $LastAccount
     */
    public function setLastAccount(string $LastAccount): void
    {
        $this->LastAccount = $LastAccount;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->Username;
    }

    /**
     * @param string $Username
     */
    public function setUsername(string $Username): void
    {
        $this->Username = $Username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->Password;
    }

    /**
     * @param string $Password
     */
    public function setPassword(string $Password): void
    {
        $this->Password = $Password;
    }

}