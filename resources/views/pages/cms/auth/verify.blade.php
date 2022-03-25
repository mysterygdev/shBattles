@extends('layouts.cms.app')
@section('index', 'patchNotes')
@section('title', 'Patch Notes')
@section('zone', 'CMS')
@section('content')
@include('partials.cms.nav')

  <section class="content-wrap">
    <div class="youplay-banner banner-top youplay-banner-parallax small">
      <div class="image" style="background-image: url('/resources/themes/YouPlay/images/template/banner-blog-bg.jpg')"></div>

      <div class="info">
        <div>
          <div class="container">
            <h1>Verificaiton</h1>
          </div>
        </div>
      </div>
    </div>

    <div class="container youplay-content text-center">
        <h2 class="mt-0">Verification</h2>
        @if ($data['verify']->getActivationData($data['id']))
          @if ($data['verify']->getActivationData($data['id'])->Verified == 1)
            your account: <strong>{{$data['verify']->getActivationData($data['id'])->UserID}}</strong> has already been activated.
          @else
            Account: <strong>{{$data['verify']->getActivationData($data['id'])->UserID}}</strong> found, activating...
            @if ($data['verify']->getUserStatus($data['verify']->getActivationData($data['id'])->UserID) == '-1' || $data['verify']->getUserStatus($data['verify']->getActivationData($data['id'])->UserID) == '-5')
                It looks like your account is banned, therefore we cannot activate your account.
            @else
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
  </section>

@include('layouts.cms.footer')
@include('layouts.cms.scripts')
@endsection

