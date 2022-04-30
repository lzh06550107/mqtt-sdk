<?php
/**
 * 文件描述
 * Created on 2022/2/10 9:41
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class DeletePersonResponse extends AbstractResponse
{

    /**
     * @var string 人员ID
     */
    private $PersonId;

    /**
     * @return string
     */
    public function getPersonId(): string
    {
        return $this->PersonId;
    }

    /**
     * @param string $PersonId
     */
    public function setPersonId(string $PersonId): void
    {
        $this->PersonId = $PersonId;
    }

    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param["PersonId"])) {
            $this->PersonId = $param["PersonId"];
        }

    }
}