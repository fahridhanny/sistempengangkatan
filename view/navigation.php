<style type="text/css">
    .navbar-inverse {
        background-color: #426edd;
        border-color: #426edd;
    }
</style>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                
                <?php if($_SESSION['akses'] == "hrd"){?>
                <div class="navbar-header">
                    <a class="navbar-brand" href="../pages/index.php"><font color='white'>Primaloka Djawharha Prakarsa</font></a>
                </div>
                <?php } ?>
                <?php if($_SESSION['akses'] != "hrd"){?>
                <div class="navbar-header">
                    <a class="navbar-brand" href="../pages/index.php"><font color='white'>Primaloka Djawharha Prakarsa</font></a>
                </div>
                <?php } ?>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-right navbar-top-links">
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="color: white;">
                            <i class="fa fa-user fa-fw"></i><font color='white'> <?php echo $_SESSION['nama']; ?></font><b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="../proses/ceklogout.php?sukses=logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation" style="background-color: #343a40;">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li class="sidebar-search">
                                <div class="input-group custom-search-form">
                                    <img alt="Logo Primaloka" src="../logo/Logo_Primaloka2.png">
                                </div>
                                <!-- /input-group -->
                            </li>
                            <li>
                                <a href="index.php" class="active" style="background-color: #343a40; color: #868e96;"><i class="fa fa-fw" aria-hidden="true" title="Copy to use home" style="color: #868e96;">&#xf015</i> Dashboard</a>
                            </li>

                            <?php if($_SESSION['akses'] == "hrd"){?>
                            <li>
                                <a href="data_kar.php" style="background-color: #343a40; color: #868e96;"><i class="fa fa-table fa-fw" style="color: #868e96;"></i>Data Karyawan Kontrak</a>
                            </li>
                            <?php } ?>
                            
                            <?php if($_SESSION['akses'] != "hrd"){?>
                            <li>
                                <a href="data_kar.php" style="background-color: #343a40; color: #868e96;"><i class="fa fa-table fa-fw" style="color: #868e96;"></i>Karyawan Kontrak Diajukan</a>
                            </li>
                            <?php } ?>

                            <?php if($_SESSION['akses'] == "hrd"){?>
                            <li>
                                <a href="pengajuan_kar.php" style="background-color: #343a40; color: #868e96;"><i class="fa fa-files-o fa-fw" style="color: #868e96;"></i>Pengajuan Karyawan Kontrak</a>
                            </li>
                            <?php } ?>

                            <li>
                                <a href="data_penilaian.php" style="background-color: #343a40; color: #868e96;"><i class="fa fa-fw" aria-hidden="true" title="Copy to use plus">&#xf067</i>Penilaian</a>
                            </li>

                            <!-- <li>
                                <a href="data_jabatan.php"><i class="fa fa-fw" aria-hidden="true" title="Copy to use black-tie">&#xf27e</i>Jabatan</a>
                            </li> -->
                            <!-- <li>
                                <a href="data_kriteria.php"><i class="fa fa-fw" aria-hidden="true" title="Copy to use black-tie">&#xf27e</i>Kriteria</a>
                            </li> -->

                            <li>
                                <a href="profile.php" style="background-color: #343a40; color: #868e96;"><i class="fa fa-user fa-fw" aria-hidden="true" title="Copy to use black-tie" style="color: #868e96;"></i>Profile</a>
                            </li>
                            <!-- <li>
                                <a href="tables.php"><i class="fa fa-table fa-fw"></i> Tables</a>
                            </li>
                            <li>
                                <a href="forms.php"><i class="fa fa-edit fa-fw"></i> Forms</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="panels-wells.php">Panels and Wells</a>
                                    </li>
                                    <li>
                                        <a href="buttons.php">Buttons</a>
                                    </li>
                                    <li>
                                        <a href="notifications.php">Notifications</a>
                                    </li>
                                    <li>
                                        <a href="icons.php"> Icons</a>
                                    </li>
                                </ul>
                            
                            </li>
                            
                            <li>
                                <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="login.php">Login Page</a>
                                    </li>
                                </ul>
                               
                            </li> -->
                        </ul>
                    </div>
                </div>
            </nav>