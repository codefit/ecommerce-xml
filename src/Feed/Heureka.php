<?php

namespace Feeds\XmlGenerator\Feed;

use Feeds\XmlGenerator\AbstractFeed;
use Feeds\XmlGenerator\Enums\HeurekaDeliveryMethod;
use Feeds\XmlGenerator\Exceptions\ValidationException;
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

    public function addItem(array $item): self
    {
        $this->validateItem($item);
        $this->items[] = $item;
        return $this;
    }

    protected function validateItem(array $item): void
    {
        $requiredTags = [
            'ITEM_ID',       // Jedinečný identifikátor produktu
            'PRODUCTNAME',   // Název produktu
            'PRICE_VAT',     // Cena produktu včetně DPH
            'URL',           // URL adresa produktu
            'CATEGORYTEXT',  // Kategorie produktu
            'DELIVERY_DATE', // Doba dodání produktu
            'IMGURL'         // URL adresa obrázku produktu
        ];
        foreach ($requiredTags as $tag) {
            if (!isset($item[$tag])) {
                throw new ValidationException("Missing required tag: {$tag}");
            }
        }
    }
} 