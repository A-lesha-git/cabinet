<?php
namespace Page\Sources;

class Sources
{

    protected $tester;


    public function __construct(\Codeception\Actor $I) {
        $this->tester = $I;
    }



}
