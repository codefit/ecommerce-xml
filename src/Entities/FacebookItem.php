<?php

namespace Feeds\XmlGenerator\Entities;

class FacebookItem
{
    private ?string $id = null;
    private ?string $title = null;
    private ?string $description = null;
    private ?string $link = null;
    private ?string $imageLink = null;
    private ?float $priceVat = null;
    private ?string $brand = null;
    private ?string $availability = null;
    private ?string $condition = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;
        return $this;
    }

    public function getImageLink(): ?string
    {
        return $this->imageLink;
    }

    public function setImageLink(string $imageLink): self
    {
        $this->imageLink = $imageLink;
        return $this;
    }

    public function getPriceVat(): ?float
    {
        return $this->priceVat;
    }

    public function setPriceVat(float $priceVat): self
    {
        $this->priceVat = $priceVat;
        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;
        return $this;
    }

    public function getAvailability(): ?string
    {
        return $this->availability;
    }

    public function setAvailability(string $availability): self
    {
        $this->availability = $availability;
        return $this;
    }

    public function getCondition(): ?string
    {
        return $this->condition;
    }

    public function setCondition(string $condition): self
    {
        $this->condition = $condition;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'g:id' => $this->id,
            'g:title' => $this->title,
            'g:description' => $this->description,
            'g:link' => $this->link,
            'g:image_link' => $this->imageLink,
            'g:price' => $this->priceVat . ' CZK',
            'g:brand' => $this->brand,
            'g:availability' => $this->availability,
            'g:condition' => $this->condition
        ];
    }
} 