# Feeds XML Generator

Tento balíček umožňuje generovat XML feedy pro různé služby (Google, Heureka, Zbozi) s podporou validace a dynamického nastavení parametrů.

## Instalace

```bash
composer require codefit/ecommerce-xml
```

## Použití

### Google Feed

```php
use Feeds\XmlGenerator\Feed\Google;
use Feeds\XmlGenerator\Entities\GoogleItem;
use Feeds\XmlGenerator\Exceptions\ValidationException;

try {
    $feed = new Google([
        'namespace' => 'http://www.w3.org/2005/Atom',
        'root_element' => 'feed'
    ]);

    // Nastavení autora, linku a title
    $feed->setAuthor('Codefit Webdesign');
    $feed->setLink('https://www.codefit.cz/');
    $feed->setTitle('Produkty');

    // Vzorová data produktů
    $products = [
        [
            'id' => '12345',
            'title' => 'iPhone 13 Pro',
            'description' => 'Nejnovější iPhone s výkonným čipem A15 Bionic',
            'link' => 'https://example.com/iphone-13-pro',
            'image_link' => 'https://example.com/images/iphone-13-pro.jpg',
            'price' => '34990',
            'brand' => 'Apple',
            'gtin' => '1234567890123',
            'mpn' => 'IP13P256',
            'google_product_category' => 'Electronics > Phones & Accessories > Mobile Phones'
        ]
    ];

    // Přidání produktů do feedu
    foreach ($products as $productData) {
        $item = new GoogleItem();
        $item->setId($productData['id'])
            ->setTitle($productData['title'])
            ->setDescription($productData['description'])
            ->setLink($productData['link'])
            ->setImageLink($productData['image_link'])
            ->setPrice($productData['price'])
            ->setBrand($productData['brand'])
            ->setGtin($productData['gtin'])
            ->setMpn($productData['mpn'])
            ->setGoogleProductCategory($productData['google_product_category']);

        $feed->addItem($item->toArray());
        $feed->addAvailability('in stock');
        $feed->addCondition('new');
        $feed->addShipping('CZ', 'Standard', 99.00);
        $feed->addShipping('CZ', 'Express', 149.00);
        $feed->addTax('CZ', '21', true);
    }

    // Generování a uložení feedu
    $feed->save('google.xml');
} catch (ValidationException $e) {
    echo "Chyba při generování Google feedu: " . $e->getMessage() . "\n";
}
```

### Heureka Feed

```php
use Feeds\XmlGenerator\Feed\Heureka;
use Feeds\XmlGenerator\Entities\HeurekaItem;
use Feeds\XmlGenerator\Enums\HeurekaDeliveryMethod;
use Feeds\XmlGenerator\Exceptions\ValidationException;

try {
    $feed = new Heureka([
        'namespace' => 'http://www.heureka.cz/ns/offer/1.0',
        'root_element' => 'SHOP',
        'country' => 'cz'
    ]);

    // Vzorová data produktů
    $products = [
        [
            'itemId' => '12345',
            'productName' => 'iPhone 13 Pro',
            'product' => 'Apple iPhone 13 Pro 256GB',
            'description' => 'Nejnovější iPhone s výkonným čipem A15 Bionic',
            'categoryText' => 'Elektronika | Mobilní telefony | Apple',
            'ean' => '1234567890123',
            'productNo' => 'IP13P256',
            'manufacturer' => 'Apple',
            'url' => 'https://example.com/iphone-13-pro',
            'deliveryDate' => 0,
            'imgUrl' => 'https://example.com/images/iphone-13-pro.jpg',
            'priceVat' => 34990.00
        ]
    ];

    // Přidání produktů do feedu
    foreach ($products as $productData) {
        $item = new HeurekaItem();
        $item->setItemId($productData['itemId'])
            ->setProductName($productData['productName'])
            ->setProduct($productData['product'])
            ->setDescription($productData['description'])
            ->setCategoryText($productData['categoryText'])
            ->setEan($productData['ean'])
            ->setProductNo($productData['productNo'])
            ->setManufacturer($productData['manufacturer'])
            ->setUrl($productData['url'])
            ->setDeliveryDate($productData['deliveryDate'])
            ->setImgUrl($productData['imgUrl'])
            ->setPriceVat($productData['priceVat']);

        $feed->addItem($item->toArray());
        $feed->addParameter('barva', 'Grafit');
        $feed->addParameter('kapacita', '256 GB');
        $feed->addDelivery(HeurekaDeliveryMethod::DPD, 99.0);
        $feed->addDelivery(HeurekaDeliveryMethod::PPL, 89.0);
        $feed->addGift('Obal zdarma');
        $feed->addWarranty('Rozšířená záruka', 36);
    }

    // Generování a uložení feedu
    $feed->save('heureka.xml');
} catch (ValidationException $e) {
    echo "Chyba při generování Heureka feedu: " . $e->getMessage() . "\n";
}
```

