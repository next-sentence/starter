<?php

declare(strict_types=1);

namespace App\Locale;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;

class UrlBasedLocaleSwitcher implements LocaleSwitcherInterface
{
    /** @var UrlGeneratorInterface */
    private $urlGenerator;
    /**
     * @var UrlMatcherInterface
     */
    private $urlMatcher;

    public function __construct(UrlGeneratorInterface $urlGenerator, UrlMatcherInterface $urlMatcher)
    {
        $this->urlGenerator = $urlGenerator;
        $this->urlMatcher = $urlMatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Request $request, string $localeCode): RedirectResponse
    {
        if (!$referer = $request->headers->get('referer')) {
            return new RedirectResponse($this->urlGenerator->generate('app_frontend_homepage', ['_locale' => $localeCode]));
        }

        try {
            $lastPath = substr($referer, (int) strpos($referer, $request->getSchemeAndHttpHost()));
            $lastPath = str_replace($request->getSchemeAndHttpHost(), '', $lastPath);
            $params =  $this->urlMatcher->match($lastPath);

            $route = $params['_route'];
            unset($params['_route']);
            $params['_locale'] = $localeCode;

            return new RedirectResponse($this->urlGenerator->generate($route, $params));
        } catch (\Exception $e) {
            return new RedirectResponse($this->urlGenerator->generate('app_frontend_homepage', ['_locale' => $localeCode]));
        }
    }
}