<?php

namespace Challenge\Api\Resources;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class ChallengeApiKernel extends BaseKernel
{
    use MicroKernelTrait;

    private function getConfigDir(): string
    {
        return __DIR__ . '/config';
    }
}