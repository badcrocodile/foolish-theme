<?php

/**
 * Class TestAjax
 *
 * @group ajax
 */
class TestAjax extends WP_Ajax_UnitTestCase {

	public string $ticker;
	public int    $num_posts;

	public function setUp() {
		parent::setUp();

		$this->ticker    = 'SBUX';
		$this->num_posts = 10;

		$this->create_posts_with_company_taxonomy();
	}

	public function tearDown() {
		parent::tearDown();
	}

	/**
	 * Make sure our ajax pagination function is returning the expected results,
	 * and the expected number of results.
	 */
	public function test_ajax_pagination_for_other_coverage() {
		$_POST['nonce']          = wp_create_nonce( 'foolish-nonce' );
		$_POST['page']           = '2';
		$_POST['company_ticker'] = $this->ticker;

		try {
			$this->_handleAjax( 'fool_paginate_custom_query' );
		} catch( WPAjaxDieContinueException $e ) {
			// Expected, do nothing
		}

		$response = $this->_last_response;

		$this->assertEquals( 5, substr_count( $response, '<li>' ) );
	}

	/**
	 * Creates 10 posts with taxonomy 'company' set to 'SBUX'
	 */
	public function create_posts_with_company_taxonomy() {
		$taxonomy = 'company';
		$term     = $this->ticker;
		$count    = $this->num_posts;

		$editor = $this->factory()->user->create( [ 'role' => 'editor' ] );
		$this->assertTrue( user_can( $editor, 'edit_posts' ) );

		wp_set_current_user( $editor );

		$this->factory()->post->create_many( $count, [
			'tax_input' => [ $taxonomy => $term ]
		] );

		$this->assertCount( $this->num_posts, get_posts( [ 'posts_per_page' => - 1 ] ) );
	}
}
