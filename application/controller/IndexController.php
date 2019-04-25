<?php
/**
 * Created by PhpStorm.
 * User: enwei
 * Date: 2019/4/22
 * Time: 6:33 PM
 */

class IndexController extends Controller
{
    public function index()
    {
        $IndexModel = new IndexModel();

        $lists = $IndexModel->selectAll();

        print_r($lists);
    }

    public function getInfo()
    {
        $id = !empty(input('get.id')) ? input('get.id') : 2;

        $IndexModel = new IndexModel();

        $info = $IndexModel->selectById($id);

        print_r($info);
    }
}