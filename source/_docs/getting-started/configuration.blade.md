---
title: Configuration
description: Configure and customize environment settings in Maizzle PHP
page_order: 3
navigation:
  group: Getting Started
  order: 3
---

# Configuration

Maizzle PHP uses Jigsaw's `config.php` files to allow for environment-specific project settings.
These are PHP arrays with key-value pairs that define certain options, and can even include functions.

This gives you the freedom to define distinct settings for any build scenario you need,
ranging from quick local development, to staging builds or production-ready emails.

## Default Config {#default}

Maizzle PHP's [`config.php`](https://github.com/maizzle/maizzle/blob/master/config.php) is just a well-commented PHP array:

```php
/*

Maizzle - Email Development Framework

A project by Cosmin Popovici (@cossssmin) and ThemeMountain (@thememountainco).

Welcome to the Maizzle config file. This is where you can customise some
Maizzle settings for your project.

View the full documentation at https://maizzle.com/docs


|-------------------------------------------------------------------------------
| The default config                   https://maizzle.com/docs/building/#local
|-------------------------------------------------------------------------------
|
| This array contains the default Maizzle settings for development. This is
| used when you run the `npm run dev` or `npm run watch` commands.
|
*/

return [

    /*
    |-----------------------------------------------------------------------------
    | Layout                                    https://maizzle.com/docs/layouts/
    |-----------------------------------------------------------------------------
    |
    | Define a master layout that all templates will extend by default.
    |
    | Maizzle comes with a default layout that sets various tags to
    | use settings from your config, but you can of course create
    | your own layouts and extend them at a template level,
    | with front matter.
    |
    */
    'extends' => '_layouts.master',

    /*
    |-----------------------------------------------------------------------------
    | Doctype                     https://maizzle.com/docs/configuration/#doctype
    |-----------------------------------------------------------------------------
    |
    | Define a doctype that will be used in the layout your emails extend.
    |
    | Maizzle defines an HTML 5 doctype by default, but you can choose
    | any doctype you need. You can also override it for each email,
    | through a front matter variable. If you use an empty string,
    | Maizzle's layouts will fallback to `html`.
    |
    */
    'doctype' => 'html',

    /*
    |-----------------------------------------------------------------------------
    | Language                   https://maizzle.com/docs/configuration/#language
    |-----------------------------------------------------------------------------
    |
    | This will be used in the `lang=""` attribute of the `<html>` tag. It helps
    | screen reader software use the correct pronunciation. Of course, you can
    | override it in each template, with front matter variables.
    |
    */

    'language' => 'en',

    /*
    |-----------------------------------------------------------------------------
    | Character set               https://maizzle.com/docs/configuration/#charset
    |-----------------------------------------------------------------------------
    |
    | Character encoding is set to UTF-8 by default. This prevents breaking
    | reading patterns by ensuring proper character rendering, both
    | on-screen and with screen readers.
    |
    */

    'charset' => 'utf8',

    /*
    |-----------------------------------------------------------------------------
    | Document title                https://maizzle.com/docs/configuration/#title
    |-----------------------------------------------------------------------------
    |
    | The `<title>` tag is needed in order to give screen reader users context.
    | It also helps when viewing the email in a browser (like your email's
    | online version), by setting the title on the browser's tab.
    |
    | You should specify a `title` key in the front matter for each email.
    |
    */

    'title' => '',

    /*
    |-----------------------------------------------------------------------------
    | Google Fonts           https://maizzle.com/docs/configuration/#google-fonts
    |-----------------------------------------------------------------------------
    |
    | This is where you can define which Google Fonts Maizzle should import.
    |
    | It will only import Google Fonts by adding a `<link>` tag to your HTML.
    | In order to use them, you still need to register the .font-{name}
    | class in the tailwind.js config file. Use as few fonts and
    | weights as possible, because it affects load time.
    |
    | Example:
    |
    | 'googleFonts' => [
    |    'Open+Sans:300,400,700',
    |    'Merriweather',
    | ],
    |
    */

    'googleFonts' => [],

    /*
    |-----------------------------------------------------------------------------
    | Screenshots                  https://maizzle.com/docs/building/#screenshots
    |-----------------------------------------------------------------------------
    |
    | This is where you can define which devices Puppeteer should emulate when
    | using the `screenshots` command in Maizzle. iPad Mini and iPhone 6 are
    | enabled by default, but you can use any of the device descriptors
    | supported by Puppeteer.
    |
    | It is recommended that you use as few devices as possible, as this
    | process launches Chrome in headless mode and, the more devices
    | you use, the more time it will take to generate screenshots.
    |
    | Note that these only emulate the viewport of a device, they are not
    | intended for email client render tests.
    |
    */

    'screenshots' => [
        'devices' => [
            'iPad Mini',
            'iPhone 6',
        ],
        'type' => 'png',
        'quality' => 100,
    ],

    /*
    |-----------------------------------------------------------------------------
    | Transformers           https://maizzle.com/docs/configuration/#transformers
    |-----------------------------------------------------------------------------
    |
    | This is where you can define various transformations that will be applied
    | to the output files. To speed up development, Maizzle disables most of
    | them for local development. They are, however, enabled in the
    | staging and production environment configs.
    |
    | Don't let the output file size scare you when working locally. Having
    | transformations disabled, you can reference any Tailwind CSS class
    | when debugging in-browser, and rapidly prototype your emails.
    |
    | Some of the advanced minifier options are not exposed here, but you
    | can customise them in tasks/js/after-jigsaw.js.
    |
    */

    'transformers' => [
        'baseImageURL' => '',
        'inlineCSS' => [
            'enabled' => false,
            'styleToAttribute' => [
                'background-color' => 'bgcolor',
                'background-image' => 'background',
                'text-align' => 'align',
                'vertical-align' => 'valign',
            ],
            'applySizeAttribute' => [
                'width' => ['TABLE', 'TD', 'TH', 'IMG', 'VIDEO'],
                'height' => ['TABLE', 'TD', 'TH', 'IMG', 'VIDEO'],
            ],
            'excludedProperties' => [],
        ],
        'cleanup' => [
            'removeUnusedCss' => [
                'enabled' => false,
                'whitelist' => [
                    ".External*",
                    ".ReadMsgBody",
                    ".yshortcuts",
                    ".Mso*",
                    "#outlook",
                ],
                'backend' => [
                  [
                    'heads' => "{{",
                    'tails' => "}}",
                  ],
                ],
                'removeHTMLComments' => [
                    'enabled' => true,
                    'preserve' => ['if', 'endif', 'mso', 'ie'],
                ],
                'uglifyClassNames' => true,
            ],
            'keepOnlyAttributeSizes' => [
                'width' => ['TABLE', 'TD', 'TH', 'IMG', 'VIDEO'],
                'height' => ['TABLE', 'TD', 'TH', 'IMG', 'VIDEO'],
            ],
            'preferBgColorAttribute' => false,
        ],
        'prettify' => false,
        'minify' => [
            'minifyCSS' => false,
            'maxLineLength' => false,
            'preserveLineBreaks' => false,
            'collapseWhitespace' => false,
            'conservativeCollapse' => false,
        ],
        'sixHex' => false,
        'altText' => false,
    ],

    /*
    |-----------------------------------------------------------------------------
    | Plaintext                 https://maizzle.com/docs/configuration/#plaintext
    |-----------------------------------------------------------------------------
    |
    | When this option is set to true, Maizzle will generate a plaintext version
    | for every template. The .txt file will be placed in the same directory
    | as the HTML it's based on, and it will also have the same name.
    |
    */

    'plaintext' => false,

    /*
    |-----------------------------------------------------------------------------
    | BrowserSync             https://maizzle.com/docs/configuration/#browsersync
    |-----------------------------------------------------------------------------
    |
    | Tunnel
    |
    | When running the `watch` command with `tunnel` set to `true`, BrowserSync
    | will create a tunnel to your localhost, via localtunnel.me. You can
    | use this URL to share a live preview of what you're working
    | on with a colleague or a client.
    |
    | By default, setting it to `true` will generate a random localtunnel.me
    | subdomain. You can use a string instead, to have BrowserSync attempt
    | to use a custom subdomain.
    |
    | Directory listing
    |
    | Setting the `listing` option to `true` will enable a directory listing
    | when running the `watch` command, so you can browse through your
    | emails. You might want to set it to `false` when using the
    | tunnel option with a client.
    |
    */

    'browsersync' => [
        'tunnel' => false,
        'listing' => false,
    ],


    /*
    |-----------------------------------------------------------------------------
    | Helpers                     https://maizzle.com/docs/configuration/#helpers
    |-----------------------------------------------------------------------------
    |
    | Jigsaw config functions used by Maizzle in the build process.
    |
    */

    'googleFontsString' => function($page) {
        return collect($page->googleFonts)->transform(function($item, $key) {
            return str_replace(' ', '+', $item);
        })->implode('|');
    },

    /*
    |-----------------------------------------------------------------------------
    | Build defaults       https://maizzle.com/docs/configuration/#build-defaults
    |-----------------------------------------------------------------------------
    |
    | Configure additional Jigsaw build settings.
    |
    */

    'baseUrl' => '',
    'pretty' => false,
    'production' => false,
    'build' => [
        'source' => 'source',
        'destination' => 'build_local',
    ],
];
```

