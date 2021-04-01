/**
 * phone2pp form DAO
 *
 * PHP version 6
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @author    Aportamedia S.L.
 * @copyright 2015 Aportamedia S.L.
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 */
var $ = jQuery;
var app = angular.module('phone2app', []);

//Parse init with API Keys
Parse.initialize("94WlIniEYIdtbKSF0ccIyNDjpOVZmiislWHrIuvh", "31DdGVZk4kKnLfpzJxuIj8PBeVwuysCMMXse3WNk");

app.controller('MainController', function($scope, $compile) {
    $scope.window = (Parse.User.current()) ? $scope.window = 'form_list' : $scope.window = 'login';
    $scope.form = {
        'edit': {
            'options': {}
        },
        'add': {
            'options': {}
        }
    };

    function _login(user, pass){
        var promise = new Parse.Promise();
        Parse.User.logIn(user, pass, {
            success: function(u) {
                $scope.window = 'form_list';
                promise.resolve(true);
                $.ajax({
                       type: "POST",
                       url: WordPressParams.path + "phone2appUserService.php",
                       data: JSON.stringify({
                           "username": user,
                           "password": pass
                       }),
                       success: function (data) {
                           console.log(data);


                       },
                       error: function (response) {
                           console.log(response);
                       }
                });
            },
            error: function(u, error) {
                promise.resolve(false);
                console.log(error);
            }
        });
        return promise;
    }
    var working = false;
    $('#login').on('submit', function(e) {
        //$("#login img").hide();
        e.preventDefault();
        if (working) return;
        working = true;
        var _this = $(this),
            _state = _this.find('button > .state');
        _this.addClass('loading');
        _state.html('Iniciando sesión');

        _login($scope.login_username, $scope.login_password).then(function(r){
            if(r){
                setTimeout(function() {
                    _this.addClass('ok');
                    _state.html('¡Bienvenido!');
                    $(".fa.fa-sign-out").show();
                    setTimeout(function() {
                        _state.html('Log in');
                        _this.removeClass('ok loading');
                        working = false;

                        $scope.window = 'form_list';
                        $scope.$apply();
                        $scope.load_forms();
                    }, 1000);
                }, 1500);
            }else{
                console.log('not logged');
                _this.addClass('ko');
                _state.html('Usuario o contraseña incorrectos :(');
                var i = setTimeout(function() {
                    _state.html('Log in');
                    _this.removeClass('ko loading');
                    _this.removeClass('ok loading');
                    working = false;
                    clearInterval(i);
                }, 4000);
            }
        });

    });

    var working = false;
    $("#signup").on("submit", function(e){
        e.preventDefault();
        if (working) return;
        working = true;
        var _this = $(this),
            _state = _this.find('button > .state');
        _this.addClass('loading');
        _state.html('Registrando...');

        $.get('http://jsonip.com/', function (r) {
            var ip = r.ip;
            console.log(r.ip);
            var useragent = navigator.userAgent;
            var vendor = navigator.vendor;
            var oscpu = navigator.oscpu;
            var platform = navigator.platform;
            $.ajax({
                type: "POST",
                url: "https://api.parse.com/1/functions/signup",
                headers: {
                    "X-Parse-Application-Id": "94WlIniEYIdtbKSF0ccIyNDjpOVZmiislWHrIuvh",
                    "X-Parse-REST-API-Key": "EoQmiFBDpNZ4FE6dNUH6RZJxNfFtfvSQfdqJI01d"
                },
                data: JSON.stringify({
                    "username": $scope.signup_username,
                    "email": $scope.signup_username,
                    "password": $scope.signup_password,
                    "phone": $scope.signup_phone,
                    "ip": ip,
                    "referral": "Wordpress",
                    "useragent": useragent,
                    "vendor": vendor,
                    "oscpu": oscpu,
                    "platform": platform
                }),
                contentType: "application/json",
                dataType: "text",
                success: function (data) {
                    _login($scope.signup_username, $scope.signup_password).then(function(r){
                        if(r){
                            setTimeout(function() {
                                _this.addClass('ok');
                                _state.html('¡Bienvenido!');
                                $(".fa.fa-sign-out").show();
                                setTimeout(function() {
                                    _state.html('Resgístrate');
                                    _this.removeClass('ok loading');
                                    working = false;

                                    $scope.window = 'form_list';
                                    $scope.$apply();
                                    $scope.load_forms();
                                }, 1000);
                            }, 1500);
                        }else{
                            _this.addClass('ko');
                            _state.html('Los datos no son válidos :(');
                            var i = setTimeout(function() {
                                _state.html('Log in');
                                _this.removeClass('ko loading');
                                _this.removeClass('ok loading');
                                working = false;
                                clearInterval(i);
                            }, 4000);
                        }
                    });
                },
                error: function (error) {
                    console.log(error.responseText);
                    if(error.responseText.indexOf("taken") > -1)
                        _state.html('El nombre de usuario ya existe :(');
                    else
                        _state.html('Los datos no son válidos');
                    _this.addClass('ko');
                    var i = setTimeout(function() {
                        _state.html('Regístrate');
                        _this.removeClass('ko loading');
                        _this.removeClass('ok loading');
                        working = false;
                        clearInterval(i);
                    }, 3000);
                }
            });
        });

    });

    $scope.load_forms = function(){
        if(Parse.User.current())
        $.get( WordPressParams.path + 'phone2appFormService.php',function(r){
            //read current form

            $scope.user = (Parse.User.current()) ? Parse.User.current().attributes : null;
            $.get( WordPressParams.path + 'phone2appUserService.php', function(r){
                var data = JSON.parse(r);
                var u = CryptoJS.AES.encrypt(data.username, "").toString();
                var p = CryptoJS.AES.encrypt(data.password, "").toString();
                console.log(data.username + " : " + u);
                console.log(data.password + " : " + p);
                $(".phone2app-header a").attr("href", "http://phone2app.com/panel?u=" + u + "&p=" + p);
                $(".phone2app-header a.plan").attr("href", "http://phone2app.com/planes-precios-phone2app/?u=" + u + "&p=" + p);

            });

            $.ajax({
                   type: "POST",
                   url: "https://api.parse.com/1/functions/totals",
                   headers: {
                       "X-Parse-Application-Id": "94WlIniEYIdtbKSF0ccIyNDjpOVZmiislWHrIuvh",
                       "X-Parse-REST-API-Key": "EoQmiFBDpNZ4FE6dNUH6RZJxNfFtfvSQfdqJI01d"
                   },
                   data: JSON.stringify({"userid": Parse.User.current().id}),
                   contentType: "application/json",
                   dataType: "text",
                   success: function (data) {
                       $scope.contacts_length = JSON.parse(data).result;
                       $scope.$apply();
                   },
                   error: function (response) {
                       console.log(response);
                   }
            });

            console.log(r);
            var current_form_id = (JSON.parse(r) != null) ? JSON.parse(r).id : -1;
                var btnhtml = '';


                if(Parse.User.current()){
                    var Form = Parse.Object.extend("Forms");
                    var query = new Parse.Query(Form);
                    query.equalTo("userid", Parse.User.current().id);
                    query.descending('createdAt');
                    query.find({
                        success: function(results) {
                            $scope.form_list = results;
                            $scope.form_list_length = results.length;
                            $scope.$apply();
                            for (var i = 0; i < results.length; i++) {
                                var object = results[i];
                                btnhtml += '<div class="form">'
                                    + '<h3 class="form_title">'+object.get('f_referral')+'</h3>'
                                    + '<div class="form_buttons">'
                                    //+ '    <input type="checkbox" class="uiswitch" form-id="'+object.id+'" '+((object.id === getCookie('active_form'))?'checked':'')+'>'
                                    + '    <input type="checkbox" class="uiswitch single" form-id="'+object.id+'" '+((current_form_id == object.id)?'checked':'')+' >'
                                    + '    <div class="form_button edit" ng-click="edit($event)" form-id="'+object.id+'"><i class="fa fa-edit"></i> editar</div>'
                                    + '    <div class="form_button delete" ng-click="delete($event)" form-id="'+object.id+'"><i class="fa fa-trash-o"></i> eliminar</div>';
                                btnhtml += '</div><p class="form_details">'+object.get('views')+' impresiones - '+object.get('leads')+' conversiones</p></div>';
                            }
                            btnhtml += '<i class="fa fa-circle-thin form-list-end"></i>';
                            var temp = $compile(btnhtml)($scope);
                            angular.element(document.getElementById('forms')).html(temp);

                            $('.uiswitch.single').click(function() {
                                var t = $(this);
                                var fid = $(this).attr('form-id');
                                for(var i = 0; i < $('.uiswitch.single').length; i++){
                                    if(!t.is($('.uiswitch.single')[i]))
                                        $('.uiswitch.single')[i].checked = false;
                                }

                                if ($(this)[0].checked){
                                    console.log('checked');
                                    _set_form(fid);
                                }
                                else{
                                    console.log('not checked, setting 0');
                                    _set_form(0);
                                }
                            });
                        },error: function(error) {
                            alert("Error: " + error.code + " " + error.message);
                        }
                    });
                }

        });
    };
    $scope.load_forms();

    $scope.add = function(){
        if (($scope.form != undefined) &&($scope.form.add.referral != undefined) && ( $scope.form.add.title != undefined) && ($scope.form.add.referral != "") && !($scope.form.add.referral.indexOf("-") > -1) && !($scope.form.add.referral.indexOf("_") > -1) && !($scope.form.add.referral.indexOf("\\") > -1) && !($scope.form.add.referral.indexOf(".") > -1) && !($scope.form.add.referral.indexOf("/") > -1) && !($scope.form.add.referral.indexOf("message=") > -1) && !($scope.form.add.referral.indexOf("=") > -1)){
            var d = {
                    "userid": Parse.User.current().id,
                    "f_type": 'widget',
                    "f_title": $scope.form.add.title,
                    "f_referral": $scope.form.add.referral,
                    "i_name": $scope.form.add.options.name,
                    "i_email":  $scope.form.add.options.email,
                    "i_phone":  $scope.form.add.options.phone,
                    "i_notes":  $scope.form.add.options.message,
            };

            $.ajax({
                type: "POST",
                url: "http://phone2app.com/api/0.1/form",
                contentType: "application/json",
                dataType: "text",
                data: JSON.stringify(d),
                success: function (data) {
                    console.log("Form created");
                    console.log(data);
                    $scope.window = 'form_list';
                    $scope.$apply();
                    $scope.load_forms();
                },
                error: function (e) {
                    console.log("Form error");
                    alert('Se ha producido un error. Inténtalo de nuevo más tarde :(');
                    console.log(e);
                }
            });
        } else {
            alert('Se ha producido un error. Comprueba los datos introducidos');
            console.log("Error al generar el formulario!");
        }
    };

    $scope.edit = function($event){
        var form_id = $event.currentTarget.attributes['form-id'].value;
        $scope.window = 'form_edit';

        if (form_id === '-1'){
            //Editing cart
            console.log('Editing cart');
            $scope.active_form = '-1';
            $scope.form.edit.referral = '';
            $scope.form.edit.title = $scope.cart.title;
            $scope.form.edit.options.name = ($scope.cart.i_name === "1");
            $scope.form.edit.options.email = ($scope.cart.i_email === "1");
            $scope.form.edit.options.phone = ($scope.cart.i_phone === "1");
            $scope.form.edit.options.message = ($scope.cart.i_notes === "1");

        }else{
            var f = $scope.form_list.filter(function ( obj ) {
                return obj.id === form_id;
            })[0];
            console.log(f.get('f_referral'));
            $scope.active_form = f;
            $scope.form.edit.referral = f.get('f_referral');
            $scope.form.edit.title = f.get('f_title');
            $scope.form.edit.options.name = f.get('i_name');
            $scope.form.edit.options.email = f.get('i_email');
            $scope.form.edit.options.phone = f.get('i_phone');
            $scope.form.edit.options.message = f.get('i_notes');
        }

    };

    $scope.save_edit = function(){
        var f = $scope.active_form;
        if(f === '-1'){
            //save cart
            var i_name=($scope.form.edit.options.name)?'1':'0';
            var i_email=($scope.form.edit.options.email)?'1':'0';
            var i_phone=($scope.form.edit.options.phone)?'1':'0';
            var i_notes=($scope.form.edit.options.message)?'1':'0';
            $.ajax({
                url:  WordPressParams.path + 'phone2appFormService.php',
                type: 'PUT',
                data: "cart=set&parse_userid="+Parse.User.current().id+"&enabled=1&title="+encodeURIComponent($scope.form.edit.title)+"&i_name="+i_name+"&i_phone="+i_phone+"&i_email="+i_email,
                success: function(data) {
                    console.log(data);
                    $scope.load_forms();
                    $scope.window = 'form_list';
                    $scope.$apply();
                }
            });
        }else{
            //Save other parse form
            f.destroy();
            var d = {
                    "userid": Parse.User.current().id,
                    "f_type": 'widget',
                    "f_title": $scope.form.edit.title,
                    "f_referral": $scope.form.edit.referral,
                    "i_name": $scope.form.edit.options.name,
                    "i_email":  $scope.form.edit.options.email,
                    "i_phone":  $scope.form.edit.options.phone,
                    "i_notes":  $scope.form.edit.options.message
            };

            $.ajax({
                type: "POST",
                url: "http://phone2app.com/api/0.1/form",
                contentType: "application/json",
                dataType: "text",
                data: JSON.stringify(d),
                success: function (data) {
                    console.log("Form edited");
                    console.log(data);
                    $scope.window = 'form_list';
                    $scope.$apply();


                    _set_form(0);

                    $scope.load_forms();
                },
                error: function (e) {
                    console.log("Form error");
                    alert('Se ha producido un error. Inténtalo de nuevo más tarde :(');
                    console.log(e);
                }
            });
        }
    };

    $scope.delete = function($event){
        var f = $scope.form_list.filter(function ( obj ) {
            return obj.id === $event.currentTarget.attributes['form-id'].value;
        })[0];
        f.destroy({
            success: function(o) {


                _set_form(0);
                $scope.load_forms();
            },
            error: function(myObject, error) {
                alert(error);
            }
        });
    };

    function _set_form(fid){
        console.log('Setting form with id: ' + fid);
        if(fid != 0){
            var f = $scope.form_list.filter(function ( obj ) {
                return obj.id ===  fid;
            })[0];

            $.ajax({
              url: WordPressParams.path + 'phone2appFormService.php',
              type: 'PUT',
            	data: "id="+fid+"&link="+'http://scripts.phone2app.com/'+Parse.User.current().id+'/'+f.get('timestamp')+'.js',
              success: function(data) {
                console.log(data);
              }
            });
        }else{
            console.log('0ing');
            $.ajax({
              url:  WordPressParams.path + 'phone2appFormService.php',
              type: 'PUT',
            	data: "id=-1&link=foo",
              success: function(data) {
                console.log(data);
              }
            });
        }
    }
});
