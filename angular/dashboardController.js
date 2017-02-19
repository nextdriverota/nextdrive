/**
 * Created by Prasanna on 1/15/2017.
 */
app.controller('dashboardController', function($scope, $rootScope, fileUpload, $timeout, $location, $http) {

    /* ***************************************
     * css rule manipulation
     * ***************************************
     */

    $('.darker').addClass('white-bg');
    $('.container').removeClass('login-cont');
    $scope.addOverflow = function () {
        $("html").css({'overflow':'visible'});
        $("body").css({'overflow':'visible'});
        $(".fullheight").css({'overflow':'visible'});
    }
    $scope.addOverflow();

    $scope.publicProfile = function () {
        /*$scope.edit_profile_section = false;
        $scope.public_profile_section = true;*/
        location.reload();
    }

    $scope.editProfile = function () {
        $scope.public_profile_section = false;
        $scope.edit_profile_section = true;
    }

    /* ***************************************
     * Utility functions
     * ***************************************
     */

    var years = function() {
        var endYear = new Date().getFullYear() + 5, years = [];
        var startYear = 1990;

        years.push("-");

        while ( startYear <= endYear ) {
            years.push(endYear--);
        }

        return years;
    }

    $scope.yearList = years();

    $scope.degreeList = ["Select the degree level you achieved","High School or equivalent","Vocational training","Certification (Diploma)","Bachelor's degree","Master's degree"];

    var dateFormat = function (str,noDate) {
        var date = new Date(str);
        var date_date = date.getDate();
        var date_month = date.getMonth();
        var date_year = date.getFullYear();

        var monthNames = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"];

        if (noDate)
        {
            return monthNames[date_month] + " " + date_year;
        }
        else
        {
            return date_date + " " + monthNames[date_month] + " " + date_year;
        }
    }

    var period = function( date1, date2 ) {

        var month=1000*60*60*24*30;

        var date1_ms = date1.getTime();
        var date2_ms = date2.getTime();

        var difference_ms = date2_ms - date1_ms;

        return Math.round(difference_ms/month);
    }

    var chipList = [];
    var chipArr = [];
    var initChips = null;

    var createChipList = function (arr) {
        var s = '{"data":['
        for (a in arr)
        {
            s += '{"tag": "' + arr[a] + '"}'+ (a < arr.length - 1 ? ',' : '');
        }
        s += ']}';
        return JSON.parse(s);
    }

    $('.chips').on('chip.add', function(e, chip){
        chipList.push(chip);
    });

    $('.chips').on('chip.delete', function(e, chip){
        chipList.splice(chipList.indexOf(chip),1);
    });

    var initInterests = function () {
        $('.chips-placeholder').material_chip({
            placeholder: 'Enter a Interest',
            secondaryPlaceholder: '+Tag',
            data: chipList,
        });
    }

    /* ***************************************
     * Background section
     * ***************************************
     */

    $scope.openUploadResume = function () {
        $scope.CVmessageBox = true;
    }

    $scope.openUploadPropic = function () {
        $scope.ProPicMessageBox = true;
    }

    $scope.closeMsgProPic = function () {
        $scope.ProPicMessageBox = false;
    }

    $scope.uploadImage = function () {
        $uploadCrop.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function (resp) {
            $http.post('/nextdrive/operations/propic/upload.php', {
                    'nic': $rootScope.user,
                    'image': resp,
                }
            ).then(
                function (data)
                {
                    console.log(data.data);
                },
                function (error)
                {
                    console.log(error.data);
                }
            );
        });
    }

    $scope.closeMsgCV = function () {
        $scope.CVmessageBox = false;
    }

    $scope.uploadResume = function () {
        var file = $scope.pdfFile;
        //console.log(file);
        if (file != null)
        {
            $http.post('/nextdrive/operations/cv/delete.php', {
                    'nic': $rootScope.user
                }
            ).then(
                function (data)
                {
                    var uploadUrl = "/nextdrive/operations/cv/upload.php";
                    var text = $rootScope.user;
                    fileUpload.uploadFileToUrl(file, uploadUrl, text);
                    $scope.CVmessageBox = false;
                    loadCV();
                },
                function (error)
                {
                    console.log(error.data);
                }
            );

        }
    }

    var loadCV = function () {
        $http.post('/nextdrive/operations/cv/search.php', {
                'nic': $rootScope.user
            }
        ).then(
            function (data)
            {
                if (data.data != "")
                {
                    setCV(data.data);
                }
                else
                {
                    $scope.downloadCV = true;
                }
            },
            function (error)
            {
                console.log(error.data);
            }
        );
    }

    $scope.saveLinks = function (info) {

        if (info == null)
        {
            console.log("info null");
        }
        else
        {
            var info_linkedin = "";
            var info_facebook = "";
            var info_googleplus = "";
            var info_twitter = "";
            var info_blog = "";
            var info_background = "";

            if (info.linkedin != null)
            {
                info_linkedin = info.linkedin;
            }
            if (info.facebook != null)
            {
                info_facebook = info.facebook;
            }
            if (info.googleplus != null)
            {
                info_googleplus = info.googleplus;
            }
            if (info.twitter != null)
            {
                info_twitter = info.twitter;
            }
            if (info.blog != null)
            {
                info_blog = info.blog;
            }
            if (info.background != null)
            {
                info_background = info.background;
            }

            $http.post('/nextdrive/operations/links/deleteLinks.php', {
                    'nic': $rootScope.user
                }
            ).then(
                function (data)
                {
                    console.log(data);
                },
                function (error)
                {
                    console.log(error.data);
                }
            );

            $http.post('/nextdrive/operations/links/saveLinks.php', {
                    'nic': $rootScope.user,
                    'background': info_background,
                    'linkedin': info_linkedin,
                    'facebook': info_facebook,
                    'googleplus': info_googleplus,
                    'twitter': info_twitter,
                    'blog': info_blog
                }
            ).then(
                function (data)
                {
                    if (data.data)
                    {
                        console.log(data);
                       // $(".personal-info form input").val("");
                    }
                    else
                    {
                        console.log("Cannot Save");
                    }
                },
                function (error)
                {
                    console.log(error.data);
                }
            );
        }
    }

    var loadLinks = function () {
        if ($rootScope.user != "")
        {
            $http.post('/nextdrive/operations/links/loadLinks.php', {
                    'nic': $rootScope.user
                }
            ).then(
                function (data)
                {
                    if (data.data != "null")
                    {
                        setLinks(data.data[0]);
                    }
                    else
                    {
                        var info = {
                            LINKEDIN : "",
                            FACEBOOK : "",
                            GOOGLEPLUS : "",
                            TWITTER : "",
                            BLOG : ""
                        }
                        setLinks(info);
                    }
                },
                function (error)
                {
                    console.log(error.data);
                }
            );
        }
    }

    /* ***************************************
     * Experience section
     * ***************************************
     */

    var updateExperiencebool = false;

    $scope.saveExperience = function(experience) {

        //console.log(experience);
        if (experience.title == null)
        {
            console.log("experience null");
        }
        else
        {
            var experience_id = $rootScope.user + (new Date().getTime()).toString();
            var experience_title = experience.title;
            var experience_from_date = "";
            var experience_to_date = "";
            var experience_company = "";
            var experience_address = "";
            var experience_description = "";

            if (experience.from_date != null)
            {
                experience_from_date = dateFormat(experience.from_date,true);
            }
            if (experience.present)
            {
                experience_to_date = "present";
            }
            else if (experience.to_date != null)
            {
                experience_to_date = dateFormat(experience.to_date,true);
            }
            if (experience.company != null)
            {
                experience_company = experience.company;
            }
            if (experience.address != null)
            {
                experience_address = experience.address;
            }
            if (experience.description != null)
            {
                experience_description = experience.description;
            }

            if (!updateExperiencebool)
            {
                $http.post('/nextdrive/operations/work/saveWork.php', {
                        'nic': $rootScope.user,
                        'id': experience_id,
                        'title': experience_title,
                        'company': experience_company,
                        'date_from': experience_from_date,
                        'date_to': experience_to_date,
                        'address': experience_address,
                        'description': experience_description
                    }
                ).then(
                    function (data)
                    {
                        //console.log(data.data);
                        if (data.data)
                        {
                            $scope.closeMsgExperience();
                        }
                        else
                        {
                            console.log("Cannot Save");
                        }
                    },
                    function (error)
                    {
                        console.log(error.data);
                    }
                );
            }
            else
            {
                experience_id = experience.id;

                $http.post('/nextdrive/operations/work/updateWork.php', {
                        'nic': $rootScope.user,
                        'id': experience_id,
                        'title': experience_title,
                        'company': experience_company,
                        'date_from': experience_from_date,
                        'date_to': experience_to_date,
                        'address': experience_address,
                        'description': experience_description
                    }
                ).then(
                    function (data)
                    {
                        //console.log(data.data);
                        if (data.data)
                        {
                            $scope.closeMsgExperience();
                        }
                        else
                        {
                            console.log("Cannot Save");
                        }
                    },
                    function (error)
                    {
                        console.log(error.data);
                    }
                );
            }

        }
    }

    var loadExperience = function () {
        if ($rootScope.user != "")
        {
            $http.post('/nextdrive/operations/work/loadWork.php', {
                    'nic': $rootScope.user
                }
            ).then(
                function (data)
                {
                    setExperience(data.data);
                },
                function (error)
                {
                    console.log(error.data);
                }
            );
        }
    }

    $scope.addExperience = function () {
        $scope.addExperienceMsg = true;
        $scope.experienceTitle = "Add Experience";
    }

    $scope.closeMsgExperience = function () {
        $scope.addExperienceMsg = false;
        $(".exp-info form input").val("");
        $(".exp-info form textarea").val("");
        $scope.deleteExperienceBtn = false;
    }

    $scope.editExperience = function (exp) {
        $scope.experience = {};
        $scope.experience.id = exp.ID;
        $scope.experience.title = exp.TITLE;
        $scope.experience.company = exp.COMPANY;
        $scope.experience.from_date = new Date(exp.DATE_FROM);
        if (exp.DATE_TO == "present")
        {
            $scope.experience.present = true;
        }
        else
        {
            $scope.experience.to_date = new Date(exp.DATE_TO);
        }
        $scope.experience.address = exp.ADDRESS;
        $scope.experience.description = exp.DESCRIPTION;

        $scope.addExperienceMsg = true;
        $scope.experienceTitle = "Edit Experience";
        $scope.deleteExperienceBtn = true;

        updateExperiencebool = true;
    }

    $scope.deleteExperience = function (id) {
        $http.post('/nextdrive/operations/work/deleteWork.php', {
                'nic': $rootScope.user,
                'id': experience_id
            }
        ).then(
            function (data)
            {
                //console.log(data.data);
                if (data.data)
                {
                    $(".exp-info form input").val("");
                    $scope.closeMsgExperience();
                }
                else
                {
                    console.log("Cannot Save");
                }
            },
            function (error)
            {
                console.log(error.data);
            }
        );
    }

    /* ***************************************
     * Education section
     * ***************************************
     */

    var updateEducationBool = false;

    $scope.saveEducation = function(education) {

        console.log(education);

        if (education.institute == null)
        {
            console.log("education null");
        }
        else
        {
            var education_id = $rootScope.user + (new Date().getTime()).toString();
            var education_institute = education.institute;
            var education_degree = "";
            var education_field = "";
            var education_from_date = "";
            var education_to_date = "";
            var education_description = "";

            if (education.degree != $scope.degreeList[0])
            {
                education_degree = education.degree;
            }
            if (education.field != null)
            {
                education_field = education.field;
            }
            if (education.year_from != "-")
            {
                education_from_date = education.year_from;
            }
            if (education.year_to != "-")
            {
                education_to_date = education.year_to;
            }
            if (education.description != null)
            {
                education_description = education.description;
            }

            if (!updateEducationBool) {
                $http.post('/nextdrive/operations/education/saveEducation.php', {
                        'nic': $rootScope.user,
                        'id': education_id,
                        'institute': education_institute,
                        'degree': education_degree,
                        'field': education_field,
                        'date_from': education_from_date,
                        'date_to': education_to_date,
                        'description': education_description
                    }
                ).then(
                    function (data) {
                        console.log(data.data);
                        if (data.data) {
                            $scope.closeMsgEducation();
                        }
                        else {
                            console.log("Cannot Save");
                        }
                    },
                    function (error) {
                        console.log(error.data);
                    }
                );
            }
            else
            {
                education_id = education.id;

                $http.post('/nextdrive/operations/education/updateEducation.php', {
                        'nic': $rootScope.user,
                        'id': education_id,
                        'institute': education_institute,
                        'degree': education_degree,
                        'field': education_field,
                        'date_from': education_from_date,
                        'date_to': education_to_date,
                        'description': education_description
                    }
                ).then(
                    function (data) {
                        console.log(data.data);
                        if (data.data) {
                            $scope.closeMsgEducation();
                        }
                        else {
                            console.log("Cannot Save");
                        }
                    },
                    function (error) {
                        console.log(error.data);
                    }
                );
            }
        }
    }

    var loadEducation = function () {
        if ($rootScope.user != "")
        {
            $http.post('/nextdrive/operations/education/loadEducation.php', {
                    'nic': $rootScope.user
                }
            ).then(
                function (data)
                {
                    setEducation(data.data);
                },
                function (error)
                {
                    console.log(error.data);
                }
            );
        }
    }

    $scope.addEducation = function () {
        $scope.addEducationMsg = true;
        $scope.educationTitle = "Add Education";
    }

    $scope.closeMsgEducation = function () {
        $scope.addEducationMsg = false;
        $(".edu-info form input").val("");
        $(".edu-info form textarea").val("");
        var select = $('.edu-info select');
        select.prop('selectedIndex', 0);
        select.material_select();
        $scope.deleteEducationBtn = false;
    }

    $scope.editEducation = function (edu) {

        $scope.education.institute = edu.INSTITUTE;
        $scope.education.id = edu.ID;

        $scope.education.degree = edu.DEGREE;
        var select = $('.edu-info select.degree');
        select.prop('selectedIndex', 0);
        for (var i=0; i<$scope.degreeList.length; i++)
        {
            if ($scope.degreeList[i] == edu.DEGREE)
            {
                select.prop('selectedIndex', i);
                break;
            }
        }
        select.material_select();

        $scope.education.year_from = edu.DATE_FROM;
        select = $('.edu-info select#edu_from');
        select.prop('selectedIndex', 0);
        for (var i=0; i<$scope.yearList.length; i++)
        {
            if ($scope.yearList[i] == edu.DATE_FROM)
            {
                select.prop('selectedIndex', i);
                break;
            }
        }
        select.material_select();

        $scope.education.year_to = edu.DATE_TO;
        select = $('.edu-info select#edu_to');
        select.prop('selectedIndex', 0);
        for (var i=0; i<$scope.yearList.length; i++)
        {
            if ($scope.yearList[i] == edu.DATE_TO)
            {
                select.prop('selectedIndex', i);
                break;
            }
        }
        select.material_select();

        $scope.education.field = edu.FIELD;
        $scope.education.description = edu.DESCRIPTION;

        //console.log($scope.education);

        $scope.addEducationMsg = true;
        $scope.deleteEducationBtn = true;
        $scope.educationTitle = "Edit Education";

        updateEducationBool = true;

    }

    $scope.deleteEducation = function (id) {
        if (id != null)
        {
            $http.post('/nextdrive/operations/education/deleteEducation.php', {
                    'nic': $rootScope.user,
                    'id': id
                }
            ).then(
                function (data) {
                    console.log(data.data);
                    if (data.data) {

                        $(".edu-info form input").val("");
                        $(".edu-info form textarea").val("");
                        var select = $('.edu-info select');
                        select.prop('selectedIndex', 0);
                        select.material_select();
                        $scope.closeMsgEducation();
                    }
                    else {
                        console.log("Cannot Save");
                    }
                },
                function (error) {
                    console.log(error.data);
                }
            );
        }
    }

    /* ***************************************
     * Interests section
     * ***************************************
     */

    $scope.saveInterests = function () {

        var interests = "";
        for (var a in chipList)
        {
            interests += chipList[a].tag + (a < chipList.length - 1 ? ',' : '');
        }
        if (interests == "")
        {

        }
        else
        {
            if (initChips == null || initChips == "null")
            {
                $http.post('/nextdrive/operations/interests/saveInterests.php', {
                        'nic': $rootScope.user,
                        'interests': interests
                    }
                ).then(
                    function (data)
                    {
                        console.log(data.data);
                        if (data.data)
                        {
                            initChips = chipList;
                        }
                        else
                        {
                            console.log("Cannot Save");
                        }
                    },
                    function (error)
                    {
                        console.log(error.data);
                    }
                );
            }
            else
            {
                $http.post('/nextdrive/operations/interests/updateInterests.php', {
                        'nic': $rootScope.user,
                        'interests': interests
                    }
                ).then(
                    function (data)
                    {
                        console.log(data.data);
                        if (data.data)
                        {
                            initChips = chipList;
                        }
                        else
                        {
                            console.log("Cannot Save");
                        }
                    },
                    function (error)
                    {
                        console.log(error.data);
                    }
                );
            }
        }
    }

    var loadInterests = function () {
        if ($rootScope.user != "")
        {
            $http.post('/nextdrive/operations/interests/loadInterests.php', {
                    'nic': $rootScope.user
                }
            ).then(
                function (data)
                {
                    initChips = data.data;
                    if (initChips != null && initChips != "null")
                    {
                        initChips = initChips[0].INTERESTS;
                        chipArr = initChips.split(",");
                        chipList = createChipList(chipArr).data;
                        setInterests(chipArr);
                    }
                    initInterests();
                },
                function (error)
                {
                    console.log(error.data);
                }
            );
        }
    }

    /* ***************************************
     * Search actions
     * ***************************************
     */

    var objArr = [];
    var dataList = [];

    $scope.searchResult =[];

    var initSearchDataBool = false;

    var formatSearchData = function (arr) {
        var s = '{"data":{'
        for (a in arr)
        {
            s += '"' + arr[a].NAME_ON_CARD + '": null '+ (a < arr.length - 1 ? ',' : '');
        }
        s += '}}';
        return JSON.parse(s);
    }

    var initSearchInput = function (data) {

        /*var compiled = _.template("hello: <%= name %>");*/

        $('input#search').autocomplete({
            data: data,
            limit: 20, // The max amount of results that can be shown at once. Default: Infinity.
        });
        /*autocomplete.compiled({name: 'moe'});*/
        initSearchDataBool = true;

    }

    $scope.initResults = function () {
        if (!initSearchDataBool) {
            $http.post('/nextdrive/operations/loadNames.php', {
                    'nic': $rootScope.user
                }
            ).then(
                function (data) {
                    if (data.data != null) {
                        objArr = data.data;
                        dataList = formatSearchData(objArr).data;
                        initSearchInput(dataList);
                    }
                },
                function (error) {
                    console.log(error.data);
                }
            );
        }
    }

    $scope.searchPeople = function () {
        console.log($scope.keywords);
        if ($scope.keywords != null && $scope.keywords != "") {
            $http.post('/nextdrive/operations/loadPeople.php', {
                    'name': $scope.keywords
                }
            ).then(
                function (data) {
                    var data = data.data
                    console.log(data);
                    for (var i=0; i<data.length; i++)
                    {
                        $scope.res = {};
                        $scope.res.basic = data[i];
                        $http.post('/nextdrive/operations/links/loadLinks.php', {
                                'nic': $scope.res.basic.NIC
                            }
                        ).then(
                            function (data)
                            {
                                $scope.res.links = data.data[0];

                                var url = "/nextdrive/propic/"+ $scope.res.basic.NIC + ".png";
                                var request = new XMLHttpRequest();
                                request.open('HEAD', url, false);
                                request.send();
                                if(request.status == 200) {
                                    $scope.res.person_image = url;
                                } else {
                                    if ( $scope.res.basic.GENDER == "Female" )
                                    {
                                        $scope.res.person_image = "/nextdrive/images/dashboard/profile-img-female.jpg";
                                    }
                                    else
                                    {
                                        $scope.res.person_image = "/nextdrive/images/dashboard/profile-img-male.jpg";
                                    }
                                }
                                $scope.searchResult.push($scope.res);
                            },
                            function (error)
                            {
                                console.log(error.data);
                            }
                        );
                    }
                    console.log($scope.searchResult);
                },
                function (error) {
                    console.log(error.data);
                }
            );
        }
    }

    /* ***************************************
     * Initial actions
     * ***************************************
     */

    console.log($rootScope.user);
    //console.log();

    if ( angular.isUndefined($rootScope.user) ) {
        $location.path('/login');
    }

    $scope.public_profile_section = true;
    $scope.CVmessageBox = false;
    $scope.downloadCV = false;
    $scope.ProPicMessageBox = false;
    $scope.addEducationMsg = false;
    $scope.deleteEducationBtn = false;
    $scope.addExperienceMsg = false;

    var getRotaData = function () {
        if ($rootScope.user != "")
        {
            $http.post('/nextdrive/operations/getRotaractorData.php', {
                    'nic': $rootScope.user
                }
            ).then(
                function (data)
                {
                    //console.log(data.data);
                    $scope.user_name_long = data.data.name_on_card;
                    updateProfile(data.data);
                },
                function (error)
                {
                    console.log(error.data);
                }
            );
        }
    }

    getRotaData();

    var updateProfile = function(udata) {
        if ( udata != null )
        {
            if (typeof udata === "undefined")
            {
                $location.path('/login');
            }
            var url = "/nextdrive/propic/"+ $rootScope.user + ".png";
            var request = new XMLHttpRequest();
            request.open('HEAD', url, false);
            request.send();
            if(request.status == 200) {
                $scope.person_image = url;
            } else {
                if ( udata.gender == "Female" )
                {
                    $scope.person_image = "/nextdrive/images/dashboard/profile-img-female.jpg";
                }
                else
                {
                    $scope.person_image = "/nextdrive/images/dashboard/profile-img-male.jpg";
                }
            }
            $scope.info_name = udata.name_on_card;
            $scope.info_club = udata.club;
            $scope.info_age = parseInt( new Date().getFullYear() ) - parseInt( udata.date_of_birth.split('-')[2] )
            $scope.info_phone = "+94 "+ udata.mobile;
            $scope.info_email = udata.email;
            /*$scope.info_address = udata.address.replace(/ ,/,'').replace(/ ,/,'');*/
        }
        else
        {
            $scope.person_image = "/nextdrive/images/dashboard/profile-img-male.jpg";
        }

    }

    loadExperience();

    var setExperience = function (expArr) {
        if (expArr != "null")
        {
            for (var i = 0; i < expArr.length; i++)
            {
                var exp = expArr[i];
                var f_date = "";
                var t_date = "";
                if (exp.DATE_FROM != null)
                {
                    f_date = new Date(exp.DATE_FROM);
                }
                if (exp.DATE_TO != null)
                {
                    if (exp.DATE_TO == "present") {
                        t_date = new Date();
                    }
                    else {
                        t_date = new Date(exp.DATE_TO);
                    }
                }
                if (f_date != "" && t_date != "")
                {
                    expArr[i].PERIOD = period(f_date,t_date) > 12 ? Math.round(period(f_date, t_date) / 12) + " years" : Math.round(period(f_date,t_date)) + " months";
                }
            }
            $scope.expArr = expArr;
        }
    }

    loadEducation();

    var setEducation = function (eduArr) {
        if (eduArr != "null")
        {
            $scope.eduArr = eduArr;
        }
    }

    loadInterests();

    var setInterests = function (intArr) {
        $scope.interestsArr = intArr;
    }

    loadCV();

    var setCV = function (cv) {
        $scope.cvURL = "http://" + $location.host() + "/nextdrive/"+ cv.split("../")[1];
        $scope.cvName = cv.split("../cv/")[1];
    }

    loadLinks();

    var setLinks = function (info) {
        $scope.infoLinks = info;
        $scope.infoLinks.LINKEDIN == "" ? $('#info-linkedin').addClass('disabled'):$('#info-linkedin').removeClass('disabled');
        $scope.infoLinks.FACEBOOK == "" ? $('#info-facebook').addClass('disabled'):$('#info-facebook').removeClass('disabled');
        $scope.infoLinks.GOOGLEPLUS == "" ? $('#info-googleplus').addClass('disabled'):$('#info-googleplus').removeClass('disabled');
        $scope.infoLinks.TWITTER == "" ? $('#info-twitter').addClass('disabled'):$('#info-twitter').removeClass('disabled');
        $scope.infoLinks.BLOG == "" ? $('#info-blog').addClass('disabled'):$('#info-blog').removeClass('disabled');

        $scope.info = {};
        $scope.info.background = $scope.infoLinks.BACKGROUND;
        $scope.info.linkedin = $scope.infoLinks.LINKEDIN;
        $scope.info.facebook = $scope.infoLinks.FACEBOOK;
        $scope.info.googleplus = $scope.infoLinks.GOOGLEPLUS;
        $scope.info.twitter = $scope.infoLinks.TWITTER;
        $scope.info.blog = $scope.infoLinks.BLOG;

    }

    $rootScope.logout = function() {
        $http.get('/nextdrive/operations/logout.php', {})
            .then(
                function (data)
                {
                    console.log(data.data);
                    $location.path('/login');
                },
                function (error)
                {
                    console.log(error.data)
                });
    }
});