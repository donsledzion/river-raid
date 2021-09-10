/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/delete.js":
/*!********************************!*\
  !*** ./resources/js/delete.js ***!
  \********************************/
/***/ (() => {

eval("$(function () {\n  $('.delete').click(function () {\n    var _this = this;\n\n    Swal.fire({\n      title: 'Are you sure?',\n      text: \"You won't be able to revert this!\",\n      icon: 'warning',\n      showCancelButton: true,\n      confirmButtonColor: '#3085d6',\n      cancelButtonColor: '#d33',\n      confirmButtonText: 'Yes, delete it!'\n    }).then(function (result) {\n      if (result.isConfirmed) {\n        //console.log('deleteUrl = ' + deleteUrl);\n        $.ajax({\n          method: 'DELETE',\n          url: deleteUrl + $(_this).data(\"class\") + \"/\" + $(_this).data(\"id\")\n        }).done(function (data) {\n          Swal.fire('Deleted!', 'Your file has been deleted.', 'success').then(function (result) {\n            if (result.isConfirmed) {\n              location.reload();\n            }\n          });\n        }).fail(function (data) {\n          Swal.fire({\n            title: 'Error',\n            text: \"There was an error!\",\n            icon: 'error'\n          });\n        });\n      }\n    });\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvZGVsZXRlLmpzP2ZlNjQiXSwibmFtZXMiOlsiJCIsImNsaWNrIiwiU3dhbCIsImZpcmUiLCJ0aXRsZSIsInRleHQiLCJpY29uIiwic2hvd0NhbmNlbEJ1dHRvbiIsImNvbmZpcm1CdXR0b25Db2xvciIsImNhbmNlbEJ1dHRvbkNvbG9yIiwiY29uZmlybUJ1dHRvblRleHQiLCJ0aGVuIiwicmVzdWx0IiwiaXNDb25maXJtZWQiLCJhamF4IiwibWV0aG9kIiwidXJsIiwiZGVsZXRlVXJsIiwiZGF0YSIsImRvbmUiLCJsb2NhdGlvbiIsInJlbG9hZCIsImZhaWwiXSwibWFwcGluZ3MiOiJBQUFBQSxDQUFDLENBQUMsWUFBVTtBQUNSQSxFQUFBQSxDQUFDLENBQUMsU0FBRCxDQUFELENBQWFDLEtBQWIsQ0FBbUIsWUFDbkI7QUFBQTs7QUFDSUMsSUFBQUEsSUFBSSxDQUFDQyxJQUFMLENBQVU7QUFDTkMsTUFBQUEsS0FBSyxFQUFFLGVBREQ7QUFFTkMsTUFBQUEsSUFBSSxFQUFFLG1DQUZBO0FBR05DLE1BQUFBLElBQUksRUFBRSxTQUhBO0FBSU5DLE1BQUFBLGdCQUFnQixFQUFFLElBSlo7QUFLTkMsTUFBQUEsa0JBQWtCLEVBQUUsU0FMZDtBQU1OQyxNQUFBQSxpQkFBaUIsRUFBRSxNQU5iO0FBT05DLE1BQUFBLGlCQUFpQixFQUFFO0FBUGIsS0FBVixFQVFHQyxJQVJILENBUVEsVUFBQ0MsTUFBRCxFQUFZO0FBQ2hCLFVBQUlBLE1BQU0sQ0FBQ0MsV0FBWCxFQUF3QjtBQUNwQjtBQUNBYixRQUFBQSxDQUFDLENBQUNjLElBQUYsQ0FBTztBQUNIQyxVQUFBQSxNQUFNLEVBQUUsUUFETDtBQUVIQyxVQUFBQSxHQUFHLEVBQUVDLFNBQVMsR0FBR2pCLENBQUMsQ0FBQyxLQUFELENBQUQsQ0FBUWtCLElBQVIsQ0FBYSxPQUFiLENBQVosR0FBb0MsR0FBcEMsR0FBMENsQixDQUFDLENBQUMsS0FBRCxDQUFELENBQVFrQixJQUFSLENBQWEsSUFBYjtBQUY1QyxTQUFQLEVBR0dDLElBSEgsQ0FHUSxVQUFTRCxJQUFULEVBQWM7QUFDbEJoQixVQUFBQSxJQUFJLENBQUNDLElBQUwsQ0FDSSxVQURKLEVBRUksNkJBRkosRUFHSSxTQUhKLEVBSUVRLElBSkYsQ0FJTyxVQUFDQyxNQUFELEVBQVk7QUFDZixnQkFBR0EsTUFBTSxDQUFDQyxXQUFWLEVBQXNCO0FBQ2xCTyxjQUFBQSxRQUFRLENBQUNDLE1BQVQ7QUFDSDtBQUNKLFdBUkQ7QUFTSCxTQWJELEVBYUdDLElBYkgsQ0FhUSxVQUFTSixJQUFULEVBQWM7QUFDbEJoQixVQUFBQSxJQUFJLENBQUNDLElBQUwsQ0FBVTtBQUNOQyxZQUFBQSxLQUFLLEVBQUUsT0FERDtBQUVOQyxZQUFBQSxJQUFJLEVBQUUscUJBRkE7QUFHTkMsWUFBQUEsSUFBSSxFQUFFO0FBSEEsV0FBVjtBQUtILFNBbkJEO0FBb0JIO0FBQ0osS0FoQ0Q7QUFpQ0gsR0FuQ0Q7QUFvQ0gsQ0FyQ0EsQ0FBRCIsInNvdXJjZXNDb250ZW50IjpbIiQoZnVuY3Rpb24oKXtcbiAgICAkKCcuZGVsZXRlJykuY2xpY2soZnVuY3Rpb24oKVxuICAgIHtcbiAgICAgICAgU3dhbC5maXJlKHtcbiAgICAgICAgICAgIHRpdGxlOiAnQXJlIHlvdSBzdXJlPycsXG4gICAgICAgICAgICB0ZXh0OiBcIllvdSB3b24ndCBiZSBhYmxlIHRvIHJldmVydCB0aGlzIVwiLFxuICAgICAgICAgICAgaWNvbjogJ3dhcm5pbmcnLFxuICAgICAgICAgICAgc2hvd0NhbmNlbEJ1dHRvbjogdHJ1ZSxcbiAgICAgICAgICAgIGNvbmZpcm1CdXR0b25Db2xvcjogJyMzMDg1ZDYnLFxuICAgICAgICAgICAgY2FuY2VsQnV0dG9uQ29sb3I6ICcjZDMzJyxcbiAgICAgICAgICAgIGNvbmZpcm1CdXR0b25UZXh0OiAnWWVzLCBkZWxldGUgaXQhJ1xuICAgICAgICB9KS50aGVuKChyZXN1bHQpID0+IHtcbiAgICAgICAgICAgIGlmIChyZXN1bHQuaXNDb25maXJtZWQpIHtcbiAgICAgICAgICAgICAgICAvL2NvbnNvbGUubG9nKCdkZWxldGVVcmwgPSAnICsgZGVsZXRlVXJsKTtcbiAgICAgICAgICAgICAgICAkLmFqYXgoe1xuICAgICAgICAgICAgICAgICAgICBtZXRob2Q6ICdERUxFVEUnLFxuICAgICAgICAgICAgICAgICAgICB1cmw6IGRlbGV0ZVVybCArICQodGhpcykuZGF0YShcImNsYXNzXCIpICsgXCIvXCIgKyAkKHRoaXMpLmRhdGEoXCJpZFwiKVxuICAgICAgICAgICAgICAgIH0pLmRvbmUoZnVuY3Rpb24oZGF0YSl7XG4gICAgICAgICAgICAgICAgICAgIFN3YWwuZmlyZShcbiAgICAgICAgICAgICAgICAgICAgICAgICdEZWxldGVkIScsXG4gICAgICAgICAgICAgICAgICAgICAgICAnWW91ciBmaWxlIGhhcyBiZWVuIGRlbGV0ZWQuJyxcbiAgICAgICAgICAgICAgICAgICAgICAgICdzdWNjZXNzJ1xuICAgICAgICAgICAgICAgICAgICApLnRoZW4oKHJlc3VsdCkgPT4ge1xuICAgICAgICAgICAgICAgICAgICAgICAgaWYocmVzdWx0LmlzQ29uZmlybWVkKXtcbiAgICAgICAgICAgICAgICAgICAgICAgICAgICBsb2NhdGlvbi5yZWxvYWQoKTtcbiAgICAgICAgICAgICAgICAgICAgICAgIH1cbiAgICAgICAgICAgICAgICAgICAgfSlcbiAgICAgICAgICAgICAgICB9KS5mYWlsKGZ1bmN0aW9uKGRhdGEpe1xuICAgICAgICAgICAgICAgICAgICBTd2FsLmZpcmUoe1xuICAgICAgICAgICAgICAgICAgICAgICAgdGl0bGU6ICdFcnJvcicsXG4gICAgICAgICAgICAgICAgICAgICAgICB0ZXh0OiBcIlRoZXJlIHdhcyBhbiBlcnJvciFcIixcbiAgICAgICAgICAgICAgICAgICAgICAgIGljb246ICdlcnJvcicsXG4gICAgICAgICAgICAgICAgICAgIH0pXG4gICAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9XG4gICAgICAgIH0pXG4gICAgfSk7XG59KTtcbiJdLCJmaWxlIjoiLi9yZXNvdXJjZXMvanMvZGVsZXRlLmpzLmpzIiwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/delete.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/delete.js"]();
/******/ 	
/******/ })()
;