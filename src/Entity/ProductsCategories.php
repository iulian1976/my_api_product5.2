<?php

namespace App\Entity;


use App\Repository\ProductsCategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;


/**
 * @ApiResource(
 *     normalizationContext={"groups"={"permission:read"}},
 *     denormalizationContext={"groups"={"permission:write"}},
 *
 *
 *
 * )
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
     *
     *@Groups({"permission:read"})
     *
     */
    private $categories_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     *
     *@Groups({"permission:read"})
     *
     */

    public function getProductId(): ?Product
    {
        return $this->product_id;
    }

    /**
     *
     *@Groups({"permission:read"})
     *
     */

    public function setProductId(?Product $product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }

    /**
     *
     *@Groups({"permission:read"})
     *
     */

    public function getCategoriesId(): ?Category
    {
        return $this->categories_id;
    }

    /**
     *
     *@Groups({"permission:read"})
     *
     */

    public function setCategoriesId(?Category $categories_id): self
    {
        $this->categories_id = $categories_id;

        return $this;
    }
}
