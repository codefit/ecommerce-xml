# Changelog

## [2.0.0] - 2025-01-27

### Changed

- **BREAKING**: Aktualizována podpora Laravel z verze 10 na verzi 12
  - `illuminate/support` aktualizováno z `^10.0` na `^12.0`
  - `orchestra/testbench` aktualizováno z `^8.0` na `^10.0` pro testování s Laravel 12
- Podpora PHP 8.3 (stále podporováno PHP ^8.1)

### Migration

Pro použití této verze je nutné mít projekt s Laravel 12. Pokud používáte Laravel 10 nebo 11, zůstaňte u verze 1.1.1.

## [1.1.0] - 2025-06-05

### Added

- Nový generátor feedu pro Facebook
  - Implementace základní třídy `Facebook` pro generování XML feedu
  - Implementace entity `FacebookItem` pro reprezentaci produktu
  - Přidání příkladu použití v `examples/FacebookExample.php`
  - Aktualizace dokumentace v README.md
