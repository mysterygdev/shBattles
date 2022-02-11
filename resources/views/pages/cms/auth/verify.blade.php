@extends('layouts.cms.app')
@section('index', 'verify')
@section('title', 'Verify')
@section('zone', 'CMS')
@section('content')
  @include('partials.cms.nav')
  @include('partials.cms.pageHeader')
  <section class="blog-area ptb-100">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-12">
          <div class="row">
            @if ($data['verify']->getActivationData($data['id']))
              @if ($data['verify']->getActivationData($data['id'])->Verified == 1)
                your account: <strong>{{$data['verify']->getActivationData($data['id'])->UserID}}</strong> has already been activated.
              @else
                Account: <strong>{{$data['verify']->getActivationData($data['id'])->UserID}}</strong> found, activating...
                @if ($data['verify']->getUserStatus($data['verify']->getActivationData($data['id'])->UserID) == '-1' || $data['verify']->getUserStatus($data['verify']->getActivationData($data['id'])->UserID) == '-5')
                  It looks like your account is banned, therefore we cannot activate your account.
                @else
                  {{-- {{$data['verify']->updateUserStatus($data['verify']->getActivationData($data['id'])->UserID, 16)}}
                  {{$data['verify']->updateVerified($data['verify']->getActivationData($data['id'])->UserID, 1)}} --}}
                  @if ($data['verify']->updateUserStatus($data['verify']->getActivationData($data['id'])->UserID, 16) && $data['verify']->updateVerified($data['verify']->getActivationData($data['id'])->UserID, 1))
                    Your account has been successfully activated.
                  @else
                    There was an error attempting to verify your account.
                  @endif
                @endif
              @endif
            @else
              Activation Key Doesn't Exist
            @endif
          </div>
        </div>
        @include('partials.cms.widgets')
      </div>
    </div>
  </section>
  @include('layouts.cms.footer')
@endsection
