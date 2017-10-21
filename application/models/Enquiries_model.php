<?php

    class Enquiries_model extends CI_Model {

        public function put_enquiry( $aEnquiry ) {

            $this->db->insert('enquiries' , $aEnquiry);
        }

        public function get_enquiry_by_id( $enquiry_id ) {

            $this->db->select('*');
            $this->db->where('id', $enquiry_id);
            $query = $this->db->get('enquiries');
            $result = $query->result();
            $aEnquiry = array (
                                'aEnquiry' => $result
                              );
            return $aEnquiry;
        }

        public function get_enquiry_reply( $enquiry_id ) {

            $this->db->select('*');
            $this->db->where('enquiry_id', $enquiry_id);
            $query = $this->db->get('enquiry_replies');
            $result = $query->result();
            $aEnquiry_reply = array (
                                'aEnquiry_reply' => $result
                              );
            return $aEnquiry_reply;
        }

        public function get_enquiries() {

            $query = $this->db->get('enquiries');
            $this->db->order_by("created_on", "desc");
            $result = $query->result();
            $result_set = array (
                                        'result' => $result
                                );
            return $result_set;
        }


        public function get_enquiry_purposes() {

            $query = $this->db->get('enquiry_purposes');
            $aPurposes = $query->result();
            $aPurposes = array (
                                    'purposes' => $aPurposes
                               );

            return $aPurposes;
        }

        public function put_enquiry_reply( $aEnquiry_reply ) {

            $this->db->insert('enquiry_replies' , $aEnquiry_reply);

        }

        public function get_username($user_id)
         {

         }
    }
?>
