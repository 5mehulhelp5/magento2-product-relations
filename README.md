# Magento 2 Product Relations

A Magento 2 module that automatically collects and stores behavioural product-affinity data from real store usage. It is a pure data collection layer — no frontend output, no REST/GraphQL endpoints, no admin reports. Other services (recommendation engines, APIs) consume the stored data directly from the database.

## Purpose

Magento provides manually-curated product relations (related, upsell, cross-sell) but has no mechanism to automatically record data-driven affinity. This module fills that gap in a composable, microservices-friendly way.

## Relation Types

| Type | Source | Trigger |
|---|---|---|
| `viewed_together` | event-based | Product page view in a shared session |
| `searched_together` | event-based | Product clicked after a shared search query |
| `sold_together` | source-based | Products in the same `sales_order_item` |

New relation types can be added by third parties via `di.xml` without modifying this module.

## Requirements

| Component | Version |
|---|---|
| PHP | 8.1, 8.2, or 8.3 |
| Magento | 2.4.7+ |
| MySQL | 8.0+ |

## Installation

```bash
composer require frank-bokdam/magento2-product-relations
bin/magento module:enable FrankBokdam_ProductRelations
bin/magento setup:upgrade
bin/magento setup:di:compile
bin/magento cache:flush
```

## Configuration

Navigate to **Stores > Configuration > Catalog > Product Relations**:

| Setting | Default | Description |
|---|---|---|
| Event TTL (days) | 30 | Days raw session events are retained before purge |
| Rollup Batch Size | 1000 | Maximum product pairs processed per cron run per type |

## Data Model

Two tables:

- `product_relation_events` — raw session co-occurrences, short-lived
- `product_relation_counts` — daily aggregated counts per store, long-lived

See `src/etc/db_schema.xml` for full schema.

## Usage

A daily cron (`frankbokdam_productrelations_rollup`, `0 2 * * *`) aggregates events into counts. Downstream services read `product_relation_counts` directly.

## Extending

Implement `FrankBokdam\ProductRelations\Api\RelationTypeInterface`, use `EventBasedRollup` or `SourceBasedRollup` trait, and register in your own module's `di.xml` under `FrankBokdam\ProductRelations\Model\RelationTypePool`.

## Development

```bash
composer install
vendor/bin/phpcs --standard=Magento2 --extensions=php src/
vendor/bin/phpstan analyse --configuration=phpstan.neon
vendor/bin/phpunit --testsuite=Unit
```

## License

MIT
