<div class="modal fade" tabindex="-1" id="editProfileModal" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            {!! Form::model($user, ['url'=>"/user/edit/$user->id", 'method'=>'post']) !!}
            <div class="modal-body">

                <div class="form-group">
                    {!! Form::label('lname', "Last Name*", ['class'=>'form-label']) !!}
                    {!! Form::text('lname', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('fname', "First Name*", ['class'=>'form-label']) !!}
                    {!! Form::text('fname', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('phone', "Phone Number", ['class'=>'form-label']) !!}
                    {!! Form::text('phone', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('designation', "Designation*", ['class'=>'form-label']) !!}
                    {!! Form::text('designation', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('school', "School/Organization*", ['class'=>'form-label']) !!}
                    {!! Form::text('school', null, ['class'=>'form-control']) !!}
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save"></i> Edit Profile
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
