<?php
/**
 * 文件描述
 * Created on 2022/2/11 8:59
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

/**
 * 人脸属性对象类
 * Created on 2022/2/11 8:59
 * Create by LZH
 */
class FaceAttribute extends AbstractModel
{
    /**
     * @var int 年龄
     */
    private $Age;

    /**
     * @var int 性别 1：男；2：女
     */
    private $Gender;

    /**
     * @var int 佩戴眼镜 0：不戴眼镜；1：戴眼镜；2：戴太阳镜
     */
    private $Glasses;

    /**
     * @var int 口罩/面具 0：不佩戴口罩/面具；1：佩戴口罩/面具
     */
    private $Mask;

    /**
     * @var int 胡子 0：没有胡子；1：有胡子
     */
    private $Beard;

    /**
     * @var int 皮肤种族 1：黄种人；2：黑种人；3：白种人
     */
    private $Race;

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->Age;
    }

    /**
     * @param int $Age
     */
    public function setAge(int $Age): void
    {
        $this->Age = $Age;
    }

    /**
     * @return int
     */
    public function getGender(): int
    {
        return $this->Gender;
    }

    /**
     * @param int $Gender
     */
    public function setGender(int $Gender): void
    {
        $this->Gender = $Gender;
    }

    /**
     * @return int
     */
    public function getGlasses(): int
    {
        return $this->Glasses;
    }

    /**
     * @param int $Glasses
     */
    public function setGlasses(int $Glasses): void
    {
        $this->Glasses = $Glasses;
    }

    /**
     * @return int
     */
    public function getMask(): int
    {
        return $this->Mask;
    }

    /**
     * @param int $Mask
     */
    public function setMask(int $Mask): void
    {
        $this->Mask = $Mask;
    }

    /**
     * @return int
     */
    public function getBeard(): int
    {
        return $this->Beard;
    }

    /**
     * @param int $Beard
     */
    public function setBeard(int $Beard): void
    {
        $this->Beard = $Beard;
    }

    /**
     * @return int
     */
    public function getRace(): int
    {
        return $this->Race;
    }

    /**
     * @param int $Race
     */
    public function setRace(int $Race): void
    {
        $this->Race = $Race;
    }

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param["Age"])) {
            $this->Age = $param["Age"];
        }

        if (isset($param["Gender"])) {
            $this->Gender = $param["Gender"];
        }

        if (isset($param["Glasses"])) {
            $this->Glasses = $param["Glasses"];
        }

        if (isset($param["Mask"])) {
            $this->Mask = $param["Mask"];
        }

        if (isset($param["Beard"])) {
            $this->Beard = $param["Beard"];
        }

        if (isset($param["Race"])) {
            $this->Race = $param["Race"];
        }
    }
}