<?php

/**
 * Gejun：Trait用.
 */

namespace Antron\Gejun;

/**
 * Gejun：Trait用.
 * 
 * @version 1.0.0 2020/05/05
 */
trait GejunTrait
{

    /**
     * Gejun用の変数.
     *
     * @var \Antron\Gejun\Gejun
     */
    public $gejun;

    /**
     * Gejun用のメソッド.
     *
     * @var array
     */
    public function setGejunJson($json)
    {
        if (is_null($this->gejun)) {
            $this->gejun = new Gejun();

            $this->gejun->fromJson($json);
        }

        return $this->gejun;
    }

    /**
     * Gejun用のメソッド.
     *
     * @var array
     */
    public function setNewGejun($json)
    {
        $this->gejun = new Gejun();

        $this->gejun->fromJson($json);

        return $this->gejun;
    }

}
