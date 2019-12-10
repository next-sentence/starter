<?php

declare(strict_types=1);

namespace App\Controller\Frontend;

use App\Locale\LocaleSwitcherInterface;
use Sylius\Component\Locale\Context\LocaleContextInterface;
use Sylius\Component\Locale\Provider\LocaleProviderInterface;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class LocaleSwitchController
{
    /**
     * @var EngineInterface
     */
    private $templatingEngine;

    /**
     * @var LocaleContextInterface
     */
    private $localeContext;

    /**
     * @var LocaleProviderInterface
     */
    private $localeProvider;

    /**
     * @var LocaleSwitcherInterface
     */
    private $localeSwitcher;


    /**
     * LocaleSwitchController constructor.
     * @param EngineInterface $templatingEngine
     * @param LocaleContextInterface $localeContext
     * @param LocaleProviderInterface $localeProvider
     * @param LocaleSwitcherInterface $localeSwitcher
     */
    public function __construct(
        EngineInterface $templatingEngine,
        LocaleContextInterface $localeContext,
        LocaleProviderInterface $localeProvider,
        LocaleSwitcherInterface $localeSwitcher
    ) {
        $this->templatingEngine = $templatingEngine;
        $this->localeContext = $localeContext;
        $this->localeProvider = $localeProvider;
        $this->localeSwitcher = $localeSwitcher;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function renderAction(Request $request): Response
    {
        return $this->templatingEngine->renderResponse('frontend/menu/_localeSwitch.html.twig', [
            'active' => $this->localeContext->getLocaleCode(),
            'locales' => $this->localeProvider->getAvailableLocalesCodes(),
        ]);
    }

    /**
     * @param Request $request
     * @param string|null $code
     * @return Response
     */
    public function switchAction(Request $request, ?string $code = null): Response
    {
        if (null === $code) {
            $code = $this->localeProvider->getDefaultLocaleCode();
        }

        if (!in_array($code, $this->localeProvider->getAvailableLocalesCodes(), true)) {
            throw new HttpException(
                Response::HTTP_NOT_ACCEPTABLE,
                sprintf('The locale code "%s" is invalid.', $code)
            );
        }

        return $this->localeSwitcher->handle($request, $code);
    }
}
