<?php echo $this->session->flashdata("result_login"); ?>
<form action="<?php echo base_url(); ?>Auth/set" method="POST">
    <input name="email" type="text"/>
    <input name="password" type="password"/>
    <input type="submit" value="Login"/>
</form>