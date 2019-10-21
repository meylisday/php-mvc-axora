<?php
class StudentModel
{
	protected $db;
	private $first_name;
	private $last_name;
	private $middle_name;
    private $birthday;

	private $errors;

 	public function errors()
    {
        return $this->errors;
    }

    public function is_valid()
    {
        $this->validateStudent();
        $this->validateBirthday();

        return $this->errors === 0;
    }
    private function validateStudent()
    {
    	if (empty($this->first_name) || empty($this->last_name) || empty($this->middle_name))
        {
            return $this->errors['student'] = 'There are empty fields';
        }
        if (!preg_match('/^[А-Яа-я\d_]{2,20}$/i', $this->first_name)
            || !preg_match('/^[А-Яа-я\d_]{2,20}$/i', $this->last_name)
            || !preg_match('/^[А-Яа-я\d_]{2,20}$/i', $this->middle_name))
        {
			return $this->errors['student'] = 'Not valid fields.';
        }
        return $this->errors['student'];
    }

    private function validateBirthday()
    {
        $matches = array();
        $pattern = '/^([0-9]{1,2})\\/([0-9]{1,2})\\/([0-9]{4})$/';
        if (!preg_match($pattern, $this->birthday ,$matches)) return false;
        if (!checkdate($matches[2], $matches[1], $matches[3])) return false;
        return true;
    }

	public function __construct(PDO $db)
	{
		$this->db = $db;
	}

	public function create($first_name, $last_name, $middle_name, $birthday)
	{
		$student = $this->db->prepare("INSERT INTO students(first_name, last_name, middle_name, birthday) VALUES (?, ?, ?, ?)");
    	$row = $student->execute(array($first_name, $last_name, $middle_name, $birthday));
		if($row)
		{
			return true;
		} else {
			return false;
		}
	}

	public function getAll()
	{
		$students = $this->db->query("SELECT * FROM students ORDER BY last_name");
		return $students->fetchAll(PDO::FETCH_OBJ);
	}

	public function getStudentById($id)
	{
		$id = (int)$id;
        $student= $this->db->query("SELECT * FROM students WHERE id = {$id}");
		return $student->fetch(PDO::FETCH_OBJ);
	}

	public function edit($id, $first_name, $last_name, $middle_name, $birthday)
	{
        $student = $this->db->prepare("UPDATE students SET first_name = ?, last_name = ?, middle_name = ?, birthday = ? WHERE id = ?");
    	$row = $student->execute(array($first_name, $last_name, $middle_name, $birthday, $id));
		if($row)
		{
			return true;
		} else {
			return false;
		}
	}
	public function delete($id)
    {
        $result = $this->db->prepare("DELETE FROM students WHERE student_id = :student_id");
        $result->bindParam(':student_id', $id, PDO::PARAM_INT);
        $result->execute();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

	public function getAllCount()
	{
		$students = $this->db->query("SELECT * FROM students");
		return $students->rowCount();
	}
}