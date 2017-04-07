import {combineReducers} from 'redux';
import {routerReducer} from 'react-router-redux';

import lang from './lang';
import basket from './basket';

export default combineReducers({
    routing: routerReducer,
    lang,
    basket
});
