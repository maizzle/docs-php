---
title: Buttons
description: Learn how to create buttons for your HTML emails in Maizzle PHP
page_order: 11
path: docs/examples
navigation:
  group: Examples
  order: 11
---

# Buttons

HTML email buttons are simple table structures with an anchor inside.

For modern email clients, CSS padding can be used to make the entire button clickable. 
In Outlook, since CSS padding isn't supported on anchor tags, the <abbr title="Microsoft Office" class="cursor-help">MSO</abbr> `mso-padding-alt` CSS property can used 
on the table cell in order to preserve the aspect - however, this means that only the text itself will be clickable.

This makes customisation easy while still keeping your buttons looking great across email clients. 
If you want fully-clickable buttons in Outlook for Windows, take a look at Campaign Monitor's [bulletproof email buttons ↗](https://buttons.cm/)

---

## Filled

The common type of button, built with a table. 
For an extra touch, let's add rounded corners and a hover effect:

```html
<table cellpadding="0" cellspacing="0" role="presentation">
  <tr>
    <th class="bg-green hover-bg-green-dark rounded" style="mso-padding-alt: 12px 48px;">
      <a href="https://maizzle.com" class="block text-white text-sm leading-full py-12 px-48 no-underline">Button</a>
    </th>
  </tr>
</table>
```

Here's how that would look like:

<table class="mb-6" cellpadding="0" cellspacing="0" role="presentation">
  <tr>
    <th class="bg-indigo hover:bg-indigo-dark rounded">
      <a href="https://maizzle.com" class="block text-sm text-white leading-full py-4 px-12 no-underline">Button</a>
    </th>
  </tr>
</table>

## Outlined

No background color, so it inherits its container's background. Instead, we add a coloured border to the table cell.
To make it more interesting, let's also add a hover effect:

```
<table cellpadding="0" cellspacing="0" role="presentation">
  <tr>
    <th class="border-2 border-indigo hover-bg-indigo block rounded" style="mso-padding-alt: 12px 48px;">
      <a href="https://maizzle.com" class="block text-sm text-indigo all-hover-text-white leading-full py-12 px-48 no-underline">Button</a>
    </th>
  </tr>
</table>
```

<table class="my-6" cellpadding="0" cellspacing="0" role="presentation">
  <tr>
    <th class="border-2 border-indigo hover:bg-indigo block rounded-lg">
      <a href="https://maizzle.com" class="block text-sm text-indigo hover:text-white leading-full py-4 px-12 no-underline">Button</a>
    </th>
  </tr>
</table>

## Pill

Pill buttons just use a big `border-radius` value. Keep in mind that Outlook doesn't support this:

```html
<table cellpadding="0" cellspacing="0" role="presentation">
  <tr>
    <th class="bg-indigo hover-bg-indigo-dark shadow-md rounded-full" style="mso-padding-alt: 12px 48px;">
      <a href="https://maizzle.com" class="block text-sm text-white leading-full py-12 px-48 no-underline">Button</a>
    </th>
  </tr>
</table>
```

<table class="my-6" cellpadding="0" cellspacing="0" role="presentation">
  <tr>
    <th class="bg-indigo hover:bg-indigo-dark shadow-md rounded-full">
      <a href="https://maizzle.com" class="block text-sm text-white leading-full py-4 px-12 no-underline">Button</a>
    </th>
  </tr>
</table>
