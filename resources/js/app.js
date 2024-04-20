import './bootstrap';
import Splide from '@splidejs/splide';
import * as Sentry from "@sentry/browser";

Sentry.init({
    dsn: import.meta.env.VITE_SENTRY_DSN_PUBLIC,
});

window.Splide = Splide;
