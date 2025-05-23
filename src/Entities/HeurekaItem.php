<?php

namespace Feeds\XmlGenerator\Entities;

class HeurekaItem
{
    private string $itemId;
    private string $productName;
    private string $product;
    private string $description;
    private string $categoryText;
    private string $ean;
    private string $productNo;
    private string $manufacturer;
    private string $url;
    private int $deliveryDate;
    private string $imgUrl;
    private float $priceVat;
    private array $parameters = [];
    private array $delivery = [];
    private array $gifts = [];
    private array $warranties = [];

    public function getItemId(): ?string
    {
        return isset($this->itemId) ? $this->itemId : null;
    }

    public function setItemId(string $itemId): self
    {
        $this->itemId = $itemId;
        return $this;
    }

    public function getProductName(): ?string
    {
        return isset($this->productName) ? $this->productName : null;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;
        return $this;
    }

    public function getProduct(): ?string
    {
        return isset($this->product) ? $this->product : null;
    }

    public function setProduct(string $product): self
    {
        $this->product = $product;
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

    public function getCategoryText(): ?string
    {
        return isset($this->categoryText) ? $this->categoryText : null;
    }

    public function setCategoryText(string $categoryText): self
    {
        $this->categoryText = $categoryText;
        return $this;
    }

    public function getEan(): ?string
    {
        return isset($this->ean) ? $this->ean : null;
    }

    public function setEan(string $ean): self
    {
        $this->ean = $ean;
        return $this;
    }

    public function getProductNo(): ?string
    {
        return isset($this->productNo) ? $this->productNo : null;
    }

    public function setProductNo(string $productNo): self
    {
        $this->productNo = $productNo;
        return $this;
    }

    public function getManufacturer(): ?string
    {
        return isset($this->manufacturer) ? $this->manufacturer : null;
    }

    public function setManufacturer(string $manufacturer): self
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }

    public function getUrl(): ?string
    {
        return isset($this->url) ? $this->url : null;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function getDeliveryDate(): ?int
    {
        return isset($this->deliveryDate) ? $this->deliveryDate : null;
    }

    public function setDeliveryDate(int $deliveryDate): self
    {
        $this->deliveryDate = $deliveryDate;
        return $this;
    }

    public function getImgUrl(): ?string
    {
        return isset($this->imgUrl) ? $this->imgUrl : null;
    }

    public function setImgUrl(string $imgUrl): self
    {
        $this->imgUrl = $imgUrl;
        return $this;
    }

    public function getPriceVat(): ?float
    {
        return isset($this->priceVat) ? $this->priceVat : null;
    }

    public function setPriceVat(float $priceVat): self
    {
        $this->priceVat = $priceVat;
        return $this;
    }

    public function addParameter(string $name, string $value): self
    {
        $this->parameters[] = [
            'name' => $name,
            'value' => $value
        ];
        return $this;
    }

    public function getParameters(): array
    {
        return $this->parameters;
    }

    public function addDelivery(string $method, float $price): self
    {
        $this->delivery[] = [
            'method' => $method,
            'price' => $price
        ];
        return $this;
    }

    public function getDelivery(): array
    {
        return $this->delivery;
    }

    public function addGift(string $text): self
    {
        $this->gifts[] = $text;
        return $this;
    }

    public function getGifts(): array
    {
        return $this->gifts;
    }

    public function addWarranty(string $name, int $months): self
    {
        $this->warranties[] = [
            'name' => $name,
            'months' => $months
        ];
        return $this;
    }

    public function getWarranties(): array
    {
        return $this->warranties;
    }

    public function toArray(): array
    {
        $data = [
            'ITEM_ID' => $this->getItemId(),
            'PRODUCTNAME' => $this->getProductName(),
            'PRODUCT' => $this->getProduct(),
            'DESCRIPTION' => $this->getDescription(),
            'CATEGORYTEXT' => $this->getCategoryText(),
            'EAN' => $this->getEan(),
            'PRODUCTNO' => $this->getProductNo(),
            'MANUFACTURER' => $this->getManufacturer(),
            'URL' => $this->getUrl(),
            'DELIVERY_DATE' => $this->getDeliveryDate(),
            'IMGURL' => $this->getImgUrl(),
            'PRICE_VAT' => $this->getPriceVat()
        ];

        if (!empty($this->parameters)) {
            $data['PARAM'] = $this->parameters;
        }

        if (!empty($this->delivery)) {
            $data['DELIVERY'] = $this->delivery;
        }

        if (!empty($this->gifts)) {
            $data['GIFT'] = $this->gifts;
        }

        if (!empty($this->warranties)) {
            $data['WARRANTY'] = $this->warranties;
        }

        return $data;
    }
}
