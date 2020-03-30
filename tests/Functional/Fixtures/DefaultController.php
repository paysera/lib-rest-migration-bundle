<?php

declare(strict_types=1);

namespace Paysera\Bundle\RestMigrationBundle\Tests\Functional\Fixtures;

use Paysera\Bundle\ApiBundle\Annotation\Query;
use Paysera\Bundle\ApiBundle\Annotation\ResponseNormalization;
use Paysera\Component\Normalization\Exception\InvalidDataException as NormalizationInvalidDataException;
use Paysera\Component\Serializer\Exception\InvalidDataException;
use Paysera\Pagination\Entity\OrderingPair;
use Paysera\Pagination\Entity\Pager;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController
{
    /**
     * @Route("/throw-serializer-invalid-data-exception")
     * @ResponseNormalization()
     *
     * @throws InvalidDataException
     */
    public function throwSerializerInvalidDataException()
    {
        throw new InvalidDataException(
            'InvalidDataException from Serializer component',
            'custom_code'
        );
    }

    /**
     * @Route("/throw-normalization-invalid-data-exception")
     * @ResponseNormalization()
     *
     * @throws NormalizationInvalidDataException
     */
    public function throwNormalizationInvalidDataException()
    {
        throw new NormalizationInvalidDataException('InvalidDataException from Normalization component');
    }

    /**
     * @Route("/pagination")
     * @Query(parameterName="pager")
     *
     * @param Pager $pager
     * @return array
     */
    public function pagination(Pager $pager)
    {
        return array_map(function (OrderingPair $orderingPair) {
            return [
                'order_by' => $orderingPair->getOrderBy(),
                'asc' => $orderingPair->isOrderingDirectionSet() ? $orderingPair->isOrderAscending() : null,
            ];
        }, $pager->getOrderingPairs());
    }
}
