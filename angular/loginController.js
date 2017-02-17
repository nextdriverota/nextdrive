/**
 * Created by Prasanna on 1/15/2017.
 */
app.controller('loginController', function($scope, $rootScope, $location, $http) {
    // more angular JS codes will be here

    $scope.message = "this is login page";

    // css rule manipulation
    $('.darker').removeClass('white-bg');
    $('.container').addClass('login-cont');
    $scope.addOverflow = function () {
        $("html").css({'overflow':'hidden'});
        $("body").css({'overflow':'hidden'});
        $(".fullheight").css({'overflow':'hidden'});
    }
    $scope.addOverflow();

    $scope.clearForm = function(){
        $scope.nic = "";
        $scope.password = "";
    }
    // clear form
    $scope.clearForm();

    $scope.login = function () {
        if ($scope.password != "" && $scope.nic != "")
        {
            $http.post('/nextdrive/operations/login.php', {
                    'nic': $scope.nic,
                    'password': $scope.password
                }
            ).then(
                function (data, status, headers, config)
                {
                    if (data.data == "true")
                    {
                        // clear modal content
                        $scope.clearForm();

                        $location.path('/dashboard');
                        location.reload();
                    }
                    else
                    {
                        $('#error').html('Incorrect username or password');
                    }

                },
                function (error)
                {
                    console.log(error.data);
                    $('#error').html('Incorrect username or password');
                }
            );
        }
    }

    $scope.sign_up = function () {
        $location.path('/register');
    }
});