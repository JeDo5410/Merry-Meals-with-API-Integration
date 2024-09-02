@section('title')
    Welcome
@endsection

@extends('Users.Member.layouts.app')

@section('content')

		<div id="fh5co-services-section">
            @if (Session::has('dataInform'))
                <h4 class="alert alert-warning animate-box text-center" role="alert">
                    {{ Session::get('dataInform') }}
                </h4>
            @endif
			<div class="container">
				<div class="row display-flex justify-content">
					<div class="col-md-6 col-sm-6 col-md-offset-3">
						<div class=" animate-box">
							<div class="col-md-12 ">
                                <h3>Reassesment</h3>
                                <form action="{{ route('member#newReassesment', Auth()->user()->id) }}" method="POST">
                                    @csrf

                                    {{-- REASON FOR REASSESMNET --}}
                                        <label class="userManagement">Why you want to extend the time of receiving this charity?</label><br>
                                        <textarea rows="5" name="member_extends_reason" class="input-md col-md-12" type="text">{{ old('member_extends_reason', $memberData->member_extends_reason) }}</textarea><br><br><br>
                                    {{-- END OF REASSESMENT REASON --}}

                                    <div class="text-center">
                                        <button class="btn-primary">Send</button> &nbsp;
                                        <a href="{{ route('member#index') }}">Cancel</a>
                                    </div>
                                </form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- END What we do -->

@endsection