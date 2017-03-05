

<label>Список группы</label>
<table class="table table-responsive">
    <thead>
    <th>Студент</th><th>1 подгруппа</th><th>2 подгруппа</th>
    </thead>
    <tbody>



    <?php foreach ($group as $key => $value): ?>
    <tr>
        <td>
            <?php echo $value['name']?>
        </td>
        <td><?php if ($value['sub'] == 1):?>
            <input type="checkbox" id="<?php echo $value['student_id']?>_1" class="student" checked>
            <?else: ?>
            <input type="checkbox" id="<?php echo $value['student_id']?>_1" class="student" >
            <? endif ?>
        </td>
        <td>
            <?php if ($value['sub'] == 1):?>
                <input type="checkbox" id="<?php echo $value['student_id']?>_2" class="student" >
            <?else: ?>
            <input type="checkbox" id ="<?php echo $value['student_id']?>_2" class="student" checked>
            <? endif ?>
        </td>
    </tr>
    <?php endforeach; ?>

    </tbody>
</table>

<input type="button" class="btn btn-block back"  id="27" value="Назад">

<script type="text/javascript">

    $(".student").click(function() {

        var id = this.id;

        if (id[2] == 1){
            var newId = id[0]+"_2";
        }else var newId = id[0]+"_1";


        $("#"+newId).prop("checked", false);

    });

    $('.back').click(function(){
        $.get('<?php echo site_url('editor/showLessonsForView/'); ?>' + $(this).attr('id'), function(r){
            if(r.success){
                $('#content').html(r.data);
            }
        });
    });
</script>

