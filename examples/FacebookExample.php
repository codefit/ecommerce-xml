<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Feeds\XmlGenerator\Feed\Facebook;
use Feeds\XmlGenerator\Entities\FacebookItem;
use Feeds\XmlGenerator\Exceptions\ValidationException;

try {
    $feed = new Facebook();

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
            'price' => 34990.00,
            'brand' => 'Apple',
            'availability' => 'in stock',
            'condition' => 'new'
        ],
        [
            'id' => '12346',
            'title' => 'Samsung Galaxy S21',
            'description' => 'Výkonný Android telefon s kvalitním fotoaparátem',
            'link' => 'https://example.com/samsung-galaxy-s21',
            'image_link' => 'https://example.com/images/samsung-galaxy-s21.jpg',
            'price' => 29990.00,
            'brand' => 'Samsung',
            'availability' => 'in stock',
            'condition' => 'new'
        ]
    ];

    // Přidání produktů do feedu
    foreach ($products as $productData) {
        $item = new FacebookItem();
        $item->setId($productData['id'])
            ->setTitle($productData['title'])
            ->setDescription($productData['description'])
            ->setLink($productData['link'])
            ->setImageLink($productData['image_link'])
            ->setPriceVat($productData['price'])
            ->setBrand($productData['brand'])
            ->setAvailability($productData['availability'])
            ->setCondition($productData['condition']);

        $feed->addItem($item);
    }

    // Generování a uložení feedu
    $feed->save('examples/xml/facebook.xml');
} catch (ValidationException $e) {
    echo "Chyba při generování Facebook feedu: " . $e->getMessage() . "\n";
} 