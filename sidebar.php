<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon rotate-n-15">
        <i><?php
        if($_SESSION['akses'] == '1'){
            echo "KI";
        }else if($_SESSION['akses'] == '2'){
            echo "KMP";
        }else if($_SESSION['akses'] == '3'){
            echo "KAMI";
        }else if($_SESSION['akses'] == '4'){
            echo "KI";
        }else if($_SESSION['akses'] == '5'){
            echo "AP";
        }
        
        ?></i>
    </div>
    <div class="sidebar-brand-text mx-3"><?php echo getPerusahaan( $_SESSION['akses'],$connect); ?></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="index.php">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>




<!-- Nav Item - Pages Collapse Menu -->
<?php
$getKategori = "SELECT * FROM kategori_menu WHERE status_category = '1'";
$runKategori = mysqli_query($connect, $getKategori);
$collapse = 1;
while($output = mysqli_fetch_array($runKategori)){
    $getAccessMenu = "SELECT * from access_menu inner join menu on access_menu.fk_id_menu = menu.id_menu WHERE fk_id_category ='".$output['id_category']."' AND fk_id_al = '".$_SESSION['akses']."' AND status_access_menu = '1' AND status_menu = '1'";
    $runGetAccessMenu = mysqli_query($connect,$getAccessMenu);
    $count = mysqli_num_rows($runGetAccessMenu);
    
    if($count > 0){
        echo "<li class='nav-item'>
        <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#collapse".$collapse."'
            aria-expanded='true' aria-controls='collapseTwo'>
            <i class=''></i>
            <span>".$output['nama_category']."</span>
        </a>";
        echo "<div id='collapse".$collapse."' class='collapse' aria-labelledby='headingTwo' data-parent='#accordionSidebar'>
        <div class='bg-white py-2 collapse-inner rounded'>";
        while($outputMenu = mysqli_fetch_array($runGetAccessMenu)){
            echo "  <a class='collapse-item' href='".$outputMenu['alamat_menu']."'>".$outputMenu['nama_menu']."</a>
                    ";
        }
        echo "</div>
        </div>
    </li>";
    $collapse +=1;
    }
}
?>





<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!-- Sidebar Message -->


</ul>
<!-- End of Sidebar -->