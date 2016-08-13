$(document).ready(function () {

    var id_patient;
    var isSelectedCure = false;

    // open Modal of Charts patient when button is clicked
    $('#btnNewCare').click(function () {

        resetCureModal();

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

        resetCureModal();

        var cureNameTrim = cureName.trim();

        if (cureNameTrim.substr(cureNameTrim.length - 1) === '|') {
            console.log('Category selected! Choose the cure item.');
            isSelectedCure = false;
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
        isSelectedCure = true;

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

        if (idImage != ("#" + "teeth") && isSelectedCure) {
            setSelectedOrUnSelectTeethImage(idImage);
        }

    });

    function setSelectedOrUnSelectTeethImage(idImage) {

        var hasClass = $(idImage).attr('class');

        if (typeof hasClass !== typeof undefined && hasClass !== false) {
            $(idImage).removeAttr("class");

        } else {
            $(idImage).addClass("teeth-border-cure");
        }

    }

    function resetCureModal() {

        isSelectedCure = false;

        /**
         * Remove the check attribute added at the div and set it at the default
         * radio button
         * */
        var allChildrenStatusTheCure = $("#allChildrenStatusTheCure div.iradio_square-green");

        for(var i = 0; i < allChildrenStatusTheCure.length; i++) {
            allChildrenStatusTheCure[i].className = "iradio_square-green";
        }

        $("#DE label div").addClass("iradio_square-green checked");
        $("#shortCode").val('');
        $("#description").val('');
        $("#descOfClient").val('');

        var theUser = 'Azo';
        $("#user option").filter(function() {
            //may want to use $.trim in here
            return $(this).text() == theUser;
        }).prop('selected', true);

        $("#price").val('0.00');
        $("#amount").val('0.00');
        
        for(var i = 1; i < 33; i++) {
            $( ("#teeth_" + i) ).removeAttr("class");
        }

        console.log('Reset Modal Cures Panel');
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





