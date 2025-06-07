<?php

namespace Str;

use IteratorAggregate;
use Traversable;
use RuntimeException;
use InvalidArgumentException;
use Normalizer;

class Str implements IteratorAggregate
{
    protected string $value;

    /**
     * Constructor
     *
     * @param string $value  The initial string value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * Returns the character at the given index.
     * Supports negative indexing from the end of the string.
     *
     * @param int $index  Position of the character (can be negative)
     * @return string|null  Character at the given index or null if out of bounds
     */
    public function at(int $index): ?string
    {
        $length = mb_strlen($this->value);

        if ($index < 0) {
            $index += $length;
        }

        if ($index < 0 || $index >= $length) {
            return null;
        }

        return mb_substr($this->value, $index, 1);
    }

    /**
     * Returns the character at the given index.
     * Only positive indexes are supported.
     * Returns an empty string if the index is out of bounds.
     *
     * @param int $index  Zero-based index of the character
     * @return string  Character at the given index or empty string if out of bounds
     */
    public function charAt(int $index): string
    {
        if ($index < 0 || $index >= mb_strlen($this->value)) {
            return '';
        }

        return mb_substr($this->value, $index, 1);
    }

    /**
     * Returns the UTF-16 code unit at the given index.
     * Returns null if index is out of bounds.
     *
     * @param int $index  Index of the character
     * @return int|null  UTF-16 code unit or null if invalid index
     */
    public function charCodeAt(int $index): ?int
    {
        $char = $this->charAt($index);
        return $char === '' ? null : mb_ord($char, 'UTF-8');
    }

    /**
     * Returns the Unicode code point of the character at the given index.
     * Returns null if index is out of bounds.
     *
     * @param int $index  Index of the character
     * @return int|null  Unicode code point or null if invalid index
     */
    public function codePointAt(int $index): ?int
    {
        $char = $this->at($index);
        return $char === null ? null : mb_ord($char, 'UTF-8');
    }

    /**
     * Concatenates the current string with one or more strings.
     *
     * @param string ...$strings  Strings to append
     * @return self  The current object for chaining
     */
    public function concat(string ...$strings): self
    {
        $this->value .= implode('', $strings);
        return $this;
    }

    /**
     * Determines whether the string ends with the given substring.
     * If length is provided, the string is treated as if it were only that long.
     *
     * @param string $searchString  The substring to search for at the end
     * @param int|null $length  Optional length to consider for truncation
     * @return bool  True if the string ends with the given substring, false otherwise
     */
    public function endsWith(string $searchString, ?int $length = null): bool
    {
        $str = $this->value;

        if ($length !== null) {
            $str = mb_substr($str, 0, $length);
        }

        $substrLength = mb_strlen($searchString);
        $end = mb_substr($str, -$substrLength);

        return $end === $searchString;
    }

    /**
     * Determines whether the string contains the given substring.
     * The search starts from the specified position.
     *
     * @param string $searchString  The substring to search for
     * @param int $position  The index to start searching from
     * @return bool  True if the substring is found, false otherwise
     */
    public function includes(string $searchString, int $position = 0): bool
    {
        if ($position < 0 || $position >= mb_strlen($this->value)) {
            return false;
        }

        $sub = mb_substr($this->value, $position);
        return mb_strpos($sub, $searchString) !== false;
    }

    /**
     * Returns the index of the first occurrence of the specified substring,
     * starting from the given position.
     *
     * @param string $searchString  The substring to search for
     * @param int $position  The index to start the search from
     * @return int  Index of the first match, or -1 if not found
     */
    public function indexOf(string $searchString, int $position = 0): int
    {
        if ($position < 0 || $position >= mb_strlen($this->value)) {
            return -1;
        }

        $index = mb_strpos($this->value, $searchString, $position);
        return $index === false ? -1 : $index;
    }

    /**
     * Checks whether the string is a well-formed UTF-8 sequence.
     *
     * @return bool  True if the string is well-formed, false otherwise
     */
    public function isWellFormed(): bool
    {
        return mb_check_encoding($this->value, 'UTF-8');
    }

    /**
     * Returns the index of the last occurrence of the specified substring.
     * Optionally limits the search to a given position from the start.
     *
     * @param string $searchString  The substring to search for
     * @param int|null $position  Optional position to search backward from
     * @return int  Index of the last occurrence, or -1 if not found
     */
    public function lastIndexOf(string $searchString, ?int $position = null): int
    {
        $haystack = $this->value;

        if ($position !== null) {
            $position = min($position, mb_strlen($haystack));
            $haystack = mb_substr($haystack, 0, $position + 1);
        }

        $index = mb_strrpos($haystack, $searchString);
        return $index === false ? -1 : $index;
    }

    /**
     * Compares the current string with another string lexicographically.
     *
     * @param string $compareString  The string to compare with
     * @return int  0 if equal, <0 if current is less, >0 if current is greater
     */
    public function localeCompare(string $compareString): int
    {
        return strcmp($this->value, $compareString);
    }

