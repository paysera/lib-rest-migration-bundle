<?php

declare(strict_types=1);

namespace Paysera\Bundle\RestMigrationBundle\Tests\Functional\Fixtures;

use Paysera\Bundle\NormalizationBundle\PayseraNormalizationBundle;
use Paysera\Bundle\ApiBundle\PayseraApiBundle;
use Paysera\Bundle\RestBundle\PayseraRestBundle;
use Paysera\Bundle\RestMigrationBundle\PayseraRestMigrationBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class TestKernel extends Kernel
{
    private $configFile;
    private $commonFile;

    public function __construct($testCase, $commonFile = 'common.yml')
    {
        parent::__construct((string)crc32($testCase . $commonFile), true);
        $this->configFile = $testCase . '.yml';
        $this->commonFile = $commonFile;
    }

    public function registerBundles()
    {
        return [
            new FrameworkBundle(),
            new SecurityBundle(),
            new PayseraNormalizationBundle(),
            new PayseraApiBundle(),
            new PayseraRestBundle(),
            new PayseraRestMigrationBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config/' . $this->commonFile);
        $loader->load(__DIR__ . '/config/' . $this->configFile);
    }
}
