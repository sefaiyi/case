<?php

app()->get('/', function () {
    response()->json(['message' => 'Parolapara Case API']);
});

# user
app()->group('/api/user', ['namespace' => 'App\Controllers', function () {
    app()->post('/register', 'UserController@register');
    app()->get('/details', 'UserController@details');
    app()->get('/balance', 'UserController@balance');
}]);

# transaction
app()->group('/api/transaction', ['namespace' => 'App\Controllers', function () {
    app()->post('/make', 'TransactionController@make');
    app()->get('/history', 'TransactionController@history');
}]);