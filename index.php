<?php
require_once 'config/define.php';
require_once 'config/DB.php';
require_once 'interface/ApiInterface.php';
require_once 'model/Product.php';
require_once 'controller/ProductController.php';
require_once 'model/Categories.php';
require_once 'controller/CategoriesController.php';
require_once 'model/Stock.php';
require_once 'controller/StockController.php';

$url = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
$explode_url = explode('/', $url);
$page = $explode_url[2];

switch ($page) {
    case 'addproduct':
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $controller = new ProductController();
            echo $controller->product_add($data);
        }
      
        else {
            echo json_encode(["status" => 400, "message" => "Geçersiz İstek Tipi"]);
        }
    
        break;
    case 'editproduct':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $controller = new ProductController();
            echo $controller->product_edit($data);
        } else {
            echo json_encode(["status" => 400, "message" => "Geçersiz İstek Tipi"]);
        }
        break;
    case 'deleteproduct':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $controller = new ProductController();
            echo $controller->product_delete($data);
        } else {
            echo json_encode(["status" => 400, "message" => "Geçersiz İstek Tipi"]);
        }
        break;

    case 'producttocategory':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $controller = new ProductController();
            echo $controller->product_to_category($data);
        } else {
            echo json_encode(["status" => 400, "message" => "Geçersiz İstek Tipi"]);
        }
        break;

    case 'productsearch':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $controller = new ProductController();
            echo $controller->product_search($data);
        } else {
            echo json_encode(["status" => 400, "message" => "Geçersiz İstek Tipi"]);
        }
        break;

    case 'productstock':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $controller = new ProductController();
            echo $controller->product_stock($data);
        } else {
            echo json_encode(["status" => 400, "message" => "Geçersiz İstek Tipi"]);
        }
        break;



    case 'addcategory':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $controller = new CategoriesController();
            echo $controller->category_add($data);

        } else {
            echo json_encode(["status" => 400, "message" => "Geçersiz İstek Tipi"]);
        }
        break;
    case 'editcategory':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $controller = new CategoriesController();
            echo $controller->category_edit($data);

        } else {
            echo json_encode(["status" => 400, "message" => "Geçersiz İstek Tipi"]);
        }
        break;
    case 'deletecategory':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $controller = new CategoriesController();
            echo $controller->category_delete($data);

        } else {
            echo json_encode(["status" => 400, "message" => "Geçersiz İstek Tipi"]);
        }
        break;

    case 'addstock':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $controller = new StockController();
            echo $controller->stock_add($data);

        } else {
            echo json_encode(["status" => 400, "message" => "Geçersiz İstek Tipi"]);
        }
        break;
    case 'editstock':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $controller = new StockController();
            echo $controller->stock_edit($data);

        } else {
            echo json_encode(["status" => 400, "message" => "Geçersiz İstek Tipi"]);
        }
        break;
    case 'deletestock':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $controller = new StockController();
            echo $controller->stock_delete($data);

        } else {
            echo json_encode(["status" => 400, "message" => "Geçersiz İstek Tipi"]);
        }
        break;

    default:
        header('Location: 404.php');
        break;
}