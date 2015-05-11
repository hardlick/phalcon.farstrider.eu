<?php

/**
 * @author farstrider
 * @version 2 2015-05-07 23:19:05 JST
 * 
 * @category module
 * @package temple
 * @subpackage model
 */

namespace farstrider\temple\model;

use Phalcon\Mvc\Model;

class Temple extends Model
{
	
	/**
	 * @var int
	 */
	protected $id;
	
	/**
	 * @var string
	 */
	protected $name;
	
	/**
	 * @var string
	 */
	protected $postcode;
	
	/**
	 * @var string
	 */
	protected $prefecture;
	
	/**
	 * @var string
	 */
	protected $city;
	
	/**
	 * @var string
	 */
	protected $address;
	
	/**
	 * @var float
	 */
	protected $latitude;
	
	/**
	 * @var float
	 */
	protected $longitude;
	
	/**
	 * An array of {@link \farstrider\temple\model\Image} instances that represent photos associated a particular temple.
	 * Goshuin are unique in that they are the only array entries that have a string index, namely 'goshuin'.
	 *
	 * @var array
	 */
	protected $photos = array();
	
	/**
	 * Used to define the relationship with the Image model (i.e. each Temple can have many images).
	 */
	public function initialize()
	{
		$this->hasMany('id', 'Image', 'temple_id');
	}
	
	/**
	 * By default, Phalcon looks for a table with the same name as the class ("temple", in this case).  However, since the
	 * table that correlates with this model is not "temple", we will direct Phalcon to the correct table using the
	 * getSource() method.
	 * 
	 * @see \Phalcon\Mvc\Model::getSource()
	 */
	public function getSource()
	{
		return 'temples';
	}
	
	/**
	 * @param int $id
	 * @return \farstrider\temple\model\Temple
	 */
	public function setId($id)
	{
		$this->id = (int) $id;
	
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @param string $name
	 * @return \farstrider\temple\model\Temple
	 */
	public function setName($name)
	{
		$this->name = (string) $name;
	
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * @param string $postcode
	 * @return \farstrider\temple\model\Temple
	 */
	public function setPostcode($postcode)
	{
		$this->postcode = (string) $postcode;
	
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getPostcode()
	{
		return $this->postcode;
	}
	
	/**
	 * @param string $prefecture
	 * @return \farstrider\temple\model\Temple
	 */
	public function setPrefecture($prefecture)
	{
		$this->prefecture = (string) $prefecture;
	
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getPrefecture()
	{
		return $this->prefecture;
	}
	
	/**
	 * @param string $city
	 * @return \farstrider\temple\model\Temple
	 */
	public function setCity($city)
	{
		$this->city = (string) $city;
	
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getCity()
	{
		return $this->city;
	}
	
	/**
	 * @param string $address
	 * @return \farstrider\temple\model\Temple
	 */
	public function setAddress($address)
	{
		$this->address = (string) $address;
	
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getAddress()
	{
		return $this->address;
	}
	
	/**
	 * @param float $latitude
	 * @return \farstrider\temple\model\Temple
	 * 
	 * @todo Validate $latitude as a float with six decimal places
	 */
	public function setLatitude($latitude)
	{
		$this->latitude = $latitude;
	
		return $this;
	}
	
	/**
	 * @return float
	 */
	public function getLatitude()
	{
		return $this->latitude;
	}
	
	/**
	 * @param float $longitude
	 * @return \farstrider\temple\model\Temple
	 * 
	 * @todo Validate $longitude as a float with six decimal places
	 */
	public function setLongitude($longitude)
	{
		$this->longitude = $longitude;
	
		return $this;
	}
	
	/**
	 * @return float
	 */
	public function getLongitude()
	{
		return $this->longitude;
	}
	
	/**
	 * Expects an array containing instances of the {@link \farstrider\temple\model\Image} class
	 *
	 * @param array $photos
	 * @return \farstrider\temple\model\Temple
	 */
	public function setPhotos(array $photos)
	{
		foreach ($photos as $photo) {
			if (!$photo instanceof \farstrider\temple\model\Image) {
				continue;
			}
			
			$this->addPhoto($photo);
		}
	
		return $this;
	}
	
	/**
	 * @return array
	 */
	public function getPhotos()
	{
		return $this->photos;
	}
	
	/**
	 * @param \farstrider\temple\model\Image $photo
	 * @throws InvalidArgumentException
	 * @return \farstrider\temple\model\Temple
	 */
	public function addPhoto(\farstrider\temple\model\Image $photo)
	{
		if (!$photo instanceof \farstrider\temple\model\Image) {
			throw new InvalidArgumentException('Excepted instance of \farstrider\temple\model\Image, received ' . get_class($photo));
		}
	
		if ('goshuin' == $photo->getType()) {
			$this->setGoshuin($photo);
		}
		else {
			array_push($this->photos, $photo);
		}
	
		return $this;
	}
	
	/**
	 * @param array $photos
	 * @return \farstrider\temple\model\Temple
	 */
	public function addPhotos(array $photos)
	{
		foreach ($photos as $photo) {
			$this->addPhoto($photo);
		}
	
		return $this;
	}
	
	/**
	 * @param \farstrider\temple\model\Image $goshuin
	 * @throws InvalidArgumentException
	 * @return \farstrider\temple\model\Temple
	 */
	public function setGoshuin(\farstrider\temple\model\Image $goshuin)
	{
		if (!$goshuin instanceof \farstrider\temple\model\Image) {
			throw new InvalidArgumentException('Excepted instance of \farstrider\temple\model\Image, received ' . get_class($goshuin));
		}
	
		// Isn't it great that PHP allows arrays with mixed keys =D
		$this->photos['goshuin'] = $goshuin;
	
		return $this;
	}
	
	/**
	 * @return \farstrider\temple\model\Image | false
	 * 
	 * @todo Implement error handling hooks
	 */
	public function getGoshuin()
	{
		if (!array_key_exists('goshuin', $this->photos)) {
			return false;
		}
	
		return $this->photos['goshuin'];
	}
}