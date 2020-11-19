<?php

namespace App\ImgBgLessGenerator;

use Mtownsend\RemoveBg\RemoveBg;

class ImgBgLessGenerator
{
    private $rmvBg;

    public function __construct()
    {
        $this->rmvBg = $removebg = new RemoveBg("iAE82W2HYXicFdPzcALt2RCS");
    }

    public function createBgLessImg($pathToFile)
    {
        $base64EncodedFile = base64_encode(file_get_contents($pathToFile));
        $this->rmvBg->base64($base64EncodedFile)->save($pathToFile);
    }
}
