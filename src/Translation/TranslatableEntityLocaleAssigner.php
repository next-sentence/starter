<?php

declare(strict_types=1);

namespace App\Translation;

use Sylius\Component\Locale\Context\LocaleContextInterface;
use Sylius\Component\Locale\Context\LocaleNotFoundException;
use Sylius\Component\Resource\Model\TranslatableInterface;
use Sylius\Component\Resource\Translation\Provider\TranslationLocaleProviderInterface;
use Sylius\Component\Resource\Translation\TranslatableEntityLocaleAssignerInterface;

final class TranslatableEntityLocaleAssigner implements TranslatableEntityLocaleAssignerInterface
{
    /**
     * @var TranslatableEntityLocaleAssignerInterface
     */
    private $translatableEntityLocaleAssigner;
    /**
     * @var TranslationLocaleProviderInterface
     */
    private $translationLocaleProvider;
    /**
     * @var LocaleContextInterface
     */
    private $localeContext;

    /**
     * TranslatableEntityLocaleAssigner constructor.
     * @param TranslatableEntityLocaleAssignerInterface $translatableEntityLocaleAssigner
     * @param TranslationLocaleProviderInterface $translationLocaleProvider
     * @param LocaleContextInterface $localeContext
     */
    public function __construct(
        TranslatableEntityLocaleAssignerInterface $translatableEntityLocaleAssigner,
        TranslationLocaleProviderInterface $translationLocaleProvider,
        LocaleContextInterface $localeContext
    )
    {
        $this->translatableEntityLocaleAssigner = $translatableEntityLocaleAssigner;
        $this->translationLocaleProvider = $translationLocaleProvider;
        $this->localeContext = $localeContext;
    }

    /**
     * {@inheritdoc}
     */
    public function assignLocale(TranslatableInterface $translatableEntity): void
    {
        $fallbackLocale = $this->translationLocaleProvider->getDefaultLocaleCode();

        try {
            $currentLocale = $this->localeContext->getLocaleCode();
        } catch (LocaleNotFoundException $e) {
            $currentLocale = $fallbackLocale;
        }

        if ($fallbackLocale === null) {
            $fallbackLocale = $this->translationLocaleProvider->getDefaultLocaleCode();
        }

        $translatableEntity->setCurrentLocale($currentLocale);
        $translatableEntity->setFallbackLocale($fallbackLocale);
    }
}
