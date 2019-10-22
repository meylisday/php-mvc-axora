<?php
class Home extends Controller
{
    private $studentModel;

    public function __construct()
	{
		$this->studentModel = $this->model('StudentModel');
	}
	public function index()
	{
		$students = $this->studentModel->getAll();
		$data = [
			'students' => $students
		];
		return $this->view('home/index', $data);
	}
}