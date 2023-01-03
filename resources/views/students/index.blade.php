@extends('layout.app')
@section('content')
    <!-- Modal -->
    <div class="modal fade" id="add-student" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Student</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body add-student-modal-body">
                    <div class="form-group mb-3">
                        <label for="">Student Name</label>
                        <input type="text" name="" id="" class="form-control name" required>
                        <div class="name-error">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Email</label>
                        <input type="text" name="" id="" class="form-control email" required>
                        <div class="email-error">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Phone</label>
                        <input type="text" name="" id="" class="form-control phone" required>
                        <div class="phone-error">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="">Course</label>
                        <input type="text" name="" id="" class="form-control course" required>
                        <div class="course-error">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary add-student">Save</button>
                </div>
            </div>
        </div>
    </div>


    <div class="card w-100">
        <div class="card-header d-flex justify-content-between">
            <h5>Student's Data</h5>
            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#add-student"> Add
                Student </button>
        </div>

        <div class="card-body">
            <h5 class="card-title">Special title treatment</h5>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

        $(document).ready(function() {
            $('.add-student').on('click', function(e) {
                e.preventDefault();

                var data = {
                    'name'   : $('.name').val(),
                    'email'  : $('.email').val(),
                    'phone'  : $('.phone').val(),
                    'course' : $('.course').val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: '/students',
                    data: data,
                    dataType: "json",
                    success: function(response) {
                        if(response.status == 400) {
                            $(".add-student-modal-body").addClass("was-validated");
                            $(".add-student-modal-body").addClass("needs-validation");
                            if(!is_undefined(response.errors.name)) {
                                $('.name-error').text(response.errors.name[0]);
                                $('.name-error').addClass("invalid-feedback");
                            }
                            else {
                                $('.name-error').text("");
                            }

                            if(!is_undefined(response.errors.email)) {

                                $('.email-error').text(response.errors.email[0]);
                                $('.email-error').addClass("invalid-feedback");
                            }
                            else {
                                $('.email-error').text("");

                            }

                            if(!is_undefined(response.errors.phone)) {

                                $('.phone-error').text(response.errors.phone[0]);
                                $('.phone-error').addClass("invalid-feedback");
                            }
                            else {
                                $('.phone-error').text("");

                            }

                            if(!is_undefined(response.errors.course)) {

                                $('.course-error').text(response.errors.course[0]);
                                $('.course-error').addClass("invalid-feedback");

                            }
                            else {
                                $('.course-error').text("");
                            }
                        }
                        else {
                            $("#add-student").modal('hide');
                            $("#add-student").find('input').val("");
                        }
                    }
                });

                function is_undefined(el) {
                    return el === undefined;
                }
            });
        });

    </script>
@endsection