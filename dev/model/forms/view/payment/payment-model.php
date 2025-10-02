    

<section id="payment-history">
    <br><br>
    <!-- Sign in  Form -->
    <div class="container">
        <div class="row" style="
                                font-size: 13px;
                                font-family: Roboto, sans-serif;
                                font-weight: bold;
                                text-decoration: none;
                                color: blue;
                                text-align:left;"> 
            <div class="col-md-2">
                <label>LEVEL</label>
                <select id='cbo-acadlvl' name='cbo-acadlvl' class='form-control' style='text-align:left;font-size:12px;' required>
                </select>
            </div>

            <div class="col-md-2">
                <label>YEAR</label>
                <select id='cbo-acadyr' name='cbo-acadyr' class='form-control' style='text-align:left;font-size:12px;' required>
                </select>
            </div>

            <div class="col-md-2">
                <label>PERIOD</label>
                <select id='cbo-acadprd' name='cbo-acadprd' class='form-control' style='text-align:left;font-size:12px;' required>
                </select>
            </div>

            <div class="col-md-5">
                <label>COURSE</label>
                <select id='cbo-acadcrse' name='cbo-acadcrse' class='form-control' style='text-align:left;font-size:12px;' required>
                </select>

            </div>
        </div>
        <br><hr><br>

        <div style="align: center;padding:0;margin:0;" class="container-fluid">
                                <!-- <hr style="margin:0; padding: 0;border-color: lightgray;"> -->
            <p style="  text-decoration: underline;
                        text-align: center;
                        font: italic 22px cambria, serif; 
                        width: 100%;
                        padding-right: 70px;
                        padding-top: 2px;
                        padding-bottom: 5px; 
                        margin: 0;
                        margin-bottom: 0;
                        color: black;
                        background-color: transparent;
                        background-image:linear-gradient(to Right,
                                             rgba(10,50,150,0.9) 1%,
                                             rgba(255,255,255,0.9) 90%);">  PREVIOUS PAYMENT TRANSACTION
            </p>
        </div><br><hr>

    <div class="container" id="table-list">
       <div id="prereg-data"></div>
        
       <table class='table table-hover'>
            <tbody id='tbody-payment-header'>
                <tr>
                    <td style='text-align:LEFT;' width='350px'><label type='label' class='text-primary'>BACHELOR OF SCIENCE IN NURSING</label></td> 
                    <td style='text-align:LEFT;'><label type='label' class='text-primary'>1ST SEM(2022-2023)</label></td>
                    <td style='text-align:center;'><label></label></td>
                    <td style='text-align:RIGHT;'><label type='label' class='text-danger'><b> </b></label></td>
                </tr>
            </tbody>
        </table>
       
       <table id='regtable' class='table table-hover table-responsive table-bordered'>
          <thead class='table table-primary'>
              <tr>
                    <th scope='col' style='text-align:center;' colspan="7"><I>PAYMENT HISTORY</I></th>
             </tr>

             <tr>
                    <td scope='col' style='text-align:center;' >#</td>
                    <th scope='col' style='text-align:center;' >DATE</th>
                    <th scope='col' style='text-align:center;' >TRANSACTION NUMBER</th>
                    <th scope='col' style='text-align:center;' >OR NUMBER</th>
                    <th scope='col' style='text-align:center;' >AMOUNT</th>

             </tr>             
          </thead>

          <tbody id='tbody-payment-history'>
                <tr > 
                    <td colspan = '5' ><label type='label' class='text-danger'><b> NO RECORD FOUND </b></label></td>
                </tr>
          </tbody>

       </table>
       

       </div>

    </div>

</section>
<?php 
    echo '<script src="../../js/custom/payment-script-alt.js"></script>';
?>