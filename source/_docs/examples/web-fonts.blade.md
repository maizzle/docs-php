---
title: Web Fonts
description: Learn how to reorder stacked columns in a mobile responsive HTML email with Maizzle PHP
page_order: 13
path: docs/examples
navigation:
  group: Examples
  order: 13
---

# Web Fonts

Web fonts have [decent support in modern email clients](https://www.campaignmonitor.com/css/text-fonts/font-face/).
This means that you can progressively enhance your emails with custom fonts, while showing a fallback system font in clients that don't support them.

Maizzle PHP supports Google Fonts, but you can also add your own, custom fonts.

---

## Google Fonts {#google}

You can define which Google Fonts your templates should use either globally in `config.php`, or for each template, through a Front Matter variable.
Once defined, you register the utility with Tailwind, so that it can generate the CSS classes.

### Global import

In `config.php`, add your Google Fonts in the `googleFonts` array, following Google's syntax.
Maizzle PHP will add the necessary `<link>` tag to the default `master.blade.php` layout:

```
'googleFonts' => [
    'Open+Sans',
    'Roboto',
],
```

### Front Matter import

When editing a template, you can specify which Google Fonts to use for this template _only_, through a Front Matter variable.
For example, here's how Maizzle PHP sets it in the `letter.blade.md` template:

```yaml
---
extends: _layouts.letter
title: Simple content-focused newsletter
preheader: This month's words of wisdom
googleFonts: ['Roboto', 'Open+Sans']
headline: This is an example of using layouts as templates in Maizzle, to only write emails in Markdown
---
```

Of course, you can import specific subsets and weights:

```yaml
---
extends: _layouts.master
googleFonts: ['Roboto&amp;subset=latin-ext', 'Open+Sans:300,400']
---
```

### Register Tailwind CSS utility {#google-fonts-register-utility}

Now that the fonts are being imported, we need to define a font stack utility in `tailwind.js`,
so that Tailwind can generate the CSS classes. Imagine we imported [Merriweather](https://fonts.google.com/specimen/Merriweather) - let's add the `font-merriweather` utility:

```js
// tailwind.js

fonts: {
  'merriweather': [
    'Merriweather',
    'Constantia',
    'Georgia',
    'serif',
  ],

  // ...
},
```

### Using Google Fonts

Email clients that support web fonts don't require the `font-family` to be inlined in your HTML.
Therefore, we can make use of Maizzle PHP's `all` breakpoint and tuck the class inside a `@media screen {}` query,
so that Juice won't inline it and we shave off some bytes.

For example:

```html
<h1 class="all-font-merriweather">Headline text</h1>
```

<div class="bg-grey-lightest border-l-4 border-blue p-4 mb-4" role="alert">
  <div class="text-grey-darker">For this to work, Maizzle sets `fonts: ['responsive'],` in your `tailwind.js` config.</div>
</div>

## Custom fonts {#custom}

In case you want to use a custom (brand?) font, or your ESP doesn't support `<link>` tags in emails (i.e. Shopify notifications),
you need to use `@font-face` to register the font family instead.

Here are a couple of ways you could go about it:

### Typography partial

You can create a partial that registers the `@font-face` rules.
For example, let's create a `typography.css` file in `source/_styles/partials`.
We need a URL to a font file, so let's use Lato from Google Fonts:

```css
@screen all {
  @font-face {
    font-family: 'Lato';
    font-style: normal;
    font-weight: 400;
    src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v14/S6uyw4BMUTPHjx4wXg.woff2) format('woff2');
    unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
  }
}
```

Next, we must import it in `main.css`:

```css
@import "tailwindcss/components";

@import "partials/reset";
@import "partials/typography"; /* import the typography partial */
@import "partials/custom-utilities";

@import "tailwindcss/utilities";
```

Then, just as before, we register the utility with Tailwind CSS:

```js
// tailwind.js

fonts: {
  'lato': [
    'Lato',
    '-apple-system',
    'Segoe UI',
    'sans-serif',
  ],

  // ...
},
```

Now we can use it:

```html
<h1 class="all-font-lato">Headline using custom webfont</h1>
```

### Push To A Blade Stack {#blade-stacks}

You can also use a [Blade Stack](/docs/templates/#blade-stacks) to `@@push()` a `<style></style>` tag right before `</head>`:


```blade
// confirm-email.blade.md

---
title: Confirm your email
preheader: Please verify your email address with us
bodyClasses: bg-grey-light
---

@@push('head')
<style>
  @media screen {
    @font-face {
      font-family: 'Lato';
      font-style: normal;
      font-weight: 400;
      src: local('Lato Regular'), local('Lato-Regular'), url(https://fonts.gstatic.com/s/lato/v14/S6uyw4BMUTPHjx4wXg.woff2) format('woff2');
      unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
    }
  }
</style>
@@endpush()

// your HTML...
```

<div class="bg-grey-lightest border-l-4 border-blue p-4 mb-4" role="alert">
    <h5 class="text-grey-darker text-base font-semibold p-0 mb-2"><code>data-embed</code> not required</h5>
    <div class="text-grey-dark">
        In the example above, since we're using a <code>@media</code> query, we don't need to add the <code>data-embed</code> attribute on the <code>&lt;style&gt;</code> tag in order to prevent Juice from inlining it.
    </div>
</div>
