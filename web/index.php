<?php

require_once '../autoload.php';

$arrPath = explode('/', strtolower($_REQUEST['path']) );

switch ($arrPath[0]) {
    case 'admin':                    // ссылки вида {имя_сайта}/admin/*
        switch ($arrPath[1])  {
            case 'singin':              // ссылки вида {имя_сайта}/admin/singin/ (*)

                $parameters = explode('?', $arrPath[2]) ? : [];

                $loginController = new adminLoginController($parameters);

                $content = $loginController->getResponce();

            case 'stat':
            case 'customers':
            default:
                $content = implode('.', $arrPath);
        }

    default: // user controllers
        switch ($arrPath[0])  {
            case 'category':


                $categoryController = new categoryController();

                $content = $categoryController->getResponce();

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

                $content = ' result from Builder ' . $queryBuilder->getSql();

                while ($row = mysqli_fetch_assoc($result)) {
                    $content .= $row['worker'] . '<br>';
                }
                break;

            default:
                $content = implode('.', $arrPath);

        }


}
include '../views/pages/main/header.html';
include '../views/pages/main/content.html';
include '../views/pages/main/footer.html';