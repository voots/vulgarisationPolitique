<?php

namespace VOOTS\IndexBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * explication
 *
 * @ORM\Table(name="explication")
 * @ORM\Entity(repositoryClass="VOOTS\IndexBundle\Repository\explicationRepository")
 */
class explication
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
     * @ORM\Column(name="contenu", type="text")
     */
    private $contenu;

    /**
     * @ORM\OneToOne(targetEntity="VOOTS\IndexBundle\Entity\tag", cascade={"persist"})
     */
    private $tagPrincipal;


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
     * Set contenu
     *
     * @param string $contenu
     *
     * @return explication
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set tagPrincipal
     *
     * @param \VOOTS\IndexBundle\Entity\tag $tagPrincipal
     *
     * @return explication
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
}
