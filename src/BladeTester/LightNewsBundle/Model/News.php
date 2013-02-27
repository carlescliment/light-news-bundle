<?php

namespace BladeTester\LightNewsBundle\Model;

class News implements NewsInterface {

	protected $title;

	protected $body;

	protected $createdAt;

	protected $updatedAt;


        public function __construct() {
            $this->createdAt = new \DateTime();
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
		return $this->createdAt;
	}

	public function setCreatedAt(\DateTime $created_at) {
		$this->createdAt = $created_at;
		return $this;
	}

	public function getUpdatedAt() {
		return $this->updatedAt;
	}

	public function setUpdatedAt(\DateTime $updated_at) {
		$this->updatedAt = $updated_at;
		return $this;
	}
}
