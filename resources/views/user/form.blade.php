<input type="hidden" name="_token" value="{{ csrf_token() }}">
@if(isset($user))
    <div class="form-group">
        <label for="exampleInputEmail1">Nombres</label>
        <input type="text" name="name" class="form-control" placeholder="Nombres" value="{{ $user->name }}">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}">
    </div>

@else
    <div class="form-group">
        <label for="exampleInputEmail1">Nombres</label>
        <input type="text" name="name" class="form-control" placeholder="Nombres">
    </div>

    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" name="email" class="form-control" placeholder="Email">
    </div>
@endif
<div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" placeholder="Password">
</div>