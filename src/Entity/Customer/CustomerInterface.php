<?php

namespace App\Entity\Customer;

use App\Entity\User\AppUserInterface;
use Sylius\Component\Customer\Model\CustomerInterface as BaseCustomerInterface;
use Sylius\Component\User\Model\UserAwareInterface;
use Sylius\Component\User\Model\UserInterface;

interface CustomerInterface extends BaseCustomerInterface, UserAwareInterface
{
    /**
     * @return AppUserInterface|Userinterface|null
     */
    public function getUser(): ?UserInterface;

    /**
     * @param AppUserInterface|UserInterface|null $user
     *
     * @return $this
     */
    public function setUser(?UserInterface $user);
}
