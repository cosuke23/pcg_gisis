{{--
    App CSS and JS. Normal browsers get the Vite build files. The Claude
    desktop pane blocks same-origin asset requests on the Tailscale address,
    so for it the build is inlined, and Font Awesome comes from the CDN
    (declared after the inline CSS so its CDN-hosted fonts win).
    See App\Support\ClaudePane.
--}}
@if (\App\Support\ClaudePane::active())
    <style>{!! \Illuminate\Support\Facades\Vite::content('resources/css/app.css') !!}</style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <script type="module">{!! \Illuminate\Support\Facades\Vite::content('resources/js/app.js') !!}</script>
@else
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endif
