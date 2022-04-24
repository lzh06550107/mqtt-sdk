<?php
/**
 * 文件描述
 * Created on 2021/12/29 15:43
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

// 扩展人员信息
use JuLongDeviceMqtt\Common\AbstractModel;

class PersonExtension extends AbstractModel
{

    public $PersonCode1;
    public $PersonCode2;
    public $PersonCode3;
    public $PersonReserveName;
    public $PersonParam1;
    public $PersonParam2;
    public $PersonParam3;
    public $PersonParam4;
    public $PersonParam5;
    public $PersonData1;
    public $PersonData2;
    public $PersonData3;
    public $PersonData4;
    public $PersonData5;

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param['PersonCode1'])) {
            $this->PersonCode1 = $param['PersonCode1'];
        }

        if (isset($param['PersonCode2'])) {
            $this->PersonCode2 = $param['PersonCode2'];
        }

        if (isset($param['PersonCode3'])) {
            $this->PersonCode3 = $param['PersonCode3'];
        }

        if (isset($param['PersonReserveName'])) {
            $this->PersonReserveName = $param['PersonReserveName'];
        }

        if (isset($param['PersonParam1'])) {
            $this->PersonParam1 = $param['PersonParam1'];
        }

        if (isset($param['PersonParam2'])) {
            $this->PersonParam2 = $param['PersonParam2'];
        }

        if (isset($param['PersonParam3'])) {
            $this->PersonParam3 = $param['PersonParam3'];
        }

        if (isset($param['PersonParam4'])) {
            $this->PersonParam4 = $param['PersonParam4'];
        }

        if (isset($param['PersonParam5'])) {
            $this->PersonParam5 = $param['PersonParam5'];
        }

        if (isset($param['PersonData1'])) {
            $this->PersonData1 = $param['PersonData1'];
        }

        if (isset($param['PersonData2'])) {
            $this->PersonData2 = $param['PersonData2'];
        }

        if (isset($param['PersonData3'])) {
            $this->PersonData3 = $param['PersonData3'];
        }

        if (isset($param['PersonData4'])) {
            $this->PersonData4 = $param['PersonData4'];
        }

        if (isset($param['PersonData5'])) {
            $this->PersonData5 = $param['PersonData5'];
        }

    }

}