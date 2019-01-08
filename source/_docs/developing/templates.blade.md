---
title: Templates
description: Creating email templates by extending a master layout in Maizzle PHP
page_order: 6
navigation:
  group: Developing
  order: 6
---

# Templates

They're called pages in Jigsaw, but in Maizzle PHP these are actually your email templates.

---

## File Types

Templates can be Blade, Markdown, or Blade-Markdown hybrids.
Different file formats support different things in Jigsaw, so here's an overview of what you can do with them.


### `*.blade.php` {#blade-php-files}

Regular PHP files that will be parsed by the Blade engine. This means you can use directives, includes, and even regular PHP in them.
It's mandatory that you use the <a href="http://jigsaw.tighten.co/docs/content-blade/" target="_blank" rel="noopener">`@@section`</a> directive to define where the content starts and ends.

### `*.md` {#md-files}

Regular Markdown files, cannot use Blade syntax. Of course, you can use YAML Front Matter variables.
They use the `extends` key in your config and will automatically extend the Layout mentioned in it, so you don't need to manually specify what Layout they extend.

### `*.blade.md` {#blade-md-files}

Blade-Markdown hybrids combine the best of both worlds, allowing you to use Markdown with Front Matter, as well as Blade and even pure PHP.
Same as with `*.md` files, these will also automatically extend the layout defined in your config's `extends` key.

## Variables

Variables can be set either in your environment config, or at a template level, through Front Matter.
With Front Matter, simply add them like this, inside triple-dashed lines at the top of your file:

```
---
myvar: This is the value
---
```

If you specify a variable that is already defined in your config, Jigsaw will use the one in your template instead.
For example, you can set the charset of a single email to be something else than the default `utf-8`:

```
---
charset: ISO-8859-1
---
```

## Defining Sections

With `.blade.md` or plain `.md` files, you don't need to define a section.
Simply using `@@yield('content')` in a Layout will pull in everything that comes after your template's Front Matter.

However, if you're using `.blade.php` files for your templates, you need to tell Jigsaw where your content starts and ends, because this type of file can define multiple sections.

To do this, simply use the `@@section` Blade directive, giving it a string parameter that matches what you have inside `@@yield()` in the layout your template is extending:

`emails/example-sections.blade.php`

```
---
extends: _layouts.master
title: The title of your email
preheader: This month's words of wisdom
---

@@section('content')

    // your email's HTML markup goes here

@@endsection
```

As you can see, we define a section named `content`, and this is exactly what `@@yield()` references in the master layout.

## Blade Stacks <span class="label bg-gradient-to-left-light-ocean text-xxs align-top">1.1.0</span> {#blade-stacks}

Maizzle PHP's default layouts include a `@@stack('head')` directive ([Blade docs](https://laravel.com/docs/5.7/blade#stacks)).

This allows you to use `@@push('head')` and `@@prepend('head')` in your Blade template files,
to add anything you'd like right before the closing `</head>` tag.

You could use this to add custom `<style></style>` blocks on a per-template basis. Email client-specific CSS resets make for a good example:

`source/emails/confirm-email.blade.md`

```blade
---
// front matter needs to be first!
---

@@push('head')
<style data-embed>
  a[x-apple-data-detectors] {color: inherit; text-decoration: none;}
</style>
@@endpush

<table>
    ...
```

You can push multiple stacks, too:

```blade
---
front matter ...
---

@@push('head')
<meta name="format-detection" content="telephone=no">
<meta name="format-detection" content="date=no">
<meta name="format-detection" content="address=no">
<meta name="format-detection" content="email=no">
@@endpush

@@prepend('head')
<style data-embed>
  a[x-apple-data-detectors] {color: inherit; text-decoration: none;}
  </style>
@@endprepend

<table>
    ...
```

Of course, you can use it for anything you'd like to have right before `</head>`, for this template only: additional meta tags,
Outlook conditionals, custom ESP code - you name it!

Notes:

- When `@@push`ing a `<style></style>`, you can add a `data-embed` attribute to it if you need the CSS inliner to ignore it.

- You cannot use Tailwind CSS at-rules here. Tailwind is processed before this file is, so using something like `@@apply` will have no effect.

## Blade Directives <span class="label bg-gradient-to-left-light-ocean text-xxs align-top">1.1.0</span> {#blade-directives}

The `@@env($environment)` Blade directive, inspired by [the one](https://laravel.com/docs/5.7/blade#extending-blade) in the Laravel docs,
allows you to output content only when building for a specific environment.

For example, to output something only for _production_ emails, you can do this:

`source/emails/example.blade.md`

```blade
---
// front matter always first!
---

<table class="w-full" cellpadding="0" cellspacing="0" role="presentation">
  <tr>
      <td align="center" class="px-8">
        @@env('production')
            This text will be visible only when running `npm run production`
        @@endenv
      </td>
  </tr>
</table>
```

Of course, you can do an if/else statement:

```blade
...

<table class="w-full" cellpadding="0" cellspacing="0" role="presentation">
  <tr>
      <td align="center" class="px-8">
        @@env('development')
            Show this if we do `npm run dev` or `npm run watch`
        @@elseenv('production')
            But when we do `npm run production`, show this instead
        @@endenv
      </td>
  </tr>
</table>
```

Note: `$environment` must match one of the `NODE_ENV` environment variables set in `package.json`.
