/**
 * Created by Prasanna on 1/15/2017.
 */
app.controller('registerController', function($scope, $rootScope, $location, $http) {
    // more angular JS codes will be here

    $scope.message = "this is register page";

    $scope.clearForm = function(){
        $scope.nic = "";
        $scope.password = "";
        $scope.confPassword = "";
    }
    // clear form
    $scope.clearForm();

    // change modal title
    $('#modal-product-title').text("Sign Up");

    $('#modal-register-form').show();

    // show create product button
    $('#btn-create-product').show();

    $scope.register = function () {
        // fields in key-value pairs
        if ($scope.password == $scope.confPassword) {
            $http.post('/nextdrive/operations/register.php', {
                    'nic': $scope.nic,
                    'password': $scope.password
                }
            ).then(
                function (data, status, headers, config)
                {
                    console.log(data);
                    //$('#error').html(data.data);

                // clear modal content
                    $scope.clearForm();
                },
                function (error)
                {
                    console.log(error.data);
                    //$('#error').html(error.data);
                }
            );
        }
        else
        {
            console.log($scope.password);
            console.log($scope.confPassword);
            console.log("password miss match");
            $('#error').html("password miss match");
        }
    }

    $scope.login = function () {
        $location.path('/login');
    }

});