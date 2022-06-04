const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

mix.css('src/app.css', 'dist')
    .options({
        postCss: [
            tailwindcss('./tailwind.config.js'),
        ]
    });