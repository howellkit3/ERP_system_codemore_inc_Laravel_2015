<?php
class PayrollsController extends PayrollAppController {


	public function settings() {

		$date = date('Y-m-d');

		$this->set(compact('date'));

	}


}