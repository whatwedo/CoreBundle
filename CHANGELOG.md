# Formatter
- Default formatter behavior changed: Outputs are now considered unsafe HTML unless explicitly marked safe. Formatters that render HTML must set `OPT_HTML_SAFE = true` via `configureOptions()` and sanitize user-provided values with `$this->escapeHTML()`. Audit custom formatter implementations.
- removed `ArrayFormatter`
- removed `CollectionTwigFormatter` => should be replaced with a ChainFormatter
- removed `JsonRequestTransformerListener`
- `core.formatter` => `whatwedo_core.formatter`
- removed all SimpleEnumFormatter, use PHP 8.1 Enums instead
