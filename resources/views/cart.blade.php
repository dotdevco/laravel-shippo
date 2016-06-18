@extends('layouts.main')

@section('content')
	<h1>Cart</h1>
	<table class="table">
		<tr>
			<th>Qty</th>
			<th>Name</th>
			<th>Price</th>
		</tr>
		<tr>
			<td>1</td>
			<td>Small T-Shirt</td>
			<td>$19.99</td>
		</tr>
		<tr>
			<td colspan="2" class="text-right"><strong>Total:</strong></td>
			<td>$19.99</td>
		</tr>
	</table>

	<h2>Create an account</h2>
	<hr>
	<form action="/cart" method="post">
		{{ csrf_field() }}
		<div class="form-group">
			<label for="name">Your Name</label>
			<input type="text" class="form-control" id="name" name="name" value="John Doe">
		</div>
		<div class="form-group">
			<label for="email">Comapny</label>
			<input type="text" class="form-control" id="email" name="company" value="Acme Inc.">
		</div>
		<div class="form-group">
			<label for="email">Your Email</label>
			<input type="text" class="form-control" id="email" name="email" value="test@example.org">
		</div>
		<div class="form-group">
			<label for="password">Your Password</label>
			<input type="text" class="form-control" id="password" name="password" value="password">
		</div>
		<div class="form-group">
			<label for="street1">Street Address</label>
			<input type="text" class="form-control" id="street1" name="street1" value="215 Clayton St.">
		</div>
		<div class="form-group">
			<label for="city">City</label>
			<input type="text" class="form-control" id="city" name="city" value="San Francisco">
		</div>
		<div class="form-group">
			<label for="state">State</label>
			<input type="text" class="form-control" id="state" name="state" value="CA">
		</div>
		<div class="form-group">
			<label for="zip">zip</label>
			<input type="text" class="form-control" id="zip" name="zip" value="94117">
		</div>
		<div class="form-group">
			<label for="country">Country</label>
			<input type="text" class="form-control" id="country" name="country" value="US">
		</div>
		<div class="form-group">
			<label for="phone">Phone</label>
			<input type="text" class="form-control" id="phone" name="phone" value="+1 555 341 9393">
		</div>
		<button class="btn btn-default">Next</button>
	</form>
@endsection