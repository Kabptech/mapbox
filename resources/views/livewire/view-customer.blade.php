<div class="card">
  <div class="card-header">
  Customer View
  </div>
  <div class="card-body">
    <h5 class="card-title">{{$customer->name}}</h5>
    <p class="card-text">{{$customer->email}}</p>
    <p class="card-text">{{$customer->phone}}</p>
    <a wire:navigate href="/customers" class="btn btn-primary">Back</a>
  </div>
</div>
