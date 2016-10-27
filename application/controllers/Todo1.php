<?php 

require APPPATH . '/libraries/REST_Controller.php';

class Todo extends REST_Controller
{
  function __construct($config = 'rest') 
  {
      parent::__construct($config);
  }


    /**
     * @api {get} /todo Get List Todo
     * @apiName GetTodo
     * @apiGroup Todo
     *
     * @apiParam {Number} id Todo unique ID.
     *
     */

  function index_get()
  {
    // untuk mendapatkan list/data todo
    $id = $this->get('id');
    if($id == '')
    {
      $todos = $this->db->get('tbl_task')->result();
    } else {
      $this->db->where('id',$id);
      $todos = $this->db->get('tbl_task')->result();
    }
    $this->response($todos, 200);
  }

    /**
     * @api {PUT} /todo PUT List Todo
     * @apiName PutTodo
     * @apiGroup Todo
     *
     * @apiParam {Number} id Todo unique ID.
     *
     */

  function index_put()
  {
    // untuk mengupdate todo dengan response status/error
    $id = $this->put('id');
    $data = array(
        'task'  => $this->post('task')
      );
    $this->db->where('id',$id);
    $update = $this->db->update('tbl_task',$data);

  }

  function index_post()
  {
    // untuk insert todo baru
    $data = array(
        'task' => $this->post('task'), 
      );
    $insert = $this->db->insert('tbl_task',$data);

    if($insert){
      $this->response($data, 200);
    } else {
      $this->response(array('status' => 'fail', 502));
    }
  }

  function index_delete()
  {
    // untuk delete todo dengan status/erros
    $id = $this->delete('id');
    $this->db->where('id', $id);
    $delete = $this->db->delete('tbl_task');

    if($delete)
    {
      $this->response(array('status'=>'succes'), 200);
    } else {
      $this->response(array('status'=>'fail'), 502);
    }
  }
}