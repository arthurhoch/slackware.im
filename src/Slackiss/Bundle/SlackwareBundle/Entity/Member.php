<?php
namespace Slackiss\Bundle\KneworkBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity
 * @Vich\Uploadable
 * @ORM\Table(name="member")
 * @ORM\Entity(repositoryClass="Slackiss\Bundle\KneworkBundle\Entity\MemberRepository")
 */
class Member extends BaseUser
{
    const ROLE_SUPER_ADMIN='ROLE_SUPER_ADMIN';
    const ROLE_ADMIN='ROLE_ADMIN';
    const ROLE_USER='ROLE_USER';
    const ROLE_COMPANY='ROLE_COMPANY';
    const ROLE_AGENT='ROLE_AGENT';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this->created = new \DateTime();
        $this->modified = $this->created;
    }

    /**
     * @ORM\Column(type="string", length=255, name="avatar",nullable = true)
     *
     * @var string $imageName
     */
	private $avatar;
    
    /**
     * @Assert\File(
     *     maxSize="10M",
     *     mimeTypes={"image/png","image/jpeg","image/pjpeg",
	 *                          "image/jpg","image/gif"}
     * )
     * @Vich\UploadableField(mapping="avatar_image", fileNameProperty="avatar")
     *
     * @var File $image
     */
	private $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime")
     */
    private $modified;

    /**
     * @ORM\ManyToOne(targetEntity="City")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id",nullable=true)
     */
    private $city;

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Agent
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     * @return Agent
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime 
     */
    public function getModified()
    {
        return $this->modified;
    }


	public function setAvatar($avatar)
	{
		$this->avatar = $avatar;
		return $this;
	}

	public function getAvatar()
	{
		return $this->avatar;
	}

	public function setImage($image)
	{
		$this->image = $image;
		return $this;
	}

	public function getImage()
	{
		return $this->image;
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
     * Set city
     *
     * @param \Slackiss\Bundle\KneworkBundle\Entity\City $city
     * @return Member
     */
    public function setCity(\Slackiss\Bundle\KneworkBundle\Entity\City $city = null)
    {
        $this->city = $city;
    
        return $this;
    }

    /**
     * Get city
     *
     * @return \Slackiss\Bundle\KneworkBundle\Entity\City 
     */
    public function getCity()
    {
        return $this->city;
    }
}