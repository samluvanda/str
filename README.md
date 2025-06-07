# Str

A fluent, chainable string utility class for PHP.

## 📦 Installation

```bash
composer require samluvanda/str
```

## 🚀 Basic Usage

```php
use Str\Str;

$str = new Str("Hello World");
echo $str->toUpperCase()->toString(); // HELLO WORLD
```

## 📚 API Reference

### `__construct()`

Constructor 

**Parameters:**

- `string $value  The initial string value`

**Returns:** `mixed`

**Example:**
```php
$str->__construct(...);
```

### `at()`

Returns the character at the given index. Supports negative indexing from the end of the string. 

**Parameters:**

- `int $index  Position of the character (can be negative)`

**Returns:** `string|null  Character at the given index or null if out of bounds`

**Example:**
```php
$str->at(...);
```

### `charAt()`

Returns the character at the given index. Only positive indexes are supported. Returns an empty string if the index is out of bounds. 

**Parameters:**

- `int $index  Zero-based index of the character`

**Returns:** `string  Character at the given index or empty string if out of bounds`

**Example:**
```php
$str->charAt(...);
```

### `charCodeAt()`

Returns the UTF-16 code unit at the given index. Returns null if index is out of bounds. 

**Parameters:**

- `int $index  Index of the character`

**Returns:** `int|null  UTF-16 code unit or null if invalid index`

**Example:**
```php
$str->charCodeAt(...);
```

### `codePointAt()`

Returns the Unicode code point of the character at the given index. Returns null if index is out of bounds. 

**Parameters:**

- `int $index  Index of the character`

**Returns:** `int|null  Unicode code point or null if invalid index`

**Example:**
```php
$str->codePointAt(...);
```

### `concat()`

Concatenates the current string with one or more strings. 

**Parameters:**

- `string ...$strings  Strings to append`

**Returns:** `self  The current object for chaining`

**Example:**
```php
$str->concat(...);
```

### `endsWith()`

Determines whether the string ends with the given substring. If length is provided, the string is treated as if it were only that long. 

**Parameters:**

- `string $searchString  The substring to search for at the end`
- `int|null $length  Optional length to consider for truncation`

**Returns:** `bool  True if the string ends with the given substring, false otherwise`

**Example:**
```php
$str->endsWith(...);
```

### `includes()`

Determines whether the string contains the given substring. The search starts from the specified position. 

**Parameters:**

- `string $searchString  The substring to search for`
- `int $position  The index to start searching from`

**Returns:** `bool  True if the substring is found, false otherwise`

**Example:**
```php
$str->includes(...);
```

### `indexOf()`

Returns the index of the first occurrence of the specified substring, starting from the given position. 

**Parameters:**

- `string $searchString  The substring to search for`
- `int $position  The index to start the search from`

**Returns:** `int  Index of the first match, or -1 if not found`

**Example:**
```php
$str->indexOf(...);
```

### `isWellFormed()`

Checks whether the string is a well-formed UTF-8 sequence. 

**Parameters:**

- _None_

**Returns:** `bool  True if the string is well-formed, false otherwise`

**Example:**
```php
$str->isWellFormed(...);
```

### `lastIndexOf()`

Returns the index of the last occurrence of the specified substring. Optionally limits the search to a given position from the start. 

**Parameters:**

- `string $searchString  The substring to search for`
- `int|null $position  Optional position to search backward from`

**Returns:** `int  Index of the last occurrence, or -1 if not found`

**Example:**
```php
$str->lastIndexOf(...);
```

### `localeCompare()`

Compares the current string with another string lexicographically. 

**Parameters:**

- `string $compareString  The string to compare with`

**Returns:** `int  0 if equal, <0 if current is less, >0 if current is greater`

**Example:**
```php
$str->localeCompare(...);
```

### `match()`

Executes a regular expression match on the string. 

**Parameters:**

- `string $pattern  The regex pattern (including delimiters)`

**Returns:** `array|null  Array of matches or null if no match`

**Example:**
```php
$str->match(...);
```

### `matchAll()`

Executes a global regular expression match and returns all matches. 

**Parameters:**

- `string $pattern  The regex pattern (including delimiters and global behavior)`

**Returns:** `array  Array of all matches (each match includes captured groups)`

**Example:**
```php
$str->matchAll(...);
```

### `normalize()`

Normalizes the string using a specified Unicode normalization form. 

**Parameters:**

- `string $form  The normalization form: NFC, NFD, NFKC, or NFKD`

**Returns:** `self  The current object for chaining`

**Example:**
```php
$str->normalize(...);
```

### `padEnd()`

Pads the end of the string with a specified string until the target length is reached. 

**Parameters:**

- `int $targetLength  Desired total length after padding`
- `string $padString  String to use for padding (defaults to space)`

**Returns:** `self  The current object for chaining`

**Example:**
```php
$str->padEnd(...);
```

### `padStart()`

Pads the start of the string with a specified string until the target length is reached. 

**Parameters:**

