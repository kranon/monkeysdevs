<?php

namespace Monkeydevs\ShortenerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statistic
 *
 * @ORM\Table(name="statistic")
 * @ORM\Entity()
 */
class Statistic {
	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer", nullable=false)
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="IDENTITY")
	 */
	protected $id;

	/**
	 * @var Link
	 *
	 * Many Statistic have One Link.
	 * @ORM\ManyToOne(targetEntity="Monkeydevs\ShortenerBundle\Entity\Link", cascade={"detach"})
	 * @ORM\JoinColumn(nullable=true)
	 */
	protected $link;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="used", type="datetime")
	 */
	protected $used;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="ip", type="string", length=500, nullable=false)
	 */
	protected $ip;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="country", type="string", length=100, nullable=false)
	 */
	protected $country;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="browser", type="string", length=100, nullable=false)
	 */
	protected $browser;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="os", type="string", length=100, nullable=false)
	 */
	protected $os;

	/**
	 * Get id
	 *
	 * @return integer
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set used
	 *
	 * @param \DateTime $used
	 *
	 * @return Statistic
	 */
	public function setUsed( $used ) {
		$this->used = $used;

		return $this;
	}

	/**
	 * Get used
	 *
	 * @return \DateTime
	 */
	public function getUsed() {
		return $this->used;
	}

	/**
	 * Set ip
	 *
	 * @param string $ip
	 *
	 * @return Statistic
	 */
	public function setIp( $ip ) {
		$this->ip = $ip;

		return $this;
	}

	/**
	 * Get ip
	 *
	 * @return string
	 */
	public function getIp() {
		return $this->ip;
	}

	/**
	 * Set country
	 *
	 * @param string $country
	 *
	 * @return Statistic
	 */
	public function setCountry( $country ) {
		$this->country = $country;

		return $this;
	}

	/**
	 * Get country
	 *
	 * @return string
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * Set browser
	 *
	 * @param string $browser
	 *
	 * @return Statistic
	 */
	public function setBrowser( $browser ) {
		$this->browser = $browser;

		return $this;
	}

	/**
	 * Get browser
	 *
	 * @return string
	 */
	public function getBrowser() {
		return $this->browser;
	}

	/**
	 * Set os
	 *
	 * @param string $os
	 *
	 * @return Statistic
	 */
	public function setOs( $os ) {
		$this->os = $os;

		return $this;
	}

	/**
	 * Get os
	 *
	 * @return string
	 */
	public function getOs() {
		return $this->os;
	}

	/**
	 * Set link
	 *
	 * @param \Monkeydevs\ShortenerBundle\Entity\Link $link
	 *
	 * @return Statistic
	 */
	public function setLink( \Monkeydevs\ShortenerBundle\Entity\Link $link = null ) {
		$this->link = $link;

		return $this;
	}

	/**
	 * Get link
	 *
	 * @return \Monkeydevs\ShortenerBundle\Entity\Link
	 */
	public function getLink() {
		return $this->link;
	}
}
