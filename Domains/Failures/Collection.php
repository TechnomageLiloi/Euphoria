<?php

namespace Liloi\Euphoria\Domains\Failures;

use Liloi\Tools\Collection as AbstractCollection;

/**
 * @todo: add tests
 * @todo: add docs
 * @package Engine\Domain\Exercise
 */
class Collection extends AbstractCollection
{
    public function getPeriod(): string
    {
        $date1 = new \DateTime(date('Y-m-d H:i:s'));
        $date2 = new \DateTime($this[0]->getDt());
        $interval = $date1->diff($date2);

        return sprintf(
            '%s days %s hours %s minutes %s seconds',
            $interval->d, $interval->h, $interval->i, $interval->s
        );
    }

    public function getPrice(): string
    {
        $total = 0;

        /** @var Entity $entity */
        foreach ($this as $entity)
        {
            $total += $entity->getPrice();
        }

        return $total;
    }
}