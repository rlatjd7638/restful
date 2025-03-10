<?php

require APPPATH . 'libraries/REST_Controller.php';

class Item extends REST_Controller
{

	/**
	 * Get All Data from this method.
	 *
	 * @return Response
	 */
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	/**
	 * Get All Data from this method.
	 *
	 * @return Response
	 */
	public function index_get($id = 0)
	{
		if(!empty($id)){
			$data = $this->db->get_where("items", ['id' => $id])->row_array();
		}else{
			$data = $this->db->get("items")->result();
		}
		$this->response($data, REST_Controller::HTTP_OK);
	}
	/**
	 * Get All Data from this method.
	 *
	 * @return Response
	 */
	public function index_post()
	{
		$json=$this->_get_jsondata();
		if($json):
			echo "post_:".$json;
			exit;
		endif;
		$input = $this->input->post();
		$this->db->insert('items',$input);

		$this->response(['Item created successfully.'], REST_Controller::HTTP_OK);
	}
	public function index_patch()
	{
		$input = $this->input->post();
		$this->db->insert('items',$input);

		$this->response(['Item created successfully.'], REST_Controller::HTTP_OK);
	}

	/**
	 * Get All Data from this method.
	 *
	 * @return Response
	 */
	public function index_put($id="")
	{
		$input = $this->put();
		$this->db->update('items', $input, array('id'=>$id));

		$this->response(['Item updated successfully.'], REST_Controller::HTTP_OK);
	}

	/**
	 * Get All Data from this method.
	 *
	 * @return Response
	 */
	public function index_delete($id="")
	{
		$this->db->delete('items', array('id'=>$id));

		$this->response(['Item deleted successfully.'], REST_Controller::HTTP_OK);
	}
	function _get_jsondata()
	{
		$this->output->set_content_type('application/json');
		$json = file_get_contents("php://input");
		return $json;
	}

}