@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Wallet Balance : $ {{ $user->balance}}</p>

                    <form action="{{ url('/sendmoney')}}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Recipient's Email :</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required autofocus>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label text-md-right">Amount :</label>

                            <div class="col-md-6">
                                <input id="amount" type="numeric" class="form-control" name="amount"  required autofocus>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Send Money
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
