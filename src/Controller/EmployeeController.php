<?php


namespace App\Controller;


class EmployeeController extends AbstractController
{
    public function index()
    {
        return $this->twig->render('EmployeeOfTheMonth/employee.html.twig');
    }
}
