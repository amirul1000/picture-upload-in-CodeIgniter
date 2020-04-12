<?php

/**
 * Author: Amirul Momenin
 * Desc:Article Controller
 *
 */
class Article extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->library('Customlib');
        $this->load->helper(array(
            'cookie',
            'url'
        ));
        $this->load->database();
        $this->load->model('Article_model');
        if (! $this->session->userdata('validated')) {
            redirect('admin/login/index');
        }
    }

    /**
     * Index Page for this controller.
     *
     * @param $start -
     *            Starting of article table's index to get query
     *            
     */
    function index($start = 0)
    {
        $limit = 10;
        $data['article'] = $this->Article_model->get_limit_article($limit, $start);
        // pagination
        $config['base_url'] = site_url('admin/article/index');
        $config['total_rows'] = $this->Article_model->get_count_article();
        $config['per_page'] = 10;
        // Bootstrap 4 Pagination fix
        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '<span aria-hidden="true"></span></span></li>';
        $config['next_tag_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';
        $this->pagination->initialize($config);
        $data['link'] = $this->pagination->create_links();

        $data['_view'] = 'admin/article/index';
        $this->load->view('layouts/admin/body', $data);
    }

    /**
     * Save article
     *
     * @param $id -
     *            primary key to update
     *            
     */
    function save($id = - 1)
    {
        $file_picture_1 = "";
        $file_picture_2 = "";

        $created_at = "";
        $updated_at = "";

        if ($id <= 0) {
            $created_at = date("Y-m-d H:i:s");
        } else if ($id > 0) {
            $updated_at = date("Y-m-d H:i:s");
        }

        $params = array(
            'subject' => html_escape($this->input->post('subject')),
            'description' => html_escape($this->input->post('description')),
            'file_picture_1' => $file_picture_1,
            'file_picture_2' => $file_picture_2,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        );

        $config['upload_path'] = "./public/uploads/images/article";
        $config['allowed_types'] = "gif|jpg|png";
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $this->load->library('upload', $config);

        if (isset($_POST) && count($_POST) > 0) {
            if (strlen($_FILES['file_picture_1']['name']) > 0 && $_FILES['file_picture_1']['size'] > 0) {
                if (! $this->upload->do_upload('file_picture_1')) {
                    $error = array(
                        'error' => $this->upload->display_errors()
                    );
                } else {
                    $file_picture_1 = "uploads/images/article/" . $_FILES['file_picture_1']['name'];
                    $params['file_picture_1'] = $file_picture_1;
                }
            } else {
                unset($params['file_picture_1']);
            }
        }

        $config['upload_path'] = "./public/uploads/images/article";
        $config['allowed_types'] = "gif|jpg|png";
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;
        $this->load->library('upload', $config);

        if (isset($_POST) && count($_POST) > 0) {
            if (strlen($_FILES['file_picture_2']['name']) > 0 && $_FILES['file_picture_2']['size'] > 0) {
                if (! $this->upload->do_upload('file_picture_2')) {
                    $error = array(
                        'error' => $this->upload->display_errors()
                    );
                } else {
                    $file_picture_2 = "uploads/images/article/" . $_FILES['file_picture_2']['name'];
                    $params['file_picture_2'] = $file_picture_2;
                }
            } else {
                unset($params['file_picture_2']);
            }
        }

        if ($id > 0) {
            unset($params['created_at']);
        }
        if ($id <= 0) {
            unset($params['updated_at']);
        }
        $data['id'] = $id;
        // update
        if (isset($id) && $id > 0) {
            $data['article'] = $this->Article_model->get_article($id);
            if (isset($_POST) && count($_POST) > 0) {
                $this->Article_model->update_article($id, $params);
                redirect('admin/article/index');
            } else {
                $data['_view'] = 'admin/article/form';
                $this->load->view('layouts/admin/body', $data);
            }
        } // save
        else {
            if (isset($_POST) && count($_POST) > 0) {
                $article_id = $this->Article_model->add_article($params);
                redirect('admin/article/index');
            } else {
                $data['article'] = $this->Article_model->get_article(0);
                $data['_view'] = 'admin/article/form';
                $this->load->view('layouts/admin/body', $data);
            }
        }
    }

    /**
     * Details article
     *
     * @param $id -
     *            primary key to get record
     *            
     */
    function details($id)
    {
        $data['article'] = $this->Article_model->get_article($id);
        $data['id'] = $id;
        $data['_view'] = 'admin/article/details';
        $this->load->view('layouts/admin/body', $data);
    }

    /**
     * Deleting article
     *
     * @param $id -
     *            primary key to delete record
     *            
     */
    function remove($id)
    {
        $article = $this->Article_model->get_article($id);

        // check if the article exists before trying to delete it
        if (isset($article['id'])) {
            $this->Article_model->delete_article($id);
            redirect('admin/article/index');
        } else
            show_error('The article you are trying to delete does not exist.');
    }

    /**
     * Search article
     *
     * @param $start -
     *            Starting of article table's index to get query
     */
    function search($start = 0)
    {
        if (! empty($this->input->post('key'))) {
            $key = $this->input->post('key');
            $_SESSION['key'] = $key;
        } else {
            $key = $_SESSION['key'];
        }

        $limit = 10;
        $this->db->like('id', $key, 'both');
        $this->db->or_like('subject', $key, 'both');
        $this->db->or_like('description', $key, 'both');
        $this->db->or_like('file_picture_1', $key, 'both');
        $this->db->or_like('file_picture_2', $key, 'both');
        $this->db->or_like('created_at', $key, 'both');
        $this->db->or_like('updated_at', $key, 'both');

        $this->db->order_by('id', 'desc');

        $this->db->limit($limit, $start);
        $data['article'] = $this->db->get('article')->result_array();
        $db_error = $this->db->error();
        if (! empty($db_error['code'])) {
            echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
            exit();
        }

        // pagination
        $config['base_url'] = site_url('admin/article/search');
        $this->db->reset_query();
        $this->db->like('id', $key, 'both');
        $this->db->or_like('subject', $key, 'both');
        $this->db->or_like('description', $key, 'both');
        $this->db->or_like('file_picture_1', $key, 'both');
        $this->db->or_like('file_picture_2', $key, 'both');
        $this->db->or_like('created_at', $key, 'both');
        $this->db->or_like('updated_at', $key, 'both');

        $config['total_rows'] = $this->db->from("article")->count_all_results();
        $db_error = $this->db->error();
        if (! empty($db_error['code'])) {
            echo 'Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message'];
            exit();
        }
        $config['per_page'] = 10;
        // Bootstrap 4 Pagination fix
        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close'] = '<span aria-hidden="true"></span></span></li>';
        $config['next_tag_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close'] = '</span></li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close'] = '</span></li>';
        $this->pagination->initialize($config);
        $data['link'] = $this->pagination->create_links();

        $data['key'] = $key;
        $data['_view'] = 'admin/article/index';
        $this->load->view('layouts/admin/body', $data);
    }

    /**
     * Export article
     *
     * @param $export_type -
     *            CSV or PDF type
     */
    function export($export_type = 'CSV')
    {
        if ($export_type == 'CSV') {
            // file name
            $filename = 'article_' . date('Ymd') . '.csv';
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$filename");
            header("Content-Type: application/csv; ");
            // get data
            $this->db->order_by('id', 'desc');
            $articleData = $this->Article_model->get_all_article();
            // file creation
            $file = fopen('php://output', 'w');
            $header = array(
                "Id",
                "Subject",
                "Description",
                "File Picture 1",
                "File Picture 2",
                "Created At",
                "Updated At"
            );
            fputcsv($file, $header);
            foreach ($articleData as $key => $line) {
                fputcsv($file, $line);
            }
            fclose($file);
            exit();
        } else if ($export_type == 'Pdf') {
            $this->db->order_by('id', 'desc');
            $article = $this->db->get('article')->result_array();
            // get the HTML
            ob_start();
            include (APPPATH . 'views/admin/article/print_template.php');
            $html = ob_get_clean();
            include (APPPATH . "third_party/mpdf60/mpdf.php");
            $mpdf = new mPDF('', 'A4');
            // $mpdf=new mPDF('c','A4','','',32,25,27,25,16,13);
            // $mpdf->mirrorMargins = true;
            $mpdf->SetDisplayMode('fullpage');
            // ==============================================================
            $mpdf->autoScriptToLang = true;
            $mpdf->baseScript = 1; // Use values in classes/ucdn.php 1 = LATIN
            $mpdf->autoVietnamese = true;
            $mpdf->autoArabic = true;
            $mpdf->autoLangToFont = true;
            $mpdf->setAutoBottomMargin = 'stretch';
            $stylesheet = file_get_contents(APPPATH . "third_party/mpdf60/lang2fonts.css");
            $mpdf->WriteHTML($stylesheet, 1);
            $mpdf->WriteHTML($html);
            // $mpdf->AddPage();
            $mpdf->Output($filePath);
            $mpdf->Output();
            // $mpdf->Output( $filePath,'S');
            exit();
        }
    }
}
//End of Article controller