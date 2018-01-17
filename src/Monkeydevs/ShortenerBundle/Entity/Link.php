<?php

namespace Monkeydevs\ShortenerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Link
 *
 * @ORM\Table(name="link")
 * @ORM\Entity()
 */
class Link {
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	protected $id;

	/**
	 * @var string
	 *
	 * @Assert\Url(protocols = {"http", "https"})
	 *
	 * @ORM\Column(name="url", type="string", length=500, nullable=false)
	 */
	protected $url;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="code", type="string", unique=true, length=100, nullable=false)
	 */
	protected $code;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="created", type="datetime")
	 */
	protected $created;

	/**
	 * @return string
	 */
	public function __toString() {
		return $this->url;
	}

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set url
	 *
	 * @param string $url
	 *
	 * @return Link
	 */
	public function setUrl( $url ) {
		$this->url = $url;

		return $this;
	}

	/**
	 * Get url
	 *
	 * @return string
	 */
	public function getUrl() {
		return $this->url;
	}

	/**
	 * Set code
	 *
	 * @param string $code
	 *
	 * @return Link
	 */
	public function setCode( $code ) {
		$this->code = $code;

		return $this;
	}

	/**
	 * Get code
	 *
	 * @return string
	 */
	public function getCode() {
		return $this->code;
	}

	/**
	 * Set created
	 *
	 * @param \DateTime $created
	 *
	 * @return Link
	 */
	public function setCreated( $created ) {
		$this->created = $created;

		return $this;
	}

	/**
	 * Get created
	 *
	 * @return \DateTime
	 */
	public function getCreated() {
		return $this->created;
	}
}
