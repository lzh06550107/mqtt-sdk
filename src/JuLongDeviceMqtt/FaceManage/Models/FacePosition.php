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
    private $left;

    /**
     * @var int 左上角纵坐标
     */
    private $top;

    /**
     * @var int 右下角横坐标
     */
    private $right;

    /**
     * @var int 右下角纵坐标
     */
    private $bottom;

    /**
     * @return int
     */
    public function getLeft(): int
    {
        return $this->left;
    }

    /**
     * @param int $left
     */
    public function setLeft(int $left): void
    {
        $this->left = $left;
    }

    /**
     * @return int
     */
    public function getTop(): int
    {
        return $this->top;
    }

    /**
     * @param int $top
     */
    public function setTop(int $top): void
    {
        $this->top = $top;
    }

    /**
     * @return int
     */
    public function getRight(): int
    {
        return $this->right;
    }

    /**
     * @param int $right
     */
    public function setRight(int $right): void
    {
        $this->right = $right;
    }

    /**
     * @return int
     */
    public function getBottom(): int
    {
        return $this->bottom;
    }

    /**
     * @param int $bottom
     */
    public function setBottom(int $bottom): void
    {
        $this->bottom = $bottom;
    }

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