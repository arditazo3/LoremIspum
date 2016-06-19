@extends('layouts.admin',
    ['title'=> 'Account Panel', 'subTitle'=>'Contacts',
     'activeOpen'=> 'MyAccountPanel', 'activeOpenSub'=> 'Contacts',
     'website'=>\App\Option::findOrFail(1)->value])


@section('content')

    <div class="row">
        @foreach($users as $user)

            <div class="col-lg-4">
                <div class="contact-box">
                    <a href="{{ $user->id }}">
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


    <div class="modal inmodal fade" id="calendarModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title pull-left">Update event</h4>
                </div>

            <!--PUT THE NICE FORM HERE-->
            @include('webapp-layouts.my_account.form_user')

            </div>
        </div>
    </div>
    {{--END EDIT MODAL--}}

@endsection

@section('myScript')

    <script>

        $(document).ready(function () {

            $('.row').on('click', 'a', function (e) {
                e.preventDefault();
                console.log($(this).attr('href'));
            });

        });

    </script>

@endsection