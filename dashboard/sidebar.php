<div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
                        <li class="active">
                            <a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
                        <?php if ($username == "admin"): ?>
                            <li>
                                <a href="departments.php"><i class="fa fa-hospital-o"></i> <span>Departments</span></a>
                            </li>
    						<li>
                                <a href="doctors.php"><i class="fa fa-user-md"></i> <span>Doctors</span></a>
                            </li>
                            <li>
                                <a href="schedule.php"><i class="fa fa-calendar-check-o"></i> <span>Doctor Schedule</span></a>
                            </li>
                            <li>
                                <a href="patients.php"><i class="fa fa-wheelchair"></i> <span>Patients</span></a>
                            </li>
                        <?php endif ?>
                        <li>
                            <a href="appointments.php"><i class="fa fa-calendar"></i> <span>Appointments</span></a>
                        </li>
                        <li>
                            <a href="reports.php"><i class="fa fa-flag-o"></i> <span>Reports</span></a>
                        </li>
                        <!-- <li>
                            <a href="chat.html"><i class="fa fa-comments"></i> <span>Chat</span> <span class="badge badge-pill bg-primary float-right">5</span></a>
                        </li> -->
						<!-- <li class="submenu">
							<a href="#"><i class="fa fa-flag-o"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a href="expense-reports.html"> Expense Report </a></li>
								<li><a href="invoice-reports.html"> Invoice Report </a></li>
							</ul>
						</li> -->
                    </ul>
                </div>
            </div>
        </div>