@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-5">
    <!-- start new id  -->
    <div id = "new-id">
       <div class="row">
           <!-- stat draw section  -->
           <div class="col-lg-6 col-md-10 col-sm-12 draw-section ">
               <div class="section-title">
                   <span class="title" data-aos="fade-up" data-aos-duration="600">Register</span>
               </div>
               <form method="POST" action="{{ route('register') }}">
                @csrf

                    <div class="" data-aos="fade-up" data-aos-duration="600">
                        
                        <div class="row d-flex justify-content-center align-items-center">
                                
                            <div class="col-3">
                                <div class="input-group mb-3">
                                    <label for="name" class="">{{ __('Name') }}</label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            
                         </div>
                        </div>

                       <div class="row d-flex justify-content-center align-items-center">
                        
                        <div class="col-3">
                            <div class="input-group mb-3">
                                <label for="email" class="">{{ __('Email Address') }}</label>
                            </div>
                        </div>
                           <div class="col-6">
                               <div class="input-group mb-3">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                               </div>
                               @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                           </div>
                           
                       </div>

                       <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-3">
                            <div class="input-group mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                      </div>


                      
                      <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-3">
                            <div class="input-group mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="input-group mb-3">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        
                      </div>
                 
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-3 offset-8">
                            {{-- <input type="button" class="btn btn-primary btn1 px-3" value="Login"/> --}}
                            <button type="submit" class="btn btn-primary btn1 px-3">
                                {{ __('Regiter') }}
                            </button>
                        </div>
                    </div>
                      
               </div>
            </form>
           </div>
           <!-- end draw section  -->
            <!--start for image  -->
           <div class="col-lg-6 col-md-10 col-sm-12">
               <div class="img-box" data-aos="fade-up" data-aos-duration="600">
                   <img src="/images/loginpage.jpg" alt="" class="img w-100">
               </div>
           </div>
           <!--end for image  -->
       </div>

    </div>
    <!-- start new id   -->
</div>
   

@endsection
