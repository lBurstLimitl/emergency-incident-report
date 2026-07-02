<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">
                    <a href="index.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                </li>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'report-emergency.php' ? 'active' : '' ?>">
                    <a href="report-emergency.php"><i class="fa fa-heartbeat"></i> <span>Report an Emergency</span></a>
                </li>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'report_history.php' ? 'active' : '' ?>">
                    <a href="report_history.php"><i class="fa fa-file-text-o"></i> <span>Previous Reports</span></a>
                </li>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : '' ?>">
                    <a href="profile.php"><i class="fa fa-user"></i> <span>Profile</span></a>
                </li>
                <li class="<?= basename($_SERVER['PHP_SELF']) == 'logout.php' ? 'active' : '' ?>">
                    <a href="logout.php"><i class="fa fa-power-off"></i><span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>

