@extends('emails.base-email')

@section('body')
<p>Welcome to Acme</p>
    <p> Please <a href="http://mvc.app:8800/verify-account?token={!! $token !!}"> click here to activate </a> your acount</p>
@stop