### Zbozi Feed

```php
use Feeds\XmlGenerator\Feed\Zbozi;
use Feeds\XmlGenerator\Entities\ZboziItem;
use Feeds\XmlGenerator\Enums\ZboziDeliveryMethod;
use Feeds\XmlGenerator\Exceptions\ValidationException;

try {
    $feed = new Zbozi([
        'namespace' => 'http://www.zbozi.cz/ns/offer/1.0',
        'root_element' => 'SHOP'
    ]);

    // Vzorová data produktů
    $products = [
        [
            'itemId' => '12345',
            'productName' => 'iPhone 13 Pro',
            'product' => 'Apple iPhone 13 Pro 256GB',
            'description' => 'Nejnovější iPhone s výkonným čipem A15 Bionic',
            'categoryText' => 'Elektronika | Mobilní telefony | Apple',
            'ean' => '1234567890123',
            'productNo' => 'IP13P256',
            'manufacturer' => 'Apple',
            'url' => 'https://example.com/iphone-13-pro',
            'deliveryDate' => 0,
            'imgUrl' => 'https://example.com/images/iphone-13-pro.jpg',
            'priceVat' => 34990.0,
            'maxCpc' => 5.80,
            'maxCpcSearch' => 4.50
        ]
    ];

    // Přidání produktů do feedu
    foreach ($products as $productData) {
        $item = new ZboziItem();
        $item->setItemId($productData['itemId'])
            ->setProductName($productData['productName'])
            ->setProduct($productData['product'])
            ->setDescription($productData['description'])
            ->setCategoryText($productData['categoryText'])
            ->setEan($productData['ean'])
            ->setProductNo($productData['productNo'])
            ->setManufacturer($productData['manufacturer'])
            ->setUrl($productData['url'])
            ->setDeliveryDate($productData['deliveryDate'])
            ->setImgUrl($productData['imgUrl'])
            ->setPriceVat($productData['priceVat'])
            ->setMaxCpc($productData['maxCpc'])
            ->setMaxCpcSearch($productData['maxCpcSearch']);

        $feed->addItem($item->toArray());
        $feed->addParameter('barva', 'Grafit');
        $feed->addParameter('kapacita', '256 GB');
        $feed->addDelivery(ZboziDeliveryMethod::DPD, 99.0);
        $feed->addDelivery(ZboziDeliveryMethod::PPL, 89.0);
        $feed->addExtraMessage('free_gift', 'Obal zdarma');
        $feed->addExtraMessage('extended_warranty', 'Rozšířená záruka 3 roky');
    }

    // Generování a uložení feedu
    $feed->save('zbozi.xml');
} catch (ValidationException $e) {
    echo "Chyba při generování Zbozi feedu: " . $e->getMessage() . "\n";
}
```

## Entity

### GoogleItem

| Vlastnost               | Typ    | Popis                           |
| ----------------------- | ------ | ------------------------------- |
| id                      | string | Unikátní identifikátor produktu |
| title                   | string | Název produktu                  |
| description             | string | Popis produktu                  |
| link                    | string | URL produktu                    |
| image_link              | string | URL obrázku produktu            |
| priceVat                | float  | Cena s DPH                      |
| brand                   | string | Značka produktu                 |
| gtin                    | string | GTIN (EAN) kód                  |
| mpn                     | string | Výrobní číslo                   |
| google_product_category | string | Kategorie produktu v Google     |

### HeurekaItem

