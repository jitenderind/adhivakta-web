<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Page extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * http://example.com/index.php/welcome
     * - or -
     * http://example.com/index.php/welcome/index
     * - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     *
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    private $pages = [
        'workspace' => array(
            'name' => 'My Desk',
            'icon' => 'dashboard',
            'tab' => 'workspace'
        ),
        'causelist' => array(
            'name' => 'Cause List',
            'icon' => 'gavel',
            'tab' => 'causelist'
        ),
        'display-board' => array(
            'name' => 'Display Board',
            'icon' => 'picture_in_picture',
            'tab' => 'display-board'
        ),
        'appeal-alert' => array(
            'name' => 'Appeal Alert',
            'icon' => 'announcement',
            'tab' => 'appeal-alert'
        ),
        'tasks' => array(
            'name' => 'Tasks',
            'icon' => 'done_all',
            'tab' => 'tasks'
        ),
        'invoice' => array(
            'name' => 'Invoice & Billing',
            'icon' => 'receipt',
            'tab' => 'billing'
        ),
        'archived' => array(
            'name' => 'Archived Cases',
            'icon' => 'archive',
            'tab' => 'archives'
        ),
        'clients' => array(
            'name' => 'clients',
            'icon' => 'face',
            'tab' => 'clients'
        ),
    ];

    public function nav()
    {
        echo $data = $this->load->view('common/nav', '', TRUE);
        // var_dump($data);
        // $this->set_output($data);
    }

    public function sidebar()
    {
        $this->load->helper('url'); // loading url helper to load assests
        echo $data = $this->load->view('common/sidebar', '', TRUE);
        // var_dump($data);
        // $this->set_output($data);
    }

    public function load_page($page)
    {
        $data['pageName'] = $this->pages[$page]['name'];
        $data['pageIcon'] = $this->pages[$page]['icon'];
        $data['activeTab'] = $this->pages[$page]['name'];
        $data['content'] = $this->load->view('ajax/' . $page, '', TRUE);
        echo json_encode($data);
    }
    
    public function load_data($page)
    {
        echo $data = $this->load->view('ajax/'.$page, '', TRUE);
    }
}