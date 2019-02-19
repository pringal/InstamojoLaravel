


<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Error Alert!</strong> {{ $message }}
            </div>
            @endif
            {!! Session::forget('error') !!}
            @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Success Alert!</strong> {{ $message }}
            </div>
            @endif
            {!! Session::forget('success') !!}
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-10">
                            <strong>Pay With Instamojo</strong>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ URL::route('payment') }}">
                        @csrf
                        <div class="form-group">
                            <label for="purpose" class="col-md-12 col-form-label">Purpose</label>
                            <div class="col-md-12">
                                <input id="purpose" type="text" class="form-control" name="purpose" value="" required>
                                @if ($errors->has('purpose'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('purpose') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="buyer_name" class="col-md-12 col-form-label">Buyer Name</label>
                            <div class="col-md-12">
                                <input id="buyer_name" type="text" class="form-control" name="buyer_name" value="" required>
                                @if ($errors->has('buyer_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('buyer_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="amount" class="col-md-12 col-form-label">Amount</label>
                            <div class="col-md-12">
                                <input id="amount" type="number" class="form-control" name="amount" value="" required>
                                @if ($errors->has('amount'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-md-12 col-form-label">Phone No.</label>
                            <div class="col-md-12">
                                <input id="phone" type="number" class="form-control" name="phone" value="" required>
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-md-offset-3">
                                <button type="submit" class="btn btn-primary btn-block desabled" id="submitUser">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>  
</div>


