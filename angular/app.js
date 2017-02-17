/**
 * Created by Prasanna on 1/15/2017.
 */
var app = angular.module('rotaApp', ['ngRoute']);

app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider.
        when('/', {
            title: 'Login',
            templateUrl: 'pages/login.html',
            controller: 'loginController',
            role: '0'
        })
        .when('/login', {
            title: 'Login',
            templateUrl: 'pages/login.html',
            controller: 'loginController',
            role: '0'
        })
        .when('/register', {
            title: 'Register',
            templateUrl: 'pages/register.html',
            controller: 'registerController',
            role: '0'
        })
        .when('/dashboard', {
            title: 'Dashboard',
            templateUrl: 'pages/dashboard.html',
            controller: 'dashboardController',
            role: '0'
        })
        .otherwise({
            redirectTo: '/login'
        });
    }])
    .run(function ($rootScope, $location,$http) {
        $http.get('/nextdrive/operations/getUserData.php')
            .then(function (user){
                // you will get user data only when session is valid.
                if (user.data != "")
                {
                    var nic = user.data;
                    nic = nic.replace("\"","").replace("\"","");
                    $rootScope.user = nic;
                    //console.log($rootScope.user);
                    $location.path("/dashboard");
                }
                else
                {
                    $location.path("/login");
                }
            },function (error){

            });
    }).directive('fileModel', ['$parse', function ($parse) {
        return {
            restrict: 'A',
            link: function(scope, element, attrs) {
                var model = $parse(attrs.fileModel);
                var modelSetter = model.assign;

                element.bind('change', function(){
                    scope.$apply(function(){
                        modelSetter(scope, element[0].files[0]);
                    });
                });
            }
        };
    }]).directive('keyEnter', function () {
        return function (scope, element, attrs) {
            element.bind("keydown keypress", function (event) {
                if(event.which === 13) {
                    scope.$apply(function (){
                        scope.$eval(attrs.keyEnter);
                    });

                    event.preventDefault();
                }
            });
        };
    });