@extends('layouts.app')

@section('title','Users')


@section('content')


<!-- Sidebar -->
@include('components.sidebar')


<div class="container">
  <div class="row">
    <div class="col">
      <div class="card m10" style="width: 18rem;">
<div class="row">
  <div class="col">
    <input type="text" class="form-control" placeholder="First name" aria-label="First name">
  </div>
  <div class="col">
    <div class="mb-3">
    <label class="form-label">Date & Time</label>

    <input
        type="datetime-local"
        class="form-control"
        name="effective_date"
        value="{{ now()->format('Y-m-d\TH:i') }}"
    >
</div>
  </div>
</div>
      </div>
   
    </div>
    <div class="col-6">
      2 of 3 (wider)
    </div>
    <div class="col">
      3 of 3
    </div>
  </div>
  <div class="row">
    <div class="col">
      1 of 3
    </div>
    <div class="col-5">
      2 of 3 (wider)
    </div>
    <div class="col">
      3 of 3
    </div>
  </div>
</div>


@endsection

@push('scripts')





@endpush