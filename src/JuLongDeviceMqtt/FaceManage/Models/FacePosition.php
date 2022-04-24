<?php
/**
 * 文件描述
 * Created on 2022/1/24 15:43
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractModel;

class FacePosition extends AbstractModel
{
    /**
     * @var int 左上角横坐标
     */
    public $left;

    /**
     * @var int 左上角纵坐标
     */
    public $top;

    /**
     * @var int 右下角横坐标
     */
    public $right;

    /**
     * @var int 右下角纵坐标
     */
    public $bottom;


    public function deserialize($param) {

        if ($param === null) {
            return;
        }

        if (isset($param["left"])) {
            $this->left = $param["left"];
        }

        if (isset($param['top'])) {
            $this->top = $param['top'];
        }

        if (isset($param['right'])) {
            $this->right = $param['right'];
        }

        if (isset($param['bottom'])) {
            $this->bottom = $param['bottom'];
        }

    }

}