<?php

namespace Feeds\XmlGenerator\Feed;

use Feeds\XmlGenerator\AbstractFeed;
use Feeds\XmlGenerator\Enums\HeurekaDeliveryMethod;
use Feeds\XmlGenerator\Exceptions\ValidationException;
use Feeds\XmlGenerator\Entities\HeurekaItem;
use Spatie\ArrayToXml\ArrayToXml;

class Heureka extends AbstractFeed
{
    protected string $country;

    public function __construct(array $config = [])
    {
        parent::__construct($config);
        $this->country = $config['country'] ?? 'cz';
    }

    public function addDelivery(
        HeurekaDeliveryMethod $method,
        float $price,
        ?float $priceCod = null
    ): self {
        $delivery = [
            'DELIVERY_ID' => $method->value,
            'DELIVERY_PRICE' => $price,
        ];

        if ($priceCod !== null) {
            $delivery['DELIVERY_PRICE_COD'] = $priceCod;
        }

        $this->items[count($this->items) - 1]['DELIVERY'][] = $delivery;
        return $this;
    }

    public function addParameter(string $name, string $value): self
    {
        $this->items[count($this->items) - 1]['PARAM'][] = [
            'PARAM_NAME' => $name,
            'VAL' => $value
        ];
        return $this;
    }

    public function addGift(string $text): self
    {
        $this->items[count($this->items) - 1]['GIFT'][] = $text;
        return $this;
    }

    public function addWarranty(string $text): self
    {
        $this->items[count($this->items) - 1]['WARRANTY'][] = $text;
        return $this;
    }

    public function getCountry(): string
    {
        return $this->country;
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

    protected function validateItem(HeurekaItem $item): void
    {
        $requiredProperties = [
            'itemId' => 'ITEM_ID',
            'productName' => 'PRODUCTNAME',
            'priceVat' => 'PRICE_VAT',
            'url' => 'URL',
            'categoryText' => 'CATEGORYTEXT',
            'deliveryDate' => 'DELIVERY_DATE',
            'imgUrl' => 'IMGURL'
        ];

        foreach ($requiredProperties as $property => $tag) {
            $getter = 'get' . ucfirst($property);
            if (is_null($item->$getter())) {
                throw new ValidationException("Missing required property: {$tag}");
            }
        }
    }
} 