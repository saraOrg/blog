<?php

namespace Admin\Action;
use Think\Action;

class WelcomeAction extends Action {
	public function index() {
		$this->display();
	}
}