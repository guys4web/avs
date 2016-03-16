<div class="panel panel-primary">
    <div class="panel-heading">
        <h4 class="panel-title">Billing informations</h4>
    </div>
    <div class="panel-body">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td>
                        Billing City : <br/>
                        <label> {{ $order->billing_data['bcity'] }} </label>
                    </td>
                    <td>
                        Billing Address : <br/>
                        <label> {{ $order->billing_data['baddress'] }} </label>
                    </td>
                </tr>
                <tr>
                    <td>
                        Billing State : <br/>
                        <label> {{ $order->billing_data['bstate'] }} </label>
                    </td>
                    <td>
                        Postal : <br/>
                        <label> {{ $order->billing_data['postal'] }} </label>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

