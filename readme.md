# A WordPress theme with the bare essentials.
This theme is built on Storefront to make sure it uses the latest WooCommerce functionalities. This will save me time having to adapt it every time a new update of WooCommerce comes out.
It also runs on the WP 5.6. You'll need scss to compile scss. A minimalist gulpfile is included.

## How to install gulp
- Install Node and NPM (google that part)
- npm install --save-dev
- npm run watch
## Plugins needed to run this theme. 
- WooCommerce
- ACF Pro (with paid license)
- Polylang Pro + Polylang WooCommerce

## SCSS Instructions and Information

`.d-h` stands for "Display Horizontal"

### Titles
The main reason I've made different titles is because they all have different margins,
alignments or line-heights.
`h2.page-title` are for the (default) pages
`h2.feature-titles`
`.section-titles`
`.page-default h2`  



## Resources
[Github Generatepress](https://github.com/tomusborne/generatepress)

### Resources Used:


## Command Line Instructions

Browser-sync: browser-sync https://artezpress.local:8890/ -w --files "**/*" --tunnel 'artezpress-peek'

