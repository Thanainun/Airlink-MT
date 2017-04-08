
  
  <!-- slider wrap starts -->
  <div class="sliderOuterWrap">
    <div class="sliderWrap">
     
      <form action="{auth_url}" id="user_login" name="form1" method="post">
        <fieldset>
          <div class="formFieldWrap">
           
           <input class="contactField requiredField" id="username" name="UserName" type="text" placeholder="<?=$this->lang->line('username_login'); ?>" >
          </div>
          <div class="formFieldWrap">
           
            <input class="contactField" id="password" name="Password" type="password" placeholder="<?=$this->lang->line('password_login'); ?>">
          </div>
          <div class="formTextareaWrap">
           <div class="formSubmitButtonErrorsWrap">{message} </div>
            <!-- form errors end -->
            <button title="Login" class="buttonWrap buttonDefault" value='Login' type="submit"><?=$this->lang->line('button_login'); ?></button>
            
          </div>
          {hidden_form}
        </fieldset>
      </form>
    </div>
  </div>
  <!-- slider wrap ends -->
  
  
  