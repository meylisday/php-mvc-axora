<?php include_once("../app/controllers/student.php"); ?>
<div class="container main">
    <h1 class="text-center title-task-list">Студенты</h1>
    <div class="row col-md-12 mb-2">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Отчество</th>
                    <th>День рождения</th>
                    <th>Возраст</th>
                </tr>
            </thead>
            <?php foreach ($data['students'] as $student):?>
            <tbody>
                <tr>
                    <td><?php echo $student->first_name;?></td>
                    <td><?php echo $student->last_name;?></td>
                    <td><?php echo $student->middle_name;?></td>
                    <td><?php echo $student->birthday;?></td>
                    <td><a href="/task/edit/<?php echo $student->student_id;?>">Edit</a></td>
                </tr>
            </tbody>
        <?php endforeach;?>
        </table>
    </div>
    <div class="col-md-8">
        <a type="button" class="btn btn-primary mb-2" href="/student/create">Create task</a>
    </div>
</div>