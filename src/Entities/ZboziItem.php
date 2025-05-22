<?php

namespace Feeds\XmlGenerator\Entities;

class ZboziItem
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
    private float $maxCpc;
    private float $maxCpcSearch;
    private array $parameters = [];
    private array $delivery = [];
    private array $extraMessages = [];

    public function getItemId(): string
    {
        return $this->itemId;
    }

    public function setItemId(string $itemId): self
    {
        $this->itemId = $itemId;
        return $this;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;
        return $this;
    }

    public function getProduct(): string
    {
        return $this->product;
    }

    public function setProduct(string $product): self
    {
        $this->product = $product;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getCategoryText(): string
    {
        return $this->categoryText;
    }

    public function setCategoryText(string $categoryText): self
    {
        $this->categoryText = $categoryText;
        return $this;
    }

    public function getEan(): string
    {
        return $this->ean;
    }

    public function setEan(string $ean): self
    {
        $this->ean = $ean;
        return $this;
    }

    public function getProductNo(): string
    {
        return $this->productNo;
    }

    public function setProductNo(string $productNo): self
    {
        $this->productNo = $productNo;
        return $this;
    }

    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): self
    {
        $this->manufacturer = $manufacturer;
        return $this;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    public function getDeliveryDate(): int
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(int $deliveryDate): self
    {
        $this->deliveryDate = $deliveryDate;
        return $this;
    }

    public function getImgUrl(): string
    {
        return $this->imgUrl;
    }

    public function setImgUrl(string $imgUrl): self
    {
        $this->imgUrl = $imgUrl;
        return $this;
    }

    public function getPriceVat(): float
    {
        return $this->priceVat;
    }

    public function setPriceVat(float $priceVat): self
    {
        $this->priceVat = $priceVat;
        return $this;
    }

    public function getMaxCpc(): float
    {
        return $this->maxCpc;
    }

    public function setMaxCpc(float $maxCpc): self
    {
        $this->maxCpc = $maxCpc;
        return $this;
    }

    public function getMaxCpcSearch(): float
    {
        return $this->maxCpcSearch;
    }

    public function setMaxCpcSearch(float $maxCpcSearch): self
    {
        $this->maxCpcSearch = $maxCpcSearch;
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

    public function addExtraMessage(string $type, ?string $text = null): self
    {
        $this->extraMessages[] = [
            'type' => $type,
            'text' => $text
        ];
        return $this;
    }

    public function getExtraMessages(): array
    {
        return $this->extraMessages;
    }

    public function toArray(): array
    {
        $data = [
            'ITEM_ID' => $this->itemId,
            'PRODUCTNAME' => $this->productName,
            'PRODUCT' => $this->product,
            'DESCRIPTION' => $this->description,
            'CATEGORYTEXT' => $this->categoryText,
            'EAN' => $this->ean,
            'PRODUCTNO' => $this->productNo,
            'MANUFACTURER' => $this->manufacturer,
            'URL' => $this->url,
            'DELIVERY_DATE' => $this->deliveryDate,
            'IMGURL' => $this->imgUrl,
            'PRICE_VAT' => $this->priceVat,
            'MAX_CPC' => $this->maxCpc,
            'MAX_CPC_SEARCH' => $this->maxCpcSearch
        ];

        if (!empty($this->parameters)) {
            $data['PARAM'] = $this->parameters;
        }

        if (!empty($this->delivery)) {
            $data['DELIVERY'] = $this->delivery;
        }

        if (!empty($this->extraMessages)) {
            $data['EXTRA_MESSAGE'] = $this->extraMessages;
        }

        return $data;
    }
} 