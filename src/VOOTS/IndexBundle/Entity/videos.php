<?php

namespace VOOTS\IndexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * videos
 *
 * @ORM\Table(name="videos")
 * @ORM\Entity(repositoryClass="VOOTS\IndexBundle\Repository\videosRepository")
 */
class videos
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
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;

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
     * Set alt
     *
     * @param string $alt
     *
     * @return videos
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return videos
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return videos
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
     * @return videos
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
     * @return videos
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
}
