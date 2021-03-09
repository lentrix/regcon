<div class="modal fade" tabindex="-1" id="changePassModal" aria-labelledby="changePassModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="btn btn-sm btn-danger"
                        data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            {!! Form::open(['url'=>"user/change-password/$user->id", 'method'=>'post']) !!}
            <div class="modal-body">

                <div class="form-group">
                    {!! Form::label("password", "New Password*",['class'=>'form-label']) !!}
                    {!! Form::password("password", ["class"=>"form-control"]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label("password_confirmation", "Confirm New Password*",['class'=>'form-label']) !!}
                    {!! Form::password("password_confirmation", ["class"=>"form-control"]) !!}
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Change Password
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
