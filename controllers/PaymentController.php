<?php

class PaymentController extends Controller
{
    public function index()
    {
        $this->view("display");
    }

    public function transaction($withdrawal, $deposit, $userId, $type)
    {
        $input = $this->model("Payment");
        $balance = $input->transaction($withdrawal, $deposit, $userId, $type);
        $this->view("result", $balance);
    }

    public function listAllAccountDetail($userId)
    {
        $list = $this->model("Payment");
        $content = $list->listAllAccountDetail($userId);
        $this->view("result", $content);
    }

    public function clear($userId)
    {
        $clear = $this->model("Payment");
        $result = $clear->clearList($userId);
        $this->view("result", $result);
    }
}
