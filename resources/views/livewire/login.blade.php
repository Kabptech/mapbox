<div class="card offset-3 col-6">
  <div class="card-header">
    Login
  </div>
  <div class="card-body">
    <form wire:submit="loginUser">
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
  
  <button type="submit" class="btn btn-primary">Login</button>
  <div class="mb-3">
    Don't have a account <button href="/register" class="btn btn-success">Register</button>
  </div>
</form>
  </div>
</div>
