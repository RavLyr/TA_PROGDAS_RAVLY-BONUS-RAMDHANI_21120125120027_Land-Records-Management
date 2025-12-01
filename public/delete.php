<?php
/**
 * Buku C Digital - Delete Page
 * Delete Land Record
 */

require_once '../libs/helpers.php';

$repository = new LandRepository(DATA_FILE);
$id = $_GET['id'] ?? '';

if (empty($id)) {
    header('Location: index.php?msg=' . urlencode('ID tidak valid!') . '&type=error');
    exit;
}

$land = $repository->findById($id);

if (!$land) {
    header('Location: index.php?msg=' . urlencode('Data tidak ditemukan!') . '&type=error');
    exit;
}

if ($repository->delete($id)) {
    header('Location: index.php?msg=' . urlencode('Data berhasil dihapus!') . '&type=success');
    exit;
} else {
    header('Location: index.php?msg=' . urlencode('Gagal menghapus data!') . '&type=error');
    exit;
}
