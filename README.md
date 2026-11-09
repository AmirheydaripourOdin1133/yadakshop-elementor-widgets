# Yadak Shop Elementor Widgets (یدک شاپ المنتور ویجت)

Standalone WordPress plugin — 6 custom Elementor widgets rebranded for **Yadak Shop**.

| | |
|---|---|
| Plugin Name | یدک شاپ المنتور ویجت |
| Version | 1.0.1 |
| Author | [Amir Heydaripour](https://wp-amir.ir) |
| Requires | WordPress 5.9+, PHP 7.4+ |
| Requires Plugins | Elementor |
| Text Domain | `yadakshop` |
| License | GPL-2.0-or-later |

## Widgets

All widgets live under the **یدک شاپ** category in the Elementor panel.

| Widget | Internal name | Assets |
|---|---|---|
| کاروسل خدمات (Services Carousel) | `yadakshop-services-carousel` | CSS + JS (Swiper via `elementorFrontend.utils.swiper`) |
| گرید خدمات (Services Grid) | `yadakshop-services-grid` | CSS |
| تماس با ما (Contact Us) | `yadakshop-contact-us` | CSS + inline SVG + map SVGs (Balad / Neshan / Google) |
| روش‌های مهاجرت (خدمات ویژه) (Immigration Methods) | `yadakshop-immigration-methods` | CSS + card icon SVG |
| محتوای ویژه (Special Content) | `yadakshop-special-content` | CSS |
| لوگوی متحرک (Logo Loop) | `yadakshop-logo-loop` | CSS + JS (infinite marquee) |

## Structure

```
yadakshop-elementor-widgets/
├── yadakshop-elementor-widgets.php      # Plugin bootstrap (constants, Elementor gate, missing-Elementor notice)
├── includes/class-yadakshop-elementor.php # Category, widget registration, asset registration
├── widgets/                             # 6 widget classes (Widget_Base)
├── assets/                              # css / js / icons / svg
├── languages/
└── readme.txt
```

## Installation

1. **Download ZIP** (Code → Download ZIP, or clone) and zip the `yadakshop-elementor-widgets` folder, or build via the release zip.
2. WordPress dashboard → **Plugins → Add New → Upload Plugin** → install and activate (Elementor must be active).
3. In the Elementor editor, look for the **یدک شاپ** category in the widget panel.
