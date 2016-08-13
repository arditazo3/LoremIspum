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

    var teeth1 = $('#teeth_32').show();
    var teeth = $('#teeth').show();
    var index = 1;

    $('#teeth_32').click(function () {

        if (index % 2 == 1) {
            teeth1.hide();
            index++;
            console.log('hide, index: ' + index);
        }
    });

    $('#teeth').click(function() {

        if(index % 2 == 0) {
            teeth1.show();
            index++;
            console.log('show, index: ' + index);
        }

    });

    function setTheCureSelected( theCure ) {
        console.log( theCure );

        var shortCode = (theCure.detail).substring(0, 4).trim();
        var description = ((theCure.detail).split('-')[1]).trim();
        var price = theCure.price1;
        var amount = parseFloat( 0 ).toFixed(2);

        $('#shortCode').val( shortCode );
        // first letter uppercase
        $('#description').val( description[0].toUpperCase() + description.slice(1) );
        $('#price').val( price );
        $('#amount').val( amount );

    }

    $("#teeth-group img").on("click", function() {
        console.log("clicked: " + $(this).prop('id') );
        
        var idImage = "#" + $(this).prop('id');

        if (idImage != ("#" + "teeth")) {
            setSelectedOrUnSelectTeethImage(idImage);
        }

    });

    function setSelectedOrUnSelectTeethImage(idImage) {

        var hasClass = $(idImage).attr('class');

        if (typeof hasClass !== typeof undefined && hasClass !== false) {
            // $(idImage).removeClass("teeth-border-cure");
            $(idImage).removeAttr("class");
        } else {
            $(idImage).addClass("teeth-border-cure");
        }

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





