<?php

/**
 * Buku C Digital - Create Page
 * Add New Land Record
 */

require_once '../libs/helpers.php';

$repository = new LandRepository(DATA_FILE);

$errors = [];
$success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $land = new Land([
        'persil_number' => $_POST['persil_number'] ?? '',
        'owner_name' => $_POST['owner_name'] ?? '',
        'owner_address' => $_POST['owner_address'] ?? '',
        'land_type' => $_POST['land_type'] ?? '',
        'luas_m2' => $_POST['luas_m2'] ?? 0,
        'peta_blok' => $_POST['peta_blok'] ?? '',
        'notes' => $_POST['notes'] ?? ''
    ]);

    $errors = $land->validate();

    if (empty($errors)) {
        $repository->save($land);
        header('Location: index.php?msg=' . urlencode('Data berhasil ditambahkan!') . '&type=success');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Tanah - Buku C Digital</title>
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
                            <h1>Tambah Data Tanah Baru</h1>
                            <p class="text-gray-600 text-sm">Lengkapi formulir di bawah untuk menambah data tanah</p>
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
                        <form method="POST" action="create.php">
                            <div class="form-group">
                                <label for="persil_number" class="form-label form-label-required">Nomor Persil</label>
                                <input
                                    type="text"
                                    id="persil_number"
                                    name="persil_number"
                                    class="input"
                                    placeholder="Contoh: 123/45"
                                    value="<?php echo isset($_POST['persil_number']) ? htmlspecialchars($_POST['persil_number']) : ''; ?>"
                                    required>
                                <p class="form-hint">Format nomor persil sesuai dengan dokumen</p>
                            </div>

                            <div class="form-group">
                                <label for="owner_name" class="form-label form-label-required">Nama Pemilik</label>
                                <input
                                    type="text"
                                    id="owner_name"
                                    name="owner_name"
                                    class="input"
                                    placeholder="Masukkan nama lengkap pemilik tanah"
                                    value="<?php echo isset($_POST['owner_name']) ? htmlspecialchars($_POST['owner_name']) : ''; ?>"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="owner_address" class="form-label form-label-required">Alamat Pemilik</label>
                                <textarea
                                    id="owner_address"
                                    name="owner_address"
                                    class="textarea"
                                    placeholder="Masukkan alamat lengkap pemilik tanah"
                                    required><?php echo isset($_POST['owner_address']) ? htmlspecialchars($_POST['owner_address']) : ''; ?></textarea>
                                <p class="form-hint">Tuliskan alamat lengkap termasuk RT/RW, kelurahan, dan kecamatan</p>
                            </div>

                            <div class="form-group">
                                <label for="land_type" class="form-label form-label-required">Jenis Tanah</label>
                                <select id="land_type" name="land_type" class="select" required>
                                    <option value="">-- Pilih Jenis Tanah --</option>
                                    <option value="tanah_kering" <?php echo (isset($_POST['land_type']) && $_POST['land_type'] === 'tanah_kering') ? 'selected' : ''; ?>>
                                        Tanah Kering
                                    </option>
                                    <option value="tanah_basah" <?php echo (isset($_POST['land_type']) && $_POST['land_type'] === 'tanah_basah') ? 'selected' : ''; ?>>
                                        Tanah Basah
                                    </option>
                                </select>
                                <p class="form-hint">Pilih jenis tanah sesuai dengan karakteristiknya</p>
                            </div>

                            <div class="form-group">
                                <label for="luas_m2" class="form-label form-label-required">Luas Tanah (m²)</label>
                                <input
                                    type="number"
                                    id="luas_m2"
                                    name="luas_m2"
                                    class="input"
                                    placeholder="Contoh: 300"
                                    value="<?php echo isset($_POST['luas_m2']) ? htmlspecialchars($_POST['luas_m2']) : ''; ?>"
                                    min="1"
                                    step="0.01"
                                    required>
                                <p class="form-hint">Masukkan luas dalam meter persegi (m²)</p>
                            </div>

                            <div class="form-group">
                                <label for="peta_blok" class="form-label form-label-required">Peta Blok</label>
                                <input
                                    type="text"
                                    id="peta_blok"
                                    name="peta_blok"
                                    class="input"
                                    placeholder="Contoh: A01, B02, C03"
                                    value="<?php echo isset($_POST['peta_blok']) ? htmlspecialchars($_POST['peta_blok']) : ''; ?>"
                                    required>
                                <p class="form-hint">Kode blok peta sesuai dengan peta wilayah</p>
                            </div>

                            <div class="form-group">
                                <label for="notes" class="form-label">Catatan Tambahan</label>
                                <textarea
                                    id="notes"
                                    name="notes"
                                    class="textarea"
                                    placeholder="Masukkan catatan atau informasi tambahan (opsional)"><?php echo isset($_POST['notes']) ? htmlspecialchars($_POST['notes']) : ''; ?></textarea>
                                <p class="form-hint">Informasi tambahan yang perlu dicatat (tidak wajib diisi)</p>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary btn-lg">
                                Simpan Data
                                </button>
                                <a href="index.php" class="btn btn-outline btn-lg">Batal</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="footer">
                <p>&copy; 2025 Buku C Digital - Pure PHP Application</p>
            </footer>
        </div>
    </div>
</body>

</html>