<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: ../index.php");
    exit();
}
include('../includes/head.php');
?>
<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <?php
			include('../includes/header.php');
            include('../includes/sidebar.php');
		?>
        <?php
		include('../includes/footer.php');
		?>
    </div>
    <?php
        include('../includes/scripts.php');
    ?>
</body>
</html>