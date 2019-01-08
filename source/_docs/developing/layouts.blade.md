---
title: Layouts
description: Using Laravel Blade layouts to build emails with Maizzle PHP
page_order: 5
navigation:
  group: Developing
  order: 5
---

# Layouts

The foundation of any email template in Maizzle PHP is the Layout.
These are 'master' pages that contain the boilerplate of your emails.
They pull in (or `yield()`) named content sections from any page that extends them.

In Maizzle PHP, layouts usually contain the `doctype`, `<head>` and `<body>` tags, with all the necessary child tags, like `<meta>` or other markup that doesn't need to change.

---

## Creating A Layout

Layout files are Laravel Blade files, stored in the `source/_layouts` directory.
For example, here is the `master.blade.php` layout in Maizzle PHP:

```php
<!DOCTYPE @{!! $page->doctype ?? 'html' !!}>
<html lang="@{{ $page->language ?? 'en' }}" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <meta charset="@{{ $page->charset ?? 'utf8' }}">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="x-apple-disable-message-reformatting">
  @@if($page->title)<title>@{{ $page->title }}</title>@@endif

  @@if(is_object($page->googleFonts) && $page->googleFonts->isNotEmpty())
  <!--[if !mso]><!--><link rel="stylesheet" href="https://fonts.googleapis.com/css?family=@{{ $page->googleFontsString() }}"><!--<![endif]-->
  @@endif

  @@include('_partials.css.email')
  @@stack('head')
</head>
<body class="@{{ $page->bodyClasses ?? '' }}">

  @@if($page->preheader)
  <div class="hidden text-0 leading-0" lang="@{{ $page->language ?? 'en' }}">@{!! $page->preheader !!}</div>
  @@endif

  @@yield('content')

</body>
</html>
```

As you can see, it's an email-tailored HTML boilerplate. It uses Laravel Blade syntax to insert variables and partials,
which are being pulled in from either your environment config, or from the template's Front Matter.

Notice the `@@yield('content')` Blade directive. This pulls in a section named `content` from any template that extends this layout.
More on sections, in the [Templates documentation](/docs/templates/#defining-sections) and in the [Laravel Blade docs](https://laravel.com/docs/5.6/blade#defining-a-layout).

## Referencing Variables

Variables, like those defined in the config or with [Front Matter at a template level](/docs/pages/#page-variables), are referenced via `$page->varname`.
In the above example, variables like `$page->language` or `$page->charset` are pulled from the config, while others like `$page->preheader` have been defined with Front Matter in the templates.

Jigsaw allows you to overwrite config variables with Front Matter, from each template.
So if one of your emails needs a different charset, you can easily override the global one.

Read the Jigsaw docs [on custom Front Matter variables](http://jigsaw.tighten.co/docs/content-markdown/).

<div class="bg-grey-lightest border-l-4 border-orange p-4 mb-4" role="alert">
    <h5 class="text-grey-darker text-base font-semibold p-0 mb-2">Overriding Nested Keys</h5>
    <div class="text-grey-dark">
        Currently, it's not possible in Jigsaw to inherit nested config keys in Front Matter.
        If you want to override a single nested key-value pair, you will need to specify all other sibling pairs, too.
    </div>
</div>

## Default extends

Maizzle PHP defines an `extends` key in your config, so that any `*.[blade].md` files will automatically extend the master Layout that the framework provides.
This way, you don't need to always specify a layout when using Blade-Markdown hybrid files.

```php
// config.php

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
```

Of course, each Template can extend its own Layout, by specifying it with Front Matter:

```
// emails/letter.blade.md

---
extends: _layouts.letter
---
```

... or with a Blade directive:

```
// emails/example.blade.php

---
title: Extending with a Blade directive, though Front Matter would work too
---

@@extends('_layouts.example.master')
```
<div class="bg-grey-lightest border-l-4 border-blue p-4 mb-4" role="alert">
  <div class="text-grey-darker">Layouts are referenced relative to the <code>source</code> directory using dot notation, where each dot represents a directory separator in the file name and the <code>.blade.php</code> extension omitted.</div>
</div>
