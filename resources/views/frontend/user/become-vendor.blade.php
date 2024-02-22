@extends('frontend.user.user-masters')
@section('user-content')
<div class="column content ajax_response">
    <form class="common-form">
        @if(isset($request_become_vendor))
            @if($request_become_vendor->flags == 1)
                <p class="message_become_a_vendor">
                    Your account has not yet been approved.
                </p>
                <button type="button" class="btn blue-button" id="save-changes">Become a seller </button>
            @else
                <p class="message_become_a_vendor">
                    Your account has not yet been approved to become a seller. When it
                    is, you will receive an email telling you that your
                    account is approved!
                </p>
            @endif

        @else

        

        <div class="form-row">
            <div class="form-group col-md-4">
                {{-- <input type="checkbox" value="become-a-vendor" name="become_a_vendor" id="become_a_vendor"> --}}
                {{-- <label for="firstName">Become a seller <span>*</span></label> --}}
            </div>
        </div>
        <div class="form-group col-md-4">
            {{-- <a href="javascript:void(0)" class="btn blue-button" id="save-changes">Become a seller</a> --}}
            <button type="button" class="btn blue-button" id="save-changes">Become a seller</button>
        </div>
    </form>
    @endif


</div>
    <div class="popup_message_show">

    </div>
@endsection
@section('scripts')
<script>
$(document).ready(function() {
    $('#save-changes').on('click', function() {
        $('#save-changes').prop('disabled', true);
        // if ($('#become_a_vendor').prop('checked')) {
            $.ajax({
                url: "{{ route('request_become_a_vendor_process') }}",
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    user_id: '{{auth()->user()->id}}',
                },
                success: function(result) {
                    var obj = jQuery.parseJSON(result);
                    if (obj.message) {
                        //location.reload();
                        $(".popup_message_show").html(`<div class="alert alert-dismissible fade success-alert show" role="alert" style="text-align:center;">
                        Application submitted
                            <button id="error_model" type="button" class="close buttonAlert" data-dismiss="alert" aria-label="Close" onclick="closeup();">
                                <i class="uil uil-multiply"></i>
                            </button>
                        </div>`);
                        setTimeout(() => {
                            $('.popup_message_show').html('');
                        }, 2500);
                        $('.ajax_response').html(obj.message);
                    }

                }
            });
        // }

    });

});
</script>

@endsection