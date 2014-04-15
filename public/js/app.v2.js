$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var askQuestion = function (ques, btn) {
        btn.attr('disabled', 'disabled');
        if ($.trim(ques) < 10) {
            btn.removeAttr('disabled');
            alert('question must be atleast of 10 charcters.');
            return;
        }
        $.ajax({
            type: 'POST',
            url: btn.attr('pfurl'),
            data: {
                qstr: ques
            },
            dataType: 'json',
            success: function (data) {
                if (data.hasOwnProperty('success')) location.reload();
            },
            complete: function (data) {
                btn.removeAttr('disabled')
            }
        });
    }
    $(document).on('change', 'select#fm_s_ss_x', function (e) {
        if ($(this).val() != '#') {
            window.location = $(this).val();
        }
    });
    $(document).on('click', '#main_s_r_dd > li', function (e) {
        var tx = $(this).text();
        $('#main_s_r_dt').text(tx);
        $('#search_cat_s_val').val(tx);
        $(this).parent().parent().find('.dropdown-toggle').dropdown('toggle');
        return false;
    });
    $(document).on('click', '#sbmt_q_mod_btn', function (e) {
        askQuestion($('#sbmt_q_mod_txt').val(), $(this));
    });
    $(document).on('click', 'a.dbt_uns_ques', function(e){
        var modal = $('#myQuesModal');
        /*modal.find('#myQuesModalDel').attr('delLink', $(this).attr('qid'));*/
        modal.find('#myQuesModalQues').text($(this).text());
        modal.find('#myQuesModalSave').attr('quesId', $(this).attr('qid'));
        modal.modal();
    });
    /*$(document).on('click', 'a.db_ans_ques', function(e){
        var modal = $('#myQuesModal');
        $('#myQuesModalTextArea').val($(this).closest('.db_ans_ans').text());
        modal.modal();
        console.log($(this).parent().parent().find('.db_ans_ans').text());
    });*/
    $(document).on('click', '#myQuesModalSave', function(e){
        var btn = $(this);
        if($('#myQuesModalTextArea').val().length < 2) {
            alert('Answer must be atleast of 2 characters.');
            return;
        }
        btn.attr('disabled', 'disabled');
        var arequest = $.post(btn.attr('furl'), { qid : btn.attr('quesId'), qanswer : $('#myQuesModalTextArea').val() });
        arequest.done(function(data){
            if(data.hasOwnProperty('success')){
                location.reload();
                return;
            }
            btn.removeAttr('disabled');
            alert('There was some error processing your request');
        });
    });
    $(document).on('click', '.disabled-link', function(e){
        e.preventDefault();
        return false;
    });
})
