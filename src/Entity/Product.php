<?php

namespace App\Entity;
use App\Entity\Brand;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @ApiResource(
 *     normalizationContext={"groups"={"permission:read"}},
 *     denormalizationContext={"groups"={"permission:write"}},
 * )
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */

class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"permission:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $active;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"permission:read", "permission:write"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"permission:read"})
     */
    private $url;

    /**
     * @ORM\Column(type="text")
     * @Groups({"permission:read", "permission:write"})
     *
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Brand::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"permission:read", "permission:write"})
     *
     */
    private $brand_id;

    /**
     * @ORM\OneToMany(targetEntity=ProductsCategories::class, mappedBy="product_id")
     * @Groups({"permission:read", "permission:write"})
     *
     */
    private $productsCategories;

    public function __construct()
    {
        $this->productsCategories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

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

    public function getBrandId(): ?Brand
    {
        return $this->brand_id;
    }

    public function setBrandId(?Brand $brand_id): self
    {
        $this->brand_id = $brand_id;

        return $this;
    }

    /**
     * @return Collection|ProductsCategories[]
     */
    public function getProductsCategories(): Collection
    {
        return $this->productsCategories;
    }

    public function addProductsCategory(ProductsCategories $productsCategory): self
    {
        if (!$this->productsCategories->contains($productsCategory)) {
            $this->productsCategories[] = $productsCategory;
            $productsCategory->setProductId($this);
        }

        return $this;
    }

    public function removeProductsCategory(ProductsCategories $productsCategory): self
    {
        if ($this->productsCategories->removeElement($productsCategory)) {
            // set the owning side to null (unless already changed)
            if ($productsCategory->getProductId() === $this) {
                $productsCategory->setProductId(null);
            }
        }

        return $this;
    }
}
