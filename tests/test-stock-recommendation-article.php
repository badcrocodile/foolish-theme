<?php
/**
 * Class SampleTest
 *
 * @package Fool_Theme
 */

/**
 * Sample test case.
 */
class TestStockRecommendationArticle extends WP_UnitTestCase {
	public function setUp() {
		parent::setUp();
	}

	public function tearDown() {
		parent::tearDown();
	}

	/**
	 * Creates posts with taxonomy 'company'
	 */
	public function test_taxonomy_company_exists() {
		$this->assertTrue( in_array( 'company', get_taxonomies() ) );
	}

}
