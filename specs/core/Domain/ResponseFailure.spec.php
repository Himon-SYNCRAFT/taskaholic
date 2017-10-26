<?php

use Taskaholic\Core\Domain\ResponseFailure;


describe('ResponseFailure', function() {
    describe('construct', function() {
        it('create proper object if given array of errors', function() {
            $errors = ['error1', 'error2'];
            $response = new ResponseFailure($errors);

            expect($response->getErrors())->to->equal($errors);
        });

        it('create proper object if given error as a string', function() {
            $error = 'error1';
            $response = new ResponseFailure($error);

            expect($response->getErrors())->to->equal([$error]);
        });
    });

    describe('->addError()', function() {
        it('add error to errors list', function() {
            $response = new ResponseFailure('error1');
            expect($response->getErrors())->to->equal(['error1']);

            $response->addError('error2');
            expect($response->getErrors())->to->equal(['error1', 'error2']);
        });
    });
});
