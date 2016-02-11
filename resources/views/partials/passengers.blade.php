@foreach($cart->cartItems as $item)
<div class="row">
  <div class="col-xs-12">
    <h3>
      {{  $item->product->service->name }}
      <br/>
      {{ $item->product->visa->name }}
    </h3>
      <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
          @foreach($item->passengers as $passenger)
          <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="heading{{ $passenger->id  }}">
              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $passenger->id  }}" aria-expanded="true" aria-controls="collapse{{ $passenger->id  }}">
                  #{{ $passenger->id  }}
                </a>
              </h4>
            </div>
            <div id="collapse{{ $passenger->id  }}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading{{ $passenger->id  }}">
              <div class="panel-body">
                  <table class="table table-striped">
                      <tr>
                          <td>
                              <small class="text-uppercase gra" >Gender</small>
                              <br/>
                              {{  $passenger->gender }}
                          </td>
                          <td>
                              <small class="text-uppercase gra">Birthday</small>
                              <br/>
                              {{  $passenger->birthday }}
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <small class="text-uppercase gra">First name</small>
                              <br/>
                              {{  $passenger->first_name }}
                          </td>
                          <td>
                              <small class="text-uppercase gra">Last name</small>
                              <br/>
                              {{  $passenger->last_name }}
                          </td>
                      </tr>
                      <tr>
                          <td>
                              <small class="text-uppercase gra">PassPort Num</small>
                              <br/>
                              {{  $passenger->passport_num }}
                          </td>
                          <td>
                              <small class="text-uppercase gra">PassPort ExpDate</small>
                              <br/>
                              {{  $passenger->passport_expirate }}
                          </td>
                      </tr>
                  </table>
              </div>
            </div>
          </div>
          @endforeach
          <!-- end -->
          <!-- end -->
        </div>
    </div>
</div>
@endforeach
