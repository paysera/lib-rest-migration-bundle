<?php

namespace Paysera\Bundle\RestBundle\Repository;

use Paysera\Component\Serializer\Entity\Filter;
use Paysera\Component\Serializer\Exception\InvalidDataException;

/**
 * Abstract interface BaseFilterAwareRepositoryInterface
 * Don't use directly, implement one of extended interfaces
 *
 * @php-cs-fixer-ignore Paysera/php_basic_feature_type_hinting_arguments
 */
interface BaseFilterAwareRepositoryInterface
{
    /**
     * @param Filter $filter
     *
     * @return array
     * @throws InvalidDataException on invalid filter values (after or before)
     */
    public function findByFilter($filter);
}
