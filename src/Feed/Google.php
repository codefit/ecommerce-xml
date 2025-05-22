<?php

namespace Feeds\XmlGenerator\Feed;

use Feeds\XmlGenerator\AbstractFeed;
use Feeds\XmlGenerator\ValidationException;
use Spatie\ArrayToXml\ArrayToXml;

class Google extends AbstractFeed
{
    protected string $author = 'Lekia';
    protected string $link = 'https://www.lekia.cz/';
    protected string $title = 'Produkty';

    public function addAvailability(string $availability): self
    {
        $this->items[count($this->items) - 1]['g:availability'] = $availability;
        return $this;
    }

    public function addCondition(string $condition): self
    {
        $this->items[count($this->items) - 1]['g:condition'] = $condition;
        return $this;
    }

    public function addShipping(
        string $country,
        string $service,
        float $price,
        ?string $currency = 'CZK'
    ): self {
        $shipping = [
            'g:country' => $country,
            'g:service' => $service,
            'g:price' => $price . ' ' . $currency
        ];

        $this->items[count($this->items) - 1]['g:shipping'][] = $shipping;
        return $this;
    }

    public function addTax(
        string $country,
        float $rate,
        ?bool $taxShip = null
    ): self {
        $tax = [
            'g:country' => $country,
            'g:rate' => $rate
        ];

        if ($taxShip !== null) {
            $tax['g:tax_ship'] = $taxShip ? 'yes' : 'no';
        }

        $this->items[count($this->items) - 1]['g:tax'][] = $tax;
        return $this;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;
        return $this;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;
        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function generate(): string
    {
        $array = [
            '_attributes' => [
                'xmlns:g' => 'http://base.google.com/ns/1.0'
            ],
            'title' => $this->title,
            'link' => [
                '_attributes' => [
                    'href' => $this->link,
                    'rel' => 'alternate',
                    'type' => 'text/html'
                ]
            ],
            'updated' => '2025-05-21T23:05:05+02:00',
            'author' => [
                'name' => $this->author
            ],
            'entry' => $this->items
        ];

        return ArrayToXml::convert($array, $this->rootElement, true, 'UTF-8');
    }

    public function save(string $path): bool
    {
        $this->validateFeed();
        return file_put_contents($path, $this->generate()) !== false;
    }

    protected function validateFeed(): void
    {
        $requiredTags = [
            'id',           // Jedinečný identifikátor produktu
            'title',        // Název produktu
            'description',  // Popis produktu
            'link',         // URL adresa produktu
            'image_link',   // URL adresa hlavního obrázku produktu
            'availability', // Dostupnost produktu (např. in stock, out of stock)
            'price',        // Cena produktu včetně měny (např. 29.99 CZK)
            'condition',    // Stav produktu (např. new, used, refurbished)
            'brand',        // Značka nebo výrobce produktu
            'gtin'          // Globální identifikátor produktu (např. EAN, UPC)
        ];
        foreach ($this->items as $item) {
            foreach ($requiredTags as $tag) {
                if (!isset($item[$tag])) {
                    throw new ValidationException("Missing required tag: {$tag}");
                }
            }
        }
    }
} 