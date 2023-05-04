@extends('layouts.app')

@section('title', 'Create Record')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Create Record</h3>
                    </div>
                    <div class="card-body">

                        {{-- start  --}}
                        <div class="modal fade" id="responseModal" tabindex="-1" role="dialog" aria-labelledby="responseModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="responseModalLabel">Server Response</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <pre id="response"></pre>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        {{-- end --}}
                        <form id="myForm" action="{{ route('submitRecord') }}" method="POST">
                            @csrf


                            <div class="form-group">
                              <label for="username">Username:</label>
                              <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required>
                              @error('username')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                            </div>

                            <div class="form-group">
                                <label for="date_created">Date Created:</label>
                                
                                <div class="input-group date" id="datetimepicker" data-target-input="nearest">
                                    <input type="text" id="date_created" name="date_created" class="form-control datetimepicker-input" data-target="#datetimepicker"/>
                                    <div class="input-group-append" data-target="#datetimepicker" data-toggle="datetimepicker">
                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                    </div>
                                  </div>
                                @error('date_created')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="product">Product Name:</label>
                                <input type="text" name="product" id="product" class="form-control @error('product') is-invalid @enderror" value="{{ old('product') }}" required>
                                @error('product')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="current_quantity">Current Quantity:</label>
                                <input type="number" name="current_quantity" id="current_quantity" class="form-control @error('current_quantity') is-invalid @enderror" value="{{ old('current_quantity') }}" required>
                                @error('current_quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="transfered_qty">Transfer Quantity:</label>
                                <input type="number" name="transfered_qty" id="transfered_qty" class="form-control @error('transfered_qty') is-invalid @enderror" value="{{ old('transfered_qty') }}" required>
                                @error('transfered_qty')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="department">Department Name:</label>
                                <input type="text" name="department" id="department" class="form-control @error('department') is-invalid @enderror" value="{{ old('department') }}" required>
                                @error('department')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary mt-2">Submit</button>
                            </div>
                        </form>
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">Response</h4>
                                    </div>
                                    <div class="modal-body">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <script>
                          $(document).ready(function() {
    // show modal when button is clicked
    $('#show-modal-button').click(function() {
        $('#myModal').modal('show');
    });
    
    // hide modal when close button or outside the modal is clicked
    $('#myModal').on('hidden.bs.modal', function () {
        $(this).find('form')[0].reset();
    });
    
    // hide modal when close button or outside the modal is clicked
    $(document).on('click', function(event) {
        if ($(event.target).hasClass('modal') || $(event.target).hasClass('close')) {
            $('#myModal').modal('hide');
        }
    });
});




                            const dateInput = document.getElementById('date_created');
                            dateInput.addEventListener('input', () => {
                                dateInput.blur(); // close the calendar
                            });



                            $(document).ready(function() {
                            $('#myForm').submit(function(e) {
                              e.preventDefault();
   
                            // Get the value of the datetime input field
                            let datetime = $('#date_created').val();

                            // Create a new Date object from the datetime value
                            let date = new Date(datetime);

                            // Format the date as a string in the desired format with seconds
                            let formattedDate = date.getFullYear() + '-' + 
                                                ('0' + (date.getMonth() + 1)).slice(-2) + '-' + 
                                                ('0' + date.getDate()).slice(-2) + ' ' +
                                                ('0' + date.getHours()).slice(-2) + ':' + 
                                                ('0' + date.getMinutes()).slice(-2) + ':' + 
                                                ('0' + date.getSeconds()).slice(-2);

                            // Set the value of the date input field to the formatted date
                            $('#date_created').val(formattedDate);


                                console.log(formattedDate)

                                // Submit the form
                                $.ajax({
                                  type: 'POST',
                                  url: $(this).attr('action'),
                                  data: $(this).serialize(),
                                  success: function(response) {
                                    $('#response').text(response);
                                    $('#responseModal').modal('show');
                                  },
                                  error: function() {
                                    alert('An error occurred while submitting the form.');
                                  }
                                });
                              });
                            });

                        </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
