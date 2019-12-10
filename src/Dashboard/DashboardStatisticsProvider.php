<?php

declare(strict_types=1);

namespace App\Dashboard;

use App\Repository\CustomerRepository;
use Sylius\Component\Resource\Repository\RepositoryInterface;

class DashboardStatisticsProvider
{
    /** @var CustomerRepository */
    private $customerRepository;

    public function __construct(RepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getStatistics(): DashboardStatistics
    {
        return new DashboardStatistics(
            $this->customerRepository->countCustomers()
        );
    }
}
