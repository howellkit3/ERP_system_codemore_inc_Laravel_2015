<?php
App::uses('ItemGroupLayer', 'Model');

/**
 * ItemGroupLayer Test Case
 *
 */
class ItemGroupLayerTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.item_group_layer'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ItemGroupLayer = ClassRegistry::init('ItemGroupLayer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ItemGroupLayer);

		parent::tearDown();
	}

}
