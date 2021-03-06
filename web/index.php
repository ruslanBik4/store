<?php

require_once '../autoload.php';
const PATH_WWW = '/web';

$arrPath = explode('/', strtolower($_REQUEST['path']) );

//array_shift($arrPath);

switch ($arrPath[0]) {
    case 'customers': // В  браузере .../web/index.php?path=customers/$command/
        $controller = new customersController($arrPath[1]);
        echo $controller->getResponce();
        break;
    case '':

    case 'main':
        include '../views/pages/main/head.html';
        include '../views/pages/main/header.html';
        include '../views/pages/main/content.html';

//        $ch = curl_init('http://store.allservice.in.ua/customers/');
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT)
//        $result = curl_exec($ch);


        include '../views/pages/main/footer.html';

        exit(0);
        break;
    case 'admin':                    // ссылки вида {имя_сайта}/admin/*
        switch ($arrPath[1])  {
            case 'singin':              // ссылки вида {имя_сайта}/admin/singin/ (*)

                $parameters = [ $arrPath[2] ]; //explode('?', $arrPath[1]) ? : [];

                $loginController = new adminLoginController($parameters);

                $content = $loginController->getResponce();

                break;

            case 'workers':
                $cLink = curl_init('http://allservice.in.ua/test_task/online_store/offices/');
                if ( curl_setopt($cLink, CURLOPT_RETURNTRANSFER, true) &&
                  curl_setopt($cLink, CURLOPT_FRESH_CONNECT, true) ) {

                    $result = curl_exec($cLink);

                    if (preg_match_all( '/((?>\\{)[\S\s]*Stylish\sDesk\sDecors[\S\s]*?(?=\\}))/', $result, $arrayFilter) ) {
                        foreach($arrayFilter as $value) {
                            if (is_array($value)) {
                                foreach($value as $val) {
                                    echo $val . '.  ';
                                }
                                echo '<br>';
                            } else {
                                echo $value . '<br>';
                            }

                        }
                    }
                    $result = json_decode($result, true);

                    foreach ($result as $json) {
                        $row = json_decode($json, true);
                        foreach ($row as $key => $value) {
                            echo "$key = $value, ";
                        }
                        echo "<br>";
                    }
                  };
                  curl_close($cLink);
                    break;
            case 'stat':
            case 'customers':
            default:
                $content = implode('.', $arrPath);
        }
 break;
    default: // user controllers
        switch ($arrPath[0])  {
            case 'image':
                $result = file_get_contents('https://www.google.com.ua/logos/doodles/2016/jean-battens-107th-birthday-5170085972934656-hp.jpg');
                echo($result);
                header('image/jpg');
                exit(0);

            case 'category':// ссылки вида {имя_сайта}/category/{$command}

                $categoryController = new categoryController($arrPath[1]); // $command
                $content = $categoryController->getResponce();

                break;

            case 'product':// ссылки вида {имя_сайта}/product/{$command}

                $controller = new productController($arrPath[1]);
                $content = $controller->getResponce();

                break;

            case 'customers':// ссылки вида {имя_сайта}/product/{$command}

                $controller = new customersController($arrPath[1]);
                $content = $controller->getResponce();

                break;

            case 'offices':

                $queryBuilder = new queryBuilder();
                $select = [
                    'worker'       => 'e.lastName',
                    'nameCustomer' => 'customerName',
                    'countOrders'  => 'count(orderNumber)',
                    'orderDate'    => 'orderDate',
                    'avgPrice'     => 'avg(priceEach)',
                    'Product'      => "GROUP_CONCAT(productName SEPARATOR ', ')",
                    'Product_Line' => "GROUP_CONCAT(textDescription SEPARATOR ', ')",
                ];

                $queryBuilder->Fields($select);

                $queryBuilder->Where( [ 'MONTH(orderDate)' => 12 ] );

                $queryBuilder->setFrom('employees e join customers cus on(e.employeeNumber = cus.salesRepEmployeeNumber) join orders OS using(CustomerNumber) 
join orderdetails OD using(orderNumber) join products p using(productCode) join productlines using(productLine)');

                $queryBuilder->setGroupBy('worker, customerName');

                $result = $queryBuilder->runPreparedSQL();

                $content = [];

                $queryBuilder->getSql();

                while ($row = mysqli_fetch_assoc($result)) {
                    $content[] = json_encode($row);
                }
                echo $content = json_encode($content);

                exit(0);

                break;

            default:
                $content = implode('.', $arrPath);

        }


}
include '../views/pages/main/content.html';
