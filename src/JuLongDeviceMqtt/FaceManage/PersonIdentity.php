<?php

namespace JuLongDeviceHttp\FaceManage;

/**
 * 人员身份，用于名单分类
 * Created on 2021/12/28 14:22
 * Create by LZH
 */
class PersonIdentity
{
    /**
     * 所有分类
     */
    public const ALL = 0;
    /**
     * 老师
     */
    public const TEACHER = 1;
    /**
     * 走读学生
     */
    public const DAY_STUDENT = 2;
    /**
     * 寄宿学生
     */
    public const BOARDING_STUDENT = 3;
    /**
     * 访客
     */
    public const VISITOR  = 4;

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