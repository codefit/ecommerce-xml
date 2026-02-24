# Changelog

## [2.0.1] - 2025-02-24

### Fixed

- **HeurekaDeliveryMethod**: Enum sjednocen s oficiálními DELIVERY_ID dle [Heureka XML feed](https://sluzby.heureka.cz/napoveda/xml-feed/#DELIVERY). Odstraněny neplatné hodnoty (CPOST, POST, INTIME, ULOZENKA, …), doplněni podporovaní dopravci a výdejní místa (CESKA_POSTA, BALIKOVNA_NA_ADRESU, ZASILKOVNA_NA_ADRESU, výdejní boxy atd.).
- **ZboziDeliveryMethod**: Enum sjednocen s oficiálními DELIVERY_ID dle [Zboží.cz / Sklik specifikace feedu](https://napoveda.sklik.cz/reklamy/xml-feed/specifikace/). Odstraněny neplatné hodnoty, doplněny výdejní místa (ALZABOX, CESKA_POSTA_BALIKOVNA, CESKA_POSTA_NA_POSTU, TOPTRANS_DEPO, VLASTNI_VYDEJNI_MISTA) a dopravci (123_KURYR, IN_TIME_KURYR, DACHSER, HDS, HELICAR, LAGERMAX, TNT, RHENUS, VLASTNI_PREPRAVA atd.).

### Migration

Při upgradu z 2.0.0 je nutné nahradit použití starých caseů novými hodnotami:

- **Heureka**: `CPOST` → `CESKA_POSTA`, `CPOST_PICKUP` → `BALIKOVNA_DEPOTAPI` (Balíkovna), `GEIS_PICKUP`/`GLS_PICKUP` → příslušné výdejní místo dle specifikace, `INTIME` → `ONE_COURIER`, `INTIME_PICKUP` → `ONE_POINT`, `POST`/`POST_PICKUP` nejsou v Heureka specifikaci – použijte CESKA_POSTA nebo výdejní místa, `SLOVAKIA_POST`/`SLOVAKIA_POST_PICKUP` (pouze SK) v této verzi pro CZ feed nejsou, `TOPTRANS_PICKUP` → viz výdejní místa, `ULOZENKA`/`ULOZENKA_PICKUP` (SK) v CZ specifikaci nejsou, `ZASILKOVNA_PICKUP` → `ZASILKOVNA`.
- **Zboží**: Obdobně nahraďte staré casey odpovídajícími hodnotami ze specifikace Zboží.cz (např. `CPOST` → `CESKA_POSTA`, `CPOST_PICKUP` → `CESKA_POSTA_NA_POSTU` nebo `CESKA_POSTA_BALIKOVNA` dle typu).

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
