<?php

declare(strict_types=1);

namespace App\Locale;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

interface LocaleSwitcherInterface
{
    public function handle(Request $request, string $localeCode): RedirectResponse;
}
