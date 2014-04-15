$(function () {
    var postRequest = function (url, data) {
        data = (typeof data !== 'undefined') ? data : {};
        var preq = $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "json"
        });
        preq.fail(function (data) {
            console.log(data);
            alert('There was some error please refresh the page.');
        });
        return preq;
    }
    var listCount = function (n) {
        if (n) {
            $('#modConfBtn').removeAttr('disabled').removeClass('disabled-link');
        } else {
            $('#modConfBtn').attr('disabled', 'disabled').addClass('disabled-link');
        }
        $('#nav_ll_count').text(n);
    }
    var reduceListCount = function () {
        var i = parseInt($('#nav_ll_count').text());
        listCount(i - 1);
        return i == 1;
    }
    var listHtml = function (data) {
        $('#nav_ll_ul_main').html(data);
    }
    var listMedia = function (uname, uid, email, profilePic) {
        return '<li><div class="media"><a class="pull-left"href="#"><img width="64px" height="64px" class="media-object"src="' + profilePic + '"alt=".media-object"></a><div class="media-body"><div class="clearfix"><h4 class="media-heading pull-left">' + uname + '</h4><button userId="' + uid + '" class="btn btn-link pull-right nav_ul_rmv_btn">Remove</button></div><ul class="list-unstyled"><li><strong>Email:</strong>' + email + '</li></ul></div></div><hr/></li>';
    }
    var updateList = function (data) {
        if (data.hasOwnProperty('users') && $.isArray(data.users) && data.users.length > 0) {
            var fhtml = '';
            for (var i = 0; i < data.users.length; ++i) {
                var tmp = data.users[i];
                fhtml += listMedia(tmp.name, tmp._id, tmp.email, tmp.profilePic);
            }
            listCount(data.users.length);
            listHtml(fhtml);
        } else {
            listCount(0);
            listHtml("<strong>You haven't made any entry in your list</strong>");
        }
    }
    if ($('#list_nav_modal').length) {
        var lmodal = $('#list_nav_modal');
        postRequest(lmodal.attr('furl')).done(function (data) {
            updateList(data);
        });
    }
    $(document).on('click', '.btn_list_add', function (e) {
        var btn = $(this);
        btn.attr('disabled', 'disabled');
        postRequest($('#list_nav_modal').attr('faddurl'), {
            uid: btn.attr('userId')
        }).done(function (data) {
            updateList(data);
        }).complete(function () {
            btn.removeAttr('disabled');
        });
    });
    $(document).on('click', '.nav_ul_rmv_btn', function (e) {
        var btn = $(this);
        btn.attr('disabled', 'disabled');
        var req = postRequest($('#list_nav_modal').attr('frmvurl'), {
            uid: btn.attr('userId')
        });
        req.done(function (data) {
            if (data.hasOwnProperty('del') && data.del) {
                btn.parent().parent().parent().parent().remove();
                if (reduceListCount()) updateList({
                    nthng: 'lolwa'
                });
            }
        });
        req.complete(function () {
            btn.removeAttr('disabled');
        })
    });
});
