<?php

namespace Feeds\XmlGenerator\Feed;

use Feeds\XmlGenerator\AbstractFeed;
use Feeds\XmlGenerator\Enums\ZboziDeliveryMethod;
use Feeds\XmlGenerator\Exceptions\ValidationException;
use Feeds\XmlGenerator\Entities\ZboziItem;
use Spatie\ArrayToXml\ArrayToXml;

class Zbozi extends AbstractFeed
{
    public function addDelivery(
        ZboziDeliveryMethod $method,
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

    public function addExtraMessage(string $type, ?string $text = null): self
    {
        $this->items[count($this->items) - 1]['EXTRA_MESSAGE'][] = $type;
        if ($text !== null) {
            $this->items[count($this->items) - 1][strtoupper($type) . '_TEXT'] = $text;
        }
        return $this;
    }

    public function addItem($item): self
    {
        $this->validateItem($item);
        $this->items[] = $item->toArray();
        return $this;
    }

    public function save(string $path): bool
    {
        return file_put_contents($path, $this->generate()) !== false;
    }

    protected function validateItem(ZboziItem $item): void
    {
        $requiredProperties = [
            'itemId' => 'ITEM_ID',
            'productName' => 'PRODUCTNAME',
            'description' => 'DESCRIPTION',
            'url' => 'URL',
            'imgUrl' => 'IMGURL',
            'priceVat' => 'PRICE_VAT',
            'deliveryDate' => 'DELIVERY_DATE',
            'categoryText' => 'CATEGORYTEXT'
        ];

        foreach ($requiredProperties as $property => $tag) {
            $getter = 'get' . ucfirst($property);
            if (is_null($item->$getter())) {
                throw new ValidationException("Missing required property: {$tag}");
            }
        }
    }
} 