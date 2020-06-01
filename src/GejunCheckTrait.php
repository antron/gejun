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
    private $error;

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

        $this->toInt();

        $this->checkYear();

        $this->checkMonth();

        $this->checkDay();

        $this->print = $this->year_print . $this->month_print . $this->day_print;

        if (self::checkInt($this->year, $this->month, $this->day)) {
            $carbon = Carbon::createFromDate($this->year_carbon, $this->month_carbon, $this->day_carbon);

            $this->yyyy_mm_dd = $carbon->toDateString();
        } else {
            $this->yyyy_mm_dd = null;
        }

        $data = [
            'order' => self::makeOrder($this->year_carbon, $this->month_carbon, $this->day_carbon),
            'yyyy_mm_dd' => $this->yyyy_mm_dd,
            'print' => $this->print,
            'year' => $this->year,
            'month' => $this->month,
            'day' => $this->day,
        ];

        $this->json = json_encode($data);
    }

    private static function checkInt($year, $month, $day)
    {
        if (!is_int($year)) {
            return false;
        }

        if (!is_int($month)) {
            return false;
        }

        if (!is_int($day)) {
            return false;
        }

        return checkdate($month, $day, $year);
    }

    private function toInt()
    {
        $this->year = intval($this->year);

        $this->month = intval($this->month);

        $this->day = intval($this->day);
    }

    private static function makeOrder($year, $month, $day)
    {
        return $year . sprintf('%02d', $month) . sprintf('%02d', $day);
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
            if ($this->day == 110) {
                $carbon_last_of_month = Carbon::createFromDate($this->year_carbon, $this->month_carbon, 1)
                        ->lastOfMonth();

                $this->day_print = $carbon_last_of_month->day . '日';

                $this->day_carbon = $carbon_last_of_month->day;
            } else {

                $this->day_print = $this->day . '日';

                $this->day_carbon = $this->day;
            }
        } else {
            $this->day_print = '';

            $this->day_carbon = 15;
        }
    }

}
