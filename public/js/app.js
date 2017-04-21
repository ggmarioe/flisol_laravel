var app = angular.module('ticket', ['ngRoute']);

app.constant('CONFIG',{
  APIURL: 'http://localhost/ticket/public/api/'
})

app.config(['$routeProvider', '$locationProvider',
  function($routeProvider, $locationProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'js/templates/home.html',
        controller: 'TicketCtrl'
      })
      .when('/ticket/listar', {
        templateUrl: 'js/templates/listar.html',
        controller: 'TicketCtrl'
      })
      .when('/ticket/agregar', {
        templateUrl: 'js/templates/agregar.html',
        controller: 'TicketCtrl'
      })
      .when('/ticket/listarporid/:ticketId', {
        templateUrl: 'js/templates/listarporid.html',
        controller: 'TicketCtrl'
      })
      .otherwise({
        redirect: '/'
      });
    $locationProvider.html5Mode({enabled: false, requireBase: false});
}])

app.controller('TicketCtrl',function($scope, $http, CONFIG){

  $scope.data = {};
  $scope.error = {};

  //listar
  $http.get(CONFIG.APIURL  + "ticket").then(function(response){
    //console.log(response.data);
    $scope.tickets = response.data;
  },function(error){
    $scope.error = error;
  });



  $scope.guardar = function(){
    $scope.mensaje='';
    $scope.mensajeError = {}
    //guardar los datos
    var params = {
          nombre: $scope.data.nombre,
          correo: $scope.data.correo,
          solicitud: $scope.data.solicitud,
          estado: "abierto"
    };
    //Es necesario pasar a json los datos que vienen por el input
    //de otra forma no se pueden utlilizar con php input en el lado del servidor
    var jsoned = angular.toJson(params);
    //headers indicando el contenido del post
    var headers = { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' };

    $http({
        url: CONFIG.APIURL + "ticket",
        method: "POST",
        data: jsoned,
        headers: headers
    }).then(function(response){
        //resolvemos los datos para entregarlos al usuario
        $scope.mensaje = response.data;
        //deferred.resolve(response.data);
    },function(error){
        $scope.error = error
    });
  }
})

app.controller('TicketDetailCtrl',function($scope, $http, $location, $routeParams,  CONFIG){

  console.log($routeParams.ticketId);

  var ticketId =$routeParams.ticketId;
  $http.get(CONFIG.APIURL  + "ticket/" + ticketId).then(function(response){

    $scope.data.nombre_usuario = response.data.nombre_usuario;
    $scope.data.correo_usuario = response.data.correo_usuario;
    $scope.data.solicitud = response.data.solicitud;
    $scope.data.estado = response.data.estado;
    $scope.data.id = response.data.id;

    console.log(response.data);
  },function(error){
    $scope.error = error;
  });

  return false;
});
