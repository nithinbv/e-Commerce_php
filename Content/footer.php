
 <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
<div id="footer" data-animate="fadeInUp"   >
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <h4>Quick Links</h4>

                        <ul>
                            <li><a href="./home.php?page=about">About us</a>
                            </li>                           
                            <li><a href="./home.php?page=faq">FAQ</a>
                            </li>
                            <li><a href="./home.php?page=contact">Go to contact page</a>
                            </li>
                        </ul>

                      

                    </div>
                    <!-- /.col-md-3 -->

                 
                    <!-- /.col-md-3 -->

                    <div class="col-md-4 col-sm-6">

                        <h4>Where to find us</h4>

                        <p><strong>SR Ltd.</strong>
                            <br>13/25 New Avenue
                            <br>New Heaven
                            <br>45Y 73J
                            <br>England
                            <br>
                            <strong>Great Britain</strong>
                        </p>
                    </div>
                    <!-- /.col-md-3 -->
                    <div class="col-md-4 col-sm-6">

                        <h4>Get the news</h4>

                        <p>marketing note.</p>

                        <form>
                            <div class="input-group">

                                <input type="text" class="form-control" name = "subscribeInfo" id="subscribeInfo">

                                <span class="input-group-btn">

                                <button class="btn btn-default" type="submit" name="subscribeAdd" id= "subscribeAdd" >Subscribe!</button>
                                </span>
                               
                            </div>
                            <!-- /input-group -->
                        </form>
                    </div>
                    <!-- /.col-md-3 -->

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#footer -->

        <!-- *** FOOTER END *** -->
        <!-- *** COPYRIGHT ***
 _________________________________________________________ -->
        <div id="copyright">
            <div class="container">
                <div class="col-md-9">
                    <p class="pull-left">© 2017 GS.</p>

                </div>              
            </div>
        </div>
        <!-- *** COPYRIGHT END *** -->

</form>

<?php
//include("db.php"); 

$db = new Db();    
    if(isset($_POST['subscribeAdd'])) 
    {   
        if(! get_magic_quotes_gpc() ) 
            {
            $subscribe_Info = addslashes ($_POST['subscribeInfo']);      
            }
        else 
            {
            $subscribe_Info = $_POST['subscribeInfo'];
            }
            
        $subscribe = $db -> select("SELECT * FROM subscribe WHERE EMAIL_ID = '$subscribe_Info'");
        $user = $db -> select("SELECT * FROM users WHERE EMAIL_ID = '$subscribe_Info'");
        
        if (count($subscribe) > 0)
        {?> 
            <script>alert("You are already subscribed.");</script>
        <?php    
        }  
        else if (count($user) > 0)
        {?> 
            <script>alert("You are already a registered user.");</script>
        <?php    
        }  
        else  
        {
            $sql = "INSERT INTO `subscribe` (`EMAIL_ID`) VALUES ('$subscribe_Info')"; 
            $result = $db -> query($sql);

            $_POST['subscribeAdd'] = null;?>
            <script>alert("You are now subscribed.");</script>
            <?php  
            
        }          
    
    }
?> 
