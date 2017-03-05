<b><?php echo 'Лекция '. $lesson[0]['name'] . " - " . $students[0]['gname']; ?></b>
<div class="table-responsive">
    <table class="table table-striped ">

        <thead>

        <th>№ПП</th><th>Студент</th><?php $i = 0; foreach($lesson as $key => $value):?> <th><?php echo date("m.d", strtotime($value['execute_date']));?></th><?endforeach?><th>Пропуски</th>
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
                            if (($mark['lesson_id'] == $date['lesson_id']) && ($mark['student_id'] == $student['student_id'])) {
                                echo $mark['scope'];
                                if ($mark['visit'] == 1) echo ' / '.'H';
                            }
                        }
                        ?>
                    </td>
                <?php endforeach ?>
                <td class="col-leave clickable">

                </td>
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

    $(function()	{
        $('td.clickable').click(function(e)	{

            var t = e.target || e.srcElement;

            var elm_name = t.tagName.toLowerCase();

            if(elm_name == 'input')	{return false;}
            var val = $(this).html();
            var code = '<input  type="text" id="edit" value="'+val+'"/>';
            $(this).empty().append(code);
            $('#edit').focus();
            $('#edit').blur(function()	{
                var val = $(this).val();
                $(this).parent().empty().html(val);
            });
        });
    });

    function CountingLeaving() {

        var count = 0;
        var currentIndex = 0;

        $('#TableListOfStudentLek tbody td.clickable').each(function () {
            if ($(this).attr("class") == "col-leave") {
                $(this).text(count * 2);
                currentIndex++;
                count = 0;
            }

            if ($(this).text() == "" || $.isNumeric($(this).text())) {
                if ($(this).hasClass("leaving")) {
                    $(this).removeClass("leaving");
                }
                return;
            }

            var index = $(this).parent('tr').index();
            $(this).attr("class", "leaving");
            if (currentIndex == index) {
                count++;
            }

        });
    }
    CountingLeaving();
</script>