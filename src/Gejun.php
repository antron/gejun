<?php

/**
 * Gejun：メイン.
 */

namespace Antron\Gejun;

/**
 * Gejun：メイン.
 * 
 * @version 1.0.0 2020/05/13
 */
class Gejun
{

    use GejunCheckTrait;
    use GejunFormTrait;

    /**
     * GejunForm.
     *
     * @var GejunForm
     */
    public $form;

    /**
     * Json.
     *
     * @var string
     */
    public $json;

    /**
     * 表示用文字列.
     *
     * @var string
     */
    public $print;

    /**
     * YYYY-MM-DD形式.
     *
     * @var string
     */
    public $yyyy_mm_dd;

    /**
     * 年.
     *
     * @var int
     */
    public $year;

    /**
     * 月.
     *
     * @var int
     */
    public $month;

    /**
     * 日.
     *
     * @var int
     */
    public $day;

    /**
     * コンストラクタ.
     */
    public function __construct()
    {
        $this->error = false;

        $this->year = 0;

        $this->month = 0;

        $this->day = 0;

        $this->setupForm();
    }

    /**
     * データ取得_Json.
     * 
     * @param string $json
     */
    public function fromJson($json)
    {
        if ($json) {
            $data = json_decode($json);

            $this->year = intval($data->year);

            $this->month = intval($data->month);

            $this->day = intval($data->day);
        }

        $this->check();
    }

    /**
     * データ取得_リクエストの配列.
     * 
     * @param array $inputs
     */
    public function fromRequest($inputs, $keys = ['year', 'month', 'day'])
    {
        if (isset($inputs[$keys[0]])) {
            $this->year = intval($inputs[$keys[0]]);

            $this->month = intval($inputs[$keys[1]]);

            $this->day = intval($inputs[$keys[2]]);
        }

        $this->check();

        foreach ($keys as $key) {
            unset($inputs[$key]);
        }

        return $inputs;
    }

    /**
     * データ取得_文字列.
     * 
     * @param string $yyyy_mm_dd
     */
    public function fromString($yyyy_mm_dd)
    {
        $this->year = intval(substr($yyyy_mm_dd, 0, 4));

        $this->month = intval(substr($yyyy_mm_dd, 5, 2));

        $this->day = intval(substr($yyyy_mm_dd, 8, 2));

        $this->check();
    }

}
