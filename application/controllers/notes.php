<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
	}

	public function index()
	{
		//do this because you can use it for var-dump testing 
		//AND you understand better what you are doing. what if this is an array of functions....
		$allNotes = $this->note->get_all_notes();  
		$this->load->view('index', array('allNotes' => $allNotes));
	}

	public function addNote()
	{
		$title = $this->input->post('title');
		$new_note = $this->note->add($title);
		$id = $this->db->insert_id();
		$output = array(
			'title' => $title,
			'id' => $id
		);
		echo json_encode($output);
	}

	public function updateNote()
	{
		$id = $this->input->post('id');
		$desc = $this->input->post('description');
		$this->note->updateNote($desc, $id);
	}

	public function removeNote()
	{
		$id = $this->input->post('id');
		$this->note->delete($id);
	}


}

//end of main controller