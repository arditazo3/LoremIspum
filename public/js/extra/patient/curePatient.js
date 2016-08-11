$(document).ready(function () {

    var id_patient;

    // open Modal of Charts patient when button is clicked
    $('#btnNewCare').click(function () {

        $('#cureModal').modal({backdrop: 'static', keyboard: false});
        console.log('Open Modal Cures Panel');
    });

    // Putting a trigger when change the value can call this method here
    $('#id_patient_hidden').change(function () {
        id_patient = $(this).val();

    });

    // Child node stelected
    $(function () {
        $('#jstree1')
            .on('changed.jstree', function (e, data) {
                var i, j, r = [];
                for(i = 0, j = data.selected.length; i < j; i++) {
                    r.push(data.instance.get_node(data.selected[i]).text);
                }
                selectedCureCategory( r.join(', ') );
            })
            .jstree();
    });

    function selectedCureCategory(cureName) {

        var cureNameTrim = cureName.trim();

        if (cureNameTrim.substr(cureNameTrim.length - 1) === '|') {
            console.log('Category selected! Choose the cure item.')
        } else {

            $.ajax({
                type: 'POST',
                url: selectedCure,
                data: {
                    cureName: cureName,
                    _token: token
                }
            })
                .error(function (msg) {
                    $('#myModalNotifyMsg').modal({backdrop: 'static', keyboard: false});
                    // set and/or replace the html code inside it
                    $("#notificationMsg").html(msg.responseText);
                })
                .done(function (msg) {
                    setTheCureSelected( msg.theCure );
                });
        }
    }
    
    function setTheCureSelected( theCure ) {
        console.log( theCure );
    }

    $('#jstree1').jstree({
        'core' : {
            'check_callback' : true
        },
        'plugins' : [ 'types', 'dnd' ],
        'types' : {
            'default' : {
                'icon' : 'fa fa-folder'
            },
            'html' : {
                'icon' : 'fa fa-file-code-o'
            },
            'svg' : {
                'icon' : 'fa fa-file-picture-o'
            },
            'css' : {
                'icon' : 'fa fa-file-code-o'
            },
            'img' : {
                'icon' : 'fa fa-file-image-o'
            },
            'js' : {
                'icon' : 'fa fa-file-text-o'
            }
        }
    });

});





