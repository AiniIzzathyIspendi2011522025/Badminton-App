// Code goes here
(function () {
    angular.module("app", ["ui.bootstrap"]).controller("Main", function ($log, $filter, $scope) {
        var vm = this;

        function Item(name, count) {
            this.name = name;
            this.count = count;
        }

        vm.data = [
            new Item("foo", 10),
            new Item("bar", 15),
            new Item("knarz", 20),
            new Item("peng", 40),
            new Item("zap", 5),
            new Item("pwnd", 1)
        ];

        vm.tablefy = function () {
            $log.info("tablefy")
            $log.info("vm.mytable = " + vm.table);
            $log.info("$scope.mytable = " + $scope.table);
            vm.table.footable();
            //var table = angular.element(".table");
            //$log.info(table);
            //table.footable();
            //vm.table.footable();
            //$scope.mytable.footable();
        };

        vm.debug = function () {
            //vm.data = $filter('orderBy')(vm.data, "count");

            vm.data = [
                new Item("Hans", 10),
                new Item("Franz", 20),
                new Item("Haus", 25),
                new Item("Maus", 5)
            ];
        };

    }).directive('onFinishRender', function ($log, $timeout) {
        return {
            restrict: 'A',
            link: function (scope, element, attr) {
                if (scope.$last === true) {
                    $log.info("onFinishRender");
                    scope.$evalAsync(attr.onFinishRender);
                }
            }
        }

    }).directive("jqlElement", function ($log, $parse) {
        // http://stackoverflow.com/questions/15881453/angularjs-accessing-dom-elements-inside-directive-template
        // https://www.webcodegeeks.com/javascript/angular-js/magic-parse-service-angularjs/
        return {
            restrict: "A",

            compile: function compile(tElement, tAttrs, transclude) {
                return {
                    pre: function preLink(scope, iElement, iAttrs, controller) {
                        $log.info("jqlElement");
                        $log.info(iElement);
                        //iElement.footable();
                        $parse(iAttrs.jqlElement).assign(scope, iElement);
                        //scope[iAttrs.jqlElement] = iElement;
                    }
                };
            }
        }

    }).directive('footableAfterRender', function ($log, $timeout) {
        return {
            restrict: 'A',
            link: function (scope, element, attr) {
                if (scope.$last === true) {
                    $log.info("footableAfterRender");
                    $log.info(attr.footableAfterRender);
                    var evalStr = attr.footableAfterRender + ".footable()";
                    $log.info("evalStr = " + evalStr);
                    //scope.$eval(attr.footableAfterRender + ".footable()");
                    //$timeout(function() { scope.$eval(evalStr); })
                    //$timeout(function() { "scope.$parent.vm.table.footable();" })
                    //scope.vm.table.footable();
                    $timeout(function () {
                        eval("scope." + attr.footableAfterRender + ".footable();");
                    });
                    //debugger;
                    //scope.$evalAsync("vm.table.footable()")
                    //angular.element(".table").footable();
                    //scope.$evalAsync(attr.footableAfterRender + ".footable()");
                    //dattr.footableAfterRender.footable();
                    //scope.$evalAsync(attr.onFinishRender);
                }
            }
        }
    });
})();