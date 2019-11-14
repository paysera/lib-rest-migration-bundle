<?php

namespace Paysera\Bundle\RestBundle\Repository;

use Paysera\Component\Serializer\Entity\Filter;

/**
 * @php-cs-fixer-ignore Paysera/php_basic_feature_type_hinting_arguments
 */
interface FilterAwareRepositoryInterface extends BaseFilterAwareRepositoryInterface
{
    /**
     * @param Filter $filter
     *
     * @return int
     */
    public function findCountByFilter($filter);
}
