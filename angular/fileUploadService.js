/**
 * Created by Prasanna on 2/5/2017.
 */

app.service('fileUpload', ['$http', function ($http) {
    this.uploadFileToUrl = function(file, uploadUrl, name){
        var fd = new FormData();
        fd.append('file', file);
        fd.append('name', name);
        $http.post(uploadUrl, fd, {
            transformRequest: angular.identity,
            headers: {'Content-Type': undefined,'Process-Data': false}
        }).then(
            function (data)
            {
                //console.log("Success");
                return data;
            },
            function (error)
            {
                //console.log(error.data);
                return error;
            }
        );
    }
}]);
