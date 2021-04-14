<?php 
session_start();
$active_page ="admins";
include('./includes/class-autoload.inc.php');
require_once('./templates/header.php');
require_once('navbar.php');

if ($_SESSION['Login_Verified'] == false) {
      header('location: admin');
}
$memberss = new Member();
$id_member  = $_SESSION['id_member'];

$members = $memberss->getMemberDashboard();

$checkadmin = $memberss->getProfile($id_member);

if ($checkadmin['admin'] == "0") {
      header('location: index.php');

    }
require_once('admin_sidebar.php');  
 ?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <table class="table table-hover">
                                    <thead>
                                        <tr class="font-14">
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Telp</th>
                                            <th>Username</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if($members) : ?>
                                        <?php foreach ($members as $member) : ?>
                                            <tr class="text">
                                            <td scope="row"><?= $member['nama']?></td>
                                            <td><?= $member['email']?></td>
                                            <td><?= $member['telp']?></td>
                                            <td><?= $member['alamat']?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                        <?php else : ?>
                                            <p class="mx-auto mt-5">post is empty</p >
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

<?php 
require_once('./templates/footer.php');

 ?>