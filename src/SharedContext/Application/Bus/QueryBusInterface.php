<?php

declare(strict_types=1);

namespace Challenge\SharedContext\Application\Bus;

use Challenge\SharedContext\Application\Query\Query;
use Challenge\SharedContext\Application\Response\AbstractResponse;

interface QueryBusInterface
{
    public function ask(Query $query): AbstractResponse;
}
