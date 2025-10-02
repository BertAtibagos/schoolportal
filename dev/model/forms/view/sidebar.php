<!-- Remix Icons -->
<link href="lib/remixicon/fonts/remixicon.css" rel="stylesheet">
<!-- Template CSS -->
<link rel="stylesheet" href="assets/css/style.min.css">
<!-- jQuery -->
<script src="lib/jquery/jquery.min.js"></script>
<!-- Boiotstrap -->
<script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Feather Icons -->
<script src="lib/feathericons/feather.min.js"></script>
<!-- perfect-scrollbar plugin -->
<script src="lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
<meta name="generator" content="Hugo 0.84.0">
<title>FCPC School Portal</title>
<link rel="icon" href="../../../images/fcpc_logo.ico">

<link href="../../../css/bootstrap/bootstrap-5.2.2/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" />
<link href="../....//css/bootstrap/bootstrap-5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="../../../css/custom/grading-scale-style.css">
<link rel="stylesheet" href="../../../css/custom/student-grades-style.css">

<link href="../../../css/custom/sidebars.css" rel="stylesheet">
<link href="../../../css/custom/masterpage-style.css" rel="stylesheet">

<!-- <script src="../../js/custom/jquery-3.6.1.slim.min.js"></script>
 -->
<script src="../../../js/jquery/jquery-3.6.0.min.js"></script>

<script src= "../../../js/custom/student-grades-js.js"></script>
<script src="../../../js/custom/sidebars.js"></script>

<script src="../../../css/bootstrap/bootstrap-5.2.2/dist/js/bootstrap.bundle.min.js"></script>


   <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Start Bootstrap
                    </a>
                </li>
                <li>
                    <a href="#">Dashboard</a>
                </li>
                <li>
                    <a href="#">Shortcuts</a>
                </li>
                <li>
                    <a href="#">Overview</a>
                </li>
                <li>
                    <a href="#">Events</a>
                </li>
                <li>
                    <a href="#">About</a>
                </li>
                <li>
                    <a href="#">Services</a>
                </li>
                <li>
                    <a href="#">Contact</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1>Simple Sidebar</h1>
                        <p>This template has a responsive menu toggling system. The menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will appear/disappear. On small screens, the page content will be pushed off canvas.</p>
                        <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>.</p>
                        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
     <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>