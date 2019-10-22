<?php

class Student extends Controller
{
    private $studentModel;

    public function __construct()
    {
        $this->studentModel = $this->model('StudentModel');
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'first_name' => trim($_POST['first_name']),
                'last_name' => trim($_POST['last_name']),
                'middle_name' => trim($_POST['middle_name']),
                'birthday' => trim($_POST['birthday']),
                'errors' => '',
            ];

            $this->studentModel->first_name = $data['first_name'];
            $this->studentModel->last_name = $data['last_name'];
            $this->studentModel->middle_name = $data['middle_name'];
            $this->studentModel->birthday = $data['birthday'];
            if (!$this->studentModel->is_valid()) {
                $data['errors'] = $this->studentModel->errors();
            }
            if (empty($data['errors'])) {
                $createStudent = $this->model('StudentModel')->create($data['first_name'], $data['last_name'],
                    $data['middle_name'], $data['birthday']);
            } else {
                $this->view('home/create', $data);
            }

        } else {
            $data = [
                'first_name' => '',
                'last_name' => '',
                'middle_name' => '',
                'birthday' => '',
            ];
        }
        return $this->view('home/create', $data);
    }

    public function edit($id)
    {
        $student = $this->model('StudentModel')->getStudentById($id);
        if ($student) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'first_name' => trim($_POST['first_name']),
                    'last_name' => trim($_POST['last_name']),
                    'middle_name' => trim($_POST['middle_name']),
                    'birthday' => trim($_POST['birthday']),
                    'errors' => '',
                ];

                if (empty($data['first_name']) || empty($data['last_name']) || empty($data['middle_name'])) {
                    $data['err'] = 'Please, enter fields';
                } else {
                    $createStudent = $this->model('StudentModel')->edit($data['id'], $data['first_name'], $data['last_name'], $data['first_name'], $data['middle_name'], $data['birthday']);
                    if ($createStudent) {
                        header("location: /home/index");
                    } else {
                        $this->view('home/edit', $data);
                    }
                }
            } else {
                header("location: /home/index");
            }
        }
        return $this->view('home/edit', $data);
    }
}