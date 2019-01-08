---
title: Build commands
description: Building and previewing email templates with Maizzle PHP
page_order: 4
navigation:
  group: Getting Started
  order: 4
---

# Commands for Building and Previewing

Maizzle PHP comes with three commands for building your templates. 

Each one is for a specific [environment provided](/docs/configuration/#environments), and shorter aliases are also included.

---

## Local

`npm run local`

This command will build your emails for the development environment.
It's meant for quick local development, and there's almost no post-processing (like CSS inlining) going on.
This means you have all Tailwind classes at your disposal, so you can tinker and prototype right in the browser.

Your emails will be compiled into the `build_local` directory (configurable).
This folder is `.gitignore`d by default, so you don't commit emails that are not production-ready.

This command is also used by `npm run watch`, and it has the fastest build time.

Alias: `npm run dev`

## Staging

`npm run staging`

This command uses settings from `config.staging.php` and will generate production-ready emails that have transformations applied, but are not minified.

Files are output to the `build_staging` directory and have CSS inlined.
Unused CSS will be purged, and various code fixes are applied (like HTML attributes preferred over inline CSS).

Alias: `npm run stage`

## Production

`npm run production`

Use this command to generate production-ready HTML emails that you will use to send from your <abbr title="Email Service Provider" class="cursor-help">ESP</abbr>.
By default, it does the same things as `npm run staging`, but it will also apply minification to the resulting HTML in the `build_production` directory.

Alias: `npm run prod`

## Watch

`npm run watch`

Using this command will do the following:

1. Browsersync will start a local server, accessible by default at `http://localhost:3000`

   It will automatically open that URL (in your default browser), showing a directory listing where you can see all folders and HTML files generated.
2. Webpack will watch for any changes you make to files in the `source` directory.

   When you edit and save a file there, the server will refresh the page so you can immediately see your changes.

This command is just an alias for `npm run local -- --watch`

## Screenshots

`npm run screenshot file=path/to/file.html`

Maizzle PHP provides a command for generating browser screenshots of your emails, using [Puppeteer](https://github.com/GoogleChrome/puppeteer).
The only argument is the path to an HTML file, which must be relative to your project's root.

A `screenshots` directory will be created in your project's root, and it will have the same structure as the default `build_local`.

Images are named after the original file, and include the [device name](/docs/configuration/#screenshots) plus a timestamp.
For example, `letter-ipad-mini-1532978719202.png`.

<div class="bg-grey-lightest border-l-4 border-blue p-4 mb-4" role="alert">
  <div class="text-grey-darker">
      When running the command for the first time, Maizzle will prompt you to download and install a recent version of Chromium for your operating system (if it's not already installed). You need to confirm, wait for the download to finish, and then run the command again.
  </div>
</div>

## NPM Scripts

All these commands are just NPM scripts, defined in [`package.json`](https://github.com/maizzle/maizzle/blob/master/package.json) :

```json
"scripts": {
    "local": "cross-env NODE_ENV=development node_modules/webpack/bin/webpack.js --progress --hide-modules --env=local --config=node_modules/laravel-mix/setup/webpack.config.js",
    "staging": "cross-env NODE_ENV=staging node_modules/webpack/bin/webpack.js --progress --hide-modules --env=staging --config=node_modules/laravel-mix/setup/webpack.config.js",
    "production": "cross-env NODE_ENV=production node_modules/webpack/bin/webpack.js --progress --hide-modules --env=production --config=node_modules/laravel-mix/setup/webpack.config.js",
    "dev": "npm run local",
    "stage": "npm run staging",
    "prod": "npm run production",
    "watch": "npm run local -- --watch",
    "screenshot": "node ./tasks/js/screenshot.js"
},
```

If you create additional [environments](../configuration#environments), this is where you register their build commands.

<div class="bg-grey-lightest border-l-4 border-blue p-4 mb-4" role="alert">
  <div class="text-grey-darker">When adding an NPM build script, take note of the <code>NODE_ENV</code> and <code>--env=</code> arguments for <code>cross-env</code> - they must match the name of your environment.</div>
</div>
