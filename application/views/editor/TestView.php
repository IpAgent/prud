
<table class="table table-inverse">

    <thead>

    <th>Студент</th><?php foreach($lesson as $key => $value):?> <th><?php echo date("m.d", strtotime($value['execute_date']));?></th><?endforeach?>
    </thead>
    <tbody>
    <?php foreach($students as $key => $student):?>
        <tr>
            <td>
                <?php echo $student['name'];
                ?>
            </td>
            <?php foreach($lesson as $key => $date):  ?>
                <td>
                    <?php
                    foreach($marks as $key => $mark){
                        if (($mark['lesson_id'] == $date['lesson_id']) && ($mark['student_id'] == $student['student_id']))
                            echo $mark['scope'];
                    }
                    ?>
                </td>
            <?php endforeach ?>
        </tr>
    <?php endforeach?>
    </tbody>
</table>


