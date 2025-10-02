

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>      

<section id='online-payment'>
	
    <div class="container">
        <br>
        <h1 align="center" style="font-size: 40px; font-family: 'Times New Roman', Times, serif;color: blue;">
            
            Online Payment 

        </h1>
        <div class="statusMsg" align="center" style="font-size: 30px;font-style: normal;"></div>
    </div>

        <form>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="transaction" class="form-label">Transaction Type *</label>
                    <select id="transaction" name="transaction" class="form-control" >
                        <option value=""> -- SELECT PAYMENT METHOD -- </option>
                        <option value="online">Online Bank Transfer</option>
                        <option value="onsite">Onsite Bank (Over the Counter)</option>
                        <option HIDDEN value="credit-card">Credit Card</option> <!-- hidden -->
                        <option value="g-cash">GCash</option>
                        <option HIDDEN value="student-inquiry">To know your balance (Student Inquiry)</option> <!-- hidden -->
                    </select>
                </div>

                <div class="col-md-6 amount bank">
                    <label class="form-label" for="amount">Amount Paid *</label>
                    <input type="number" id="amount" name="amount" placeholder="Amount Paid"
                        class="form-control bank amount" maxlength="40" >
                </div>

            </div>
            <div class="row mb-3">
                <div class="col-md-4 bank" id="bank-option" style="display: none">

                    <label for="bank-name" class="form-label">Bank Name *</label>
                    <select id="bank" name="bank" class="form-control bank">
                        <option value=""> -- SELECT BANK NAME -- </option>
                        <option value="bdo">BDO</option>
                        <option value="robinsons-bank">Robinsons Bank</option>
                        <option value="land-bank">Landbank</option>
                        <option value="g-cash">GCash</option>
                    </select>

                </div>
                <div class="col-md-4 bank">
                    <label class="form-label" for="referenceNumber">Transaction Reference Number *</label>
                    <input type="text" id="referenceNumber" name="referenceNumber"
                        placeholder="Transaction Reference Number" class="form-control bank" maxlength="40">
                </div>
                <div class="col-md-4 bank">
                    <label class="form-label" for="date">Transaction date *</label>
                    <input type="date" id="date" name="date" placeholder="Transaction date" class="form-control bank">
                </div>
            </div>
            <div class="col-md- bank" id="bank-receipts" style="display: none">
                <div class="col-md-8">
                    <label class="form-label" for="receipt">Image/Scanned/Screenshot of Transaction Receipt *</label>
                    <input
                        accept="image/jpeg,image/jpg,image/png,application/pdf,application/msword,application/vnd.ms-excel"
                        type="file" id="file" name="file" placeholder="Transaction date" class="form-control">
                </div>
            </div><br><hr><br>

            <div align="center">
                <input type="button" id="submit" name="submit" class="btn btn-block btn-primary" style = "font-size: 30;" value="Submit"/>

            </div>

        </form><br><hr><br>

        <div style="align: center;padding:0;margin:0;" class="container-fluid">
            <p style="text-decoration: underline;
                    text-align: center;
                    font: italic 30px cambria, serif; 
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
    </div><br>
    
        <div class="container" id="transaction-history">

            <?php

                $createDropDown      = "<table id='regtable' class='table table-bordered'>";
                $createDropDown     .= "    <thead class='table table-primary'>";
                $createDropDown     .= "        <tr>";
                $createDropDown     .= "            <th scope='col' style='text-align:center;'>#</th>";
                $createDropDown     .= "            <th scope='col' style='text-align:center;'>Transaction Type</th>";
                $createDropDown     .= "            <th scope='col' style='text-align:center;'>Amount Paid</th>";
                $createDropDown     .= "            <th scope='col' style='text-align:center;'>Bank Name</th>";
                $createDropDown     .= "            <th scope='col' style='text-align:center;'>Transaction Reference Number</th>";
                $createDropDown     .= "            <th scope='col' style='text-align:center;'>Transaction Date</th>";
                $createDropDown     .= "            <th scope='col' style='text-align:center;'>Receipt</th>";
                $createDropDown     .= "        </tr>";
                $createDropDown     .= "    </thead>";

            

                $qry = "    SELECT * 
                            FROM `schoolonlinepayment`
                        ";
                $rsreg = $dbConn->query($qry);
                $fetchDatareg = $rsreg->fetch_all(MYSQLI_ASSOC);
                $rsreg->close();

                $createDropDown     .= "    <tbody>";
                $count = 1;

                foreach($fetchDatareg as $regitem)
                {
                    $createDropDown  .= "<tr>";
                    $createDropDown  .= "   <td style='text-align:center;'><label type='label'>". $count++ ."</label></td>";
                    $createDropDown  .= "   <td style='text-align:center;'><label type='label'>". $regitem['schlpayment_transtype'] ."</label></td>";
                    $createDropDown  .= "   <td style='text-align:center;'><label type='label'>". $regitem['schlpayment_amountpaid'] ."</label></td>";
                    $createDropDown  .= "   <td style='text-align:center;'><label type='label'>". $regitem['schlpayment_bankname'] ."</label></td>";
                    $createDropDown  .= "   <td style='text-align:center;'><label type='label'>". $regitem['schlpayment_transno'] ."</label></td>";
                    $createDropDown  .= "   <td style='text-align:center;'><label type='label'>". $regitem['schlpayment_transdate'] ."</label></td>";
                    $createDropDown  .= "   <td style='text-align:center;'><label type='label'>". $regitem['schlpayment_receipt'] ."</label></td>";

                    //$createDropDown  .=   "<td style='text-align:center;'><label type='label'><button type='button' class='btn btn-success' value = ".$regitem['SUBJ_ID']."> View Class List </button></label></td>";

                    $createDropDown  .= "</tr>";

                }
                $createDropDown     .= "    </tbody>";
                $createDropDown     .= "</table>";

                echo $createDropDown;
            ?>

        </div>

    <script>
        $(document).ready(function(){
            $('#transaction').change(function(){
                $("#bank-option").show();
                $("#bank-receipts").show();
            });

            $("#submit").click(function(){

                var files = $('#file')[0].files;

                if(files.length > 0)
                {   
                    $('.statusMsg').html(''); // to clear 

                    var fd = new FormData();
                    fd.append('file',files[0]);

                    alert(fd);

                    $.ajax({
                        url: '../../model/class/online-payment/onlinepayment-fileupload.php',
                        type: 'post',
                        data: fd,
                        dataType:'json',
                        contentType: false,
                        cache: false,
                        processData:false,

                        success: function(response)
                        {
                            $('.statusMsg').html('');
                            if(response.status == 1)
                            {
                                // $('#fupForm')[0].reset();
                                $('.statusMsg').html('<p class="alert alert-success">'+response.message+'</p>');
                            }
                            else
                            {
                                $('.statusMsg').html('<p class="alert alert-danger">'+response.message+'</p>');
                            }
                            // $('#transaction-history').show();
                            // $('#transaction-history').html(response);

                        },
                    });

                }
                else
                {
                    $('.statusMsg').html('');
                    $('.statusMsg').html('<p class="alert alert-danger"> NO FILE SELECTED </p>');
                }



                var transaction         = $('#transaction').val();
                var amount              = $('#amount').val();
                var bank                = $('#bank').val();
                var referenceNumber     = $('#referenceNumber').val();
                var date                = $('#date').val();
                var file                = $('input[type=file]').val().split('\\').pop();
                alert( transaction + ', ' + amount + ', ' + bank + ', ' + referenceNumber + ', ' + date + ', ' + file);


                $.ajax({
                    type: 'POST',
                    url: "../../model/class/online-payment/onlinepayment-class.php",
                    data:
                    {
                        transaction     : transaction,
                        amount          : amount,
                        bank            : bank,
                        referenceNumber : referenceNumber,
                        date            : date,
                        file            : file
                    },
                    success: function (data)
                    {
                        $("#transaction-history").show();
                        $("#transaction-history").html(data);
                    }
                });
            });

            $("#file").change(function() 
            {
                var file = this.files[0];
                var fileType = file.type;
                var match = ['application/pdf', 'application/msword', 'application/vnd.ms-office', 'image/jpeg', 'image/png', 'image/jpg'];
                if(!((fileType == match[0]) || (fileType == match[1]) || (fileType == match[2]) || (fileType == match[3]) || (fileType == match[4]) || (fileType == match[5]))){
                    alert('Sorry, only PDF, DOC, JPG, JPEG, & PNG files are allowed to upload.');
                    $("#file").val('');
                    return false;
                }
            });

        });
    </script>
</section>