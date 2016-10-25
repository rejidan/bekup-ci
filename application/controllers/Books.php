<?php 

require APPPATH . '/libraries/REST_Controller.php';

class Books extends REST_Controller
{
  public function index_get()
  {
    // Display all books
    $this->response($this->db->get('tbl_task')->result());
  }

  public function index_post()
  {
    // Create a new book
	$this->response($book, 201); // Send an HTTP 201 Created

  }
}