<b><?php echo 'Практика: ' .$lesson[0]['name'] . " - " . $students[0]['gname']?></b>
<div class="table-responsive">
    <table class="table table-striped ">

        <thead>

        <th>№ПП</th><th>Студент</th><?php $i = 0; foreach($lesson as $key => $value):?> <th><?php echo date("m.d", strtotime($value['execute_date']));?></th><?endforeach?>
        </thead>
        <tbody>
        <?php foreach($students as $key => $student):?>
            <tr>
                <td>
                    <?php echo ++$i;?>
                </td>
                <td>
                    <?php echo $student['name'];
                    ?>
                </td>
                <?php foreach($lesson as $key => $date):  ?>
                    <td class="clickable">
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
</div>
<input type="button" value="Назад" class="back btn btn-cancel">
<script type="text/javascript">
    $('.back').click(function(){
        $.get('<?php echo site_url('editor/showLessonsForView/27');  ?>' , function(r){
            if(r.success){
                $('#content').html(r.data);
            }
        });
    });


</script>