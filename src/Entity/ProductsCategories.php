<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductsCategoriesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=ProductsCategoriesRepository::class)
 */
class ProductsCategories
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="productsCategories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product_id;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="productsCategories")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductId(): ?Product
    {
        return $this->product_id;
    }

    public function setProductId(?Product $product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }

    public function getCategoriesId(): ?Category
    {
        return $this->categories_id;
    }

    public function setCategoriesId(?Category $categories_id): self
    {
        $this->categories_id = $categories_id;

        return $this;
    }
}
