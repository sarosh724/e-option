@extends('mails.template.email')
@section('email.content')

    <p>Dear {{ $user->name}},</p>
    <p>Your account has been banned due to over trading</p>

    <p>Team Easy Option</p>

@endsection('email.content')
