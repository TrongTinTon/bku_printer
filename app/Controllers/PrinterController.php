<?php

namespace App\Controllers;

use Core\Request;
use Core\ValidateRequest;
use Core\ValidationException;
use Core\Response;
use App\Models\PrinterModel;
use App\Entities\PrinterEntity;
use App\Controllers\BaseController;
use PDOException;

class PrinterController extends BaseController {

    public function __construct() {
        $this->printer = new PrinterModel($this->DB());
    }

    public function getPrinters() {
        $request = new Request; 
        $data = $request->getBody();
        $conditions = [];
        foreach ($data as $key => $val) {
            //Kiểm tra có tồn tại trong bảng print_history hay không?
            if (in_array($key, ['status', 'name'])) {
               $conditions[$key] = $val;
            }
        }
        
        $responeData = $this->printer->getPrinters($conditions);
        Response::json(200, $responeData, 'Lấy danh sách máy in thành công');
    }

    public function addPrinter() {
        $request = new Request; 
        $data = $request->getBody();
        try {
            // Khởi tạo lớp validate và áp dụng luật
            $validator = new ValidateRequest($data);
            $validator->validate([
                'name' => 'required',
                'status' => 'required',
            ]);
           
        } catch (ValidationException $e) {
            // Xử lý lỗi xác thực
            Response::json(422, [
                'errors' => $e->getValidationErrors()
            ], 'Validation failed');
        }

        $entity = new PrinterEntity();
        $entity->setName($data['name']);
        $entity->setStatus($data['status']);
        $respone;
        try {
            $this->printer->addPrinter($entity);
            Response::json(200, [], 'Thêm máy in thành công');
        } catch(PDOException $e) {
            // Phân loại lỗi
            if ($e->getCode() === '23000') {
                if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
                    Response::json(409, [],"Duplicate entry detected: " . $e->getMessage());
                }
                if (strpos($e->getMessage(), 'foreign key constraint') !== false) {
                    Response::json(409, [],"Foreign key violation: " . $e->getMessage());
                }
            }

            // Các lỗi khác
            Response::json(500, [],"Database error: " . $e->getMessage());
        }
    }
}
