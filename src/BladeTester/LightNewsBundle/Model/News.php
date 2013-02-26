<?php

namespace BladeTester\LightNewsBundle\Model;

class News implements NewsInterface {

	protected $title;

	protected $body;

	protected $created_at;

	protected $updated_at;


    public function __construct() {
        $this->created = new \DateTime();
    }

	public function getTitle() {
		return $this->title;
	}

	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}

	public function getBody() {
		return $this->body;
	}

	public function setBody($body) {
		$this->body = $body;
		return $this;
	}

	public function getCreatedAt() {
		return $this->created_at;
	}

	public function setCreatedAt(\DateTime $created_at) {
		$this->created_at = $created_at;
		return $this;
	}

	public function getUpdatedAt() {
		return $this->updated_at;
	}

	public function setUpdatedAt(\DateTime $updated_at) {
		$this->updated_at = $updated_at;
		return $this;
	}
}