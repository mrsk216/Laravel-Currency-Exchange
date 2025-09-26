@extends('layouts.default')
@section('content')
    <div class="container-fluid h-100">
        <div class="row justify-content-center align-items-center h-100">
            <div class="col-10 col-md-8 col-lg-6 col-xl-4 shadow-lg text-center rounded-4 p-4">
                <h2 class="mb-4">Currency Exchange Form</h2>
                <div class="input-group">
                    <span class="input-group-text">Amount</span>
                    <input type="text" id="amount" class="form-control form-control-lg" value="0" min="0" autocomplete="off">
                </div>
                <div class="d-flex gap-3 my-3">
                    <select name="from_currency" id="from" class="form-select">
                        @isset($currencies)
                            @foreach ($currencies as $code)
                                <option value="{{ $code }}" @if($code === "USD") selected @endif>{{ $code }}</option>
                            @endforeach
                        @endisset
                    </select>
                    <button type="button" id="reverse" class="border-0 bg-transparent p-0 m-0">
                        <img src="{{ asset('assets/images/left-and-right.png') }}" alt="exchange icon" class="icon">
                    </button>
                    <select name="to_currency" id="to" class="form-select">
                        @isset($currencies)
                            @foreach ($currencies as $code)
                                <option value="{{ $code }}" @if($code === "BDT") selected @endif>{{ $code }}</option>
                            @endforeach
                        @endisset
                    </select>
                </div>

                <div class="input-group">
                    <span class="input-group-text">Exchange Rate</span>
                    <input type="text" id="rate" class="form-control form-control-lg" value="0" readonly>
                </div>
                <p class="text-danger mt-3" id="error"></p>
            </div>
        </div>
    </div>
@endsection
