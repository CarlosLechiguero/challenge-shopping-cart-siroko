<?php

declare(strict_types=1);

namespace Challenge\SharedContext\Infrastructure\Bus;

use League\Tactician\CommandBus as TacticianBus;
use Challenge\SharedContext\Application\Bus\QueryBusInterface;
use Challenge\SharedContext\Application\Query\Query;
use Challenge\SharedContext\Application\Response\AbstractResponse;

class TacticianQueryBus implements QueryBusInterface
{
    public function __construct(
        private readonly TacticianBus $tacticianBus,
    ) {
    }

    public function ask(Query $query): AbstractResponse
    {
        return $this->tacticianBus->handle($query);
    }
}
