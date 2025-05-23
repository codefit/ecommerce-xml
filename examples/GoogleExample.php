<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Feeds\XmlGenerator\Feed\Google;
use Feeds\XmlGenerator\Entities\GoogleItem;
use Feeds\XmlGenerator\Exceptions\ValidationException;

try {
    // Create feed instance with configuration
    $feed = new Google([
        'namespace' => 'http://www.w3.org/2005/Atom',
        'root_element' => 'feed'
    ]);

    // Set author, link, and title
    $feed->setAuthor('Codefit Webdesign');
    $feed->setLink('https://www.codefit.cz/');
    $feed->setTitle('Produkty');

    // Sample products data
    $products = [
        [
            'id' => '12345',
            'title' => 'iPhone 13 Pro',
            'description' => 'Nejnovější iPhone s výkonným čipem A15 Bionic',
            'link' => 'https://example.com/iphone-13-pro',
            'image_link' => 'https://example.com/images/iphone-13-pro.jpg',
            'priceVat' => 34990.00,
            'brand' => 'Apple',
            'gtin' => '1234567890123',
            'mpn' => 'IP13P256',
            'google_product_category' => 'Electronics > Phones & Accessories > Mobile Phones'
        ],
        [
            'id' => '12346',
            'title' => 'Samsung Galaxy S21',
            'description' => 'Výkonný Android telefon s kvalitním fotoaparátem',
            'link' => 'https://example.com/samsung-s21',
            'image_link' => 'https://example.com/images/samsung-s21.jpg',
            'priceVat' => 24990.00,
            'brand' => 'Samsung',
            'gtin' => '9876543210987',
            'mpn' => 'SGS21128',
            'google_product_category' => 'Electronics > Phones & Accessories > Mobile Phones'
        ],
        [
            'id' => '12347',
            'title' => 'Google Pixel 6',
            'description' => 'Chytrý telefon s nejlepším fotoaparátem na trhu',
            'link' => 'https://example.com/google-pixel-6',
            'image_link' => 'https://example.com/images/google-pixel-6.jpg',
            'priceVat' => 19990.00,
            'brand' => 'Google',
            'gtin' => '4567891234567',
            'mpn' => 'GP6X128',
            'google_product_category' => 'Electronics > Phones & Accessories > Mobile Phones'
        ]
    ];

    // Add products to feed
    foreach ($products as $productData) {
        $item = new GoogleItem();
        $item->setId($productData['id'])
            ->setTitle($productData['title'])
            ->setDescription($productData['description'])
            ->setLink($productData['link'])
            ->setImageLink($productData['image_link'])
            ->setPriceVat($productData['priceVat'])
            ->setBrand($productData['brand'])
            ->setGtin($productData['gtin'])
            ->setMpn($productData['mpn'])
            ->setGoogleProductCategory($productData['google_product_category']);

        $feed->addItem($item);
        $feed->addAvailability('in stock');
        $feed->addCondition('new');
        $feed->addShipping('CZ', 'Standard', 99.00);
        $feed->addShipping('CZ', 'Express',  149.00);
        $feed->addTax('CZ', '21', true);
    }

    // Generate and save the feed
    $feed->save('examples/xml/google.xml');
    
    echo "Google feed byl úspěšně vygenerován.\n";
} catch (ValidationException $e) {
    echo "Chyba při generování Google feedu: " . $e->getMessage() . "\n";
} catch (\Exception $e) {
    echo "Neočekávaná chyba: " . $e->getMessage() . "\n";
} 