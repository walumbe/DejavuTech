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
                        <form id="myForm" action="{{ route('submitRecord') }}" method="POST">
                            @csrf

                            <div class="form-group">
                                <label for="date_created">Date Created:</label>
                                <input type="datetime-local" name="date_created" id="date_created" class="form-control @error('date_created') is-invalid @enderror" value="{{ old('date_created') }}" required>
                                @error('date_created')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            

                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" name="username" id="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required>
                                @error('username')
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
                            const dateInput = document.getElementById('date_created');
                            dateInput.addEventListener('input', () => {
                                dateInput.blur(); // close the calendar
                            });
                            // Get the modal element
                            var modal = document.getElementById('myModal');
                    
                            // Get the close button element
                            // var closeBtn = document.getElementsByClassName('close')[0];
                            var closeBtn = document.getElementsByClassName('btn btn-default')[0];
                    
                            // // When the form is submitted, show the modal with the API response
                            @if(isset($response))
                            modal.style.display = 'block';
                            @endif
                    
                            // // When the user clicks on the close button, hide the modal
                            closeBtn.onclick = function() {
                                modal.style.display = 'none';
                            }

                            $(document).ready(function() {
                                $('#myForm').submit(function(e) {
                                    e.preventDefault();
                                    var data = {
                                        date_created: $('#date_created').val(),
                                        username: $('#username').val(),
                                        product: $('#product').val(),
                                        current_quantity: $('#current_quantity').val(),
                                        transfered_qty: $('#transfered_qty').val(),
                                        department: $('#department').val()
                                    };
                                    $.ajax({
                                        type: 'POST',
                                        url: 'https://dejavutechkenya.com/dejavuurls/dejavuurls.php',
                                        data: JSON.stringify(data),
                                        contentType: 'application/json',
                                        success: function(response) {
                                            $('#myModal .modal-body').html(response);
                                            $('#myModal').modal('show');
                                        },
                                        error: function(response) {
                                            $('#myModal .modal-body').html('Error: ' + response.statusText);
                                            $('#myModal').modal('show');
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
