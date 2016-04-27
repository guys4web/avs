                                    <div class="form-group">
                                      <label for="service" class="col-md-6 control-label">How soon would you like to go  ? *</label>
                                      <div class="col-md-6">
                                         <select data-select2="false" class="form-control input" name="payment_type" id="payment_type">
                                           <option @if(isset($cart)) @if($cart->payment_type=='cc') selected="selected" @endif @endif  value="cc">Card credit</option>
                                           <option @if(isset($cart)) @if($cart->payment_type=='check') selected="selected" @endif @endif value="check">Check</option>
                                           <option @if(isset($cart)) @if($cart->payment_type=='money')selected="selected" @endif @endif  value="money" >Money Order</option>
                                         </select>
                                      </div>
                                    </div>
                                    <div class="form-group required">
                                        <label for="cardnum" class="col-sm-4 control-label">Card Number</label>
                                        <div class="col-sm-8">
                                            <input id="cardnum" name="cardnum" type="text" class="form-control"
                                                value="{!! session('cardnum',Input::old('cardnum','')) !!}"/>
                                        </div>
                                        @if(\Session::has('error_cardnum'))
                                            <span class="help-block">{{ \Session::get('error_cardnum') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group required">
                                        <label for="expDate" class="col-sm-4 control-label">Expiration Date</label>

                                        <div class="col-sm-4">
                                            <select data-select2="false" class="form-control" id="expDate-month" name="expDate-month">
                                                <option value="">Month</option>
                                                <option @if(session('expDate-month','')==1) selected="selected" @endif value="1">1</option>
                                                <option @if(session('expDate-month','')==2) selected="selected" @endif value="2">2</option>
                                                <option @if(session('expDate-month','')==3) selected="selected" @endif value="3">3</option>
                                                <option @if(session('expDate-month','')==4) selected="selected" @endif value="4">4</option>
                                                <option @if(session('expDate-month','')==5) selected="selected" @endif value="5">5</option>
                                                <option @if(session('expDate-month','')==6) selected="selected" @endif value="6">6</option>
                                                <option @if(session('expDate-month','')==7) selected="selected" @endif value="7">7</option>
                                                <option @if(session('expDate-month','')==8) selected="selected" @endif value="8">8</option>
                                                <option @if(session('expDate-month','')==9) selected="selected" @endif value="9">9</option>
                                                <option @if(session('expDate-month','')==10) selected="selected" @endif value="10">10</option>
                                                <option @if(session('expDate-month','')==11) selected="selected" @endif value="11">11</option>
                                                <option @if(session('expDate-month','')==12) selected="selected" @endif value="12">12</option>
                                            </select>
                                        </div>

                                        <div class="col-sm-4">
                                          <select data-select2="false" class="form-control" id="expDate-year" name="expDate-year">
                                              @for($i=0;$i<=7;$i++)
                                                <option @if(session('expDate-year','')==(((int)date('Y')) + $i)) selected="selected" @endif value="{{ ((int)date('Y')) + $i }}">{{ ((int)date('Y')) + $i }}</option>
                                              @endfor
                                              <option @if(session('expDate-year','')==2038) selected="selected" @endif value="2038">2038</option>
                                          </select>
                                        </div>
                                        @if(\Session::has('error_expDate'))
                                            <span class="help-block">{{ \Session::get('error_expDate') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group required">
                                        <label for="ccv" class="col-sm-4 control-label">CCV</label>
                                        <div class="col-sm-8">
                                            <input id="ccv" name="ccv" type="text" class="form-control"
                                                   value="{!! session('ccv',Input::old('ccv','')) !!}"/>
                                        </div>
                                        @if(\Session::has('error_ccv'))
                                            <span class="help-block">{{ \Session::has('error_ccv') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group required">
                                        <label for="bname" class="col-sm-4 control-label">Name on Card</label>
                                        <div class="col-sm-8">
                                            <input id="bname" name="bname" type="text" class="form-control"
                                                   value="{!! session('bname',Input::old('bname','')) !!}"/>
                                        </div>
                                        @if(\Session::has('error_bname'))
                                            <span class="help-block">{{ \Session::has('error_bname') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group required">
                                        <label for="baddress" class="col-sm-4 control-label">Billing Address</label>
                                        <div class="col-sm-8">
                                            <input id="baddress" name="baddress" type="text" class="form-control"
                                                   value="{!! session('baddress',Input::old('baddress','')) !!}"/>
                                        </div>
                                        @if(\Session::has('error_baddress'))
                                            <span class="help-block">{{ \Session::get('error_baddress') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group required">
                                        <label for="bcity" class="col-sm-4 control-label">Billing City</label>
                                        <div class="col-sm-8">
                                            <input id="bcity" name="bcity" type="text" class="form-control"
                                                   value="{!! session('bcity',Input::old('bcity','')) !!}"/>
                                        </div>
                                        @if(\Session::has('error_bcity'))
                                            <span class="help-block">{{ \Session::get('error_bcity') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group required">
                                        <label for="bstate" class="col-sm-4 control-label">Billing State</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="bstate" id="bstate" style="width: 100%">
                                                <option selected disabled>Select State</option>
                                                @foreach($states as $id => $item)
                                                    <option value="{{$item}}">{{$item}}</option>
                                                @endforeach
                                           </select>
                                        </div>
                                        @if(\Session::has('error_bstate'))
                                            <span class="help-block">{{ \Session::get('error_bstate') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group required">
                                        <label for="postal" class="col-sm-4 control-label">Billing Postal/zip</label>
                                        <div class="col-sm-8">
                                            <input id="postal" name="postal" type="text" class="form-control"
                                                   value="{!! session('postal',Input::old('postal','')) !!}"/>
                                        </div>
                                        @if(\Session::has('error_postal'))
                                            <span class="help-block">{{ \Session::get('error_postal') }}</span>
                                        @endif
                                    </div>