| Vlastnost    | Typ    | Popis                             |
| ------------ | ------ | --------------------------------- |
| itemId       | string | Unikátní identifikátor produktu   |
| productName  | string | Název produktu                    |
| product      | string | Plný název produktu               |
| description  | string | Popis produktu                    |
| categoryText | string | Kategorie produktu                |
| ean          | string | EAN kód                           |
| productNo    | string | Výrobní číslo                     |
| manufacturer | string | Výrobce                           |
| url          | string | URL produktu                      |
| deliveryDate | int    | Počet dní do dodání (0 = skladem) |
| imgUrl       | string | URL obrázku produktu              |
| priceVat     | float  | Cena s DPH                        |
| parameters   | array  | Parametry produktu                |
| delivery     | array  | Možnosti dopravy                  |
| gifts        | array  | Dárky k produktu                  |
| warranties   | array  | Záruky                            |

### ZboziItem

| Vlastnost     | Typ    | Popis                             |
| ------------- | ------ | --------------------------------- |
| itemId        | string | Unikátní identifikátor produktu   |
| productName   | string | Název produktu                    |
| product       | string | Plný název produktu               |
| description   | string | Popis produktu                    |
| categoryText  | string | Kategorie produktu                |
| ean           | string | EAN kód                           |
| productNo     | string | Výrobní číslo                     |
| manufacturer  | string | Výrobce                           |
| url           | string | URL produktu                      |
| deliveryDate  | int    | Počet dní do dodání (0 = skladem) |
| imgUrl        | string | URL obrázku produktu              |
| priceVat      | float  | Cena s DPH                        |
| maxCpc        | float  | Maximální CPC pro obsahovou síť   |
| maxCpcSearch  | float  | Maximální CPC pro vyhledávání     |
| parameters    | array  | Parametry produktu                |
| delivery      | array  | Možnosti dopravy                  |
| extraMessages | array  | Extra zprávy                      |

## Enums

### HeurekaDeliveryMethod

- `PPL`: PPL
- `DPD`: DPD
- `DPD_PICKUP`: DPD výdejní místo
- `CPOST`: Česká pošta
- `CPOST_PICKUP`: Česká pošta výdejní místo
- `GEIS`: Geis
- `GEIS_PICKUP`: Geis výdejní místo
- `GLS`: GLS
- `GLS_PICKUP`: GLS výdejní místo
- `INTIME`: Intime
- `INTIME_PICKUP`: Intime výdejní místo
- `POST`: Pošta
- `POST_PICKUP`: Pošta výdejní místo
- `SLOVAKIA_POST`: Slovenská pošta
- `SLOVAKIA_POST_PICKUP`: Slovenská pošta výdejní místo
- `TOPTRANS`: Toptrans
- `TOPTRANS_PICKUP`: Toptrans výdejní místo
- `ULOZENKA`: Uloženka
- `ULOZENKA_PICKUP`: Uloženka výdejní místo
- `ZASILKOVNA`: Zásilkovna
- `ZASILKOVNA_PICKUP`: Zásilkovna výdejní místo

### ZboziDeliveryMethod

- `PPL`: PPL
- `DPD`: DPD
- `DPD_PICKUP`: DPD výdejní místo
- `CPOST`: Česká pošta
- `CPOST_PICKUP`: Česká pošta výdejní místo
- `GEIS`: Geis
- `GEIS_PICKUP`: Geis výdejní místo
- `GLS`: GLS
- `GLS_PICKUP`: GLS výdejní místo
- `INTIME`: Intime
- `INTIME_PICKUP`: Intime výdejní místo
- `POST`: Pošta
- `POST_PICKUP`: Pošta výdejní místo
- `SLOVAKIA_POST`: Slovenská pošta
- `SLOVAKIA_POST_PICKUP`: Slovenská pošta výdejní místo
- `TOPTRANS`: Toptrans
- `TOPTRANS_PICKUP`: Toptrans výdejní místo
- `ULOZENKA`: Uloženka
- `ULOZENKA_PICKUP`: Uloženka výdejní místo
- `ZASILKOVNA`: Zásilkovna
- `ZASILKOVNA_PICKUP`: Zásilkovna výdejní místo
