---
title: Includes
description: Using Blade includes and components to import reusable blocks of email code in Maizzle PHP
page_order: 7
navigation:
  group: Developing
  order: 7
---

# Includes

Since we're using Laravel Blade, we can use its directives to pull in reusable blocks of code.
More, we can even create our own `@` directives for components and dynamic content.

---

## Partials

You can use the [`@@include()`](https://laravel.com/docs/5.7/blade#including-sub-views) Blade directive to pull reusable sections into your emails.

For example, Maizzle PHP does this in the master layout with the `email.blade.php` partial, to pull in the compiled CSS together with an Outlook-specific block of code.

### Example {#partials-example}

First, create a file at `source/_partials/sidebar.blade.php`, with the following content:

```php
<table>
  <tr>
    <td>
      <p>Sidebar content...</p>
    </td>
  </tr>
</table>
```

Then, use `@@include()` to pull it in a layout or a page:

```php
@@include('_partials.sidebar')
```
<div class="bg-grey-lightest border-l-4 border-blue p-4 mb-4" role="alert">
  <div class="text-grey-darker">Since it's a Blade file, it can contain both HTML and Blade syntax, and even plain PHP.</div>
</div>


---

## Components

Blade [Components & Slots](https://laravel.com/docs/5.7/blade#components-and-slots) are also supported.

You can use them as in the Blade docs or, because we're using Jigsaw, you can even register component aliases.

<div class="bg-grey-lightest border-l-4 border-orange p-4 mb-4" role="alert">
  <div class="text-grey-darker">Blade Components must be referenced relative to the <code>source</code> directory.</div>
</div>

### Registering Component Aliases

You can register a Blade component alias inside `blade.php`, as described [here](https://github.com/tightenco/jigsaw/pull/204).

Maizzle PHP currently comes with one component alias: an Outlook VML background image component.
The component file is a Blade file in the `source/_components` directory:

```php
// source/_components/vmlbg.blade.php

<!--[if mso]>
<v:image src="@{{ $src }}" xmlns:v="urn:schemas-microsoft-com:vml" style="width:@{{ $width }}px;height:@{{ $height }}px;" />
<v:rect fill="false" stroke="false" style="position:absolute;width:@{{ $width }}px;height:@{{ $height }}px;">
<div><![endif]-->
@{{ $slot }}
<!--[if mso]></div></v:rect><![endif]-->
```

Then, we simply register it in `blade.php`:

```php
// blade.php

$bladeCompiler->component('_components.vmlbg');
```

We can now use it in a layout or page:

```php
@@vmlbg(['src' => 'https://url.to/image.jpg', 'width' => 600, 'height' => 400])
    // your HTML to be overlayed on top of the image
@@endvmlbg
```




