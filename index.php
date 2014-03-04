<?php
    /*
        The MIT License (MIT)

        Copyright (c) 2014 Julian Xhokaxhiu

        Permission is hereby granted, free of charge, to any person obtaining a copy of
        this software and associated documentation files (the "Software"), to deal in
        the Software without restriction, including without limitation the rights to
        use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
        the Software, and to permit persons to whom the Software is furnished to do so,
        subject to the following conditions:

        The above copyright notice and this permission notice shall be included in all
        copies or substantial portions of the Software.

        THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
        IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
        FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
        COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
        IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
        CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
    */

    require 'lib/flight/Flight.php';
    require 'app/Tokens.php';
    require 'app/TokensCollection.php';

    Flight::route('/', function(){
        $ret = array(
            'id' => null,
            'results' => array(),
            'error' => null
        );

        $tokens = new TokenCollection(realpath('./_builds/'));
        $ret['results'] = $tokens->getUpdateList();

        Flight::json($ret);
    });

    Flight::route('/api/v1/build/get_delta', function(){
        $ret = array(
            'errors' => null
        );

        $tokens = new TokenCollection(realpath('./_builds/'));
        $delta = $token->getDeltaUpdate();

        if ( $delta === false ) {
            $ret['errors'] = array(
                'message' => 'Unable to find delta'
            );
        } else {
            array_merge($ret, $delta);
        }

        Flight::json($ret);
    });


    Flight::map('notFound', function(){
        // Display custom 404 page
        echo 'Sorry, 404!';
    });

    Flight::start();
?>
