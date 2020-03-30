<?php

declare(strict_types=1);

namespace Paysera\Bundle\RestMigrationBundle\Tests\Functional;

class FunctionalInvalidDataExceptionTest extends FunctionalTestCase
{
    protected function setUp()
    {
        parent::setUp();
        $this->setUpContainer('basic');
    }

    public function testSerializerInvalidDataExceptionIsMappedCorrectly()
    {
        $response = $this->makeGetRequest('/throw-serializer-invalid-data-exception');

        $jsonResponse = json_decode($response->getContent(), true);

        $this->assertArraySubset(
            ['error' => 'custom_code', 'error_description' => 'InvalidDataException from Serializer component'],
            $jsonResponse,
            'expected correct content'
        );
        $this->assertEquals(
            400,
            $response->getStatusCode(),
            'expected correct status code'
        );
    }

    public function testDefaultInvalidDataExceptionStillWorks()
    {
        $response = $this->makeGetRequest('/throw-normalization-invalid-data-exception');

        $jsonResponse = json_decode($response->getContent(), true);

        $this->assertArraySubset(
            ['error' => 'invalid_parameters', 'error_description' => 'InvalidDataException from Normalization component'],
            $jsonResponse,
            'expected correct content'
        );
        $this->assertEquals(
            400,
            $response->getStatusCode(),
            'expected correct status code'
        );
    }
}
