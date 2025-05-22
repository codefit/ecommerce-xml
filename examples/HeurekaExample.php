<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Feeds\XmlGenerator\Feed\Heureka;
use Feeds\XmlGenerator\Entities\HeurekaItem;
use Feeds\XmlGenerator\Enums\HeurekaDeliveryMethod;
use Feeds\XmlGenerator\Exceptions\ValidationException;

try {
    // Create feed instance with configuration
    $feed = new Heureka([
        'namespace' => 'http://www.heureka.cz/ns/offer/1.0',
        'root_element' => 'SHOP',
        'country' => 'cz'
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
            'priceVat' => 34990.00
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
            'priceVat' => 24990.00
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
            'priceVat' => 19990.00
        ]
    ];

    // Add products to feed
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

        // Add parameters
        $feed->addParameter('barva', 'Grafit');
        $feed->addParameter('kapacita', '256 GB');

        // Add delivery methods
        $feed->addDelivery(HeurekaDeliveryMethod::DPD, 99.0);
        $feed->addDelivery(HeurekaDeliveryMethod::PPL, 89.0);

        // Add gifts
        $feed->addGift('Obal zdarma');

        // Add warranties
        $feed->addWarranty('Rozšířená záruka', 36);
    }

    // Generate and save the feed
    $feed->save('examples/xml/heureka.xml');
    
    echo "Heureka feed byl úspěšně vygenerován.\n";
} catch (ValidationException $e) {
    echo "Chyba při generování Heureka feedu: " . $e->getMessage() . "\n";
} catch (\Exception $e) {
    echo "Neočekávaná chyba: " . $e->getMessage() . "\n";
} 