    /**
     * Executes a regular expression match on the string.
     *
     * @param string $pattern  The regex pattern (including delimiters)
     * @return array|null  Array of matches or null if no match
     */
    public function match(string $pattern): ?array
    {
        $matches = [];
        $result = preg_match($pattern, $this->value, $matches);

        return $result === 1 ? $matches : null;
    }

    /**
     * Executes a global regular expression match and returns all matches.
     *
     * @param string $pattern  The regex pattern (including delimiters and global behavior)
     * @return array  Array of all matches (each match includes captured groups)
     */
    public function matchAll(string $pattern): array
    {
        $matches = [];
        preg_match_all($pattern, $this->value, $matches, PREG_SET_ORDER);
        return $matches;
    }

    /**
     * Normalizes the string using a specified Unicode normalization form.
     *
     * @param string $form  The normalization form: NFC, NFD, NFKC, or NFKD
     * @return self  The current object for chaining
     */
    public function normalize(string $form = 'NFC'): self
    {
        if (!class_exists('Normalizer')) {
            throw new RuntimeException('The intl extension is required for normalization.');
        }

        $normalized = Normalizer::normalize($this->value, constant('Normalizer::' . $form));
        if ($normalized === false) {
            throw new InvalidArgumentException("Invalid normalization form: $form");
        }

        $this->value = $normalized;
        return $this;
    }

    /**
     * Pads the end of the string with a specified string until the target length is reached.
     *
     * @param int $targetLength  Desired total length after padding
     * @param string $padString  String to use for padding (defaults to space)
     * @return self  The current object for chaining
     */
    public function padEnd(int $targetLength, string $padString = ' '): self
    {
        $currentLength = mb_strlen($this->value);

        if ($currentLength >= $targetLength || $padString === '') {
            return $this;
        }

        $padNeeded = $targetLength - $currentLength;

        while (mb_strlen($padString) < $padNeeded) {
            $padString .= $padString;
        }

        $this->value .= mb_substr($padString, 0, $padNeeded);

        return $this;
    }

    /**
     * Pads the start of the string with a specified string until the target length is reached.
     *
     * @param int $targetLength  Desired total length after padding
     * @param string $padString  String to use for padding (defaults to space)
     * @return self  The current object for chaining
     */
    public function padStart(int $targetLength, string $padString = ' '): self
    {
        $currentLength = mb_strlen($this->value);

        if ($currentLength >= $targetLength || $padString === '') {
            return $this;
        }

        $padNeeded = $targetLength - $currentLength;

        while (mb_strlen($padString) < $padNeeded) {
            $padString .= $padString;
        }

        $this->value = mb_substr($padString, 0, $padNeeded) . $this->value;

        return $this;
    }

    /**
     * Repeats the current string a specified number of times.
     *
     * @param int $count  Number of times to repeat the string
     * @return self  The current object for chaining
     * @throws InvalidArgumentException if count is negative
     */
    public function repeat(int $count): self
    {
        if ($count < 0) {
            throw new InvalidArgumentException('Repeat count must be non-negative.');
        }

        $this->value = str_repeat($this->value, $count);
        return $this;
    }

    /**
     * Replaces the first occurrence of a pattern with a replacement.
     *
     * @param string|array $pattern  The search string or pattern
     * @param string|callable $replacement  The replacement string or callback
     * @return self  The current object for chaining
     */
    public function replace(string|array $pattern, string|callable $replacement): self
    {
        $this->value = preg_replace($pattern, $replacement, $this->value, 1);
        return $this;
    }

    /**
     * Replaces all occurrences of a pattern with a replacement.
     *
     * @param string|array $pattern  The search string or pattern
     * @param string|callable $replacement  The replacement string or callback
     * @return self  The current object for chaining
     */
    public function replaceAll(string|array $pattern, string|callable $replacement): self
    {
        $this->value = preg_replace($pattern, $replacement, $this->value);
        return $this;
    }

    /**
     * Searches for a pattern using regular expression.
     *
     * @param string $pattern  The regex pattern
     * @return int  Index of first match or -1 if not found
     */
    public function search(string $pattern): int
    {
        $result = preg_match($pattern, $this->value, $matches, PREG_OFFSET_CAPTURE);
        return $result === 1 ? $matches[0][1] : -1;
    }

    /**
     * Extracts a section of the string from start to (but not including) end.
     *
     * @param int $start  Start index (can be negative)
     * @param int|null $end  Optional end index (can be negative)
     * @return self  The current object with sliced value
     */
    public function slice(int $start, ?int $end = null): self
    {
        $length = mb_strlen($this->value);

        if ($start < 0) $start += $length;
        if ($end !== null && $end < 0) $end += $length;

        $substrLength = $end !== null ? $end - $start : null;

        $this->value = mb_substr($this->value, $start, $substrLength);
        return $this;
    }

