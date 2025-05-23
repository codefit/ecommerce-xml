<?php

namespace Feeds\XmlGenerator\Entities;

class GoogleItem
{
    private string $id;
    private string $title;
    private string $description;
    private string $link;
    private string $imageLink;
    private float $priceVat;
    private string $currency = 'CZK';
    private string $brand;
    private string $gtin;
    private string $mpn;
    private string $googleProductCategory;
    private string $availability = 'in stock';
    private string $condition = 'new';
    private array $shipping = [];
    private array $tax = [];

    public function getId(): ?string
    {
        return isset($this->id) ? $this->id : null;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): ?string
    {
        return isset($this->title) ? $this->title : null;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): ?string
    {
        return isset($this->description) ? $this->description : null;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getLink(): ?string
    {
        return isset($this->link) ? $this->link : null;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;
        return $this;
    }

    public function getImageLink(): ?string
    {
        return isset($this->imageLink) ? $this->imageLink : null;
    }

    public function setImageLink(string $imageLink): self
    {
        $this->imageLink = $imageLink;
        return $this;
    }

    public function setPriceVat(float $priceVat, string $currency = 'CZK'): self
    {
        $this->priceVat = $priceVat;
        $this->currency = $currency;
        return $this;
    }

    public function getPriceVat(): ?string
    {
        return isset($this->priceVat) ? $this->priceVat . ' ' . ($this->currency ?? 'CZK') : null;
    }

    public function getBrand(): ?string
    {
        return isset($this->brand) ? $this->brand : null;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;
        return $this;
    }

    public function getGtin(): ?string
    {
        return isset($this->gtin) ? $this->gtin : null;
    }

    public function setGtin(string $gtin): self
    {
        $this->gtin = $gtin;
        return $this;
    }

    public function getMpn(): ?string
    {
        return isset($this->mpn) ? $this->mpn : null;
    }

    public function setMpn(string $mpn): self
    {
        $this->mpn = $mpn;
        return $this;
    }

    public function getGoogleProductCategory(): ?string
    {
        return isset($this->googleProductCategory) ? $this->googleProductCategory : null;
    }

    public function setGoogleProductCategory(string $googleProductCategory): self
    {
        $this->googleProductCategory = $googleProductCategory;
        return $this;
    }

    public function getAvailability(): ?string
    {
        return isset($this->availability) ? $this->availability : null;
    }

    public function setAvailability(string $availability): self
    {
        $this->availability = $availability;
        return $this;
    }

    public function getCondition(): ?string
    {
        return isset($this->condition) ? $this->condition : null;
    }

    public function setCondition(string $condition): self
    {
        $this->condition = $condition;
        return $this;
    }

    public function addShipping(string $country, string $service, float $price): self
    {
        $this->shipping[] = [
            'country' => $country,
            'service' => $service,
            'price' => $price
        ];
        return $this;
    }

    public function addTax(string $country, string $rate, bool $taxShip): self
    {
        $this->tax[] = [
            'country' => $country,
            'rate' => $rate,
            'tax_ship' => $taxShip
        ];
        return $this;
    }

    public function toArray(): array
    {
        $data = [
            'g:id' => $this->getId(),
            'g:title' => $this->getTitle(),
            'g:description' => $this->getDescription(),
            'g:link' => $this->getLink(),
            'g:image_link' => $this->getImageLink(),
            'g:price' => $this->getPriceVat(),
            'g:brand' => $this->getBrand(),
            'g:gtin' => $this->getGtin(),
            'g:mpn' => $this->getMpn(),
            'g:google_product_category' => $this->getGoogleProductCategory(),
            'g:availability' => $this->getAvailability(),
            'g:condition' => $this->getCondition()
        ];

        if (!empty($this->shipping)) {
            $data['g:shipping'] = $this->shipping;
        }

        if (!empty($this->tax)) {
            $data['g:tax'] = $this->tax;
        }

        foreach($data as $key => $item){
            if($item === ""){
                unset($data[$key]);
            }
        }

        return $data;
    }
}
