---
title: Divider
description: Learn how to create a divider or horizontal rule for your HTML emails in Maizzle PHP
page_order: 10
path: docs/examples
navigation:
  group: Examples
  order: 10
---

# Divider

Similar to [Spacers](/docs/examples/spacers/), Divider provides consistent vertical spacing while allowing visual separation of your content.

A Divider has a thin horizontal line in the middle, which you can style to suit your needs. 
It can be used anywhere a `<table>` is allowed: before/after other tables, or inside table cells or divs.

The spacing above and below the Divider line is defined through the vertical padding of the inner `<td>` element, with Tailwind utilities:


```html
<table class="w-full" cellpadding="0" cellspacing="0" role="presentation">
  <tr>
    <td class="py-24 px-16">
      <div class="bg-black h-px leading-px">&zwnj;</div>
    </td>
  </tr>
</table>
```

In the example above:

1. `py-24 px-16` add 24px top&amp;bottom padding, as well as 16px padding on the sides
2. The `<div>` is the horizontal line, and we set its height and line-height to 1px
3. Just like with a Spacer, we use a `&zwnj;` to add _something_ inside, so it can take up height

### Customisation

You can use the padding utilities on the `<td>` to push and pull the horizontal line as needed. 
And you can increase the thickness of the hairline, too.

For example:

```html
<table class="w-full" cellpadding="0" cellspacing="0" role="presentation">
  <tr>
    <td class="pt-24 pr-64 pb-48 pl-0">
      <div class="bg-grey-light h-4 leading-4">&zwnj;</div>
    </td>
  </tr>
</table>
```

Need a shorter Divider when viewed on mobile devices? Use the `sm` breakpoint:

```html
<table class="w-full" cellpadding="0" cellspacing="0" role="presentation">
  <tr>
    <td class="py-24 px-16 sm-py-12 sm-py-8">
      <div class="bg-black h-px leading-px">&zwnj;</div>
    </td>
  </tr>
</table>
```
