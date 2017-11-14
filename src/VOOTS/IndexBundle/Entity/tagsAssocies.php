<?php

namespace VOOTS\IndexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * tagsAssocies
 *
 * @ORM\Table(name="tags_associes")
 * @ORM\Entity(repositoryClass="VOOTS\IndexBundle\Repository\tagsAssociesRepository")
 */
class tagsAssocies
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
     * @ORM\OneToOne(targetEntity="VOOTS\IndexBundle\Entity\tag", cascade={"persist"})
     */
    private $tagAssocie;


    /**
     * Get id
     *
     * @return int
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
     * @return tagsAssocies
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
     * Set tagAssocie
     *
     * @param \VOOTS\IndexBundle\Entity\tag $tagAssocie
     *
     * @return tagsAssocies
     */
    public function setTagAssocie(\VOOTS\IndexBundle\Entity\tag $tagAssocie = null)
    {
        $this->tagAssocie = $tagAssocie;

        return $this;
    }

    /**
     * Get tagAssocie
     *
     * @return \VOOTS\IndexBundle\Entity\tag
     */
    public function getTagAssocie()
    {
        return $this->tagAssocie;
    }
}
