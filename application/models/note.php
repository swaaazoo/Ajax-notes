<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Note extends CI_Model {


	public function add($data)
	{
		$query = "INSERT INTO notes (title, created_at, updated_at) VALUE (?,NOW(),NOW())";
		$values = $data;
		$this->db->query($query, $values);
	}

	// public function update()
	public function get_all_notes()
	{
		
		return $this->db->query("SELECT * FROM notes")->result_array();
	}


	public function delete($id)
	{
		$this->db->query("DELETE FROM notes WHERE id=?", array($id));
	}

	public function updateNote($desc, $id)
	{
		$query = "UPDATE notes SET description = ?, updated_at = NOW() WHERE id = ?";
		$values = array($desc, $id);
		return $this->db->query($query, $values);
	}
}

?>