- `int $targetLength  Desired total length after padding`
- `string $padString  String to use for padding (defaults to space)`

**Returns:** `self  The current object for chaining`

**Example:**
```php
$str->padStart(...);
```

### `repeat()`

Repeats the current string a specified number of times.  @throws InvalidArgumentException if count is negative

**Parameters:**

- `int $count  Number of times to repeat the string`

**Returns:** `self  The current object for chaining`

**Example:**
```php
$str->repeat(...);
```

### `replace()`

Replaces the first occurrence of a pattern with a replacement. 

**Parameters:**

- `string|array $pattern  The search string or pattern`
- `string|callable $replacement  The replacement string or callback`

**Returns:** `self  The current object for chaining`

**Example:**
```php
$str->replace(...);
```

### `replaceAll()`

Replaces all occurrences of a pattern with a replacement. 

**Parameters:**

- `string|array $pattern  The search string or pattern`
- `string|callable $replacement  The replacement string or callback`

**Returns:** `self  The current object for chaining`

**Example:**
```php
$str->replaceAll(...);
```

### `search()`

Searches for a pattern using regular expression. 

**Parameters:**

- `string $pattern  The regex pattern`

**Returns:** `int  Index of first match or -1 if not found`

**Example:**
```php
$str->search(...);
```

### `slice()`

Extracts a section of the string from start to (but not including) end. 

**Parameters:**

- `int $start  Start index (can be negative)`
- `int|null $end  Optional end index (can be negative)`

**Returns:** `self  The current object with sliced value`

**Example:**
```php
$str->slice(...);
```

### `split()`

Splits the string into an array using a separator. 

**Parameters:**

- `string $separator  The delimiter or regex`
- `int $limit  Maximum number of splits`

**Returns:** `array  Array of string segments`

**Example:**
```php
$str->split(...);
```

### `startsWith()`

Checks if the string starts with the given substring at the specified position. 

**Parameters:**

- `string $searchString  The substring to check`
- `int $position  The position to start checking from`

**Returns:** `bool  True if it starts with the substring, false otherwise`

**Example:**
```php
$str->startsWith(...);
```

### `substring()`

Returns the part of the string between start and end indexes. 

**Parameters:**

- `int $start  Start index (negative treated as 0)`
- `int|null $end  Optional end index (not included)`

**Returns:** `self  The current object with the substring value`

**Example:**
```php
$str->substring(...);
```

### `toLocaleLowerCase()`

Converts the string to lowercase using the specified locale. 

**Parameters:**

- `string $locale  The locale to use (e.g. en_US)`

**Returns:** `self  The current object for chaining`

**Example:**
```php
$str->toLocaleLowerCase(...);
```

### `toLocaleUpperCase()`

Converts the string to uppercase using the specified locale. 

**Parameters:**

- `string $locale  The locale to use (e.g. en_US)`

**Returns:** `self  The current object for chaining`

**Example:**
```php
$str->toLocaleUpperCase(...);
```

### `toLowerCase()`

Converts the string to lowercase. 

**Parameters:**

- _None_

**Returns:** `self  The current object for chaining`

**Example:**
```php
$str->toLowerCase(...);
```

### `toString()`

Returns the string value of the object. 

**Parameters:**

- _None_

**Returns:** `string  The current string value`

**Example:**
```php
$str->toString(...);
```

### `toUpperCase()`

Converts the string to uppercase. 

**Parameters:**

- _None_

**Returns:** `self  The current object for chaining`

**Example:**
```php
$str->toUpperCase(...);
```

### `toWellFormed()`

Replaces malformed UTF-8 sequences with the Unicode replacement character. 

**Parameters:**

- _None_

**Returns:** `self  The current object with a well-formed string`

**Example:**
```php
$str->toWellFormed(...);
```

### `trim()`

Trims whitespace from both ends of the string. 

**Parameters:**

- _None_

**Returns:** `self  The current object for chaining`

**Example:**
```php
$str->trim(...);
```

### `trimEnd()`

Trims whitespace from the end of the string. 

**Parameters:**

- _None_

**Returns:** `self  The current object for chaining`

**Example:**
```php
$str->trimEnd(...);
```

### `trimStart()`

Trims whitespace from the beginning of the string. 

**Parameters:**

- _None_

**Returns:** `self  The current object for chaining`

**Example:**
```php
$str->trimStart(...);
```

### `valueOf()`

Returns the primitive string value of the object. 

**Parameters:**

- _None_

**Returns:** `string  The current string value`

**Example:**
```php
$str->valueOf(...);
```

### `getIterator()`

Returns an iterator over the characters of the string. 

**Parameters:**

- _None_

**Returns:** `Traversable  Iterator over string characters`

**Example:**
```php
$str->getIterator(...);
```

### `__get()`

Magic getter for virtual properties like 'length'. 

**Parameters:**

- `string $name  The name of the property`

**Returns:** `mixed  The value of the virtual property`

**Example:**
```php
$str->__get(...);
```

## 📄 License

This project is open-sourced under the [MIT license](LICENSE).
