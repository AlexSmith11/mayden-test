@component('mail::message')
# My Cart

Here is my current cart. let me know if you want any changes!

@component('mail::button', ['url' => 'http://localhost/api/cart/1'])
Current cart
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
