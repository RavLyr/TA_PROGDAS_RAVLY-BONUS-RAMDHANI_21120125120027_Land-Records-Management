<?php
/**
 * Helper Functions for Buku C Digital
 * Pure PHP - No Database
 */

define('DATA_FILE', __DIR__ . '/../data/lands.json');

class Land {
    private $id;
    private $persilNumber;
    private $ownerName;
    private $ownerAddress;
    private $landType;
    private $luasM2;
    private $petaBlok;
    private $notes;
    private $createdAt;
    private $updatedAt;

    public function __construct($data) {
        $this->id = $data['id'] ?? uniqid('land-', true);
        $this->persilNumber = $data['persil_number'];
        $this->ownerName = $data['owner_name'];
        $this->ownerAddress = $data['owner_address'];
        $this->landType = $data['land_type'];
        $this->luasM2 = $data['luas_m2'];
        $this->petaBlok = $data['peta_blok'];
        $this->notes = $data['notes'] ?? '';
        $this->createdAt = $data['created_at'] ?? date('Y-m-d H:i:s');
        $this->updatedAt = $data['updated_at'] ?? date('Y-m-d H:i:s');
    }

    public function validate() {
        $errors = [];
        if (empty($this->persilNumber)) $errors[] = 'Nomor persil harus diisi';
        if (empty($this->ownerName)) $errors[] = 'Nama pemilik harus diisi';
        if (empty($this->ownerAddress)) $errors[] = 'Alamat pemilik harus diisi';
        if (empty($this->landType)) $errors[] = 'Jenis tanah harus dipilih';
        if ($this->luasM2 <= 0) $errors[] = 'Luas tanah harus lebih dari 0';
        if (empty($this->petaBlok)) $errors[] = 'Peta blok harus diisi';
        return $errors;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'persil_number' => $this->persilNumber,
            'owner_name' => $this->ownerName,
            'owner_address' => $this->ownerAddress,
            'land_type' => $this->landType,
            'luas_m2' => $this->luasM2,
            'peta_blok' => $this->petaBlok,
            'notes' => $this->notes,
            'created_at' => $this->createdAt,
            'updated_at' => $this->updatedAt,
        ];
    }

    public function getId() {
        return $this->id;
    }

    public function getPersilNumber() {
        return $this->persilNumber;
    }

    public function getOwnerName() {
        return $this->ownerName;
    }

    public function getOwnerAddress() {
        return $this->ownerAddress;
    }

    public function getLandType() {
        return $this->landType;
    }

    public function getLuasM2() {
        return $this->luasM2;
    }

    public function getPetaBlok() {
        return $this->petaBlok;
    }

    public function getNotes() {
        return $this->notes;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }

    public function getUpdatedAt() {
        return $this->updatedAt;
    }
}

class LandRepository {
    private $dataFile;

    public function __construct($dataFile) {
        $this->dataFile = $dataFile;
    }

    private function loadData() {
        if (!file_exists($this->dataFile)) {
            file_put_contents($this->dataFile, json_encode([], JSON_PRETTY_PRINT));
        }
        return json_decode(file_get_contents($this->dataFile), true) ?? [];
    }

    private function saveData($data) {
        file_put_contents($this->dataFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public function findAll() {
        return $this->loadData();
    }

    public function findById($id) {
        foreach ($this->loadData() as $item) {
            if ($item['id'] === $id) return $item;
        }
        return null;
    }

    public function save(Land $land) {
        $data = $this->loadData();
        $data[] = $land->toArray();
        $this->saveData($data);
    }

    public function update($id, Land $land) {
        $data = $this->loadData();
        foreach ($data as $key => $item) {
            if ($item['id'] === $id) {
                $data[$key] = $land->toArray();
                $this->saveData($data);
                return true;
            }
        }
        return false;
    }

    public function delete($id) {
        $data = $this->loadData();
        $newData = array_filter($data, fn($item) => $item['id'] !== $id);
        $this->saveData($newData);
    }
}
