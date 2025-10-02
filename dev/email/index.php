<!DOCTYPE html>
<html>
<head>
    <title>Contact Form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <form id="contact-form">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        
        <input type="button" id="send-email" value="Send Email">
    </form>
    
    <div id="response"></div>

    <script>
        $(document).ready(function() {
            $("#send-email").click(function() {
                var email = $('#email').val();

                $.ajax({
                    type: "POST",
                    url: "sendEmail.php",
                    data: {
                        email : email
                    },
                    success: function(response) {
                        $("#response").html(response);
                    }
                });
            });
        });
    </script>
</body>
</html>
