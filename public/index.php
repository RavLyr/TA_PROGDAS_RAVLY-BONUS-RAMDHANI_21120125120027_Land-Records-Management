<?php
/**
 * Buku C Digital - Index Page
 * List and Search Land Records
 */

require_once '../libs/helpers.php';

$repository = new LandRepository(DATA_FILE);

$searchQuery = $_GET['q'] ?? '';

if (!empty($searchQuery)) {
    $lands = array_map(fn($data) => new Land($data), $repository->findAll());
} else {
    $lands = array_map(fn($data) => new Land($data), $repository->findAll());
}

$message = $_GET['msg'] ?? '';
$messageType = $_GET['type'] ?? 'success';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buku C Digital - Data Tanah</title>
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
                            <h1>Buku C Digital</h1>
                            <p class="text-gray-600 text-sm">Sistem Informasi Pertanahan Digital</p>
                        </div>
                    </div>
                    <a href="create.php" class="btn btn-primary">
                       Tambah Data Baru
                    </a>
                </div>

                <?php if (!empty($message)): ?>
                    <div class="alert alert-<?php echo $messageType; ?>">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
            </header>

            <section class="search-section">
                <form method="GET" action="index.php" class="search-form">
                    <input 
                        type="text" 
                        name="q" 
                        class="input search-input"
                        placeholder="Cari berdasarkan nomor persil, nama pemilik, atau peta blok..." 
                        value="<?php echo htmlspecialchars($searchQuery); ?>"
                    >
                    <button type="submit" class="btn btn-secondary">
                       Cari
                    </button>
                    <?php if (!empty($searchQuery)): ?>
                        <a href="index.php" class="btn btn-outline">
                            <span>✖</span> Reset
                        </a>
                    <?php endif; ?>
                </form>
            </section>

            <?php if (empty($lands)): ?>
                <div class="card">
                    <div class="empty-state">
                        <div class="empty-state-icon">📭</div>
                        <h2>Tidak ada data ditemukan</h2>
                        <p>
                            <?php if (!empty($searchQuery)): ?>
                                Pencarian "<strong><?php echo htmlspecialchars($searchQuery); ?></strong>" tidak menemukan hasil.
                            <?php else: ?>
                                Belum ada data tanah. Silakan tambah data baru untuk memulai.
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            <?php else: ?>
                <div class="table-container">
                    <div class="table-stats">
                        <strong>Total Data:</strong> <?php echo count($lands); ?> data tanah
                    </div>
                    <div class="table-wrapper">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nomor Persil</th>
                                    <th>Nama Pemilik</th>
                                    <th>Jenis Tanah</th>
                                    <th>Luas (m²)</th>
                                    <th>Peta Blok</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($lands as $land): ?>
                                <tr>
                                    <td class="text-gray-600"><?php echo $no++; ?></td>
                                    <td class="font-semibold text-gray-900"><?php echo htmlspecialchars($land->getPersilNumber()); ?></td>
                                    <td class=""><?php echo htmlspecialchars($land->getOwnerName()); ?></td>
                                    <td>
                                        <span class="badge badge-info">
                                            <?php echo htmlspecialchars($land->getLandType()); ?>
                                        </span>
                                    </td>
                                    <td class="font-medium"><?php echo number_format($land->getLuasM2(), 0, ',', '.'); ?></td>
                                    <td><span class="badge badge-success"><?php echo htmlspecialchars($land->getPetaBlok()); ?></span></td>
                                    <td>
                                        <div class="table-actions">
                                            <a href="detail.php?id=<?php echo $land->getId(); ?>" class="btn btn-info btn-sm">
                                                 Detail
                                            </a>
                                            <a href="edit.php?id=<?php echo $land->getId(); ?>" class="btn btn-warning btn-sm">
                                                Edit
                                            </a>
                                            <a href="delete.php?id=<?php echo $land->getId(); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            <?php endif; ?>

            <footer class="footer">
                <p>&copy; 2025 Buku C Digital - Pure PHP Application</p>
            </footer>
        </div>
    </div>
</body>
</html>
