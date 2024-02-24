<div class="card offset-3 col-6">
  <div class="card-header">
    Featured
  </div>
  <div class="card-body">
    <form wire:submit="storeUser">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input wire:model="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div>
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
  
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Email</label>
    <input wire:model="email" type="email" class="form-control" id="exampleInputPassword1">
    <div>
                    @error('email')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input wire:model="password"  type="password" class="form-control" id="exampleInputPassword1">
    <div>
                    @error('password')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
  <div class="mb-3">
    Already have a account? <button href="/login" class="btn btn-success">Login</button>
  </div>
</form>
  </div>
</div>