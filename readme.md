# Example Shippo Laravel Project

This is a companion project to the following tutorial: [Easily handle shipping in Laravel with Shippo](https://dotdev.co/easily-handle-shipping-in-laravel-with-shippo-12055c903704#.izbng6oyo)

It's a standard Laravel application with the minimum setup to demonstrate the following [Shippo](https://goshippo.com) features:

* Validating a shipping address
* Getting a list of shipping rates
* Generating a shipping transaction and label

The primary example files are:

 * [Shipping.php](https://github.com/dotdevco/laravel-shippo/blob/master/app/Services/Shipping.php)
 * [Cart Controller](https://github.com/dotdevco/laravel-shippo/blob/master/app/Http/Controllers/CartController.php)
 * [Checkout Controller](https://github.com/dotdevco/laravel-shippo/blob/master/app/Http/Controllers/CheckoutController.php)
 * [Rates Selection View](https://github.com/dotdevco/laravel-shippo/blob/master/resources/views/checkout/index.blade.php)
