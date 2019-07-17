<p align="center">
    <img src="https://img.icons8.com/nolan/2x/text-box.png">
</p>

# Text Field
> This component is a part of the [**Olympus Zeus Core**][zeus-url] **WordPress** framework.  
> It uses the default WordPress text field to display password, range, text, datetime, tel, and more fields.

[![Olympus Component][olympus-image]][olympus-url]
[![CodeFactor Grade][codefactor-image]][codefactor-url]
[![Packagist Version][packagist-image]][packagist-url]

## Installation

Using `composer` in your PHP project:

```sh
composer require getolympus/olympus-text-field
```

## Field initialization

Use the following lines to add a `text field` in your **WordPress** admin pages or custom post type meta fields:

```php
return \GetOlympus\Field\Text::build('my_text_field_id', [
    'title' => 'What do you like?',
    'default' => 'Penguins, I am sure they\'re gonna dominate the World!',
    'description' => 'Put in here everything you want.',
    'placeholder' => 'McDonald\'s as well',
    'type' => 'text',

    /**
     * Settings definition
     * @see the `Settings definition` section below
     */
    'settings' => [],
]);
```

## Variables definitions

| Variable      | Type    | Default value if not set | Accepted values |
| ------------- | ------- | ------------------------ | --------------- |
| `title`       | String  | `'Text'` | *empty* |
| `default`     | String  | *empty* | *empty* |
| `description` | String  | *empty* | *empty* |
| `placeholder` | String  | *empty* | *empty* |
| `type`        | String  | `'text'` | see [Accepted type](#accepted-type) |
| `settings`    | Array   | see [Field initialization](#field-initialization) | see [Settings definition](#settings-definition) |

## Accepted type

* `date` see [Date type](#date-type)
* `datetime-local` see [Datetime-local type](#datetime-local-type)
* `email` see [Email type](#email-type)
* `hidden` see [Hidden type](#hidden-type)
* `month` see [Month type](#month-type)
* `number` see [Number type](#number-type)
* `password` see [Password type](#password-type)
* `range` see [Range type](#range-type)
* `search` see [Search type](#search-type)
* `tel` see [Tel type](#tel-type)
* `text` see [Text type](#text-type)
* `time` see [Time type](#time-type)
* `week` see [Week type](#week-type)

## Settings definition

The `settings` variable is an array of options depending on `type` value.  
In all cases, here are the default settings with their explanations:

| Variable      | Type    | Default value if not set | Accepted values |
| ------------- | ------- | ------------------------ | --------------- |
| `attrs`       | String  | *empty* | *empty* |
| `after`       | String  | *empty* | *empty* |
| `before`      | String  | *empty* | *empty* |
| `class`       | String  | *empty* | *empty* |
| `readonly`    | Boolean | `false` | `true` or `false` |

* **Special case:** `attrs` will let you add all additional attributes you need, such as `data-*`. **Pay attention** to this!
* `after` will insert contents after the field. In `number` and `range` cases, the `after` content will prepend the `max` value
* `before` will insert contents before the field. In `number` and `range` cases, the `before` content will append the `min` value
* `class` will add CSS classes to the already-in `regular-text` field class (not used in `hidden` case)
* `readonly` will avoid the field to be used when its value is set to `true`

### Date type

Full documentation on [Mozilla Date page](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/Input/date)

| Variable      | Type    | Default value if not set | Accepted values |
| ------------- | ------- | ------------------------ | --------------- |
| `max`         | Date    | *empty* | latest date to accept in `yyyy-MM-dd` format |
| `min`         | Date    | *empty* | earliest date to accept in `yyyy-MM-dd` format |
| `step`        | Integer | *empty* | integer, to read as `day` |

### Datetime-local type

Full documentation on [Mozilla Datetime-local page](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/Input/datetime-local)

| Variable      | Type    | Default value if not set | Accepted values |
| ------------- | ------- | ------------------------ | --------------- |
| `max`         | Date    | *empty* | latest date to accept in `yyyy-MM-ddThh:mm` format |
| `min`         | Date    | *empty* | earliest date to accept in `yyyy-MM-ddThh:mm` format |
| `step`        | Integer | *empty* | integer, to read as `second` |

### Email type

Full documentation on [Mozilla Email page](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/Input/email)

| Variable      | Type    | Default value if not set | Accepted values |
| ------------- | ------- | ------------------------ | --------------- |
| `maxlength`   | Integer | *empty* | *empty* |
| `minlength`   | Integer | *empty* | *empty* |
| `multiple`    | Boolean | `false` | `true` or `false` |
| `pattern`     | String  | *empty* | javascript regular expression |
| `size`        | Integer | *empty* | *empty* |
| `spellcheck`  | Boolean | `false` | `true` or `false` |

### Hidden type

Full documentation on [Mozilla Hidden page](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/Input/hidden)

| Variable      | Type    | Default value if not set | Accepted values |
| ------------- | ------- | ------------------------ | --------------- |
| `display`     | Boolean | `false` | `true` or `false` |

This special `display` variable defines if the hidden field have to show field value or not:
- set to `false`, a sentence will show where the value is stored in Database
- set to `true`, a sentence will show where the value is stored in Database and what is the current value

### Month type

Full documentation on [Mozilla Month page](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/Input/month)

| Variable      | Type    | Default value if not set | Accepted values |
| ------------- | ------- | ------------------------ | --------------- |
| `max`         | Date    | *empty* | latest date to accept in `yyyy-MM` format |
| `min`         | Date    | *empty* | earliest date to accept in `yyyy-MM` format |
| `step`        | Integer | *empty* | integer, to read as `month` |

### Number type

Full documentation on [Mozilla Number page](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/Input/number)

| Variable      | Type    | Default value if not set | Accepted values |
| ------------- | ------- | ------------------------ | --------------- |
| `max`         | Integer | *empty* | *empty* |
| `min`         | Integer | *empty* | *empty* |
| `step`        | Integer | *empty* | integer, to read as `number` |

This `number` type will display `max` and `min` values arround the field itself.

### Password type

Full documentation on [Mozilla Password page](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/Input/password)

| Variable      | Type    | Default value if not set | Accepted values |
| ------------- | ------- | ------------------------ | --------------- |
| `maxlength`   | Integer | *empty* | *empty* |
| `minlength`   | Integer | *empty* | *empty* |
| `pattern`     | String  | *empty* | javascript regular expression |
| `size`        | Integer | *empty* | *empty* |

### Range type

Full documentation on [Mozilla Range page](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/Input/range)

| Variable      | Type    | Default value if not set | Accepted values |
| ------------- | ------- | ------------------------ | --------------- |
| `max`         | Integer | *empty* | *empty* |
| `min`         | Integer | *empty* | *empty* |
| `step`        | Integer | *empty* | integer, to read as `number` |

This `range` type will display `max` and `min` values arround the field itself, with value in an `output` HTML tag.

### Search type

Full documentation on [Mozilla Search page](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/Input/search)

| Variable      | Type    | Default value if not set | Accepted values |
| ------------- | ------- | ------------------------ | --------------- |
| `maxlength`   | Integer | *empty* | *empty* |
| `minlength`   | Integer | *empty* | *empty* |
| `pattern`     | String  | *empty* | javascript regular expression |
| `size`        | Integer | *empty* | *empty* |
| `spellcheck`  | Boolean | `false` | `true` or `false` |

### Tel type

Full documentation on [Mozilla Tel page](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/Input/tel)

| Variable      | Type    | Default value if not set | Accepted values |
| ------------- | ------- | ------------------------ | --------------- |
| `maxlength`   | Integer | *empty* | *empty* |
| `minlength`   | Integer | *empty* | *empty* |
| `pattern`     | String  | *empty* | javascript regular expression |
| `size`        | Integer | *empty* | *empty* |

### Text type

Full documentation on [Mozilla Text page](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/Input/text)

| Variable      | Type    | Default value if not set | Accepted values |
| ------------- | ------- | ------------------------ | --------------- |
| `maxlength`   | Integer | *empty* | *empty* |
| `minlength`   | Integer | *empty* | *empty* |
| `pattern`     | String  | *empty* | javascript regular expression |
| `size`        | Integer | *empty* | *empty* |
| `spellcheck`  | Boolean | `false` | `true` or `false` |

### Time type

Full documentation on [Mozilla Time page](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/Input/time)

| Variable      | Type    | Default value if not set | Accepted values |
| ------------- | ------- | ------------------------ | --------------- |
| `max`         | Date    | *empty* | latest time to accept in `hh:mm` or `hh:mm:ss` format |
| `min`         | Date    | *empty* | earliest time to accept in `hh:mm` or `hh:mm:ss` format |
| `step`        | Integer | *empty* | integer, to read as `second` |

When the `step` variable is provided, browser will add the seconds input area adjacent to the minutes section.  
The `max` and `min` variables format will automatically be forced to `hh:mm:ss`.

### Week type

Full documentation on [Mozilla Week page](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/Input/week)

| Variable      | Type    | Default value if not set | Accepted values |
| ------------- | ------- | ------------------------ | --------------- |
| `max`         | Date    | *empty* | latest time to accept in `yyyy-Www` format |
| `min`         | Date    | *empty* | earliest time to accept in `yyyy-Www` format |
| `step`        | Integer | *empty* | integer, to read as `1week` |

## Retrive data

Retrieve your value from Database with a simple `get_option('my_text_field_id', '')` (see [WordPress reference][getoption-url]):

```php
// Get text from Database
$text = get_option('my_text_field_id', '');

// Display text
echo $text;
```

## Release History

* 0.0.16
- [x] FIX: remove twig dependency from composer

* 0.0.15
- [x] FIX: remove zeus-core dependency from composer

* 0.0.14
- [x] ADD: new version with dedicated type settings

## Authors and Copyright

Achraf Chouk  
[![@crewstyle][twitter-image]][twitter-url]

Please, read [LICENSE][license-blob] for more information.  
[![MIT][license-image]][license-url]

<https://github.com/crewstyle>  
<https://fr.linkedin.com/in/achrafchouk>

## Contributing

1. Fork it (<https://github.com/GetOlympus/olympus-text-field/fork>)
2. Create your feature branch (`git checkout -b feature/fooBar`)
3. Commit your changes (`git commit -am 'Add some fooBar'`)
4. Push to the branch (`git push origin feature/fooBar`)
5. Create a new Pull Request

---

**Built with ♥ by [Achraf Chouk](http://github.com/crewstyle "Achraf Chouk") ~ (c) since a long time.**

<!-- links & imgs dfn's -->
[olympus-image]: https://img.shields.io/badge/for-Olympus-44cc11.svg?style=flat-square
[olympus-url]: https://github.com/GetOlympus
[zeus-url]: https://github.com/GetOlympus/Zeus-Core
[codefactor-image]: https://www.codefactor.io/repository/github/GetOlympus/olympus-text-field/badge?style=flat-square
[codefactor-url]: https://www.codefactor.io/repository/github/getolympus/olympus-text-field
[getoption-url]: https://developer.wordpress.org/reference/functions/get_option/
[license-blob]: https://github.com/GetOlympus/olympus-text-field/blob/master/LICENSE
[license-image]: https://img.shields.io/badge/license-MIT_License-blue.svg?style=flat-square
[license-url]: http://opensource.org/licenses/MIT
[packagist-image]: https://img.shields.io/packagist/v/getolympus/olympus-text-field.svg?style=flat-square
[packagist-url]: https://packagist.org/packages/getolympus/olympus-text-field
[twitter-image]: https://img.shields.io/badge/crewstyle-blue.svg?style=social&logo=twitter
[twitter-url]: http://twitter.com/crewstyle