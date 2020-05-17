<?php

/**
 * Gejun：チェック用.
 */

namespace Antron\Gejun;

use \Carbon\Carbon;

/**
 * Gejun：チェック用.
 * 
 * @version 1.0.0 2020/05/15
 */
trait GejunCheckTrait
{

    /**
     * エラーフラグ.
     *
     * @var boolean
     */
    public $error;

    /**
     * 年_表示用.
     *
     * @var string
     */
    private $year_print;

    /**
     * 年_carbon用.
     *
     * @var string
     */
    private $year_carbon;

    /**
     * 月_表示用.
     *
     * @var string
     */
    private $month_print;

    /**
     * 月_carbon用.
     *
     * @var string
     */
    private $month_carbon;

    /**
     * 日_表示用.
     *
     * @var string
     */
    private $day_print;

    /**
     * 日_carbon用.
     *
     * @var string
     */
    private $day_carbon;

    /**
     * チェック.
     */
    protected function check()
    {
        $this->error = !checkdate($this->month, $this->day, $this->year);

        $this->checkYear();

        $this->checkMonth();

        $this->checkDay();

        $this->makePrint();

        if ($this->error) {
            $this->yyyy_mm_dd = null;
        } else {
            $carbon = Carbon::createFromDate($this->year_carbon, $this->month_carbon, $this->day_carbon);

            $this->yyyy_mm_dd = $carbon->toDateString();
        }

        $data = [
            'year' => $this->year,
            'month' => $this->month,
            'day' => $this->day,
            'yyyy_mm_dd' => $this->yyyy_mm_dd,
            'print' => $this->print,
        ];

        $this->json = json_encode($data);
    }

    /**
     * チェック_年.
     */
    private function checkYear()
    {
        if ($this->year) {
            $this->year_print = $this->year . '年';

            $this->year_carbon = $this->year;
        } else {
            $this->year_print = '';

            $this->year_carbon = config('gejun.year_oldest');
        }
    }

    /**
     * チェック_月.
     */
    private function checkMonth()
    {
        if ($this->month) {
            $this->month_print = $this->month . '月';

            $this->month_carbon = $this->month;
        } else {
            $this->month_print = '';

            $this->month_carbon = 6;
        }
    }

    /**
     * チェック_日.
     */
    private function checkDay()
    {
        if ($this->day) {
            $this->day_print = $this->day . '日';

            $this->day_carbon = $this->day;
        } else {
            $this->day_print = '';

            $this->day_carbon = 15;
        }
    }

    /**
     * 表示用文字列の作成.
     */
    private function makePrint()
    {

        $this->print = $this->year_print . $this->month_print . $this->day_print;

        if (!$this->print) {
            $this->print = '不明';
        }
    }

}
