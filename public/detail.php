<?php
/**
 * Buku C Digital - Detail Page
 * View Detailed Land Record Information
 */

require_once '../libs/helpers.php';

$repository = new LandRepository(DATA_FILE);

// Get ID from URL
$id = $_GET['id'] ?? '';

$landData = $repository->findById($id);

if (!$landData) {
    header('Location: index.php?msg=' . urlencode('Data tidak ditemukan!') . '&type=error');
    exit;
}

$land = new Land($landData);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Data Tanah - Buku C Digital</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="page-wrapper">
        <div class="container">
            <!-- Page Header -->
            <header class="page-header">
                <div class="header-content">
                    <div class="header-title">
                        <div>
                            <h1>Detail Data Tanah</h1>
                            <p class="text-gray-600 text-sm">Informasi lengkap mengenai data tanah ini</p>
                        </div>
                    </div>
                </div>
                
                <div class="btn-group mb-4">
                    <a href="index.php" class="btn btn-outline">
                         Kembali
                    </a>
                    <a href="edit.php?id=<?php echo $id; ?>" class="btn btn-warning">
                         Edit Data
                    </a>
                    <a href="delete.php?id=<?php echo $id; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                         Hapus Data
                    </a>
                </div>
            </header>

            <!-- Detail Card -->
            <div class="detail-card mb-6">
                <table class="detail-table">
                    <tbody>
                        <tr>
                            <th class="text-left">ID Unik</th>
                            <td><code style="font-size: 0.8125rem; color: #6b7280;"><?php echo htmlspecialchars($land->getId()); ?></code></td>
                        </tr>
                        <tr>
                            <th>Nomor Persil</th>
                            <td><span class="detail-value-highlight"><?php echo htmlspecialchars($land->getPersilNumber()); ?></span></td>
                        </tr>
                        <tr>
                            <th>Nama Pemilik</th>
                            <td><?php echo htmlspecialchars($land->getOwnerName()); ?></td>
                        </tr>
                        <tr>
                            <th>Alamat Pemilik</th>
                            <td><?php echo nl2br(htmlspecialchars($land->getOwnerAddress())); ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Tanah</th>
                            <td>
                                <span class="badge badge-info">
                                    <?php echo htmlspecialchars($land->getLandType()); ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Luas Tanah</th>
                            <td><span class="detail-value-highlight"><?php echo number_format($land->getLuasM2(), 2, ',', '.'); ?> m²</span></td>
                        </tr>
                        <tr>
                            <th>Peta Blok</th>
                            <td><span class="badge badge-success"><?php echo htmlspecialchars($land->getPetaBlok()); ?></span></td>
                        </tr>
                        <tr>
                            <th>Catatan</th>
                            <td>
                                <?php 
                                if (!empty($land->getNotes())) {
                                    echo nl2br(htmlspecialchars($land->getNotes()));
                                } else {
                                    echo '<em style="color: #9ca3af;">Tidak ada catatan</em>';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Dibuat</th>
                            <td><?php echo htmlspecialchars($land->getCreatedAt()); ?></td>
                        </tr>
                        <tr>
                            <th>Terakhir Diubah</th>
                            <td><?php echo htmlspecialchars($land->getUpdatedAt()); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Footer -->
            <footer class="footer">
                <p>&copy; 2025 Buku C Digital - Pure PHP Application</p>
            </footer>
        </div>
    </div>
</body>
</html>
