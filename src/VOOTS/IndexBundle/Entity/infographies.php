<?php

namespace VOOTS\IndexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * infographies
 *
 * @ORM\Table(name="infographies")
 * @ORM\Entity(repositoryClass="VOOTS\IndexBundle\Repository\infographiesRepository")
 */
class infographies
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @ORM\OneToOne(targetEntity="VOOTS\IndexBundle\Entity\tag", cascade={"persist"})
     */
    private $tagPrincipal;    
    
    /**
     * @ORM\ManyToMany(targetEntity="VOOTS\IndexBundle\Entity\tag", cascade={"persist"})
     */
    private $tags;
    
    /**
     * @var int
     *
     * @ORM\Column(name="importance", type="integer")
     */
    private $importance;    

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return infographies
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return infographies
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set tagPrincipal
     *
     * @param \VOOTS\IndexBundle\Entity\tag $tagPrincipal
     *
     * @return infographies
     */
    public function setTagPrincipal(\VOOTS\IndexBundle\Entity\tag $tagPrincipal = null)
    {
        $this->tagPrincipal = $tagPrincipal;

        return $this;
    }

    /**
     * Get tagPrincipal
     *
     * @return \VOOTS\IndexBundle\Entity\tag
     */
    public function getTagPrincipal()
    {
        return $this->tagPrincipal;
    }

    /**
     * Add tag
     *
     * @param \VOOTS\IndexBundle\Entity\tag $tag
     *
     * @return infographies
     */
    public function addTag(\VOOTS\IndexBundle\Entity\tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \VOOTS\IndexBundle\Entity\tag $tag
     */
    public function removeTag(\VOOTS\IndexBundle\Entity\tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Set importance
     *
     * @param integer $importance
     *
     * @return infographies
     */
    public function setImportance($importance)
    {
        $this->importance = $importance;

        return $this;
    }

    /**
     * Get importance
     *
     * @return integer
     */
    public function getImportance()
    {
        return $this->importance;
    }
}
