<!-- *** TOPBAR ***
 _________________________________________________________ -->
 <div id="top">
        <div class="container" >
            <div class="col-md-12" data-animate="fadeInDown" >
                <ul class="menu" align="right">  
                <?php if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']) {?>   
                    <h5>  <?php echo $_SESSION['userFullName'] ?></h5>          
                    <li>             
                    <a href="./home.php?page=orderhistory?1?OrderHistory">Order History</a>
                </li>    
                <?php } ?>
                <?php if(isset($_SESSION['is_logged_in']) && !$_SESSION['is_logged_in']) {?>     
                <li><a href="./index.php">Sign in</a>
                    </li>                    
                     <li><a href="./register.php">Register</a>
                    </li> 
                    <?php } ?>
                    <?php if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']) {?>     
                <li><a href="#"  data-toggle="modal" data-target="#login-modal">Sign Out</a>
                    </li>
                    <?php } ?>
                                    
                </ul>
            </div>
        </div>
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-md">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Are you sure you want to sign out?</h4>
                    </div>
                    <div class="modal-body">          
                        <button type="submit" class="btn btn-primary" id="signOut" align="center">Sign Out</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script id="source" language="javascript" type="text/javascript">      
        $(document).on('click','#signOut',function(e) {
           
            document.location.href = './thankyou.php';
      });
    </script>
 