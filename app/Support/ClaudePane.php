<?php

namespace App\Support;

/**
 * Detects the Claude desktop app's built-in browser pane.
 *
 * When that pane opens the app on its Tailscale address, it loads the HTML
 * but blocks every same-origin sub-request (CSS, JS, images) with
 * ERR_BLOCKED_BY_CLIENT, so pages render unstyled. Cross-origin CDNs, inline
 * <style>/<script> and data: URIs are allowed, so for that browser only the
 * layouts inline the built assets and embed the logo. Every other browser
 * gets the normal @vite files and image URLs.
 */
class ClaudePane
{
    private static ?string $logoDataUri = null;

    public static function active(): bool
    {
        return str_contains((string) request()->userAgent(), ' Claude/');
    }

    /** URL for the PCG logo: a data: URI inside the Claude pane, else a normal asset URL. */
    public static function logo(): string
    {
        if (! self::active()) {
            return asset('images/pcg_logo.png');
        }

        if (self::$logoDataUri === null) {
            $path = public_path('images/pcg_logo.png');
            self::$logoDataUri = is_file($path)
                ? 'data:image/png;base64,'.base64_encode((string) file_get_contents($path))
                : asset('images/pcg_logo.png');
        }

        return self::$logoDataUri;
    }
}
