<?php
declare(strict_types=1);

namespace Paysera\Bundle\RestMigrationBundle\Normalizer;

use Paysera\Bundle\RestBundle\Normalizer\Pagination\PagerDenormalizer;
use Paysera\Component\Normalization\DenormalizationContext;
use Paysera\Component\Normalization\ObjectDenormalizerInterface;
use Paysera\Component\Normalization\TypeAwareInterface;
use Paysera\Component\ObjectWrapper\Exception\InvalidItemException;
use Paysera\Component\ObjectWrapper\ObjectWrapper;
use Paysera\Pagination\Entity\OrderingPair;
use Paysera\Pagination\Entity\Pager;

class PagerDenormalizerDecorator implements ObjectDenormalizerInterface, TypeAwareInterface
{
    private $pagerDenormalizer;

    public function __construct(PagerDenormalizer $pagerDenormalizer)
    {
        $this->pagerDenormalizer = $pagerDenormalizer;
    }

    public function denormalize(ObjectWrapper $input, DenormalizationContext $context)
    {
        $pager = $this->pagerDenormalizer->denormalize($input, $context);

        $this->modifyPager($pager, $input);

        return $pager;
    }

    private function modifyPager(Pager $pager, ObjectWrapper $input)
    {
        if (count($pager->getOrderingPairs()) > 0) {
            return;
        }

        $orderBy = $input->getString('order_by');
        if ($orderBy === null) {
            return;
        }

        $orderDirection = $input->getString('order_direction');

        if ($orderDirection !== null) {
            $orderDirection = mb_strtolower($orderDirection);
            if (!in_array($orderDirection, array('asc', 'desc'))) {
                throw new InvalidItemException('order_direction', 'order_direction must be asc or desc');
            }
        }

        $orderAscending = $orderDirection !== null ? $orderDirection === 'asc' : null;

        $orderingPairs = [];
        foreach (explode(',', $orderBy) as $orderByPart) {
            $orderingPairs[] = new OrderingPair($orderByPart, $orderAscending);
        }

        $pager->setOrderingPairs($orderingPairs);
    }

    public function getType(): string
    {
        return $this->pagerDenormalizer->getType();
    }
}
