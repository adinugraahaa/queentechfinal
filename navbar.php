<nav class="navbar navbar-expand-lg navigations">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">QueenTech</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <?php if ($active_page == 'index') : ?> 
    <form action="" class="form-inline" id="form-navbar">
            <input class="form-control form-control-sm"  type="search" name="search" id="search" placeholder="Cari produk">
            <select class="custom-select custom-select-sm" name="category" id="category">
                                <option selected value="pilih">Pilih kategori</option>
                                <option value="nama_barang" >nama</option>
                                <option value="brand_barang" >brand</option>
                                <option value="baterai_barang" >baterai</option>
                                <option value="memori_barang" >memori</option>
                                <option value="warna_barang" >warna</option>
                                <option value="kamera_depan_barang" >kamera depan</option>
                                <option value="kamera_belakang_barang" >kamera belakang</option>
                                <option value="ram_barang" >ram</option>
                              </select>
            <button class="btn btn-light btn-sm my-2 my-sm-0" id="button-search"><i class="fas fa-search"></i></button>
          </form>
    <?php endif; ?>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto">
        <?php if($_SESSION['Login_Verified'] == true) : ?>
          
          <?php if($active_page != "admins") : ?>
          <li class="nav-item">
            <a href="keranjang.php" class="nav-link">
              <button type="button" class="btn bg-transparent text-white m-0 p-0">
                  <i class="fas fa-shopping-cart"></i> <span class="badge badge-light" id="cart-count"></span>
                </button>
            </a>
          </li>
        <?php endif; ?>
        
        <li class="nav-item">
          <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="profile.php">
                          Profile
                        </a>
                        <a class="dropdown-item" href="logout.php">Logout</a>
                    </div>
                </li>
        </li>
        <?php else: ?>
          <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <li class="nav-item pr-5">
          <a class="nav-link" href="register.php">Register</a>
        </li>
      <?php endif; ?>
        
      </ul>
    </div>
  </div>
</nav>
