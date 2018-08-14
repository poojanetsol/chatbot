<section>
    <?php echo $this->Flash->render();
    echo $this->Form->create(false, ['name'=>'loginForm','id'=>'registrationForm', 'novalidate' => true,'class'=>'form-signin']);?>
    <h3 class='form-signin-heading'>Administrator Login</h3>
    <div>
        <?php  echo $this->Form->input('username', [
                                        'class' => 'input-block-level',
                                        'placeholder' => 'Username',
                                        'label' =>false
                                        ]);
                                        ?>
    </div>
    <div>
        <?php  echo $this->Form->password('password', [
                                        'class' => 'input-block-level',
                                        'placeholder' => 'Password',
                                        'autocomplete'=>'off',
                                        'label' =>false
                                        ]);
                                        ?>
    </div>
    
    <div class="roleCheck">
        <?php $roles = ['0'=>'Admin','1'=>'Call Center'];
        echo $this->Form->radio('role',$roles,['label'=>['class'=> 'checkbox inline'],'default' => 0]);?>   
    </div>
    
    <label class="checkbox">
        <?php echo $this->Form->checkbox('remember_me');?> Remember Me
    </label>
        
    <div>
        <?php echo $this->Form->button('SignIn', [
                                        'type' => 'submit',
                                        'class' => 'btn btn-large btn-primary']);?>
       
        <a class="reset_pass" href="<?php echo $_SERVER['REQUEST_URI']?>Admins/forgot">Forgot Password?</a>
    </div>  
    <?php echo $this->Form->end() ?>
</section>


