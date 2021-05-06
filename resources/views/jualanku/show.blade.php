@extends('layouts.app')

@section('title', 'Jualanku')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Link Invoice Customer</div>

        <div class="card-body">
        <form class="row d-flex justify-content-center form-link">
          <div class="col-7">
            <input type="text" class="form-control" value="{{url('/').'/order/'.$invoice}}" id="copyMe" readonly>
          </div>
          <div class="col-5">
            <button onclick="myFunction()" class="btn btn-primary mb-3">Copy link</button>
          </div>
        </form>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@section('extra-js')
<script>
function myFunction() {
  var copyText = document.getElementById("copyMe");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Link berhasil di copy: " + copyText.value);
}
</script>
@endsection