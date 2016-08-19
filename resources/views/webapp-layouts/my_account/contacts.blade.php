@extends('layouts.admin',
    ['title'=> 'Account Panel', 'subTitle'=>'Contacts',
     'activeOpen'=> 'MyAccountPanel', 'activeOpenSub'=> 'Contacts',
     'website'=>\App\Option::findOrFail(1)->value])


@section('content')

    <div class="row">
        @foreach($users as $user)

            <div class="col-lg-4">
                <div class="contact-box">
                    {{-- WE PUT THE OBJECT HERE AND RETRIEVE IT AFTER CLICK --}}
                    <a href="{{ $user }}">
                        <div class="col-sm-4">
                            <div class="text-center">
                                <img alt="image" class="img-circle m-t-xs img-responsive"
                                     src="{{ $user->image ? ($website . $user->image->path) : ($website . 'img/user-no_photo.png') }}">
                                <div class="m-t-xs font-bold">{{ $user->role ? $user->role->status : 'No role' }}</div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <h3><strong>
                                    @if(Auth::user()->id == $user->id)
                                        {{ $user->first_name }} {{ $user->last_name }} (My profile)
                                    @elseif(Auth::user()->id != $user->id)
                                        {{ $user->first_name }} {{ $user->last_name }}
                                    @endif
                                </strong></h3>
                            <p>
                                <i class="fa fa-map-marker"></i> {{ trim($user->address) == '' ? 'No address' : $user->address }}
                            </p>
                            <p><i class="fa fa-phone"></i> {{ $user->phone }} </p>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </div>
            </div>

        @endforeach
    </div>


    <div class="modal inmodal fade" id="modalUserProfile" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title pull-left">Update profile</h4>
                </div>

                <!--PUT THE NICE FORM HERE-->
                @include('webapp-layouts.my_account.form_user', ['user'=>$user])

            </div>
        </div>
    </div>
    {{--END EDIT MODAL--}}

@endsection

@section('myScript')
    @include('includes.myScript.toastr')
    @include('includes.myScript.jquery_validate')

    @include('includes.myScript.my_profileJS')

    <script>

        var getPathProfilePicAjax = '{{ route('api/getPathProfilePicAjax') }}';
        var token = '{{ \Illuminate\Support\Facades\Session::token() }}';
        var noClickOnSingleOperation = 0;

        $(document).ready(function () {

            $('.row').on('click', 'a', function (e) {
                e.preventDefault();

                console.log($(this).attr('href'));

                var user = JSON.parse($(this).attr('href'));
                setProfilePicture(user["image_id"], user);

            });

        });

        function setProfilePicture(idImange, user) {

            var getProfilePicPath = '';
            noClickOnSingleOperation++;

            if (noClickOnSingleOperation == 1 ) {
                $.ajax({
                    method: 'POST',
                    url: getPathProfilePicAjax,
                    data: {
                        image_id: idImange,
                        _token:   token
                    }
                })
                        .done(function (msg) {
                            console.log("Test");
                            console.log(JSON.stringify(msg));
                            getProfilePicPath = msg;

                            var imagePath = "{{ $website }}" + getProfilePicPath['image_id'];

                            $('#id_user').val(user["id"]);
                            $('#first_name').val(user["first_name"]);
                            $('#last_name').val(user["last_name"]);
                            $('#email').val(user["email"]);
                            $('#phone').val(user["phone"]);
                            $('#address').val(user["address"]);
                            $('#defaultProfilePicture img').attr("src", imagePath);

                            $('#modalUserProfile').modal({backdrop: 'static', keyboard: false});

                            noClickOnSingleOperation = 0;
                        });
            }

        }

    </script>

@endsection