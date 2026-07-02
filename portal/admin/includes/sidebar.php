<?php
$pdo = new PDO('mysql:host=localhost;dbname=db_ems', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch count for pending emergencies
$result = $pdo->prepare("SELECT count(*) as total FROM emergency WHERE status = 'Pending'");
$result->execute();
$row = $result->fetch();
?>
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">
                    <a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                </li>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'agency.php' ? 'active' : '' ?>">
                    <a href="agency.php"><i class="fa fa-user-md"></i> <span>Agency</span></a>
                </li>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'category.php' ? 'active' : '' ?>">
                    <a href="category.php"><i class="fa fa-user-md"></i> <span>Station Types</span></a>
                </li>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'emergency_type.php' ? 'active' : '' ?>">
                    <a href="emergency_type.php"><i class="fa fa-wheelchair"></i> <span>Emergency Types</span></a>
                </li>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'view-emergency.php' ? 'active' : '' ?>">
                    <a href="view-emergency.php">
                        <i class="fa fa-file"></i>
                        <span>View Emergency</span>
                        <span class="badge badge-pill bg-primary float-right"><?php echo $row['total']; ?></span>
                    </a>
                </li>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'report_history.php' ? 'active' : '' ?>">
                    <a href="report_history.php"><i class="fa fa-file-text-o"></i> <span>Reports History</span></a>
                </li>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'information.php' ? 'active' : '' ?>">
                    <a href="information.php"><i class="fa fa-info-circle"></i> <span>Project Information</span></a>
                </li>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'logout.php' ? 'active' : '' ?>">
                    <a href="logout.php"><i class="fa fa-power-off"></i> <span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
