<?php

/**
 * Gejun：Form用.
 */

namespace Antron\Gejun;

/**
 * Gejun：Form用.
 * 
 * @version 1.0.0 2020/05/05
 */
trait GejunFormTrait
{

    /**
     * 配列_年.
     *
     * @var array
     */
    public $form_year;

    /**
     * 配列_月.
     *
     * @var array
     */
    public $form_month = [
        0 => '不明',
        1 => '1月',
        2 => '2月',
        3 => '3月',
        4 => '4月',
        5 => '5月',
        6 => '6月',
        7 => '7月',
        8 => '8月',
        9 => '9月',
        10 => '10月',
        11 => '11月',
        12 => '12月',
    ];

    /**
     * 配列_日.
     *
     * @var array
     */
    public $form_day = [
        0 => '不明',
        1 => '1日',
        2 => '2日',
        3 => '3日',
        4 => '4日',
        5 => '5日',
        6 => '6日',
        7 => '7日',
        8 => '8日',
        9 => '9日',
        10 => '10日',
        11 => '11日',
        12 => '12日',
        13 => '13日',
        14 => '14日',
        15 => '15日',
        16 => '16日',
        17 => '17日',
        18 => '18日',
        19 => '19日',
        20 => '20日',
        21 => '21日',
        22 => '22日',
        23 => '23日',
        24 => '24日',
        25 => '25日',
        26 => '26日',
        27 => '27日',
        28 => '28日',
        29 => '29日',
        30 => '30日',
        31 => '31日',
        100 => '上旬',
        110 => '中旬',
        120 => '下旬',
    ];

    /**
     * コンストラクタ.
     */
    public function setupForm()
    {
        $this->form_year[0] = '不明';

        $year_count = intval(date('Y')) + config('gejun.year_add');

        $year_oldest = config('gejun.year_oldest');

        while ($year_count >= $year_oldest) {
            $this->form_year[$year_count] = strval($year_count) . '年';

            $year_count--;
        }
    }

}
