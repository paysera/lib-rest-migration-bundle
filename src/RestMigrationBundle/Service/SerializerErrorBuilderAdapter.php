<?php

declare(strict_types=1);

namespace Paysera\Bundle\RestMigrationBundle\Service;

use Exception;
use Paysera\Bundle\ApiBundle\Entity\Error;
use Paysera\Bundle\ApiBundle\Exception\ApiException;
use Paysera\Bundle\ApiBundle\Service\ErrorBuilderInterface;
use Paysera\Component\Serializer\Entity\Violation;
use Paysera\Component\Serializer\Exception\InvalidDataException;

class SerializerErrorBuilderAdapter implements ErrorBuilderInterface
{
    private $originalErrorBuilder;

    public function __construct(ErrorBuilderInterface $originalErrorBuilder)
    {
        $this->originalErrorBuilder = $originalErrorBuilder;
    }

    public function createErrorFromException(Exception $exception): Error
    {
        if ($exception instanceof InvalidDataException) {
            $violations = array_map(function (Violation $violation) {
                return (new Violation())
                    ->setCode($violation->getCode())
                    ->setField($violation->getField())
                    ->setMessage($violation->getMessage())
                ;
            }, $exception->getViolations());

            return (new Error())
                ->setCode($exception->getCustomCode() ?: ApiException::INVALID_PARAMETERS)
                ->setMessage($exception->getMessage())
                ->setStatusCode(400)
                ->setProperties($exception->getProperties())
                ->setViolations($violations)
            ;
        }

        return $this->originalErrorBuilder->createErrorFromException($exception);
    }
}
