<?php

declare(strict_types=1);

namespace Paysera\Bundle\RestMigrationBundle\Tests\Functional;

class FunctionalPagerDenormalizerTest extends FunctionalTestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->setUpContainer('basic');
    }

    /**
     * @dataProvider provideDataForPagination
     *
     * @param array $expected
     * @param string $queryString
     */
    public function testPagination(array $expected, string $queryString)
    {
        $response = $this->makeGetRequest('/pagination?' . $queryString);

        $this->assertSame(
            $expected,
            json_decode($response->getContent(), true),
            'expected correct content'
        );
    }

    public function provideDataForPagination()
    {
        return [
            'works with default behavior #1' => [
                [
                    ['order_by' => 'a', 'asc' => true],
                ],
                'sort=a',
            ],
            'works with default behavior #2' => [
                [
                    ['order_by' => 'a', 'asc' => false],
                ],
                'sort=-a',
            ],
            'works with default behavior #3' => [
                [
                    ['order_by' => 'a', 'asc' => true],
                    ['order_by' => 'b', 'asc' => false],
                ],
                'sort=a,-b',
            ],
            'works with order_by' => [
                [
                    ['order_by' => 'a', 'asc' => null],
                ],
                'order_by=a',
            ],
            'works with several order_by' => [
                [
                    ['order_by' => 'a', 'asc' => null],
                    ['order_by' => 'b', 'asc' => null],
                ],
                'order_by=a,b',
            ],
            'works with several order_by and direction' => [
                [
                    ['order_by' => 'a', 'asc' => true],
                    ['order_by' => 'b', 'asc' => true],
                ],
                'order_by=a,b&order_direction=asc',
            ],
            'works with several order_by and desc direction' => [
                [
                    ['order_by' => 'a', 'asc' => false],
                    ['order_by' => 'b', 'asc' => false],
                ],
                'order_by=a,b&order_direction=desc',
            ],
            'order_by is ignored if sort is passed' => [
                [
                    ['order_by' => 'c', 'asc' => true],
                ],
                'sort=c&order_by=a,b&order_direction=desc',
            ],
        ];
    }
}
