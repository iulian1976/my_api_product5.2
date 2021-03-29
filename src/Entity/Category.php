<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource(
 *
 *     normalizationContext={"groups"={"permission:read"}},
 *     denormalizationContext={"groups"={"permission:write"}},
 * )
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"permission:read"})
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=ProductsCategories::class, mappedBy="categories_id")
     * @Groups({"permission:read"})
     */
    private $productsCategories;

    public function __construct()
    {
        $this->productsCategories = new ArrayCollection();
    }

    /**
     *
     * @Groups({"permission:read"})
     */

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     *
     * @Groups({"permission:read"})
     */

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|ProductsCategories[]
     * @Groups({"permission:read"})
     *
     */
    public function getProductsCategories(): Collection
    {
        return $this->productsCategories;
    }

    public function addProductsCategory(ProductsCategories $productsCategory): self
    {
        if (!$this->productsCategories->contains($productsCategory)) {
            $this->productsCategories[] = $productsCategory;
            $productsCategory->setCategoriesId($this);
        }

        return $this;
    }

    public function removeProductsCategory(ProductsCategories $productsCategory): self
    {
        if ($this->productsCategories->removeElement($productsCategory)) {
            // set the owning side to null (unless already changed)
            if ($productsCategory->getCategoriesId() === $this) {
                $productsCategory->setCategoriesId(null);
            }
        }

        return $this;
    }
}
