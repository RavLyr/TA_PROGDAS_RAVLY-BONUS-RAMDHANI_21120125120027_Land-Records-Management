<?php
/**
 * Buku C Digital - Edit Page
 * Edit Existing Land Record
 */

require_once '../libs/helpers.php';

$repository = new LandRepository(DATA_FILE);

$errors = [];

$id = $_GET['id'] ?? '';
$landData = $repository->findById($id);

if (!$landData) {
    header('Location: index.php?msg=' . urlencode('Data tidak ditemukan!') . '&type=error');
    exit;
}

$land = new Land($landData);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $land = new Land([
        'id' => $id,
        'persil_number' => $_POST['persil_number'] ?? '',
        'owner_name' => $_POST['owner_name'] ?? '',
        'owner_address' => $_POST['owner_address'] ?? '',
        'land_type' => $_POST['land_type'] ?? '',
        'luas_m2' => $_POST['luas_m2'] ?? 0,
        'peta_blok' => $_POST['peta_blok'] ?? '',
        'notes' => $_POST['notes'] ?? '',
        'created_at' => $landData['created_at']
    ]);

    $errors = $land->validate();

    if (empty($errors)) {
        $repository->update($id, $land);
        header('Location: index.php?msg=' . urlencode('Data berhasil diperbarui!') . '&type=success');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Tanah - Buku C Digital</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="page-wrapper">
        <div class="container">
            <header class="page-header">
                <div class="header-content">
                    <div class="header-title">
                        <div>
                            <h1>Edit Data Tanah</h1>
                            <p class="text-gray-600 text-sm">Perbarui informasi data tanah yang sudah ada</p>
                        </div>
                    </div>
                    <a href="index.php" class="btn btn-outline">
                         Kembali
                    </a>
                </div>

                <?php if (!empty($errors)): ?>
                    <div class="alert alert-error">
                        <strong>Terjadi kesalahan:</strong>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </header>

            <div class="card">
                <div class="card-body">
                    <div class="form-container">
                        <form method="POST" action="edit.php?id=<?php echo $id; ?>">
                            <div class="form-group">
                                <label for="persil_number" class="form-label form-label-required">Nomor Persil</label>
                                <input 
                                    type="text" 
                                    id="persil_number" 
                                    name="persil_number"
                                    class="input"
                                    placeholder="Contoh: 123/45"
                                    value="<?php echo htmlspecialchars($land->getPersilNumber()); ?>"
                                    required
                                >
                            </div>

                            <div class="form-group">
                                <label for="owner_name" class="form-label form-label-required">Nama Pemilik</label>
                                <input 
                                    type="text" 
                                    id="owner_name" 
                                    name="owner_name"
                                    class="input"
                                    placeholder="Masukkan nama lengkap pemilik tanah"
                                    value="<?php echo htmlspecialchars($land->getOwnerName()); ?>"
                                    required
                                >
                            </div>

                            <div class="form-group">
                                <label for="owner_address" class="form-label form-label-required">Alamat Pemilik</label>
                                <textarea 
                                    id="owner_address" 
                                    name="owner_address"
                                    class="textarea"
                                    placeholder="Masukkan alamat lengkap pemilik tanah"
                                    required
                                ><?php echo htmlspecialchars($land->getOwnerAddress()); ?></textarea>
                            </div>

                            <div class="form-group">
                                <label for="land_type" class="form-label form-label-required">Jenis Tanah</label>
                                <select id="land_type" name="land_type" class="select" required>
                                    <option value="">-- Pilih Jenis Tanah --</option>
                                    <option value="tanah_kering" <?php echo ($land->getLandType() === 'tanah_kering') ? 'selected' : ''; ?>>
                                        Tanah Kering
                                    </option>
                                    <option value="tanah_basah" <?php echo ($land->getLandType() === 'tanah_basah') ? 'selected' : ''; ?>>
                                        Tanah Basah
                                    </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="luas_m2" class="form-label form-label-required">Luas Tanah (m²)</label>
                                <input 
                                    type="number" 
                                    id="luas_m2" 
                                    name="luas_m2"
                                    class="input"
                                    placeholder="Contoh: 300"
                                    value="<?php echo htmlspecialchars($land->getLuasM2()); ?>"
                                    min="1"
                                    step="0.01"
                                    required
                                >
                            </div>

                            <div class="form-group">
                                <label for="peta_blok" class="form-label form-label-required">Peta Blok</label>
                                <input 
                                    type="text" 
                                    id="peta_blok" 
                                    name="peta_blok"
                                    class="input"
                                    placeholder="Contoh: A01, B02, C03"
                                    value="<?php echo htmlspecialchars($land->getPetaBlok()); ?>"
                                    required
                                >
                            </div>

                            <div class="form-group">
                                <label for="notes" class="form-label">Catatan Tambahan</label>
                                <textarea 
                                    id="notes" 
                                    name="notes"
                                    class="textarea"
                                    placeholder="Masukkan catatan atau informasi tambahan (opsional)"
                                ><?php echo htmlspecialchars($land->getNotes()); ?></textarea>
                            </div>

                            <div class="info-box">
                                <h3>Informasi Sistem</h3>
                                <p><strong>Dibuat:</strong> <?php echo htmlspecialchars($land->getCreatedAt()); ?></p>
                                <p><strong>Terakhir diubah:</strong> <?php echo htmlspecialchars($land->getUpdatedAt()); ?></p>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary btn-lg">
                                     Update Data
                                </button>
                                <a href="detail.php?id=<?php echo $id; ?>" class="btn btn-secondary btn-lg">
                                   Lihat Detail
                                </a>
                                <a href="index.php" class="btn btn-outline btn-lg">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <footer class="footer">
                <p>&copy; 2025 Buku C Digital - Pure PHP Application</p>
            </footer>
        </div>
    </div>
</body>
</html>
