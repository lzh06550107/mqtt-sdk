<?php

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage;

use Utils\Spl\SplEnum;

/**
 * 人员身份，用于名单分类
 * Created on 2021/12/28 14:22
 * Create by LZH
 */
class PersonIdentity extends SplEnum
{

    /**
     * 所有分类
     */
    const ALL = 0;
    /**
     * 老师
     */
    const TEACHER = 1;
    /**
     * 走读学生
     */
    const DAY_STUDENT = 2;
    /**
     * 寄宿学生
     */
    const BOARDING_STUDENT = 3;
    /**
     * 访客
     */
    const VISITOR  = 4;

    public static function getPersonGroupNameById(int $id) {
        $GroupNames = [
            "所有分组",
            "老师",
            "走读学生",
            "寄宿学生",
            "访客"
        ];
        return $GroupNames[$id] ?? '未知分组';

    }
}