    /**
     * Splits the string into an array using a separator.
     *
     * @param string $separator  The delimiter or regex
     * @param int $limit  Maximum number of splits
     * @return array  Array of string segments
     */
    public function split(string $separator, int $limit = PHP_INT_MAX): array
    {
        if (@preg_match($separator, '') !== false) {
            return preg_split($separator, $this->value, $limit);
        }

        return explode($separator, $this->value, $limit);
    }

    /**
     * Checks if the string starts with the given substring at the specified position.
     *
     * @param string $searchString  The substring to check
     * @param int $position  The position to start checking from
     * @return bool  True if it starts with the substring, false otherwise
     */
    public function startsWith(string $searchString, int $position = 0): bool
    {
        if ($position < 0 || $position >= mb_strlen($this->value)) {
            return false;
        }

        return mb_substr($this->value, $position, mb_strlen($searchString)) === $searchString;
    }

    /**
     * Returns the part of the string between start and end indexes.
     *
     * @param int $start  Start index (negative treated as 0)
     * @param int|null $end  Optional end index (not included)
     * @return self  The current object with the substring value
     */
    public function substring(int $start, ?int $end = null): self
    {
        $length = mb_strlen($this->value);

        $start = max(0, $start);
        $end = $end !== null ? max(0, $end) : $length;

        if ($start > $end) {
            [$start, $end] = [$end, $start];
        }

        $this->value = mb_substr($this->value, $start, $end - $start);
        return $this;
    }

    /**
     * Converts the string to lowercase using the specified locale.
     *
     * @param string $locale  The locale to use (e.g. en_US)
     * @return self  The current object for chaining
     */
    public function toLocaleLowerCase(string $locale = 'en_US'): self
    {
        $prevLocale = setlocale(LC_CTYPE, 0);
        setlocale(LC_CTYPE, $locale);

        $this->value = mb_strtolower($this->value, mb_detect_encoding($this->value));

        setlocale(LC_CTYPE, $prevLocale);
        return $this;
    }

    /**
     * Converts the string to uppercase using the specified locale.
     *
     * @param string $locale  The locale to use (e.g. en_US)
     * @return self  The current object for chaining
     */
    public function toLocaleUpperCase(string $locale = 'en_US'): self
    {
        $prevLocale = setlocale(LC_CTYPE, 0);
        setlocale(LC_CTYPE, $locale);

        $this->value = mb_strtoupper($this->value, mb_detect_encoding($this->value));

        setlocale(LC_CTYPE, $prevLocale);
        return $this;
    }

    /**
     * Converts the string to lowercase.
     *
     * @return self  The current object for chaining
     */
    public function toLowerCase(): self
    {
        $this->value = mb_strtolower($this->value);
        return $this;
    }

    /**
     * Returns the string value of the object.
     *
     * @return string  The current string value
     */
    public function toString(): string
    {
        return $this->value;
    }

    /**
     * Converts the string to uppercase.
     *
     * @return self  The current object for chaining
     */
    public function toUpperCase(): self
    {
        $this->value = mb_strtoupper($this->value);
        return $this;
    }

    /**
     * Replaces malformed UTF-8 sequences with the Unicode replacement character.
     *
     * @return self  The current object with a well-formed string
     */
    public function toWellFormed(): self
    {
        $this->value = mb_convert_encoding($this->value, 'UTF-8', 'UTF-8');
        return $this;
    }

    /**
     * Trims whitespace from both ends of the string.
     *
     * @return self  The current object for chaining
     */
    public function trim(): self
    {
        $this->value = trim($this->value);
        return $this;
    }

    /**
     * Trims whitespace from the end of the string.
     *
     * @return self  The current object for chaining
     */
    public function trimEnd(): self
    {
        $this->value = rtrim($this->value);
        return $this;
    }

    /**
     * Trims whitespace from the beginning of the string.
     *
     * @return self  The current object for chaining
     */
    public function trimStart(): self
    {
        $this->value = ltrim($this->value);
        return $this;
    }

    /**
     * Returns the primitive string value of the object.
     *
     * @return string  The current string value
     */
    public function valueOf(): string
    {
        return $this->value;
    }

    /**
     * Returns an iterator over the characters of the string.
     *
     * @return Traversable  Iterator over string characters
     */
    public function getIterator(): Traversable
    {
        $length = mb_strlen($this->value);
        for ($i = 0; $i < $length; $i++) {
            yield mb_substr($this->value, $i, 1);
        }
    }

    /**
     * Magic getter for virtual properties like 'length'.
     *
     * @param string $name  The name of the property
     * @return mixed  The value of the virtual property
     */
    public function __get(string $name): mixed
    {
        return match ($name) {
            'length' => mb_strlen($this->value),
            default => null,
        };
    }
}
