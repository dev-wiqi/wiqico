<?php echo $this->session->flashdata("result_register"); ?>
<form action="<?php echo base_url(); ?>Register/set" method="POST">
    First Name :
    <input name="firstname" type="text"/><br/>
    Last Name :
    <input name="lastname" type="text"/><br/>
    Email :
    <input name="email" type="email"/><br/>
    Password :
    <input name="password" type="password"/><br/>
    BirthDate :
    <input name="birth" type="text"/><br/>
    Phone :
    <input name="phone" type="text"/><br/>
    Address :
    <textarea name="address"/></textarea><br/>
    City :
    <input name="city" type="text"/><br/>
    Identity :
    <input name="identity" type="text"/><br/>
    Bank :
    <input name="bank" type="text"/><br/>
    Account Bank :
    <input name="account" type="number"/><br/>

    <input type="submit" value="Save"/>
</form>