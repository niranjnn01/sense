<?php
class Contact_us_model extends CI_Model{

	function __construct(){
		parent::__construct();

		$this->load->config('contact_us');
		$this->aPurposeStatus = $this->config->item('contact_us_purpose_status');
	}


	/**
	 *
	 * Get a single purpose
	 *
	 */
	function getPurposeBy($sField='uid', $sValue, $aWhere=array() ) {

		$sField = 'EP.'.$sField;

        $aWhere[$sField] = $sValue;

        if( $aWhere ) {
            $this->db->where($aWhere);
        }

		$query = $this->db->get('enquiry_purposes EP');

		//p($this->db->last_query());

		return $query->row();
	}


	/**
	 * get a list of purposes
	 *
	 * @param unknown_type $iLimit
	 * @param unknown_type $iOffset
	 * @param unknown_type $aWhere
	 * @return unknown
	 */
	function getPurposes( $iLimit=0, $iOffset=0, $aWhere=array(), $aOrderBy=array() ) {


		if($iLimit || $iOffset){
			$this->db->limit($iLimit, $iOffset);
		}

		if($aWhere){
			$this->db->where($aWhere, false);
		}

		if($aOrderBy){
			foreach($aOrderBy AS $key=>$value){
				$this->db->order_by($key, $value);
			}
		}


		//p($this->db->last_query());
		return $this->db->get('enquiry_purposes EP')->result();
	}



	public function put_enquiry( $aEnquiry ) {

		$this->db->insert('enquiries' , $aEnquiry);
	    $last_row = $this->db->select('*')->order_by('id',"desc")->limit(1)->get('enquiries')->row();
		return $last_row;
	}


	//get a list of enquiries.
	public function get_enquiries($iLimit=0, $iOffset=0, $aWhere=array(), $aOrderBy=array(), $aOrWhere=array()) {

		$this->db->select('E.*');

		if( $iLimit || $iOffset ) {

			$this->db->limit($iLimit, $iOffset);
		}

		if( $aWhere ) {

			$this->db->where($aWhere, false);

		}

		if( $aOrWhere ) {

			foreach($aOrWhere AS $aItem){
				$this->db->or_where($aItem, false);
			}
		}

		if( $aOrderBy ) {

			foreach($aOrderBy AS $sKey => $sItem){

				$this->db->order_by($sKey, $sItem);
			}

		}

		$query = $this->db->get('enquiries E');
		// $this->db->order_by("created_on", "desc");
		$result = $query->result();
		return $result;

	}



	public function get_enquiry( $enquiry_id, $aWhere=array() ) {

		$this->db->select('*');

		$this->db->where('id', $enquiry_id);

		if( $aWhere ) {
            $this->db->where($aWhere);
        }

		$query = $this->db->get('enquiries');
		$result = $query->result();
		return $result;
	}


	public function get_enquiry_count($aWhere=array(), $aOrderBy=array(), $aOrWhere=array()) {

		$iCount = 0;

		$this->db->select('COUNT(E.id) count');

		if( $aWhere ) {

			$this->db->where($aWhere, false);

		}

		if( $aOrWhere ) {

			foreach($aOrWhere AS $aItem){
				$this->db->or_where($aItem, false);
			}
		}

		if( $oRow = $this->db->get('enquiries E')->row() ) {

			$iCount = $oRow->count;
		}

		//p($this->db->last_query());

		return $iCount;


	}


	public function get_enquiry_details( $enquiry_id, $aWhere=array() ) {

		$this->db->select('
						E.*,
						CONCAT_WS(" ", U.first_name, U.middle_name, U.last_name ) full_name
						');

		$this->db->where('id', $enquiry_id);

		if( $aWhere ) {
			$this->db->where($aWhere);
		}

		$this->db->join('users U', 'U.account_no = E.account_number');

		$query = $this->db->get('enquiries E');
		$result = $query->result();
		return $result;
	}


	//get an enquiry.
	public function getenquiryby($sField='id', $sValue, $aWhere=array()){

		$sField = 'E.'.$sField;

        $aWhere[$sField] = $sValue;

        if( $aWhere ) {
            $this->db->where($aWhere);
        }

		$query = $this->db->get('enquiries E');

		//p($this->db->last_query());

		return $query->row();

	}

	//put an enquiry reply message.
	public function put_enquiry_reply( $aEnquiry_reply ) {

		$this->db->insert('enquiry_replies' , $aEnquiry_reply);

	}

	//get list of enquiry reply by id.
	public function get_enquiry_reply( $enquiry_id ) {

		$this->db->select('*');
		$this->db->where('enquiry_id', $enquiry_id);
		$query = $this->db->get('enquiry_replies');
		$result = $query->result();
		return $result;
	}

	//get list of enquiry reply by id.
	public function get_enquiry_reply_details( $enquiry_id ) {

		$this->db->select('
						ER.*,
						CONCAT_WS(" ", U.first_name, U.middle_name, U.last_name ) full_name,
						U.type user_type
						');
		$this->db->where('enquiry_id', $enquiry_id);

		$this->db->join('users U', 'U.account_no = ER.author_account');

		$query = $this->db->get('enquiry_replies ER');
		$result = $query->result();
		return $result;
	}


	function getEmailTemplateBy($sField='uid', $sValue, $aWhere=array() ) {

	    $sField = 'ET.'.$sField;

	        $aWhere[$sField] = $sValue;

	        if( $aWhere ) {
	            $this->db->where($aWhere);
	        }

	    $query = $this->db->get('email_templates ET');



	    return $query->row();
	  }
}
