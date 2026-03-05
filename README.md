# Spintax

A lightweight, SEO-friendly WordPress plugin that randomly 'spins' alternative
words or phrases on each page load — entirely on the server.

## Key Features

- **Server-Side Processing** — Spintax is resolved in PHP before HTML reaches
  the browser. No FOUC, no raw variables flashing on screen.
- **SEO Friendly** — Search engines index the final rendered text, not
  `{word1|word2}` codes.
- **Pure PHP** — Zero JavaScript dependencies. No jQuery required.
- **Page Builder Safe** — Automatically detects and skips Bricks Builder,
  Elementor, Gutenberg, REST API, AJAX, Cron, and Customizer contexts so your
  builder never breaks.

## Usage

Place spintax anywhere in your WordPress content — pages, posts, widgets, or
page builder elements.

### Curly Bracket Syntax

```
Get {the best|expert|professional} addiction treatment
```

On each **uncached** page load, one word is randomly selected (e.g., "Get expert
addiction treatment").

### Tilde Syntax

```
We offer ~compassionate|personalized|evidence-based~ care
```

Behaves identically to curly brackets — randomly picks one option server-side.

## Caching & Randomization

> **Important:** If you use a full-page caching plugin (LiteSpeed Cache, WP
> Super Cache, W3 Total Cache, etc.), the spintax is resolved once when the
> cache is built. Subsequent visitors see the cached version until the cache
> expires or is purged.

This means:

- **Each cache rebuild** picks new random words — great for SEO variation over
  time.
- **To see randomization in real-time**, either purge your cache and refresh, or
  append a unique query string to bypass cache:
  ```
  https://yoursite.com/page/?nocache=1
  https://yoursite.com/page/?nocache=2
  ```

## How It Works

The plugin hooks into `template_redirect` using PHP output buffering
(`ob_start`). Before the HTML is sent to the browser, a regex scans for spintax
patterns (requiring at least one `|` pipe character) and replaces each with a
randomly selected option. The regex is specifically designed to **not** match
CSS `{}`, JavaScript objects, or JSON — only legitimate spintax like
`{word1|word2}`.

## Compatibility

Fully compatible with:

- **Bricks Builder** — builder editor, AJAX rendering, and frontend
- **Elementor** — preview mode, edit mode, and frontend
- **Gutenberg** — block editor detection
- **REST API / AJAX / Cron / XML-RPC / WP CLI** — all skipped automatically

## Installation

1. Upload the `wp-spintax` folder to `/wp-content/plugins/`.
2. Activate through **Plugins → Installed Plugins**.
3. Add `{word1|word2|word3}` or `~word1|word2~` to your content.
4. Clear your page cache to see new random selections.

## License

GPL-2.0+ — See [LICENSE.txt](LICENSE.txt) for details.
