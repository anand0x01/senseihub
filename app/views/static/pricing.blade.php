@extends('layouts.static')
@section('content')
<div class="top_margin privacy_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <h2>Pricing</h2>
                <h4>Organisations</h4>
                <p>Organizations pay the student a standardized stipend: <strong>$0, $50, $100, $200, $300 or $500</strong>. Please keep in mind minimum wage and labor laws when choosing your stipend. <strong>SensiHub</strong>’s standard nominal 10% fee to provide you the marketplace and PayPal charges are added to the stipend.</p>
                <h4>Students</h4>
                <p>Students don’t pay anything to use the marketplace.</p>
                <p>To illustrate our fees, if a Student accepts an Organization stipend of $200, the Organization will pay to <strong>SensiHub</strong> $226 ($200 + $20 Service Fee + $6 Transaction Fee). Once work is complete, <strong>SensiHub</strong> will transfer to the Student $200.</p>
                <div class="row pricing_table">
                    <div class="col-xs-12 col-md-8 center-block">
                        <div class="table-responsive">
                          <table class="table table-striped">
                            <thead>
                                <tr>
                                  <th>Recommended Stipend* (USD)</th>
                                  <th>Undergrad</th>
                                  <th>Grad</th>
                                  <th>PHD</th>
                                </tr>
                             </thead>
                             <tbody>
                                <tr>
                                    <td>Melbourne</td>
                                    <td>300</td>
                                    <td>500</td>
                                    <td>500</td>
                                </tr>
                                <tr>
                                    <td>Eg:- New York, Hong Kong, London, San Francisco, Tokyo</td>
                                    <td>200</td>
                                    <td>300</td>
                                    <td>500</td>
                                </tr>
                                <tr>
                                    <td>Eg:- Warsaw, Vienna, Austin, Shanghai, Tel Aviv, Sao Paolo, Moscow</td>
                                    <td>100</td>
                                    <td>200</td>
                                    <td>300</td>
                                </tr>
                                <tr>
                                    <td>Eg:- Manila, Mumbai, Hanoi</td>
                                    <td>50</td>
                                    <td>100</td>
                                    <td>200</td>
                                </tr>
                                <tr>
                                    <td><small>*Figures are recommended using minimum wage as a baseline</small></td>
                                </tr>
                             </tbody>
                          </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
