<?php

namespace App\Services\Prometheus;

use Prometheus\CollectorRegistry;
use Prometheus\Storage\Redis;

class PrometheusService
{
    private CollectorRegistry $registry;

    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        $this->registry = new CollectorRegistry(
            new Redis([
                "host" => '127.0.0.1',
                'port' => 6379,
            ])
        );
    }

    public function getRegistry():CollectorRegistry{
        return $this->registry;
    }
}
