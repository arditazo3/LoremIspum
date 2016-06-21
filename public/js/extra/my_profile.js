$(document).ready(function () {

    /**
     * at begin all components are disabled, should click edit
     * to enable them
     */
    allComponentsIsDisable(true);

    $('#btnEditUserProfileData').on('click', function () {
        allComponentsIsDisable(false);

        console.log($('#btnEditUserProfileData').text());

        if ($('#btnEditUserProfileData').text().trim() == 'Edit') {
            $('#btnEditUserProfileData').text("Don't edit");

            allComponentsIsDisable(false);

            toastr.info('Edit mode','You can change the form!');
        } else {
            $('#btnEditUserProfileData').text('Edit');

            allComponentsIsDisable(true);

            toastr.warning('Edit mode','You can change the form!');
        }
    });

    $('#btnSaveEditUser').on('click', function () {

        $('#formUpdateProfile').validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                password : { },
                confirm_password : {
                    equalTo : "#password"
                }
            },

            messages: {
                first_name: "Please enter the first name",
                last_name: "Please enter the last name",
                email: "Please enter the email",
                confirm_password: "Please enter the same password",
            }
        });

    });


    var changeProfPicGlob = $('#changeProfilePicture').hide();
    var defaultProfPicGlob = $('#defaultProfilePicture').show();
    var confirmPasswordGlob = $('#divComfirmPassword').hide();

    $('#btnChangeProfilePicture').click(function () {

        changeProfPicGlob.show();
        defaultProfPicGlob.hide();
    });

    $('#btnBackProfilePicture').click(function () {

        changeProfPicGlob.hide();
        defaultProfPicGlob.show();
    });

    // Show confirm password if we change the password
    $('#password').on('keyup', function () {
        if( $('#password').val().length > 0 ) {

            confirmPasswordGlob.show();
        } else {
            confirmPasswordGlob.hide();
        }
    });

});

function allComponentsIsDisable(isEnable) {

    $('#btnChangeProfilePicture').prop('disabled', isEnable);
    $('#first_name').prop('disabled', isEnable);
    $('#last_name').prop('disabled', isEnable);
    $('#email').prop('disabled', isEnable);
    $('#phone').prop('disabled', isEnable);
    $('#password').prop('disabled', isEnable);
    $('#btnSaveEditUser').prop('disabled', isEnable);
}


