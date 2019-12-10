<?php

namespace App\Context;

use Sylius\Component\Locale\Context\LocaleContextInterface;
use Sylius\Component\Locale\Context\LocaleNotFoundException;
use Sylius\Component\Locale\Provider\LocaleProviderInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class LocaleContext implements LocaleContextInterface
{
    /** @var RequestStack */
    private $requestStack;

    /** @var LocaleProviderInterface */
    private $localeProvider;

    public function __construct(RequestStack $requestStack, LocaleProviderInterface $localeProvider)
    {
        $this->requestStack = $requestStack;
        $this->localeProvider = $localeProvider;
    }

    /**
     * @return string
     */
    public function getLocaleCode(): string
    {
        $request = $this->requestStack->getMasterRequest();
        if (null === $request) {
            throw new LocaleNotFoundException('No master request available.');
        }

        $localeCode = $request->attributes->get('_locale');
        if (null === $localeCode) {
            $localeCode = $this->localeProvider->getDefaultLocaleCode();
        }

        $availableLocalesCodes = $this->localeProvider->getAvailableLocalesCodes();
        if (!in_array($localeCode, $availableLocalesCodes, true)) {
            throw LocaleNotFoundException::notAvailable($localeCode, $availableLocalesCodes);
        }

        return $localeCode;
    }
}
