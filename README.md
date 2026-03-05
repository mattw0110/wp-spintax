# Spintax

Spintax is a lightweight, SEO-friendly WordPress plugin designed to randomly
'spin' through alternative words or phrases on every page reload.

## Key Features

- **Server-Side Processing**: Unlike many other spintax plugins that rely on
  client-side JavaScript, this plugin processes all spintax on the server. This
  ensures:
  - **No FOUC (Flash of Unstyled Content)**: Users never see the raw spintax
    variables during page load.
  - **SEO Friendly**: Search engines index the fully rendered content, not the
    raw spintax codes.
- **Pure PHP Implementation**: No dependency on jQuery or other heavy
  client-side libraries.
- **Page Builder Compatible**: Built-in safeguards ensure full compatibility
  with modern builders like **Bricks Builder** and **Elementor**.
- **Regex Protection**: Smart processing logic ensures that CSS, JavaScript, and
  JSON content (like those in page builder AJAX calls) are never accidentally
  modified.

## Usage

You can use spintax anywhere in your WordPress content (pages, posts, or
widgets).

### 1. Simple Spintax

Use curly brackets to randomly select a word on every page refresh:
`{ Hi | Hello | Hey | Greetings }`

### 2. Tilde Syntax

The tilde syntax is also supported and behaves exactly like the simple curly
bracket syntax, rendering instantly on the server:
`~ Beautiful | Stunning | Elegant | Modern ~`

## How it works

The plugin uses PHP output buffering to intercept the HTML content before it's
sent to the browser. It applies a refined regular expression to identify spintax
patterns (requiring at least one `|` character) and replaces them with a
randomly selected choice from the provided list.

## Compatibility Note

This plugin is specifically designed to be safe for use with **Bricks Builder**
and **Elementor**. It automatically detects builder contexts and REST API/AJAX
requests to ensure its processing logic only runs where it's supposed to,
keeping your layout and builder functionality intact.

## Installation

1. Upload the `wp-spintax` folder to your `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Start adding `{word1|word2|word3}` to your pages!
