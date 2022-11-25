<?php  $uid = $this->session->userdata('uid');

    if(empty($uid)){
        header('Location:'.base_url());
    }

?>

<?php $this->load->view('includes/header'); ?>

<?php $this->load->view($main_content); ?>

<?php $this->load->view('includes/footer'); ?>
