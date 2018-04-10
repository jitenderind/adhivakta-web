        <div class="sidebar-wrapper">
            <!--Begins Logo start-->
            <div class="logo">
            <img class="w-in-50" style="margin:0 auto !important;display: block;" src="<?php echo base_url(); ?>assets/img/logo.png" alt="Adhivakta E-Diary"">
            </div>
            <!--End Logo start-->

            <!--Begins User Section-->
           <!--  <div class="user">
                <div class="photo">
                    <img src="assets/img/default-avatar.jpg"/>
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#ap_user_nav" class="collapsed">
                            <span><?php echo $_SESSION['user']['first_name']?>
                                <b class="caret"></b>
                            </span>
                    </a>
                    <div class="collapse m-t-10" id="ap_user_nav">
                        <ul class="nav">
                            <li>
                                <a class="profile-dropdown" href="javascript:void(0)">
                                    <span class="sidebar-mini"><i class="icon-user"></i></span>
                                    <span class="sidebar-normal">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a class="profile-dropdown" href="javascript:void(0)">
                                    <span class="sidebar-mini"><i class="icon-settings"></i></span>
                                    <span class="sidebar-normal">Settings</span>
                                </a>
                            </li>
                            <li>
                                <a class="profile-dropdown" href="/logout">
                                    <span class="sidebar-mini"><i class="icon-logout"></i></span>
                                    <span class="sidebar-normal">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
             -->
            <!--End User Section-->

            <ul class="nav">
                <li id="workspace" class="nav-item <?php if($page=="workspace"){echo "active";}?>">
                    <a class="nav-link loader-link" href="/workspace">
                        <i class="material-icons">dashboard</i>
                        <p>
                            My Desk
                        </p>
                    </a>
                </li>

                <li id="causelist" class="nav-item">
                    <a class="nav-link loader-link"  href="/causelist">
                        <i class="material-icons">gavel</i>
                        <p>
                            Causelist
                        </p>
                    </a>
                </li>

                <li id="display-board" class="nav-item">
                    <a class="nav-link loader-link" href="/display-board">
                        <i class="material-icons">picture_in_picture</i>
                        <p>
                            Display Baord
                        </p>
                    </a>
                </li>

                <li id="appeal-alert" class="nav-item">
                    <a class="nav-link loader-link" href="/appeal-alert">
                        <i class="material-icons">announcement</i>
                        <p>
                            Appeal Alert
                        </p>
                    </a>
                </li>

                <li id="tasks" class="nav-item">
                    <a class="nav-link loader-link"  href="/tasks">
                        <i class="material-icons">done_all</i>
                        <p>
                            Tasks
                        </p>
                    </a>
                </li>
                <!-- 
                 <li id="calendar" class="nav-item">
                    <a class="nav-link loader-link"  href="/tasks">
                        <i class="material-icons">today</i>
                        <p>
                            My Calendar
                        </p>
                    </a>
                </li>
                 -->

                <li id="billing" class="nav-item">
                    <a class="nav-link loader-link" href="/invoice">
                        <i class="material-icons">receipt</i>
                        <p>
                            Invoice & Billing
                        </p>
                    </a>
                </li>

                <li id="archives" class="nav-item">
                    <a class="nav-link loader-link" href="/archived">
                        <i class="material-icons">archive</i>
                        <p>
                            Archived Cases
                        </p>
                    </a>
                </li>

                <!-- 
                <li id="staff" class="nav-item">
                    <a class="nav-link loader-link" href="/staff">
                        <i class="material-icons">supervisor_account</i>
                        <p>
                            Staff
                        </p>
                    </a>
                </li>
 -->
                <li id="clients" class="nav-item">
                    <a class="nav-link loader-link" href="/clients">
                        <i class="material-icons">face</i>
                        <p>
                            Clents
                        </p>
                    </a>
                </li>

            </ul>
        </div>
