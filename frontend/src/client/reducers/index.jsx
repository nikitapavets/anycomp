import {combineReducers} from 'redux';
import {routerReducer} from 'react-router-redux';

import lang from './lang';

export default combineReducers({
    routing: routerReducer,
    lang
});
