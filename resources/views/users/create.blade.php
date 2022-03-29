<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/helper.css') }}" rel="stylesheet"></link>
    <link href="{{ asset('css/jquery.toast.css') }}" rel="stylesheet"></link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <title>Create User</title>
</head>

<body>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ route('users.store') }}" class="form-horizontal ajax-form" id="create-user-form" enctype="multipart/form-data">
                        <div class="card-header">
                            Create User
                        </div>
                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <label class="col-sm-2 col-form-label">First Name</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" name="first_name" class="form-control" placeholder="Enter first name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Last Name</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" name="last_name" class="form-control" placeholder="Enter last name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Enter Email">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="file" name="image" class="form-control" id="user_profile">
                                    </div>
                                    <img src="" height="100" width="100" id="user_profile_preview" style="display: none;" />
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Date of birth</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="date" name="dob" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Age</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="number" name="age" class="form-control" placeholder="Enter Age">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Home Phone</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="number" name="home_phone" class="form-control" placeholder="Enter Home Phone">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Mobile Phone</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" name="mobile_phone" class="form-control" placeholder="Enter Mobile Phone" id="mobile_phone">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Street Addres</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <textarea name="street_address" class="form-control" placeholder="Enter Street Addres"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">City</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" name="city" class="form-control" placeholder="Enter City">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">State</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" name="state" class="form-control" placeholder="Enter State">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 col-form-label">Zip Code</label>
                                <div class="col-sm-10">
                                    <div class="form-group bmd-form-group">
                                        <input type="text" name="zip_code" class="form-control" placeholder="Enter Zio Code">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ml-auto mr-auto" style="margin-top: 10px;">
                            <button type="submit" class="btn btn-primary">Add User</button>
                            <a href="{{ route('users.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type='text/javascript' src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.5/jquery.inputmask.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="{{ asset('js/jquery.toast.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/helper.js') }}" type="text/javascript"></script>
<script>
    user_profile.onchange = evt => {
        const [file] = user_profile.files
        if (file) {
            $('#user_profile_preview').show();
            user_profile_preview.src = URL.createObjectURL(file)
        }
    }

    $(function () {
        $('#mobile_phone').inputmask({"mask": "(999) 999-9999"})
    });

    $("form.ajax-form").submit(function() {
        // I used one helper js file for below ajax call
        $.easyAjax({
            type: "POST",
            url: $(this).attr('action'),
            container: '#create-user-form',
            data: $(this).serializeArray(),
            redirect: true,
            file: true
        })

        // This is manually when we call ajax

        // e.preventDefault();
        // $(this).removeClass('has-error').find('.help-block').remove();
        // $.ajax({
        //     method: "POST",
        //     url: $(this).attr('action'),
        //     data: $(this).serialize(),
        //     dataType: "json"
        // })
        // .done(function(data) {
        //     if (data.status == "success") {
        //         $.showToastr(data.message);
        //         window.location.href = data.url;
        //     }
        // })
        // .fail(function(data) {
        //     $.each(data.responseJSON.errors, function(key, value) {
        //         $('#create-user-form input[name=' + key + '],#create-user-form select[name=' + key + ']').after('<div class="help-block">' + value + '</div>').parent().addClass('has-error');
        //     });
        // });
    })
</script>