## Environments

Use environment configurations and NPM scripts to define settings and compile emails for different scenarios.

Think of them like this:

<blockquote class="italic p-4 bg-grey-lightest rounded text-grey-dark mb-4 font-serif text-base">
    When I run this command, should X happen? Should CSS be inlined? Should my HTML be minified? Do I need some data to be available for the templates?
</blockquote>

Environment-based configurations are supported out of the box by Jigsaw,
and can be defined by simply duplicating the default `config.php` to include the desired environment in the file name.
([Jigsaw docs](https://jigsaw.tighten.co/docs/environments/))

### Local {#env-local}

[`config.php`](https://github.com/maizzle/maizzle/blob/master/config.php) is for local development. No CSS is purged from your final emails and no inlining takes place,
so that you can quickly prototype emails with all of Tailwind's classes at your disposal, for tinkering in the browser.

This one has the fastest build time, since almost no post-processing takes place.

### Staging {#env-staging}

Use [`config.staging.php`](https://github.com/maizzle/maizzle/blob/master/config,staging.php) to configure build settings for emails that you share with other humans.
This one enables post-processing similar to production builds, but it prettifies code so that people see nicely-formatted, readable code.

### Production {#env-production}

Finally, Maizzle PHP also provides a [`config.production.php`](https://github.com/maizzle/maizzle/blob/master/config.production.php) file,
which enables the most transformations, such as CSS inlining, unused CSS purging, and even email-optimised HTML minification.

### Custom Environments

You can go even further, and create your own, custom environments.

For example, you could create an environment config for a certain client or brand,
like `config.mystore.php` or `config.someclient.php` - all with their own settings.

As the [Jigsaw docs mention](http://jigsaw.tighten.co/docs/environments/), custom environment configurations are merged on top of the default `config.php` ones.
This means that for a custom environment you only need to specify the variables that you are changing.

---

Let's have a look at all the default options Maizzle comes with.

<div class="bg-grey-lightest border-l-4 border-blue p-4 mb-4" role="alert">
    <div class="text-grey-darker -mb-4" markdown="1">You can override all of these keys for each page in particular, with Front Matter variables. See [Jigsaw docs](http://jigsaw.tighten.co/docs/markdown/).</div>
</div>

## Layouts

`'extends' => '_layouts.master',`

Maizzle PHP uses "master" pages, called Layouts.

A layout tipically contains the base HTML of a site (or, in our case, an email): things like the `<head>` tag, the `<body>` tag, and the main content wrapper.

Instead of always having to write it for each page, you simply _extend_ it from a page, thus reusing the same layout file.
Learn more in the [Laravel Blade docs](https://laravel.com/docs/5.7/blade#defining-a-layout) and [Jigsaw docs](https://jigsaw.tighten.co/docs/content-blade/).

### Blade-Markdown automatic extends

Normally with Jigsaw, your templates each need to specify what layout they extend, either with a Blade `@@extends()`, or through a Front Matter variable.

The `extends` key is provided in the default Maizzle PHP config so that, if you use `.blade.md` files,
they will extend `_layouts.master` automatically. No need to [extend with Front Matter](../layouts/#extending-layouts) for each email 🤙

## Doctype <span class="label bg-green text-xxs align-top">1.1.0</span> {#doctype}

`'doctype' => 'html',`

By default, Maizzle PHP sets a HTML 5 doctype for your emails.
This is used in the `master.blade.php` layout, and will default to `html` if it's not set in the config:

```blade
<!DOCTYPE @{!! $page->doctype ?? 'html' !!}>
```

You can, of course, set this for each email template, through Front Matter:

```yaml
---
doctype: html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"
title: Confirm your email
preheader: Please verify your email address with us
---
```

## Language

`'language' => 'en',`

The `language` key is used to define a content language for your emails.
Maizzle PHP uses it in the `lang=""` attribute on the `<html>` tag inside the `master.blade.php` layout file, and it defaults to `en`:

```php
<html lang="@{{ $page->language ?? 'en' }}" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
```

Specifying it in Front Matter will change it only for that email:

```yaml
---
language: ro
title: Verificare adresă de email
preheader: Te rugăm să ne confirmi adresa de email
---
```

## Charset

`'charset' => 'utf8',`

This option is used to set the default character encoding, defaulting to UTF-8:

```php
<meta charset="@{{ $page->charset ?? 'utf8' }}">
```

Most likely, you won't need to change this.

## Title

`'title' => 'Maizzle - Build HTML emails fast, with Tailwind CSS and Jigsaw',`

Used to enable the `<title></title>` tag in your email template. If empty, the tag will not be inserted:

```php
@@if($page->title)<title>@{{ $page->title }}</title>@@endif
```

As you saw in the previous examples, each email can specify the `title` in Front Matter.

For accessibility reasons, it's recommended that you always add a title.
As a bonus, if you're using the same email for your newsletter's 'web version', the browser tab will be informative.

## Google Fonts

The `'googleFonts'` key is an array with Google Fonts font names in Google's specific string formatting,
that Maizzle PHP should pull into your template.

Open Sans and Merriweather are provided as examples:

```php
'googleFonts' => [
    'Open+Sans:300,400,700',
    'Merriweather',
],
```

If this array is empty, the `<link>` tag containing the Google Fonts import will not be added:

```php
@@if($page->googleFonts)
  <!--[if !mso]><!--><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=@{{ $page->googleFontsString() }}"><!--<![endif]-->
@@endif
```

The `$page->googleFontsString()` in the code above is a helper method that is also defined in `config.php`.
It simply collects all Google Fonts you've specified, and returns a formatted string that we can use in the `<link>` tag:

```php
'googleFontsString' => function($page) {
    return collect($page->googleFonts)->transform(function($item, $key) {
        return str_replace(' ', '+', $item);
    })->implode('|');
},
```

<div class="bg-grey-lightest border-l-4 border-blue p-4 mb-4" role="alert">
  <div class="text-grey-darker -mb-4" markdown="1">Read more about [helper methods](https://jigsaw.tighten.co/docs/helper-methods/) in Jigsaw's docs.</div>
</div>

## Screenshots

The `screenshots` array contains settings for the [Screenshots](../building/#screenshots) functionality.

You can use any [device descriptors](https://github.com/GoogleChrome/puppeteer/blob/master/DeviceDescriptors.js) that Puppeteer knows about,
and you can specify the screenshot file type and quality (quality applicable only to JPG).

```php
'screenshots' => [
    'devices' => [
        'iPad Mini',
        'iPhone 6',
    ],
    'type' => 'png',
    'quality' => 100,
],
```

<div class="bg-grey-lightest border-l-4 border-orange p-4 mb-4" role="alert">
    <h5 class="text-grey-darker text-base font-semibold p-0 mb-2">Screenshots speed</h5>
    <div class="text-grey-dark">
        The more devices you add, the longer it will take to process all the screenshots.
    </div>
</div>

## Transformers

Transformers control how the email magic happens: they enable various post-processing scripts that optimise your HTML for email clients.
The following examples show all options, but will vary between environments.

#### baseImageURL {.font-mono .text-base}

```php
'baseImageURL' => 'https://cdn.example.com/some/folder/',
```

When set to a _valid_ URL, all image paths in your email (both inline and background images) will have this URL prepended.
Useful if you already host your images somewhere, so you don't have to write the full URL every time when developing.

<div class="bg-grey-lightest border-l-4 border-blue p-4 mb-4" role="alert">
  <div class="text-grey-darker">If you use a trailing slash, make sure your image <code>src=""</code> doesn't start with one.</div>
</div>

#### inlineCSS {.font-mono .text-base}

```php
'inlineCSS' => [
    'enabled' => true,
    'styleToAttribute' => [
        'background-color' => 'bgcolor',
        'background-image' => 'background',
        'text-align' => 'align',
        'vertical-align' => 'valign',
    ],
    'applySizeAttribute' => [
        'width' => ['TABLE', 'TD', 'TH', 'IMG', 'VIDEO'],
        'height' => ['TABLE', 'TD', 'TH', 'IMG', 'VIDEO'],
    ],
    'excludedProperties' => [],
],
```

Uses Automattic's [Juice](https://github.com/Automattic/juice) library to inline CSS.

You can toggle this with the `enabled` boolean.
When enabled, you can also define if Juice should remove the original `<style></style>` tags after (possibly) inlining the CSS from them,
through `'removeStyleTags'`, as shown below.

#### `removeStyleTags` <span class="label bg-grey text-xxs align-top">1.0.2</span> {#removestyletags}

This option has been removed from the configs in `v1.1.0`, because it was set to `true` in all environments.
It now defaults to `true` in the JS post-processing script, but you can opt-out by setting it to `false` in your config:

```php
'inlineCSS' => [
    'enabled' => true,
    'removeStyleTags' => false,
    // [...]
],
```

<div class="bg-grey-lightest border-l-4 border-blue p-4 mb-4" role="alert">
    <h5 class="text-grey-darker text-base font-semibold pb-2">@media rules</h5>
    <div class="text-grey-dark">
        <code>removeStyleTags</code> works together with <code>preserveMediaQueries</code> behind the scenes, so that any <code>@media</code> queries will not be removed from your <code>&lt;style&gt;&lt;/style&gt;</code> tags.
    </div>
</div>

#### `styleToAttribute` <span class="label bg-gradient-to-left-light-ocean text-xxs align-top">1.1.0</span> {#styletoattribute}

This option contains an array of rules that map CSS properties to HTML attributes.
These are used by the Juice inliner to duplicate inline CSS as HTML attributes on table tags:

```php
'inlineCSS' => [
    // ...
    'styleToAttribute' => [
        'background-color' => 'bgcolor',
        'background-image' => 'background',
        'text-align' => 'align',
        'vertical-align' => 'valign',
    ],
    // ...
],
```

<strong class="font-sans text-grey-darkest">Opt-out by design</strong>

By default, Maizzle PHP production configs include the `styleToAttribute` key, and populate it with [Juice's defaults](https://github.com/Automattic/juice/blob/master/lib/inline.js#L12-L17).
This is on purpose, for better email client compatibility.

However, if you specify a single mapping, Juice will only convert _that_ to an attribute,
keeping any other properties as inline CSS-only:

```php
'inlineCSS' => [
    'enabled' => true,
    'styleToAttribute' => [
        'background-color' => 'bgcolor',
    ],
],
```

With the code above, only the CSS `background-color` will be added as `bgcolor=""` to HTML elements -
`background-image`, `text-align` and `vertical-align` will remain as inlined CSS.

#### `applySizeAttribute` <span class="label bg-gradient-to-left-light-ocean text-xxs align-top">1.1.0</span> {#applysizeattribute}

This allows you to specify an array of elements that should receive `width=""` and `height=""` attributes.
These elements will be passed to the Juice inliner, which will add any inline width and height CSS rules it finds as HTML attributes, but only for these elements.

#### `excludedProperties` <span class="label bg-gradient-to-left-light-ocean text-xxs align-top">1.1.0</span> {#excludedproperties}

The `excludedProperties` option allows you to define an array of CSS properties that should be excluded from the CSS inlining process by Juice:

```php
'inlineCSS' => [
    'enabled' => true,
    // ...
    'excludedProperties' => [],
],
```

Maizzle PHP sets this to an empty array in the production environment configs.

Property names are considered unique, so you need to specify each one you'd like to exclude. For example:

```php
'excludedProperties' => ['padding', 'padding-left'],
```

<div class="bg-grey-lightest border-l-4 border-orange p-4 mb-4" role="alert">
    <h5 class="text-grey-darker text-base font-semibold pb-2">Classes will be removed</h5>
    <div class="text-grey-dark">
        Corresponding classes that these CSS properties are derived from (i.e. <code>pl-2</code>) will still be removed from your HTML if <code>removeUnusedCss</code> is enabled.
        To prevent this, you could add <code>'removeStyleTags' => false</code>, in the <code>inlineCSS</code> options array.
    </div>
</div>

#### cleanup {.font-mono .text-base}

This key contains settings that you can use to clean up your email's code.

<div class="bg-grey-lightest border-l-4 border-blue p-4 mb-4" role="alert">
    <h5 class="text-grey-darker text-base font-semibold pb-2">Do use it in production</h5>
    <div class="text-grey-dark">
        Cleaning up your HTML email results in smaller file sizes, which translate to faster email sendouts, faster opens (think slow 3G),
        and snappier rendering times (DOM parsing).
        Also, Gmail will clip your email around 102KB, so anything past that mark won't even be in the DOM
        (which can lead to unexpected results like tracking pixel not loaded or, worse, hidden unsubscribe links).
        <br><br>
        In email, bigger is never better. Clean up your production emails.
    </div>
</div>

#### `removeUnusedCss`

These options are passed to [email-remove-unused-css](https://bitbucket.org/codsen/email-remove-unused-css.git)
in order to safely remove unused CSS in your email.
You can also define whether certain HTML comments should be removed,
and if your CSS class names should be uglified so that they're much shorter (helps reduce HTML size):

```php
'removeUnusedCss' => [
    'enabled' => true,
    'whitelist' => [
        ".External*",
        ".ReadMsgBody",
        ".yshortcuts",
        ".Mso*",
        "#outlook",
    ],
    'backend' => [
      [
        'heads' => "@{{",
        'tails' => "}}",
      ],
    ],
    'removeHTMLComments' => [
        'enabled' => false,
        'preserve' => ['if', 'endif', 'mso', 'ie'],
    ],
    'uglifyClassNames' => false,
],
```

It is recommended to have `removeUnusedCss` enabled for production builds, as it reduces file size considerably.

Also, if you are just documenting your code, please note that you can use @php echo '<code>{{-- Blade comments --}}</code>' @endphp instead of `<!-- regular HTML comments -->`.
Blade comments are not rendered in your compiled emails.

#### `keepOnlyAttributeSizes` <span class="label bg-green text-xxs align-top">1.1.0</span> {#keeponlyattributesizes}

```php
'cleanup' => [
    // [...]
    'keepOnlyAttributeSizes' => [
        'width' => ['TABLE', 'TD', 'TH', 'IMG', 'VIDEO'],
        'height' => ['TABLE', 'TD', 'TH', 'IMG', 'VIDEO'],
    ],
],
```

You can specify for which elements should the inline CSS `width` and `height` be removed.
As you can see, Maizzle defaults to the same elements as in the `applySizeAttribute` option.

<div class="bg-grey-lightest border-l-4 border-blue p-4 mb-4" role="alert">
  <div class="text-grey-darker">
      Removing the entire <code>keepOnlyAttributeSizes</code> key will leave any inline CSS widths and heights untouched.
  </div>
</div>

Providing an empty array to one of its keys will not remove the corresponding CSS property for that key on any element.
So if you do this:

```php
'cleanup' => [
    // [...]
    'keepOnlyAttributeSizes' => [
        'width' => [],
        'height' => ['TABLE', 'TD', 'TH', 'IMG', 'VIDEO'],
    ],
],
```

... then any inline CSS `width` will be left untouched, while inline CSS `height` will be removed for all those elements specified in the array.

#### `preferBgColorAttribute`

```php
'preferBgColorAttribute' => true,
```

This will remove the inline `background-color: #......` CSS from tables, so they only use the HTML `bgcolor=""` attribute.
Set to `false` if you want background colours set with both CSS and HTML attributes.

<div class="bg-grey-lightest border-l-4 border-blue p-4 mb-4" role="alert">
    <h5 class="text-grey-darker text-base font-semibold pb-2">Prefer CSS-only background colors?</h5>
    <div class="text-grey-dark">
        If you only want to use CSS for your background colours, you can remove the <code>'background-color' => 'bgcolor',</code> mapping from <code>styleToAttribute</code>,
        so that Juice does not duplicate this CSS as an HTML attribute.
    </div>
</div>

#### prettify {.font-mono .text-base}

```php
'prettify' => true,
```

When `true`, Maizzle PHP will use [pretty](https://www.npmjs.com/package/pretty) to beautify your email's HTML.
It indents your code and makes it more readable - useful before sending it to another human.

#### minify {.font-mono .text-base}

```php
'minify' => [
    'minifyCSS' => false,
    'maxLineLength' => false,
    'preserveLineBreaks' => false,
    'collapseWhitespace' => false,
    'conservativeCollapse' => false,
],
```

Uses [html-minifier](https://www.npmjs.com/package/html-minifier) to minify your email's HTML:

`minifyCSS` - whether to minify the embedded CSS in your `<style></style>` tag

`maxLineLength` - set a maximum line length. Some email clients have issues with lines of code that exceed a certain amount of characters. Defaults to a conservative `500` in the production config.

`preserveLineBreaks` - always collapse to 1 line break (never remove it entirely) when whitespace between tags include a line break. Requires `collapseWhitespace` to be `true`.

`collapseWhitespace` - collapses white space that contributes to text nodes in a document tree ([read more](http://perfectionkills.com/experimenting-with-html-minifier/#collapse_whitespace))

`conservativeCollapse` - always collapse to one space, never fully remove it

<div class="bg-grey-lightest border-l-4 border-blue p-4 mb-4" role="alert">
  <div class="text-grey-darker">
      Sometimes, after inlining and cleaning up CSS, it can happen that you end up with empty <code>style=""</code> tags. The minifier has an option called <code>'removeEmptyAttributes'</code> that will always remove any such empty attributes. Maizzle PHP doesn't expose this option, but it's enabled by default.
  </div>
</div>

#### sixHex {.font-mono .text-base}

```php
'sixHex' => true,
```

Uses [color-shorthand-hex-to-six-digit](https://www.npmjs.com/package/color-shorthand-hex-to-six-digit) to ensure your HEX colour codes are written in full, with 6 digits.
Some email clients don't support shorthand HEX, so we recommend leaving this enabled for production.

#### altText {.font-mono .text-base}

```php
'altText' => true,
```

Uses [html-img-alt](https://www.npmjs.com/package/html-img-alt) to make sure that all your `<img>` tags have an `alt=""` attribute defined.
If an image already includes the attribute, it'll leave it alone. If the attribute is missing, it will add an empty one.

## Plaintext

```php
'plaintext' => true,
```

Set this option to `true`, to have Maizzle PHP generate a plaintext version for every email template.
The .txt file will be placed in the same directory as the HTML it's based on, and it will also have the same name.

By default, plaintext generation is enabled only in the production config.

## BrowserSync

```php
'browsersync' => [
    'tunnel' => false,
    'listing' => false,
],
```

Basic settings for the BrowserSync plugin, that Maizzle PHP will use when you develop locally with `npm run watch`.

#### tunnel {.font-mono .text-base}

This enables localhost tunneling in Browsersync (through [localtunnel.me](https://localtunnel.me)),
so you can live-share a URL to an email that you're working on right now, with a colleague or a client.

Both parties see the same thing, so if you change a color and save, it will automatically refresh the page and update on their screen as well. Scrolling is synced, too.

You can also use a string instead of a boolean - for example `'tunnel' => 'mybrand'`.
In this case, BrowserSync will attempt to use a custom subdomain for the URL, i.e. `https://mybrand.localtunnel.me`.

If that subdomain is unavailable, you will be allocated a random name as usual.

#### listing {.font-mono .text-base}

When running the `npm run watch` command with this setting enabled, BrowserSync will open a file explorer in your browser, starting at the root of the build directory.

If you set this to `false`, the page opened by BrowserSync will be blank, and you'll need to manually navigate to your emails directory.

<div class="bg-grey-lightest border-l-4 border-orange p-4 mb-4" role="alert">
  <div class="text-grey-darker">
      If using the tunneling option to do a demo for a client, you might want to use <code>'listing' => false</code>, so that they can't freely browse all your emails by going to the root URL.
  </div>
</div>

## Helpers

Your config can also contain PHP helper methods that you can use to manipulate data or page variables.
Maizzle PHP comes with a `'googleFontsString'` method that formats the Google Fonts names you have defined and appends them to the URL in the `<link>` tag.

Learn more about helper methods in the [Jigsaw docs](http://jigsaw.tighten.co/docs/helper-methods/).

## Jigsaw build {#build-defaults}

These are Jigsaw core settings, like[ output file base URL](http://jigsaw.tighten.co/docs/page-metadata/), [pretty permalinks](http://jigsaw.tighten.co/docs/pretty-urls/), or source and destination directories for the build process.

#### pretty {.font-mono .text-base}

```php
'pretty' => false,
```

Setting the `'pretty'` key to `true` will have Jigsaw output each file as `index.html`, inside a folder named after the original source file.
Maizzle PHP disables it by default in all environments.

More on pretty permalinks, in the [Jigsaw docs](http://jigsaw.tighten.co/docs/pretty-urls/).

#### build {#build-source-destination .font-mono .text-base}

```php
'build' => [
    'source' => 'source',
    'destination' => 'build_staging',
],
```

`source` defines the path to the source directory where Jigsaw should look for files to be compiled.

`destination` defines the path to the directory where Jigsaw should output the generated files.

#### Source and destination can be used with build environments

Imagine you have a folder named `/spacecogs` that represents a client, and it contains a bunch of emails.

You can create a config specifically for this client, and change source and destination so that when you build for this environment,
Jigsaw will only build the emails for _this_ client, instead of all emails in the `/source` directory:

```php
// config.spacecogs.php

'build' => [
    'source' => 'source/spacecogs',
    'destination' => 'spacecogs',
],
```

Of course, you'll need to [define the NPM script](/docs/building/#npm-scripts):

```json
// package.json

"scripts": {
    ...
    "spacecogs": "cross-env NODE_ENV=production node_modules/webpack/bin/webpack.js --progress --hide-modules --env=production --config=node_modules/laravel-mix/setup/webpack.config.js",
},
```

<div class="bg-grey-lightest border-l-4 border-blue p-4 mb-4" role="alert">
  <div class="text-grey-darker">
      Jigsaw always looks for <code>_layouts</code> and partials relative to the <code>source</code> folder specified here.
      If you set it to a custom path like shown above, you will need to have the layouts and any other partials duplicated inside this new directory.</code>
  </div>
</div>

<div class="bg-grey-lightest border-l-4 border-orange p-4 mb-4" role="alert">
  <div class="text-grey-darker -mb-4" markdown="1">Be [very careful](https://github.com/tightenco/jigsaw/issues/222#issuecomment-394157769) how you change these paths: upon build, the <code>destination</code> folder is deleted.</div>
</div>

## Tailwind CSS {#tailwind}

Maizzle PHP uses Tailwind's default configuration, customized for email development.

Specifically:

- all units are pixels or percentages
- some utilities that aren't supported in email have been disabled
- [`important`](https://tailwindcss.com/docs/configuration#important) is set to `true`, so that responsive utilities can actually override inline CSS
- although darn cool, the `:` [separator](https://tailwindcss.com/docs/configuration#separator) which allows for classes like `hover:bg-blue` doesn't work in some email clients (ex. Gmail).
It has been replaced with `-`
- for the same reason, classes such as `w-1/2` have been renamed to `w-1-2`

### Tailwind plugins <span class="label bg-gradient-to-left-light-ocean text-xxs align-top">1.1.0</span> {#tailwind-plugins}

Starting with `v1.1.0`, Maizzle PHP comes with custom Tailwind CSS plugins.

#### Background gradients plugin {#gradients-tailwind-plugin}

A plugin that generates CSS background gradients, forked from [@benface's plugin](https://github.com/benface/tailwindcss-gradients).

You can define the gradients in your `tailwind.js` config, just like with any other module:

```js
let gradients = {
  'grey-dark': ['#b8c2cc', '#8795a1'],
  'red-dark': ['#e3342f', '#cc1f1a'],
  'orange-dark': ['#f6993f', '#de751f'],
  'yellow-dark': ['#ffed4a', '#f2d024'],
  'green-dark': ['#38c172', '#1f9d55'],
  'teal-dark': ['#4dc0b5', '#38a89d'],
  'blue-dark': ['#3490dc', '#2779bd'],
  'indigo-dark': ['#6574cd', '#5661b3'],
  'purple-dark': ['#9561e2', '#794acf'],
  'pink-dark': ['#f66d9b', '#eb5286'],
}
```

Those are the default ones Maizzle PHP comes with, and they're based on Tailwind's default color palette.
Of course, Tailwind's `config()` function can be used instead of hardcoding HEX values - [see how](../examples/gradients/#using-tailwind-colors).

You can add your own gradients, with as many color stops as you need:

```js
let gradients = {
  // ...

  'hydrogen': ['#667db6', '#0082c8', '0082c8', '667db6'],
}
```

If you define a single color instead of an array, the resulting gradient will start from `transparent` and move towards the color you defined:

```js
let gradients = {
  // ...

  'black': '#22292f',
}
```

... will generate classes like:

```css
.bg-gradient-to-top-black {
  background-image: linear-gradient(to top, transparent, #22292f);
}
```

Of course, the generated classes cover all four directions. With the example above, you'd get:

```css
.bg-gradient-to-top-black {
  background-image: linear-gradient(to top, transparent, #22292f);
}
.bg-gradient-to-right-black {
  background-image: linear-gradient(to right, transparent, #22292f);
}
.bg-gradient-to-bottom-black {
  background-image: linear-gradient(to bottom, transparent, #22292f);
}
.bg-gradient-to-left-black {
  background-image: linear-gradient(to left, transparent, #22292f);
}
```

Just like with any module, you can control which variants are generated.
Maizzle PHP only enables the `hover` variant by default, but you can use any of the variants, or set it to `false` to not generate any background gradients:

```js
modules: {
  // ...
  gradients: ['hover'],
 // ...
},
```

Need inspiration? Try [uigradients.com](https://uigradients.com) {.text-indigo}
