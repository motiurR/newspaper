<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>

<?php
class VotingPool{
		private $db;
		private $fm;

	public function __construct(){
		$this->db = new Database();
		$this->fm = new Format();
	  }

	  public function addQuestion($data){
		$question = $this->fm->validation($data['question']);
		$question = mysqli_real_escape_string($this->db->link,$question);
		$status = $this->fm->validation($data['status']);
		$status = mysqli_real_escape_string($this->db->link,$status);

		if ($question =="") {
	    	$msg = "<span class='error'>Field must not be empty!</span>";
			return $msg;
	    }else{
	    	$query = "INSERT INTO poll_question(question,status) VALUES('$question','$status')";
	    	$inserted_row = $this->db->insert($query);
	      }if ($inserted_row) {
				$msg = "<span class='success'>inserted successfully!</span>";
			    return $msg;
				
			}else{
				$msg = "<span class='error'>Something Went Wrong!</span>";
			    return $msg;
			}
		}
		public function getallques(){
			$subJquery = "SELECT * FROM  poll_question ORDER BY id DESC";
		      $result = $this->db->select($subJquery);
		      return $result;
		}


		public function changeQuesStatusById($id){
			$query = "UPDATE poll_question SET status = !status WHERE id = '$id'";
			$changstutus = $this->db->update($query);
			return $changstutus;
		}
		public function delQuestionByid($id){
			$query = "DELETE FROM  poll_question WHERE id = '$id'";
		      $result = $this->db->delete($query);
		      return $result;
		}
		public function getquesforshow($id){
			$query = "SELECT * FROM  poll_question WHERE id = '$id'";
		      $result = $this->db->select($query);
		      return $result;
		}

		public function Updatequestiom($data, $id){
			$question = $this->fm->validation($data['question']);
			$question = mysqli_real_escape_string($this->db->link,$question);

			$updatequery = "UPDATE poll_question 
							SET 
							question = '$question'
							WHERE id = '$id'";
			$update_row = $this->db->update($updatequery);
			if ($update_row) {
				$msg = "<span class='success'>Update Successfully.</span>";
				return $msg;
			}else{
				$msg = "<span class='unsuccess'>Something Went Wrong</span>";
				return $msg;
			} 
		}

		public function getAllQuestionforaddAns(){
			$query = "SELECT * FROM poll_question ORDER BY id DESC";
		      $result = $this->db->select($query);
		      return $result;
		}
		public function addanswer($data){
			$poll_id = $this->fm->validation($data['poll_id']);
		    $poll_id = mysqli_real_escape_string($this->db->link,$poll_id);
		    $option = $this->fm->validation($data['option']);
		    $option = mysqli_real_escape_string($this->db->link,$option);

		    if ($option =="") {
	    	$msg = "<span class='error'>Field must not be empty!</span>";
			return $msg;
	    }else{
	    	$query = "INSERT INTO poll_option(poll_id,option) VALUES('$poll_id','$option')";
	    	$inserted_row = $this->db->insert($query);
	      }if ($inserted_row) {
				$msg = "<span class='success'>inserted successfully!</span>";
			    return $msg;
				
			}else{
				$msg = "<span class='error'>Something Went Wrong!</span>";
			    return $msg;
			}
		}
		public function getAllVotQnAns(){
			/*$query = "SELECT * FROM poll_option ORDER BY id DESC";
		      $result = $this->db->select($query);
		      return $result;*/

		      $newsShowquery = "SELECT poll_option.*,poll_question.*
					           FROM poll_option
					           INNER JOIN poll_question 
					           ON poll_option.poll_id = poll_question.id
					           ORDER BY poll_option.id DESC";
		      $result = $this->db->select($newsShowquery);
		      return $result;
		}
		public function delVotansById($id){
			$query = "DELETE FROM  poll_option WHERE poll_id = '$id'";
		      $result = $this->db->delete($query);
		      return $result;
		}
	  
 }