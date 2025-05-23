<?php

namespace Feeds\XmlGenerator\Feed;

use Feeds\XmlGenerator\AbstractFeed;
use Feeds\XmlGenerator\Exceptions\ValidationException;
use Feeds\XmlGenerator\Entities\GoogleItem;
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
        return file_put_contents($path, $this->generate()) !== false;
    }

    public function addItem($item): self
    {
        $this->validateItem($item);
        $this->items[] = $item->toArray();
        return $this;
    }

    protected function validateItem(GoogleItem $item): void
    {
        $requiredProperties = [
            'id' => 'g:id',
            'title' => 'g:title',
            'description' => 'g:description',
            'link' => 'g:link',
            'imageLink' => 'g:image_link',
            'priceVat' => 'g:price',
            'brand' => 'g:brand',
            'gtin' => 'g:gtin',
            'availability' => 'g:availability',
            'condition' => 'g:condition'
        ];

        foreach ($requiredProperties as $property => $tag) {
            $getter = 'get' . ucfirst($property);
            if (is_null($item->$getter())) {
                throw new ValidationException("Missing required property: {$tag}");
            }
        }
    }
} 