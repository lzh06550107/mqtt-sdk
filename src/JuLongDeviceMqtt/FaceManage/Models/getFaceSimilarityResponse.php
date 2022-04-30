<?php
/**
 * 文件描述
 * Created on 2022/2/10 10:22
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

use JuLongDeviceMqtt\Common\AbstractResponse;

class getFaceSimilarityResponse extends AbstractResponse
{
    /**
     * @var int 相似度阈值
     */
    private $Similarity;

    /**
     * @return int
     */
    public function getSimilarity(): int
    {
        return $this->Similarity;
    }

    /**
     * @param int $Similarity
     */
    public function setSimilarity(int $Similarity): void
    {
        $this->Similarity = $Similarity;
    }


    public function deserialize($param) {

        parent::deserialize($param);

        if ($param === null) {
            return;
        }

        if (isset($param["Similarity"])) {
            $this->Similarity = $param["Similarity"];
        }

    }
}