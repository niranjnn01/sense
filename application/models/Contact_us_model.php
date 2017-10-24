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
	}

	public function get_enquiries() {

		$query = $this->db->get('enquiries');
		$this->db->order_by("created_on", "desc");
		$result = $query->result();
		return $result;
	}

	public function get_enquiry( $enquiry_id ) {

		$this->db->select('*');
		$this->db->where('id', $enquiry_id);
		$query = $this->db->get('enquiries');
		$result = $query->result();
		return $result;
	}

	public function put_enquiry_reply( $aEnquiry_reply ) {

		$this->db->insert('enquiry_replies' , $aEnquiry_reply);

	}

	public function get_enquiry_reply( $enquiry_id ) {

		$this->db->select('*');
		$this->db->where('enquiry_id', $enquiry_id);
		$query = $this->db->get('enquiry_replies');
		$result = $query->result();
		return $result;
	}

}
