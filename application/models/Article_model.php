<?php

/**
 * Author: Amirul Momenin
 * Desc:Article Model
 */
class Article_model extends CI_Model
{

    protected $article = 'article';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * Get article by id
     *
     * @param $id -
     *            primary key to get record
     *            
     */
    function get_article($id)
    {
        $result = $this->db->get_where('article', array(
            'id' => $id
        ))->row_array();
        $db_error = $this->db->error();
        if (! empty($db_error['code'])) {
            echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
            exit();
        }
        return $result;
    }

    /**
     * Get all article
     */
    function get_all_article()
    {
        $this->db->order_by('id', 'desc');
        $result = $this->db->get('article')->result_array();
        $db_error = $this->db->error();
        if (! empty($db_error['code'])) {
            echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
            exit();
        }
        return $result;
    }

    /**
     * Get limit article
     *
     * @param $limit -
     *            limit of query , $start - start of db table index to get query
     *            
     */
    function get_limit_article($limit, $start)
    {
        $this->db->order_by('id', 'desc');
        $this->db->limit($limit, $start);
        $result = $this->db->get('article')->result_array();
        $db_error = $this->db->error();
        if (! empty($db_error['code'])) {
            echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
            exit();
        }
        return $result;
    }

    /**
     * Count article rows
     */
    function get_count_article()
    {
        $result = $this->db->from("article")->count_all_results();
        $db_error = $this->db->error();
        if (! empty($db_error['code'])) {
            echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
            exit();
        }
        return $result;
    }

    /**
     * function to add new article
     *
     * @param $params -
     *            data set to add record
     *            
     */
    function add_article($params)
    {
        $this->db->insert('article', $params);
        $id = $this->db->insert_id();
        $db_error = $this->db->error();
        if (! empty($db_error['code'])) {
            echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
            exit();
        }
        return $id;
    }

    /**
     * function to update article
     *
     * @param $id -
     *            primary key to update record,$params - data set to add record
     *            
     */
    function update_article($id, $params)
    {
        $this->db->where('id', $id);
        $status = $this->db->update('article', $params);
        $db_error = $this->db->error();
        if (! empty($db_error['code'])) {
            echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
            exit();
        }
        return $status;
    }

    /**
     * function to delete article
     *
     * @param $id -
     *            primary key to delete record
     *            
     */
    function delete_article($id)
    {
        $status = $this->db->delete('article', array(
            'id' => $id
        ));
        $db_error = $this->db->error();
        if (! empty($db_error['code'])) {
            echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
            exit();
        }
        return $status;
    }
}
