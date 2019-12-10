<?php

declare(strict_types=1);

namespace App\Dashboard;

class DashboardStatistics
{
    /** @var int */
    private $numberOfNewCustomers;

    public function __construct(int $numberOfNewCustomers)
    {
        $this->numberOfNewCustomers = $numberOfNewCustomers;
    }

    public function getNumberOfNewCustomers(): int
    {
        return $this->numberOfNewCustomers;
    }
}
