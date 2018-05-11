<div id="all">    
    <div id="content">
        <div class="container">    
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li><a href="./home.php?page=landing">Home</a>
                    </li>
                    <li><?php echo $_SESSION['parameterName']?></li>
                </ul>    
            </div>
        </div>
    </div>
</div>

<?php
    include('content/fusioncharts.php'); 
?>

<!DOCTYPE html>
<html>
 
    <head>
      <script type='text/javascript' src='js/fusioncharts.js'></script>
      <script type='text/javascript' src='js/fusioncharts.charts.js'></script>
    </head>
 
    <body> 
    
        <?php
        
            $config = parse_ini_file('config.ini');

            $dbhandle = new mysqli($config['servername'],$config['username'],$config['password'],$config['dbname']);
 
            if ($dbhandle -> connect_error) {
                exit('There was an error with your connection: '.$dbhandle -> connect_error);
            }
                            
            $strQuery1 = "select count(od.ORDER_ID) as COUNT,pm.METHOD_NAME as METH_NAME from ORDER_DETAIL od, PAYMENT_METHOD pm where od.PAYMENT_METHOD_ID=pm.METHOD_ID group by pm.METHOD_ID;";
            $strQuery2 = "select count(od.ORDER_ID) as COUNT,st.TYPE_NAME as SHIP_NAME from ORDER_DETAIL od, SHIP_TYPE st where od.SHIP_TYPE_ID=st.TYPE_ID group by st.TYPE_ID;";
            $strQuery3 = "select 'USERS' as TYPE, count(EMAIL_ID) AS COUNT from USERS UNION select 'SUBSCRIBERS' as TYPE, count(EMAIL_ID) AS COUNT from SUBSCRIBE;";
             
             
            
            $result1 = $dbhandle->query($strQuery1) or exit('Error code ({$dbhandle->errno}): {$dbhandle->error}');
            $result2 = $dbhandle->query($strQuery2) or exit('Error code ({$dbhandle->errno}): {$dbhandle->error}');
            $result3 = $dbhandle->query($strQuery3) or exit('Error code ({$dbhandle->errno}): {$dbhandle->error}');
            
            if ($result1) 
            {
             
              $arrData = array
                (
                'chart' => array
                    (
                    'theme' => 'fint',
                    'caption' => 'Payment Statistics',
                    'captionFontSize' => '24',
                    'paletteColors' => '#A2A5FC, #41CBE3, #EEDA54, #BB423F #,F35685',
                    'baseFont' => 'Quicksand, sans-serif'
                    )
                );
             
              $arrData['data'] = array();
             
              while ($row = mysqli_fetch_array($result1)) 
              {
                array_push  ($arrData['data'], 
                            array   (
                                    'label' => $row['METH_NAME'],
                                    'value' => $row['COUNT']
                                    )
                            );
              }
             
              $jsonEncodedData1 = json_encode($arrData);
         
            }
            

            if ($result2) 
            {
             
              $arrData = array
                (
                'chart' => array
                    (
                    'theme' => 'fint',
                    'caption' => 'Shipping Statistics',
                    'captionFontSize' => '24',
                    'paletteColors' => '#A2A5FC, #41CBE3, #EEDA54, #BB423F #,F35685',
                    'baseFont' => 'Quicksand, sans-serif'
                    )
                );
             
              $arrData['data'] = array();
             
              while ($row = mysqli_fetch_array($result2)) 
              {
                array_push  ($arrData['data'], 
                            array   (
                                    'label' => $row['SHIP_NAME'],
                                    'value' => $row['COUNT']
                                    )
                            );
              }
             
              $jsonEncodedData2 = json_encode($arrData);
         
            }    
            
            
            if ($result3) 
            {
             
              $arrData = array
                (
                'chart' => array
                    (
                    'theme' => 'fint',
                    'caption' => 'User Statistics',
                    'captionFontSize' => '24',
                    'paletteColors' => '#A2A5FC, #41CBE3, #EEDA54, #BB423F #,F35685',
                    'baseFont' => 'Quicksand, sans-serif'
                    )
                );
             
              $arrData['data'] = array();
             
              while ($row = mysqli_fetch_array($result3)) 
              {
                array_push  ($arrData['data'], 
                            array   (
                                    'label' => $row['TYPE'],
                                    'value' => $row['COUNT']
                                    )
                            );
              }
             
              $jsonEncodedData3 = json_encode($arrData);
         
            }                  
            
    
        $var = new FusionCharts('type of chart', 
                        'unique chart id', 
                        'width of chart', 
                        'height of chart', 
                        'div id to render the chart', 
                        'type of data', 
                        'actual data');
        				

        $doughnutChart1 = new FusionCharts('doughnut2d', 'browserShareChart1' , '100%', '450', 'doughnut-chart1', 'json', $jsonEncodedData1);
        $doughnutChart2 = new FusionCharts('doughnut2d', 'browserShareChart2' , '100%', '450', 'doughnut-chart2', 'json', $jsonEncodedData2);
        $doughnutChart3 = new FusionCharts('doughnut2d', 'browserShareChart3' , '100%', '450', 'doughnut-chart3', 'json', $jsonEncodedData3);
        
             
        $doughnutChart1->render(); 
        $doughnutChart2->render(); 
        $doughnutChart3->render();
        
        
        ?>
        
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="col-sm-4">
                <div id="doughnut-chart1">Fusion Charts will render here</div>
            </div>
            <div class="col-sm-4">
                <div id="doughnut-chart2">Fusion Charts will render here</div>
            </div>   
            <div class="col-sm-4">
                <div id="doughnut-chart3">Fusion Charts will render here</div>
            </div>             
        </div>        
    </div>
</div>  
    &nbsp;
        
   
        
    </body>
</html>
