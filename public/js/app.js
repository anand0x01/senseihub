$( document ).ready( function () {
    $.ajaxSetup( {
        headers: {
            'X-CSRF-Token': $( 'meta[name="csrf-token"]' ).attr( 'content' )
        }
    } );
    var listCount = function ( n ) {
        $( '#nav_ll_count' ).text( n );
    }
    var listHtml = function ( data ) {
        $( '#nav_ll_ul_main' ).html( data );
    }
    var listMedia = function ( uname, uid, email, jdate ) {
        return '<li><div class="media"><a class="pull-left"href="#"><img class="media-object"src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI2NCIgaGVpZ2h0PSI2NCI+PHJlY3Qgd2lkdGg9IjY0IiBoZWlnaHQ9IjY0IiBmaWxsPSIjZWVlIi8+PHRleHQgdGV4dC1hbmNob3I9Im1pZGRsZSIgeD0iMzIiIHk9IjMyIiBzdHlsZT0iZmlsbDojYWFhO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEycHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+NjR4NjQ8L3RleHQ+PC9zdmc+"alt=".media-object"></a><div class="media-body"><div class="clearfix"><h4 class="media-heading pull-left">' + uname + '</h4><button userId="' + uid + '" class="btn btn-link pull-right nav_ul_rmv_btn">Remove</button></div><ul class="list-unstyled"><li><strong>Email:</strong>' + email + '</li><li><strong>Joined On:</strong>' + jdate + '</li></ul></div></div><hr/></li>';
    }
    var updateList = function ( data ) {
        if ( data.hasOwnProperty( 'users' ) && data.users ) {
            fhtml = '';
            for ( var i = 0; i < data.users.length; ++i ) {
                fhtml += listMedia( data.users[ i ].username, data.users[ i ].id, data.users[ i ].email, data.users[ i ].created_at );
            }
            listCount( data.users.length );
            listHtml( fhtml );
        } else {
            listCount( 0 );
            listHtml( "<strong>You haven't made any entry in your list</strong>" );
        }
    }
    var askQuestion = function ( ques, project, btn ) {
        btn.attr( 'disabled', 'disabled' );
        if ( $.trim( ques ).length < 10 ) {
            btn.removeAttr( 'disabled' );
            alert( 'question must be atleast of 10 charcters.' );
            return;
        }
        $.ajax( {
            type: 'POST',
            url: AQUES,
            data: {
                pid: project,
                qstr: ques
            },
            dataType: 'json',
            success: function ( data ) {
                if ( data.hasOwnProperty( 'success' ) ) {
                    location.reload();
                }
            },
            complete: function ( data ) {
                btn.removeAttr( 'disabled' );
            }
        } );
    }
    if ( $( '#list_nav_modal' ).length != 0 ) {
        $.ajax( {
            type: 'GET',
            url: LGET,
            dataType: 'json',
            success: function ( data ) {
                updateList( data );
            }
        } );
    }
    $( document ).on( 'click', '#sbmt_q_mod_btn', function ( e ) {
        askQuestion( $( '#sbmt_q_mod_txt' ).val(), $( this ).attr( 'pid' ), $( this ) );
    } );
    $( document ).on( 'change', 'select#fm_s_ss_x', function ( e ) {
        if ( $( this ).val() != '#' ) {
            window.location = $( this ).val();
        }
    } );
    $( document ).on( 'click', '#main_s_r_dd > li', function ( e ) {
        var tx = $( this ).text();
        $( '#main_s_r_dt' ).text( tx );
        $( '#search_cat_s_val' ).val( tx );
        $( this ).parent().parent().find( '.dropdown-toggle' ).dropdown( 'toggle' );
        return false;
    } );
    $( document ).on( 'click', 'button.btn_list_add', function ( e ) {
        var btn = $( this );
        btn.attr( 'disabled', 'disabled' );
        $.ajax( {
            type: 'POST',
            url: LADD,
            data: {
                id: $( this ).attr( 'userId' )
            },
            dataType: 'json',
            success: function ( data ) {
                updateList( data );
            },
            complete: function () {
                btn.removeAttr( 'disabled' );
            }
        } );
    } );
    // Remove an item from nav list.
    $( document ).on( 'click', '.nav_ul_rmv_btn', function ( e ) {
        var btn = $( this );
        btn.attr( 'disabled', 'disabled' );
        $.ajax( {
            type: 'POST',
            url: LRMV,
            data: {
                id: btn.attr( 'userId' )
            },
            dataType: 'json',
            success: function ( data ) {
                updateList( data );
            },
            complete: function ( data ) {
                btn.removeAttr( 'disabled' );
            }
        } );
    } );
    $( document ).on( 'click', '.p_d_ctr_btn', function ( e ) {
        var btn = $( this );
        $( 'button.p_d_ctr_btn' ).attr( 'disabled', 'disabled' );
        $.ajax({
            type: 'POST',
            url: PCONTROL,
            data: {
                command: btn.attr('command'),
                pid: $('#dash_ac_head').attr('pid')
            },
            dataType: 'json',
            success: function ( data ) {
                console.log(data)
            }
        });
    } )
    $( document ).on( 'keyup', '#rch_cov_inx', function ( e ) {
        var tmp = $( this );
        var intRegex = /^\d+$/;
        if ( !intRegex.test( tmp.val() ) ) {
            $( '#rch_cov_msg' ).text( 'Only integer input is allowed.' );
            return;
        }
        if ( parseInt( tmp.val() ) < 10 ) {
            $( '#rch_cov_msg' ).text( 'Minimum amount for recharge is 10$.' );
            return;
        }
        if ( parseInt( tmp.val() ) > 10000 ) {
            $( '#rch_cov_msg' ).text( 'You can\'t recharge your account with more than 10, 000$ in one attempt' );
            return;
        }
        var amt = parseFloat( tmp.val(), 0 ) * 0.971 - 0.30;
        $( '#rch_cov_msg' ).text( 'Actual amount deposited in your account will be ' + amt.toFixed( 3 ).toString() + '$' );
    } );
} );
