<?php

    class Categories_model extends CI_Model {

        public function put_category( $aCategory ) {

            $this->db->insert('categories' , $aCategory);
        }

        public function get_categories() {

            $query = $this->db->get('categories');
            $result = $query->result();
            return $result;
        }

        public function get_categories_by_group( $group_id ) {

            $this->db->select('*');
            $this->db->where('group_id', $group_id);
            $query = $this->db->get('categories');
            $result = $query->result();
            $result_set = array (
                                'aCategories' => $result
                              );
            return $result_set;
        }

        public function get_category_by_id($category_id) {

            $this->db->select('*');
            $this->db->where('id', $category_id);
            $query = $this->db->get('categories');
            $result = $query->result();

            return $result;
        }

        public function put_category_group( $aCategory_group ) {

            $this->db->insert('category_group' , $aCategory_group);
        }

        public function get_category_groups() {

            $query = $this->db->get('category_group');
            $result = $query->result();
            // $result_set = array (
            //                             'aCategory_group' => $result
            //                     );
            return $result;
        }

        public function get_category_group_by_id($group_id) {

            $this->db->select('*');
            $this->db->where('id', $group_id);
            $query = $this->db->get('category_group');
            $result = $query->result();
            $result_set = array (
                                        'aCategory_group' => $result
                                );
            return $result_set;
        }

        public function update_category_groups($aCategory_group) {

            $id = $aCategory_group['id'];
            $data = array(
                        'title'  => $aCategory_group['title'],
                        'status' => $aCategory_group['status']
                         );
            $this->db->where('id', $id);
            $this->db->update('category_group', $data);
        }

        public function update_category($aCategory) {

            $id = $aCategory['id'];
            $data = array(
                        'title'         => $aCategory['title'],
                        'description'   => $aCategory['description'],
                        'status'        => $aCategory['category_status'],
                         );

            $this->db->where('id', $id);
            $this->db->update('categories', $data);
        }

        public function get_category_group_status() {

            $query = $this->db->get('category_group_statuses');
            $result = $query->result();
            return $result;
        }

        public function get_category_status() {

            $query = $this->db->get('category_statuses');
            $result = $query->result();

            return $result;
        }

    }
?>
