<?php

namespace App\Fixture\Factory;

use Sylius\Component\Locale\Model\Locale;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LocaleExampleFactory extends AbstractExampleFactory implements ExampleFactoryInterface
{
    /**
     * @var FactoryInterface
     */
    private $localeFactory;

    /**
     * @var \Faker\Generator
     */
    private $faker;

    /**
     * @var OptionsResolver
     */
    private $optionsResolver;

    /**
     * AdminUserExampleFactory constructor.
     *
     * @param FactoryInterface $adminUserFactory
     */
    public function __construct(FactoryInterface $localeFactory)
    {
        $this->localeFactory = $localeFactory;

        $this->faker = \Faker\Factory::create();
        $this->optionsResolver = new OptionsResolver();

        $this->configureOptions($this->optionsResolver);
    }

    /**
     * {@inheritdoc}
     */
    public function create(array $options = [])
    {
        $options = $this->optionsResolver->resolve($options);

        /** @var Locale $locale */
        $locale = $this->localeFactory->createNew();
        $locale->setCode($options['code']);

        return $locale;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefault('code', function (Options $options) {
                return $this->faker->languageCode;
            })
        ;
    }
}
