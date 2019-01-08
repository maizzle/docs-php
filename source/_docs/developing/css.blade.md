---
title: CSS
description: Create custom and email client-specific styles for your emails in Maizzle PHP
page_order: 8
navigation:
  group: Developing
  order: 8
---

# CSS

The `source/_styles` directory contains all CSS files used by the framework.
Maizzle PHP uses Laravel Mix with Webpack and PostCSS to compile Tailwind and your custom CSS, then processes it further according to your configuration.

---

## main.css

The master CSS file, which pulls in Tailwind CSS components and utilities, plus some partials.
As you can see, our partials are imported before Tailwind utilities, so that the latter can still override them:

```css
@import "tailwindcss/components";

@import "partials/reset";
@import "partials/custom-utilities";

@import "tailwindcss/utilities";
```


## Custom utilities

The `custom-utilities.css` partial is where you can register any custom Tailwind utilities.

Maizzle PHP provides some custom utilities by default:

```css
.mso-leading-exactly {
  mso-line-height-rule: exactly;
}

@responsive {
  .table-row-group {
    display: table-row-group;
  }
  .table-header-group {
    display: table-header-group;
  }
  .table-footer-group {
    display: table-footer-group;
  }
  .table-column-group {
    display: table-column-group;
  }
  .table-column {
    display: table-column;
  }
  .table-caption {
    display: table-caption;
  }
}
```

## CSS Partials {#partials}

Partials live in the `_styles/partials` directory, and are imported with [postcss-import](https://github.com/postcss/postcss-import).

You can use them to define additional styles that should be compiled and placed in the embedded CSS tag, when Maizzle PHP builds your emails.

You can use partials to extract Tailwind CSS utilities to component classes, through the [`@apply`](https://tailwindcss.com/docs/functions-and-directives/#apply) directive.

Styles in partials will be inlined if CSS inlining is enabled, and as long as they're not inside a `@media` query.
They also go through the CSS purging process.

### reset.css

Maizzle PHP provides a `reset.css` file where you can add all your generic CSS resets:

```css
@screen all {
  img {
    @apply max-w-full;
  }

  td, th {
    box-sizing: border-box;
  }
}

body {
  box-sizing: border-box;
  @apply m-0 p-0 w-full;
  word-break: break-word;
  -webkit-font-smoothing: antialiased;
}

img {
  border: 0;
  @apply leading-full align-middle;
}
```

## Extra CSS

Maizzle PHP uses a combination of [laravel-mix-purge-css](https://github.com/spatie/laravel-mix-purgecss), [Juice](https://github.com/Automattic/juice),
and [email-remove-unused-css](https://bitbucket.org/codsen/email-remove-unused-css.git) options to purge unused CSS  after the initial
Tailwind CSS build, and then to also remove any CSS classes that have already been inlined.

**You can use the `extra.css` file to define styles that won't be inlined.**

The contents of this file are added inside a `<style></style>` tag that will be ignored by the CSS inliner,
so you can use it to define email client-specific resets (that would normally be removed, because they usually target selectors that don't exist in your markup).

<div class="bg-grey-lightest border-l-4 border-orange p-4 mb-4" role="alert">
    <h5 class="text-grey-darker text-base font-semibold p-0 mb-2">CSS Purging Note</h5>
    <div class="text-grey-dark">
        CSS purging also applies to <code>extra.css</code>, so make sure that any selectors target existing elements in your HTML.
        Additionally, you can also whitelist selectors in the <code>removeUnusedCss.whitelist</code> option from your config.
    </div>
</div>

## Shorthand CSS

Thanks to [`postcss-merge-longhand`](https://github.com/cssnano/cssnano/tree/master/packages/postcss-merge-longhand),
Maizzle PHP can rewrite your CSS `padding`, `margin`, and `border` properties in shorthand-form, where possible.

Because Tailwind CSS classes mostly map one-to-one with CSS properties, this won't have any effect on them.
Instead, it's very useful when you extract components with Tailwind's `@apply`.

For example, considering this template:

```
---
title: Confirm your email
preheader: Please verify your email address with us
bodyClasses: bg-grey-light
---

<div class="col">test</div>
```

... let's extract a `.col` class in an imaginary `source/_styles/components.css`:

```css
.col {
  @apply py-8 px-4;
}
```

Normally, that would give us this:

```html
<div style="padding-top: 8px; padding-bottom: 8px; padding-left: 4px; padding-right: 4px;">test</div>
```

However, thanks to `postcss-merge-longhand`, we get this:

```html
<div style="padding: 8px 4px;">test</div>
```

As mentioned, this works for padding, margin, and border. Using shorthand CSS for these is well supported in email clients
and will make your HTML lighter, but the shorthand border is particularly useful because it's the only way Outlook will render it properly.

<div class="bg-grey-lightest border-l-4 border-orange p-4 mb-4" role="alert">
    <h5 class="text-grey-darker text-base font-semibold p-0 mb-2">No assumptions for missing values</h5>
    <div class="text-grey-dark">
        This functionality won't assume any missing values.
        For <code>padding</code> and <code>margin</code>, the class needs to specify properties for all four sides. For borders, see the example below.
    </div>
</div>

### Shorthand borders

To get the PostCSS plugin to rewrite your CSS borders in shorthand-form, you need to specify all these:

- `border-width`
- `border-style`
- `border-color`

<br>
When extracting a component class in Tailwind, that means you can do something like this:

```css
.my-border {
  @apply border border-solid border-blue;
}
```

... which, following the example above, will result in this shorthand form:

```html
<div style="border: 1px solid #3490dc;">Border example</div>
```
