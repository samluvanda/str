# Str

A fluent, chainable string utility class for PHP.

## 📦 Installation

Via Composer:

```bash
composer require samluvanda/str
```

## 🚀 Usage

```php
use Str\Str;

$str = new Str("Hello World");
echo $str->toUpperCase()->toString(); // HELLO WORLD
```

## 📚 Available Methods

### `__construct()`

**Parameters:**

- `string $value`

**Returns:** `mixed`

**Usage:**
```php
$str->__construct(...);
```

### `at()`

**Parameters:**

- `int $index`

**Returns:** `?string`

**Usage:**
```php
$str->at(...);
```

### `charAt()`

**Parameters:**

- `int $index`

**Returns:** `string`

**Usage:**
```php
$str->charAt(...);
```

### `charCodeAt()`

**Parameters:**

- `int $index`

**Returns:** `?int`

**Usage:**
```php
$str->charCodeAt(...);
```

### `codePointAt()`

**Parameters:**

- `int $index`

**Returns:** `?int`

**Usage:**
```php
$str->codePointAt(...);
```

### `concat()`

**Parameters:**

- `string ...$strings`

**Returns:** `self`

**Usage:**
```php
$str->concat(...);
```

### `endsWith()`

**Parameters:**

- `string $searchString`
- `?int $length = null`

**Returns:** `bool`

**Usage:**
```php
$str->endsWith(...);
```

### `includes()`

**Parameters:**

- `string $searchString`
- `int $position = 0`

**Returns:** `bool`

**Usage:**
```php
$str->includes(...);
```

### `indexOf()`

**Parameters:**

- `string $searchString`
- `int $position = 0`

**Returns:** `int`

**Usage:**
```php
$str->indexOf(...);
```

### `isWellFormed()`

**Parameters:**

- _None_

**Returns:** `bool`

**Usage:**
```php
$str->isWellFormed(...);
```

### `lastIndexOf()`

**Parameters:**

- `string $searchString`
- `?int $position = null`

**Returns:** `int`

**Usage:**
```php
$str->lastIndexOf(...);
```

### `localeCompare()`

**Parameters:**

- `string $compareString`

**Returns:** `int`

**Usage:**
```php
$str->localeCompare(...);
```

### `match()`

**Parameters:**

- `string $pattern`

**Returns:** `?array`

**Usage:**
```php
$str->match(...);
```

### `matchAll()`

**Parameters:**

- `string $pattern`

**Returns:** `array`

**Usage:**
```php
$str->matchAll(...);
```

### `normalize()`

**Parameters:**

- `string $form = 'NFC'`

**Returns:** `self`

**Usage:**
```php
$str->normalize(...);
```

### `padEnd()`

**Parameters:**

- `int $targetLength`
- `string $padString = ' '`

**Returns:** `self`

**Usage:**
```php
$str->padEnd(...);
```

### `padStart()`

**Parameters:**

- `int $targetLength`
- `string $padString = ' '`

**Returns:** `self`

**Usage:**
```php
$str->padStart(...);
```

### `repeat()`

**Parameters:**

- `int $count`

**Returns:** `self`

**Usage:**
```php
$str->repeat(...);
```

### `replace()`

**Parameters:**

- `string|array $pattern`
- `string|callable $replacement`

**Returns:** `self`

**Usage:**
```php
$str->replace(...);
```

### `replaceAll()`

**Parameters:**

- `string|array $pattern`
- `string|callable $replacement`

**Returns:** `self`

**Usage:**
```php
$str->replaceAll(...);
```

### `search()`

**Parameters:**

- `string $pattern`

**Returns:** `int`

**Usage:**
```php
$str->search(...);
```

### `slice()`

**Parameters:**

- `int $start`
- `?int $end = null`

**Returns:** `self`

**Usage:**
```php
$str->slice(...);
```

### `split()`

**Parameters:**

- `string $separator`
- `int $limit = PHP_INT_MAX`

**Returns:** `array`

**Usage:**
```php
$str->split(...);
```

### `startsWith()`

**Parameters:**

- `string $searchString`
- `int $position = 0`

**Returns:** `bool`

**Usage:**
```php
$str->startsWith(...);
```

### `substring()`

**Parameters:**

- `int $start`
- `?int $end = null`

**Returns:** `self`

**Usage:**
```php
$str->substring(...);
```

### `toLocaleLowerCase()`

**Parameters:**

- `string $locale = 'en_US'`

**Returns:** `self`

**Usage:**
```php
$str->toLocaleLowerCase(...);
```

### `toLocaleUpperCase()`

**Parameters:**

- `string $locale = 'en_US'`

**Returns:** `self`

**Usage:**
```php
$str->toLocaleUpperCase(...);
```

### `toLowerCase()`

**Parameters:**

- _None_

**Returns:** `self`

**Usage:**
```php
$str->toLowerCase(...);
```

### `toString()`

**Parameters:**

- _None_

**Returns:** `string`

**Usage:**
```php
$str->toString(...);
```

### `toUpperCase()`

**Parameters:**

- _None_

**Returns:** `self`

**Usage:**
```php
$str->toUpperCase(...);
```

### `toWellFormed()`

**Parameters:**

- _None_

**Returns:** `self`

**Usage:**
```php
$str->toWellFormed(...);
```

### `trim()`

**Parameters:**

- _None_

**Returns:** `self`

**Usage:**
```php
$str->trim(...);
```

### `trimEnd()`

**Parameters:**

- _None_

**Returns:** `self`

**Usage:**
```php
$str->trimEnd(...);
```

### `trimStart()`

**Parameters:**

- _None_

**Returns:** `self`

**Usage:**
```php
$str->trimStart(...);
```

### `valueOf()`

**Parameters:**

- _None_

**Returns:** `string`

**Usage:**
```php
$str->valueOf(...);
```

### `getIterator()`

**Parameters:**

- _None_

**Returns:** `Traversable`

**Usage:**
```php
$str->getIterator(...);
```

### `__get()`

**Parameters:**

- `string $name`

**Returns:** `mixed`

**Usage:**
```php
$str->__get(...);
```

## 📄 License

This project is open-sourced under the [MIT license](LICENSE).
