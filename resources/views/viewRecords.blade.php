@extends('layouts.app')

@section('title', 'View Records')

@section('content')
    
	<main>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date Created</th>
                    <th>Username</th>
                    <th>Product Name</th>
                    <th>Current Quantity</th>
                    <th>Transfer Quantity</th>
                    <th>Department Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records  as $record)
                {{-- @foreach($records  as $inventories) --}}
                {{-- @foreach($inventories as $record) --}}
                
                <tr>
                    <td>{{ $record['date_created'] }}</td>
                    <td>{{ $record['username'] }}</td>
                    <td>{{ $record['product'] }}</td>
                    <td>{{ $record['current_quantity'] }}</td>
                    <td>{{ $record['transfered_qty'] }}</td>
                    <td>{{ $record['department'] }}</td>
                </tr>
                {{-- @endforeach --}}
                @endforeach
            </tbody>
        </table>
    </main>
@endsection
