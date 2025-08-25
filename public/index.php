<?php

use Challenge\Api\Resources\ChallengeApiKernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new ChallengeApiKernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
