var admin=webpackJsonp_name_([2],{0:function(e,t,r){r(230),e.exports=r(399)},399:function(e,t,r){"use strict";function n(e){return e&&e.__esModule?e:{default:e}}var o=r(2),u=n(o),_=r(118),a=n(_),d=r(48),i=r(28),s=r(376),f=r(377),c=n(f),l=r(38),m=r(153),p=r(401),E=n(p),R=r(402),O=(0,i.createStore)(E.default,(0,s.composeWithDevTools)((0,i.applyMiddleware)(c.default))),y=(0,m.syncHistoryWithStore)(l.hashHistory,O);a.default.render(u.default.createElement(d.Provider,{store:O},u.default.createElement(l.Router,{history:y,routes:R.routes})),document.getElementById("root"));(function(){"undefined"!=typeof __REACT_HOT_LOADER__&&(__REACT_HOT_LOADER__.register(O,"store","/var/www/anycompb/frontend/src/admin/index.jsx"),__REACT_HOT_LOADER__.register(y,"history","/var/www/anycompb/frontend/src/admin/index.jsx"))})()},400:function(e,t,r){"use strict";function n(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0});var o=r(12),u=n(o),_=r(10),a=n(_),d=r(14),i=n(d),s=r(13),f=n(s),c=r(2),l=n(c),m=function(e){function t(){var e,r,n,o;(0,a.default)(this,t);for(var _=arguments.length,d=Array(_),s=0;s<_;s++)d[s]=arguments[s];return r=n=(0,i.default)(this,(e=t.__proto__||(0,u.default)(t)).call.apply(e,[this].concat(d))),n.render=function(){return l.default.createElement("div",null,"Admin HomePage")},o=r,(0,i.default)(n,o)}return(0,f.default)(t,e),t}(l.default.Component),p=m;t.default=p;(function(){"undefined"!=typeof __REACT_HOT_LOADER__&&(__REACT_HOT_LOADER__.register(m,"HomePage","/var/www/anycompb/frontend/src/admin/pages/HomePage.jsx"),__REACT_HOT_LOADER__.register(p,"default","/var/www/anycompb/frontend/src/admin/pages/HomePage.jsx"))})()},401:function(e,t,r){"use strict";Object.defineProperty(t,"__esModule",{value:!0});var n=r(28),o=r(153),u=(0,n.combineReducers)({routing:o.routerReducer});t.default=u;(function(){"undefined"!=typeof __REACT_HOT_LOADER__&&__REACT_HOT_LOADER__.register(u,"default","/var/www/anycompb/frontend/src/admin/reducers/index.jsx")})()},402:function(e,t,r){"use strict";function n(e){return e&&e.__esModule?e:{default:e}}Object.defineProperty(t,"__esModule",{value:!0}),t.routes=void 0;var o=r(2),u=n(o),_=r(38),a=r(400),d=n(a),i=t.routes=u.default.createElement("div",null,u.default.createElement(_.Route,{path:"/"},u.default.createElement(_.IndexRoute,{component:d.default})));(function(){"undefined"!=typeof __REACT_HOT_LOADER__&&__REACT_HOT_LOADER__.register(i,"routes","/var/www/anycompb/frontend/src/admin/routes.jsx")})()}});