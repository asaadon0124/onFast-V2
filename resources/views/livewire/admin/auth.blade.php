<div>
     <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form" wire:submit.prevent="login">
                    <span class="login100-form-title p-b-43">
                        <img src="{{ asset('assets/admin/auth/images/logo.jpg') }}" alt="" style="height: 80px; width: 80px; border-radius: 50%;">
                    </span>
                    <span class="login100-form-title p-b-43" style="font-size: 40px; font-weight: bold; color: #333;">
                        Go <span style="color: rgb(224, 131, 0)">Express</span>
                    </span>


                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" wire:model="email">
                        <span class="focus-input100"></span>
                        @error('email') <span class="text-danger" style="color: red;">{{ $message }}</span> @enderror
                        <span class="label-input100">Email</span>
                    </div>


                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" wire:model="password">
                         @error('password') <span class="text-danger" style="color: red;">{{ $message }}</span> @enderror
                        <span class="focus-input100"></span>
                        <span class="label-input100">Password</span>
                    </div>

                    <div class="flex-sb-m w-full p-t-3 p-b-32">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
                            <label class="label-checkbox100" for="ckb1">
                                Remember me
                            </label>
                        </div>

                        <div>
                            <a href="#" class="txt1">
                                Forgot Password?
                            </a>
                        </div>
                    </div>


                    <div class="container-login100-form-btn btn-warning">
                        <button class="btn btn-warning btn-lg btn-block" type="submit" style="background-color: rgb(224, 131, 0); border-radious:10%; color: white; font-weight: bold;">
                            Login
                        </button>
                    </div>

                    {{-- <div class="text-center p-t-46 p-b-20">
                        <span class="txt2">
                            or sign up using
                        </span>
                    </div> --}}

                    {{-- <div class="login100-form-social flex-c-m">
                        <a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
                            <i class="fa fa-facebook-f" aria-hidden="true"></i>
                        </a>

                        <a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                        </a>
                    </div> --}}
                </form>

                <div class="login100-more" style="background-image: url({{ asset('assets/admin/auth/images/logo.jpg') }});">
                </div>
            </div>
        </div>
    </div>
</div>
