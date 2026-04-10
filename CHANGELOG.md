# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Added
- Initial module scaffold with `src/` layout, PHPStan max, PHPCS Magento2, PHPUnit 10
- GitHub Actions CI workflow
- `product_relation_events` and `product_relation_counts` declarative schema
- `RelationTypeInterface`, `DateRange`, `RelationTypePool`, `Config`
- `EventBasedRollup`, `SourceBasedRollup`, `CountsUpsert` traits
- `ViewedTogether`, `SearchedTogether`, `SoldTogether` relation types
- `CaptureViewedTogether`, `TrackSearchQuery`, `CaptureSearchedTogether` observers
- `RollupRelations` daily cron
- Admin configuration under Stores > Configuration > Catalog > Product Relations
