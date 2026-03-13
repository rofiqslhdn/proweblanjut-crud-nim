<?php
include 'koneksi.php';

/* stok rendah */
$stmt = $pdo->query("SELECT COUNT(*) as total FROM barang WHERE jumlah < 10");
$stok_rendah = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

/* total jenis barang */
$stmt = $pdo->query("SELECT COUNT(*) as total FROM barang");
$total_barang = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

/* total stok semua barang */
$stmt = $pdo->query("SELECT SUM(jumlah) as total FROM barang");
$total_stok = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

/* total nilai inventory */
$stmt = $pdo->query("SELECT SUM(jumlah * harga) as total FROM barang");
$total_nilai = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
?>

<div class="content">
    <div class="row mt-4">

                <!-- STOK RENDAH -->
                <div class="col-md-3 mb-4">
                    <div class="stat-card">

                        <div class="stat-icon" style="background-color:#FF9800;">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>

                        <div class="stat-info">
                            <h3>Stok < 10</h3>
                                    <p class="stat-number"><?php echo $stok_rendah; ?></p>
                        </div>

                    </div>
                </div>

                <!-- TOTAL BARANG -->
                <div class="col-md-3 mb-4">
                    <div class="stat-card">

                        <div class="stat-icon" style="background-color:#2196F3;">
                            <i class="fas fa-box"></i>
                        </div>

                        <div class="stat-info">
                            <h3>Total Barang</h3>
                            <p class="stat-number"><?php echo $total_barang; ?></p>
                        </div>

                    </div>
                </div>

                <!-- TOTAL STOK -->
                <div class="col-md-3 mb-4">
                    <div class="stat-card">

                        <div class="stat-icon" style="background-color:#4CAF50;">
                            <i class="fas fa-warehouse"></i>
                        </div>

                        <div class="stat-info">
                            <h3>Total Stok</h3>
                            <p class="stat-number"><?php echo $total_stok; ?></p>
                        </div>

                    </div>
                </div>

                <!-- TOTAL NILAI INVENTORY -->
                <div class="col-md-3 mb-4">
                    <div class="stat-card">

                        <div class="stat-icon" style="background-color:#9C27B0;">
                            <i class="fas fa-coins"></i>
                        </div>

                        <div class="stat-info">
                            <h3>Nilai Inventory</h3>
                            <p class="stat-number">
                                Rp <?php echo number_format($total_nilai, 0, ',', '.'); ?>
                            </p>
                        </div>

                    </div>
                </div>

            </div>
    </div>
</div>