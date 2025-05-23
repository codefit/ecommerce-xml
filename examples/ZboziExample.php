<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Feeds\XmlGenerator\Feed\Zbozi;
use Feeds\XmlGenerator\Entities\ZboziItem;
use Feeds\XmlGenerator\Enums\ZboziDeliveryMethod;
use Feeds\XmlGenerator\Exceptions\ValidationException;

try {
    // Create feed instance with configuration
    $feed = new Zbozi([
        'namespace' => 'http://www.zbozi.cz/ns/offer/1.0',
        'root_element' => 'SHOP'
    ]);

    // Sample products data
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
        ],
        [
            'itemId' => '12346',
            'productName' => 'Samsung Galaxy S21',
            'product' => 'Samsung Galaxy S21 128GB',
            'description' => 'Výkonný Android telefon s kvalitním fotoaparátem',
            'categoryText' => 'Elektronika | Mobilní telefony | Samsung',
            'ean' => '9876543210987',
            'productNo' => 'SGS21128',
            'manufacturer' => 'Samsung',
            'url' => 'https://example.com/samsung-s21',
            'deliveryDate' => 0,
            'imgUrl' => 'https://example.com/images/samsung-s21.jpg',
            'priceVat' => 24990.0,
            'maxCpc' => 4.50,
            'maxCpcSearch' => 3.50
        ],
        [
            'itemId' => '12347',
            'productName' => 'Google Pixel 6',
            'product' => 'Google Pixel 6 128GB',
            'description' => 'Chytrý telefon s nejlepším fotoaparátem na trhu',
            'categoryText' => 'Elektronika | Mobilní telefony | Google',
            'ean' => '4567891234567',
            'productNo' => 'GP6X128',
            'manufacturer' => 'Google',
            'url' => 'https://example.com/google-pixel-6',
            'deliveryDate' => 0,
            'imgUrl' => 'https://example.com/images/google-pixel-6.jpg',
            'priceVat' => 19990.0,
            'maxCpc' => 3.50,
            'maxCpcSearch' => 2.50
        ]
    ];

    // Add products to feed
    foreach ($products as $productData) {
        $item = new ZboziItem();
        $item
            ->setItemId($productData['itemId'])
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

        $feed->addItem($item);

        // Add parameters
        $feed->addParameter('barva', 'Grafit');
        $feed->addParameter('kapacita', '256 GB');

        // Add delivery methods
        $feed->addDelivery(ZboziDeliveryMethod::DPD, 99.0);
        $feed->addDelivery(ZboziDeliveryMethod::PPL, 89.0);

        // Add extra messages
        $feed->addExtraMessage('free_gift', 'Obal zdarma');
        $feed->addExtraMessage('extended_warranty', 'Rozšířená záruka 3 roky');
    }

    // Generate and save the feed
    $feed->save('examples/xml/zbozi.xml');
    
    echo "Zbozi feed byl úspěšně vygenerován.\n";
} catch (ValidationException $e) {
    echo "Chyba při generování Zbozi feedu: " . $e->getMessage() . "\n";
} catch (\Exception $e) {
    echo "Neočekávaná chyba: " . $e->getMessage() . "\n";
} 