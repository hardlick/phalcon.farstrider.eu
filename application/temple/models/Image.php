<?php

/**
 * @author farstrider
 * @version 1 2015-05-07 21:36:19 JST
 * 
 * @category module
 * @package temple
 * @subpackage model
 */

namespace farstrider\temple\model;

use Phalcon\Mvc\Model;

class Image extends Model
{
	
	/**
	 * @var int
	 */
	protected $id;
	
	/**
	 * @var string
	 */
	protected $type;
	
	/**
	 * @var string
	 */
	protected $sha1;
	
	/**
	 * @var string
	 */
	protected $file_name;
	
	/**
	 * By default, Phalcon looks for a table with the same name as the class ("image", in this case).  However, since the
	 * table that correlates with this model is not "image", we will direct Phalcon to the correct table using the
	 * getSource() method.
	 * 
	 * @see \Phalcon\Mvc\Model::getSource()
	 */
	public function getSource()
	{
		echo 'images';
	}
	
	/**
	 * @param int $id
	 * @return \farstrider\temple\model\Image
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
	 * @param string $type
	 * @return \farstrider\temple\model\Image
	 */
	public function setType($type)
	{
		$this->type = (string) $type;
	
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getType()
	{
		return $this->type;
	}
	
	/**
	 * @param string $sha1
	 * @return \farstrider\temple\model\Image
	 */
	public function setSha1($sha1)
	{
		$this->sha1 = (string) $sha1;
	
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getSha1()
	{
		return $this->sha1;
	}
	
	/**
	 * @param string $filename
	 * @return \farstrider\temple\model\Image
	 */
	public function setFilename($filename)
	{
		$this->file_name = (string) $filename;
	
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getFilename()
	{
		return $this->file_name;
	}
}