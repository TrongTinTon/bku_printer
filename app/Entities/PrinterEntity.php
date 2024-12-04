<?php

namespace App\Entities;

use App\Entities\Entity;

/**
 * Class PrinterEntity
 * Đại diện cho dữ liệu của một máy in.
 */
class PrinterEntity extends Entity {
    private $id;
    private $printer_name;
    private $status;

    /**
     * Constructor của PrinterEntity.
     *
     * @param int|null $id ID của máy in (null nếu là user mới).
     * @param string|null $printer_name printer_name của máy in.
     * @param string|null $status trạng thái của máy in.
     */
    public function __construct($id = null, $printer_name = null, $status = null) {
        $this->id = $id;
        $this->printer_name = $printer_name;
        $this->status = $status;
    }

      /**
     * Lấy ID của máy in.
     *
     * @return int|null ID của máy in.
     */
    public function getId() { return $this->id; }

    /**
     * Thiết lập ID cho máy in.
     *
     * @param int $id ID của máy in.
     */
    public function setId($id) { $this->id = $id; }

    /**
     * Lấy printer_name của máy in.
     *
     * @return string|null tên của máy in.
     */
    public function getName() { return $this->printer_name; }

    /**
     * Thiết lập printer_name cho máy in.
     *
     * @param string $printer_name tên của máy in.
     */
    public function setName($printer_name) { $this->printer_name = $printer_name; }

    /**
     * Lấy trạng thái của máy in.
     *
     * @return string|null trạng thái của máy in.
     */
    public function getStatus() { return $this->status; }

    /**
     * Thiết lập trạng thái cho máy in.
     *
     * @param string $status trạng thái của máy in.
     */
    public function setStatus($status) { $this->status = $status; }

    
    /**
     * Trả về thông tin máy in dưới dạng mảng.
     *
     * @return array Mảng chứa thông tin máy in.
     */
    public function toArray() {
        return [
            'id' => $this->id,
            'printer_name' => $this->name,
            'status' => $this->status,
        ];
    }
}
?>
