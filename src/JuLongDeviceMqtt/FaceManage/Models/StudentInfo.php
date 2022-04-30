<?php
/**
 * 文件描述
 * Created on 2021/12/29 15:51
 * Create by LZH
 */

declare(strict_types=1);

namespace JuLongDeviceMqtt\FaceManage\Models;

// 分班播报学生信息列表
use JuLongDeviceMqtt\Common\AbstractModel;

class StudentInfo extends AbstractModel
{
    /**
     * @var string 学生姓名
     */
    private $StudentName;
    /**
     * @var array 学生分班播报机编号列表，就是在那些播报机中播放
     */
    private $ReportList;

    /**
     * @return string
     */
    public function getStudentName(): string
    {
        return $this->StudentName;
    }

    /**
     * @param string $StudentName
     */
    public function setStudentName(string $StudentName): void
    {
        $this->StudentName = $StudentName;
    }

    /**
     * @return array
     */
    public function getReportList(): array
    {
        return $this->ReportList;
    }

    /**
     * @param array $ReportList
     */
    public function setReportList(array $ReportList): void
    {
        $this->ReportList = $ReportList;
    }

    public function deserialize($param)
    {

        if ($param === null) {
            return;
        }

        if (isset($param['StudentName'])) {
            $this->StudentName = $param['StudentName'];
        }

        if (isset($param['ReportList'])) {
            $this->ReportList = $param['ReportList'];
        }
    }
}