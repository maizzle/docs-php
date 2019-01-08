---
title: Spacers
description: Learn how to create vertical spacers for your HTML emails in Maizzle PHP
page_order: 9
path: docs/examples
navigation:
  group: Examples
  order: 9
---

# Spacers

Vertical spacing in HTML emails can be tricky, because of inconsistent support for `margin`, `padding`, and `<br>` tags.
Here's how to create simple yet reliable spacers for your emails, using basic HTML and Tailwind.

---

## The Div {#div-spacer}

This is the simplest kind of spacer you can use in an HTML email.

Being a `<div>`, it can be used anywhere such an element is allowed. 
In our case: before/after a `<table>`, inside `<td>` or `<th>`, or inside other `<div>` elements.

```html
<div class="leading-64 sm-h-32">&zwnj;</div>
```

Here's the idea:

1. `leading-64` adds `line-height: 64px;` - this is the default height, for desktop clients
2. `sm-h-32` sets `height: 32px;` for the `sm` breakpoint - this is the responsive height
3. We use a `&zwnj;` to add _something_ inside, so it can take up height reliably in all email clients

### Custom top/bottom heights

In case the `sm-h-{$size}` classes you have defined in your (custom?) Tailwind CSS config are not enough, you can double up by using padding instead:

```html
<div class="leading-64 sm-h-0 sm-py-64">&zwnj;</div>
```

`sm-h-0` will reset the height to zero on the `sm` breakpoint, and `sm-py-64` will add 128px of total padding,

## The Row {#row-spacer}

Use this one directly inside a `<table>`:

```
<tr>
  <td class="h-64 sm-h-32"></td>
</tr>
```

By default, Maizzle will transform the inline CSS `height: 64px;` to a `height="64"` attribute, for consistent email client support.

## The Table {#table-spacer}

A simple table with an empty cell that has a height set. Use it anywhere you can't use a Div or Row spacer.

```html
<table class="w-full" cellpadding="0" cellspacing="0" role="presentation">
  <tr>
    <td class="h-64 sm-h-32"></td>
  </tr>
</table>
```

<div class="bg-grey-lightest border-l-4 border-blue p-4 mb-4" role="alert">
    <h5 class="text-grey-darker text-base font-semibold mb-2 p-0">Accessibility</h5>
    <div class="text-grey-dark">
        Unless actually displaying tabular data in an email, <em>always</em> add <code>role="presentation"</code> to your tables.
    </div>
</div>
