<div class="materialContainer">

  <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">

     <div class="box">

        <div class="title">LOGIN</div>

        <div class="input">
           <label for="name">Username</label>
           <input type="text" name="login_name" id="name" autofocus required>
           <span class="spin"></span>
        </div>

        <div class="input">
           <label for="pass">Password</label>
           <input type="password" name="login_pass" id="pass" required>
           <span class="spin"></span>
        </div>

        <div class="button login">
           <button name="btn_login" id="btn_login"><span>GO</span> <i class="fa fa-check"></i></button>
        </div>

        <a href="" class="pass-forgot">Don't have an account? Click that attractive red button!</a>

     </div>

  </form>

  <form action="register.php" method="POST">

     <div class="overbox">
        
        <div class="material-button alt-2"><span class="shape"></span></div>

        <div class="title">REGISTER</div>

        <div class="input">
           <label for="regname">Username</label>
           <input type="text" name="reg_name" id="regname" required>
           <span class="spin"></span>
        </div>

        <div class="input">
           <label for="regpass">Password</label>
           <input type="password" name="reg_pass" id="regpass" required>
           <span class="spin"></span>
        </div>

        <div class="input">
           <label for="reregpass">Repeat Password</label>
           <input type="password" name="reg_repass" id="reregpass" required>
           <span class="spin"></span>
        </div>

        <div class="button">
           <button name="btn_register" id="btn_register"><span>NEXT</span></button>
        </div>


     </div>

  </form>

</div>