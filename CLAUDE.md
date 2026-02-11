# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

E-commerce platform built on **Bitrix CMS** (1C-Битрикс: Управление сайтом) for B2B sales. PHP 8.1+, MySQL 8.0.

**Repository:** https://github.com/DiLes/bxRazvitie.git

## Key Directories

```
/local/                          # Custom code (main development area)
  /php_interface/
    init.php                     # Entry point, loads all custom PHP
    constants.php                # Page constants (IS_INDEX, NO_IMAGE, etc.)
    functions.php                # Utility functions (plural(), pre())
    events.php                   # Bitrix event handlers
  /templates/razvitie/           # Main theme template
    header.php, footer.php       # Site layout
    /components/                 # Template-specific component overrides
    /src/assets/                 # Images, icons
    /src/styles/                 # CSS source files

/ajax/                           # REST-like AJAX handlers (22 endpoints)
  game_discount.php              # Gamified discount system by INN
  form_handler.php               # Form processing with discount logic
  add2basket.php                 # Add to cart
  favorites.php                  # Wishlist management
  one_click_order.php            # Quick checkout

/bitrix/                         # Bitrix core (do not modify)
  /modules/                      # System modules (catalog, sale, iblock, etc.)
  /components/                   # Official Bitrix components
  .settings.php                  # DB connection, crypto keys

/catalog/, /personal/, /news/    # Content sections
/include/                        # Shared include files (logo, contacts, etc.)
/TestWeb/                        # Unity WebGL game for discounts
```

## Architecture Patterns

### Bitrix Component System
Components are loaded with `$APPLICATION->IncludeComponent()`. Override official components by copying to `/local/components/` or `/local/templates/razvitie/components/`.

### Information Blocks (IBlocks)
Content types managed via IBlock IDs:
- **ID 2:** Product catalog
- **ID 5:** Slider/news
- **ID 9:** Documents
- **ID 14:** Game discounts (by INN)

### Event Handlers
Custom events in `/local/php_interface/events.php`. Register via:
```php
\Bitrix\Main\EventManager::getInstance()->addEventHandler(...)
```

### Caching
Aggressive caching (CACHE_TIME: 36000000 = 416 days). Clear cache at `/bitrix/managed_cache/` when debugging.

## Common Operations

### Load Bitrix Module
```php
use Bitrix\Main\Loader;
Loader::includeModule("iblock");
Loader::includeModule("catalog");
Loader::includeModule("sale");
```

### Database Query (IBlock Elements)
```php
$res = CIBlockElement::GetList(
    ["SORT" => "ASC"],
    ["IBLOCK_ID" => 2, "ACTIVE" => "Y"],
    false,
    ["nTopCount" => 10],
    ["ID", "NAME", "PROPERTY_*"]
);
while ($row = $res->GetNext()) { ... }
```

### AJAX Handler Template
```php
define("NO_KEEP_STATISTIC", true);
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
header('Content-Type: application/json; charset=utf-8');
// ... logic ...
echo json_encode(["status" => "success", "data" => $result]);
```

## URL Routing

SEF URLs configured in `urlrewrite.php`. Key routes:
- `/catalog/` → bitrix:catalog component
- `/personal/` → bitrix:sale.personal.section
- `/services/`, `/news/`, `/projects/`, `/reviews/` → news.list components

## Development Notes

- **No build system** (no npm/webpack). CSS/JS served directly from `/local/templates/razvitie/`
- **Debug mode enabled** in current config
- **Debug output:** `pre($data)` function only outputs for admin (USER ID = 1)
- **Russian localization:** Use `plural()` function for word inflection

## Custom Business Logic

### Game Discount System (`/ajax/game_discount.php`, `/TestWeb/`)
- Unity WebGL game awards discounts (5%, 10%, 15%) by level
- Discounts tied to company INN (Tax ID), stored in IBlock 14
- JavaScript in `/TestWeb/index.html` handles game-to-site communication

### Form Handler (`/ajax/form_handler.php`)
- Processes contact/order forms
- Applies discounts from game system
- Sends email notifications via `Bitrix\Main\Mail\Event`

## AI Assistant Guidelines

- Разработка ведётся на ОС Windows (OSPanel)
- Общение на русском языке
- Пути к файлам используют обратный слеш (`\`) в Windows, но в PHP/веб-контексте используй прямой (`/`)
- Кодировка файлов: UTF-8