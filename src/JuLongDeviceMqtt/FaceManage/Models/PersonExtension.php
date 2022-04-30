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
    private $PersonCode1;
    private $PersonCode2;
    private $PersonCode3;
    private $PersonReserveName;
    private $PersonParam1;
    private $PersonParam2;
    private $PersonParam3;
    private $PersonParam4;
    private $PersonParam5;
    private $PersonData1;
    private $PersonData2;
    private $PersonData3;
    private $PersonData4;
    private $PersonData5;

    /**
     * @return mixed
     */
    public function getPersonCode1()
    {
        return $this->PersonCode1;
    }

    /**
     * @param mixed $PersonCode1
     */
    public function setPersonCode1($PersonCode1): void
    {
        $this->PersonCode1 = $PersonCode1;
    }

    /**
     * @return mixed
     */
    public function getPersonCode2()
    {
        return $this->PersonCode2;
    }

    /**
     * @param mixed $PersonCode2
     */
    public function setPersonCode2($PersonCode2): void
    {
        $this->PersonCode2 = $PersonCode2;
    }

    /**
     * @return mixed
     */
    public function getPersonCode3()
    {
        return $this->PersonCode3;
    }

    /**
     * @param mixed $PersonCode3
     */
    public function setPersonCode3($PersonCode3): void
    {
        $this->PersonCode3 = $PersonCode3;
    }

    /**
     * @return mixed
     */
    public function getPersonReserveName()
    {
        return $this->PersonReserveName;
    }

    /**
     * @param mixed $PersonReserveName
     */
    public function setPersonReserveName($PersonReserveName): void
    {
        $this->PersonReserveName = $PersonReserveName;
    }

    /**
     * @return mixed
     */
    public function getPersonParam1()
    {
        return $this->PersonParam1;
    }

    /**
     * @param mixed $PersonParam1
     */
    public function setPersonParam1($PersonParam1): void
    {
        $this->PersonParam1 = $PersonParam1;
    }

    /**
     * @return mixed
     */
    public function getPersonParam2()
    {
        return $this->PersonParam2;
    }

    /**
     * @param mixed $PersonParam2
     */
    public function setPersonParam2($PersonParam2): void
    {
        $this->PersonParam2 = $PersonParam2;
    }

    /**
     * @return mixed
     */
    public function getPersonParam3()
    {
        return $this->PersonParam3;
    }

    /**
     * @param mixed $PersonParam3
     */
    public function setPersonParam3($PersonParam3): void
    {
        $this->PersonParam3 = $PersonParam3;
    }

    /**
     * @return mixed
     */
    public function getPersonParam4()
    {
        return $this->PersonParam4;
    }

    /**
     * @param mixed $PersonParam4
     */
    public function setPersonParam4($PersonParam4): void
    {
        $this->PersonParam4 = $PersonParam4;
    }

    /**
     * @return mixed
     */
    public function getPersonParam5()
    {
        return $this->PersonParam5;
    }

    /**
     * @param mixed $PersonParam5
     */
    public function setPersonParam5($PersonParam5): void
    {
        $this->PersonParam5 = $PersonParam5;
    }

    /**
     * @return mixed
     */
    public function getPersonData1()
    {
        return $this->PersonData1;
    }

    /**
     * @param mixed $PersonData1
     */
    public function setPersonData1($PersonData1): void
    {
        $this->PersonData1 = $PersonData1;
    }

    /**
     * @return mixed
     */
    public function getPersonData2()
    {
        return $this->PersonData2;
    }

    /**
     * @param mixed $PersonData2
     */
    public function setPersonData2($PersonData2): void
    {
        $this->PersonData2 = $PersonData2;
    }

    /**
     * @return mixed
     */
    public function getPersonData3()
    {
        return $this->PersonData3;
    }

    /**
     * @param mixed $PersonData3
     */
    public function setPersonData3($PersonData3): void
    {
        $this->PersonData3 = $PersonData3;
    }

    /**
     * @return mixed
     */
    public function getPersonData4()
    {
        return $this->PersonData4;
    }

    /**
     * @param mixed $PersonData4
     */
    public function setPersonData4($PersonData4): void
    {
        $this->PersonData4 = $PersonData4;
    }

    /**
     * @return mixed
     */
    public function getPersonData5()
    {
        return $this->PersonData5;
    }

    /**
     * @param mixed $PersonData5
     */
    public function setPersonData5($PersonData5): void
    {
        $this->PersonData5 = $PersonData5;
    }

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