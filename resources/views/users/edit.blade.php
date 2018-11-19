<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

</head>
<body>
    <div>
        <div>
            <!-- Branding Image -->
            <a href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <ul>
            <!-- Authentication Links -->
            @guest
                <li><a href="{{ route('login') }}">Login</a></li>
            @else
                        <li>{!! link_to_route('users.index', 'Users') !!}</li>
                            @can('admin-higher')
                                <li><a href="{{ route('register') }}">Register</a></li>
                            @endcan
                        <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                </li>
            @endguest
        </ul>
    </div>

    <h1>User Email : {{ $user->email }}</h1>
    <img class="media-object img-rounded img-responsive" src="{{ Gravatar::src($user->email, 100) }}" alt="">
    <p>User ID : {{ $user->id }}</p>
    <p>User Name : {{ $user->name }}</p>
    @switch($user->role)
        @case(1)
            <p>User Role : System-Administrator</p>
            @break
            
        @case(3)
            <p>User Role : Administrator</p>
            @break
            
        @case(5)
            <p>User Role : CRUD</p>
            @break
        
        @case(7)
            <p>User Role : CRU</p>
            @break
        
        @case(8)
            <p>User Role : Read & Update</p>
            @break
        
        @case(10)
            <p>User Role : Read-Only</p>
            @break
        
        @default
            <p>User Role : Unkwoun</p>
    @endswitch
    
    <p>Last Login : {{ $user->last_login_at }}</p>
    
    <p>Create Date : {{ $user->created_at }}</p>
    
    <p>Update Date : {{ $user->updated_at }}</p>
    
    <h1>ID:{{ $user->id }} EDIT</h1>
    
    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    
    {!! Form::model($user, ['route' => ['users.update', $user->id], 'class' => 'form-horizontal', 'method' => 'put']) !!}
        <div>
        {!! Form::label('name', 'Name:') !!}
        {!! Form::text('name') !!}
        </div>
        <!--
        <div>
        {!! Form::label('email', 'Email:') !!}
        {!! Form::email('email') !!}
        </div>
        -->
        @can('admin-higher')
            <div>
                {!! Form::label('role', 'Role:') !!}
                @if($user->role === 1)
                    {!! Form::select('role', [
                        '10' => 'Read Only',
                        '8' => 'R&U',
                        '7' => 'CRU',
                        '5' => 'CRUD',
                        '3' => 'Administrator',
                        '1' => 'SA'
                    ]) !!}
                @else
                    {!! Form::select('role', [
                        '10' => 'Read Only',
                        '8' => 'R&U',
                        '7' => 'CRU',
                        '5' => 'CRUD',
                        '3' => 'Administrator',
                    ]) !!}
                @endif
            </div>
        @endcan
        <!--
        <div>
        {!! Form::label('password', 'Password:') !!}
        {!! Form::password('password') !!}
        </div>
        
        <div>
        {!! Form::label('password-confirmation', 'Confirm Password:') !!}
        {!! Form::password('password-confirmation') !!}
        </div>
        -->
        <div>
        {!! Form::submit('EDIT', ['class' => 'btn btn-danger btn-lg btn-block']) !!}
        </div>
    {!! Form::close() !!}

</body>
</html>
