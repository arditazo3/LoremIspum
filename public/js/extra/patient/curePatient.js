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
    $('#jstree1').jstree({
        'core': {
            'check_callback': true,
            'data': [
                {
                    'text': 'css',
                    'children': [
                        {
                            'text': 'animate.css', 'icon': 'none'
                        },
                        {
                            'text': 'bootstrap.css', 'icon': 'none'
                        },
                        {
                            'text': 'main.css', 'icon': 'none'
                        },
                        {
                            'text': 'style.css', 'icon': 'none'
                        }
                    ],
                    'state': {
                        'opened': true
                    }
                },
                {
                    'text': 'js',
                    'children': [
                        {
                            'text': 'bootstrap.js', 'icon': 'none'
                        },
                        {
                            'text': 'inspinia.min.js', 'icon': 'none'
                        },
                        {
                            'text': 'jquery.min.js', 'icon': 'none'
                        },
                        {
                            'text': 'jsTree.min.js', 'icon': 'none'
                        },
                        {
                            'text': 'custom.min.js', 'icon': 'none'
                        }
                    ],
                    'state': {
                        'opened': true
                    }
                }
            ]

        },
        'plugins': ['types', 'dnd'],
        'types': {
            'default': {
                'icon': 'fa fa-folder'
            },
            'html': {
                'icon': 'fa fa-file-code-o'
            },
            'svg': {
                'icon': 'fa fa-file-picture-o'
            },
            'css': {
                'icon': 'fa fa-file-code-o'
            },
            'img': {
                'icon': 'fa fa-file-image-o'
            },
            'js': {
                'icon': 'fa fa-file-text-o'
            }

        }
    });


});





